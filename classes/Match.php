<?php

/**
 * A match played between two teams
 */
class Match extends Model
{

    /**
     * The ID of the first team of the match
     * @var int
     */
    protected $team_a;

    /**
     * The ID of the second team of the match
     * @var int
     */
    protected $team_b;

    /**
     * The match points (usually the number of flag captures) Team A scored
     * @var int
     */
    protected $team_a_points;

     /**
     * The match points Team B scored
     * @var int
     */
    protected $team_b_points;

     /**
     * The ELO score of Team A after the match
     * @var int
     */
    protected $team_a_elo_new;

     /**
     * The ELO score of Team B after the match
     * @var int
     */
    protected $team_b_elo_new;

    /**
     * The absolute value of the ELO score difference
     * @var int
     */
    protected $elo_diff;

    /**
     * The timestamp representing when the match was played
     * @var string
     */
    protected $timestamp;

    /**
     * The timestamp representing when the match information was last updated
     * @var string
     */
    protected $updated;

    /**
     * The duration of the match in minutes
     * @var int
     */
    protected $duration;

    /**
     * The ID of the person (i.e. referee) who last updated the match information
     * @var string
     */
    protected $entered_by;

    /**
     * The status of the match. Can be 'entered', 'disabled', 'deleted' or 'reported'
     * @var string
     */
    protected $status;

    /**
     * The name of the database table used for queries
     */
    const TABLE = "matches";

    /**
     * @see Model::getColumns()
     */
    protected function getColumns() {
        $columns = parent::getColumns();
        $columns["team_a"] = Column::Int("team_a");
        $columns["team_b"] = Column::Int("team_b");
        $columns["team_a_points"] = Column::Double("team_a_points");
        $columns["team_b_points"] = Column::Double("team_b_points");
        $columns["team_a_elo_new"] = Column::Double("team_a_elo_new");
        $columns["team_b_elo_new"] = Column::Double("team_b_elo_new");
        $columns["elo_diff"] = Column::Double("elo_diff");
        $columns["timestamp"] = Column::DateTime("timestamp");
        $columns["updated"] = Column::DateTime("updated");
        $columns["duration"] = Column::Double("duration");
        $columns["timestamp"] = Column::DateTime("timestamp");
        $columns["status"] = Column::String("status");

        return $columns;
    }

    /**
     * Get the timestamp of the match
     * @return string The match's timestamp
     */
    function getTimestamp() {
        return $this->timestamp->diffForHumans();
    }

    /**
     * Get the first team involved in the match
     * @return Team Team A's id
     */
    function getTeamA() {
        return new Team($this->team_a);
    }

    /**
     * Get the second team involved in the match
     * @return Team Team B's id
     */
    function getTeamB() {
        return new Team($this->team_b);
    }

    /**
     * Get the first team's points
     * @return int Team A's points
     */
    function getTeamAPoints() {
        return $this->team_a_points;
    }

    /**
     * Get the second team's points
     * @return int Team B's points
     */
    function getTeamBPoints() {
        return $this->team_b_points;
    }

    /**
     * Get the ELO difference applied to each team's old ELO
     * @return int The ELO difference
     */
    function getEloDiff() {
        return $this->elo_diff;
    }

    /**
     * Get the first team's new ELO
     * @return int Team A's new ELO
     */
    function getTeamAEloNew() {
        return $this->team_a_elo_new;
    }

    /**
     * Get the second team's new ELO
     * @return int Team B's new ELO
     */
    function getTeamBEloNew() {
        return $this->team_b_elo_new;
    }

    /**
     * Get the match duration
     * @return int The duration
     */
    function getDuration() {
        return $this->duration;
    }

    /**
     * Get the user who entered the match
     * @return Player
     */
    function getEnteredBy() {
        return new Player($this->entered_by);
    }

    /**
     * Determine whether the match was a draw
     * @return bool True if the match ended without any winning teams
     */
    function isDraw() {
        return $this->team_a_points == $this->team_b_points;
    }

    /**
     * Enter a new match to the database
     * @param int $a Team A's ID
     * @param int $b Team B's ID
     * @param int $a_points Team A's match points
     * @param int $b_points Team B's match points
     * @param int $duration The match duration in minutes
     * @param $entered_by
     * @param string $timestamp When the match was played
     * @return Match An object representing the match that was just entered
     */
    public static function enterMatch($a, $b, $a_points, $b_points, $duration, $entered_by, $timestamp = "now") {
        $db = Database::getInstance();

        $team_a = new Team($a);
        $team_b = new Team($b);
        $a_elo = $team_a->getElo();
        $b_elo = $team_b->getElo();

        $diff = Match::calculateEloDiff($a_elo, $b_elo, $a_points, $b_points, $duration);

        $a_elo += $diff;
        $b_elo -= $diff;

        // Update team ELOs
        $team_a->changeElo($diff);
        $team_b->changeElo(-$diff);

        $diff = abs($diff);

        $timestamp = new TimeDate($timestamp);

        $db->query("INSERT INTO matches (team_a, team_b, team_a_points, team_b_points, team_a_elo_new, team_b_elo_new, elo_diff, timestamp, updated, duration, entered_by, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?, ?, ?)",
        "iiiiiiisiis", array($a, $b, $a_points, $b_points, $a_elo, $b_elo, $diff, $timestamp->format(DATE_FORMAT), $duration, $entered_by, "entered"));

        $id = $db->getInsertId();

        // Update team match count
        if ($a_points == $b_points) {
            $team_a->incrementMatchCount("draw");
            $team_b->incrementMatchCount("draw");
        } elseif ($a_points > $b_points) {
            $team_a->incrementMatchCount("win");
            $team_b->incrementMatchCount("loss");
        } else {
            $team_a->incrementMatchCount("loss");
            $team_b->incrementMatchCount("win");
        }

        return new Match($id);
    }

    /**
     * Calculate the ELO score difference
     *
     * Computes the absolute value of the ELO score difference on each team
     * after a match, based on GU League's rules.
     *
     * @param int $a_elo Team A's current ELO score
     * @param int $b_elo Team B's current ELO score
     * @param int $a_points Team A's match points
     * @param int $b_points Team B's match points
     * @param int $duration The match duration in minutes
     * @return int The ELO score difference
     */
    public static function calculateEloDiff($a_elo, $b_elo, $a_points, $b_points, $duration) {
        $prob = 1.0 / (1 + pow(10, (($b_elo-$a_elo)/400.0)));
        if ($a_points > $b_points) {
           $diff = 50*(1-$prob);
        } else if ($a_points == $b_points) {
            $diff = 50*(0.5-$prob);
        } else {
            $diff = 50*(0-$prob);
        }

        $durations = unserialize(DURATION);

        foreach ($durations as $time => $modifier) {
            if ($duration == $time) {
                return floor($modifier*$diff);
            }
        }

        return floor($diff);
    }

    /**
     * Get all the matches in the database that aren't disabled or deleted
     * @return array An array of match IDs
     */
    public static function getMatches() {
        return parent::fetchIdsFrom("status", array("disabled", "deleted"), "s", true, 'ORDER BY timestamp DESC');
    }

}
