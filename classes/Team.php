<?php

/**
 * A league team
 */
class Team extends Model
{

    /**
     * The name of the team
     *
     * @var string
     */
    protected $name;

    /**
     * The description of the team
     *
     * @var string
     */
    protected $description;

    /**
     * The url of the team's avatar
     *
     * @var string
     */
    protected $avatar;

    /**
     * The creation date of the teamm
     *
     * @var TimeDate
     */
    protected $created;

    /**
     * The team's current elo
     *
     * @var int
     */
    protected $elo;

    /**
     * The team's activity
     *
     * @var double
     */
    protected $activity;

    /**
     * The id of the team leader
     *
     * @var int
     */
    protected $leader;

    /**
     * The number of matches won
     *
     * @var int
     */
    protected $matches_won;

    /**
     * The number of matches lost
     *
     * @var int
     */
    protected $matches_lost;

    /**
     * The number of matches tied
     *
     * @var int
     */
    protected $matches_draw;

    /**
     * The total number of matches
     *
     * @var int
     */
    protected $matches_total;

    /**
     * The number of members
     *
     * @var int
     */
    protected $members;

    /**
     * The team's status
     *
     * @var string
     */
    protected $status;

    /**
     * The name of the database table used for queries
     */
    const TABLE = "teams";

    /**
     * @see Model::getColumns()
     */
    protected function getColumns() {
        $columns = parent::getColumns();
        $columns["name"] = Column::String("name");
        $columns["alias"] = Column::String("alias");
        $columns["description"] = Column::String("description");
        $columns["avatar"] = Column::String("avatar");
        $columns["created"] = Column::DateTime("created");
        $columns["elo"] = Column::Double("elo");
        $columns["activity"] = Column::Double("activity");
        $columns["leader"] = Column::Int("leader");
        $columns["matches_won"] = Column::Int("matches_won");
        $columns["matches_lost"] = Column::Int("matches_lost");
        $columns["matches_draw"] = Column::Int("matches_draw");
        $columns["members"] = Column::Int("members");
        $columns["status"] = Column::String("status");
        return $columns;
    }

    /**
     * Construct a new Team
     *
     * @param int $id The team's id
     */
    function __construct($id) {
        parent::__construct($id);
        $this->matches_total = $this->matches_won + $this->matches_lost + $this->matches_draw;
    }

    /**
     * Create a new team
     *
     * @param string $name The name of the team
     * @param int $leader The ID of the person creating the team, also the leader
     * @param string $avatar The URL to the team's avatar
     * @param string $description The team's description
     * @return Team An object that represents the newly created team
     */
    public static function createTeam($name, $leader, $avatar, $description) {
        $alias = Team::generateAlias($name);

        $db = Database::getInstance();

        $query = "INSERT INTO teams VALUES(NULL, ?, ?, ?, ?, NOW(), 1200, 0.00, ?, 0, 0, 0, 0, 'open')";
        $params = array(
            $name,
            $alias,
            $description,
            $avatar,
            $leader
        );

        $db->query($query, "ssssi", $params);
        $id = $db->getInsertId();

        // If the generateAlias() method couldn't find an appropriate alias,
        // just make it the same as the ID
        if ($alias === null) {
            $db->query("UPDATE teams SET alias = id WHERE id = ?", 'i', array(
                $id
            ));
        }

        $team = new Team($id);

        $team->addMember($leader);

        return $team;
    }

    /**
     * Get the members on the team
     *
     * @return array The members on the team
     */
    function getMembers() {
        return Player::fetchIds("WHERE team = ?", "i", array(
            $this->id
        ));
    }

    /**
     * Get the number of members on the team
     *
     * @return int The number of members on the team
     */
    function getNumMembers() {
        return $this->members;
    }

    /**
     * Get the total number of matches this team has played
     *
     * @return int The total number of matches this team has played
     */
    function getNumTotalMatches() {
        return $this->matches_total;
    }

    /**
     * Increment the team's match count by one
     *
     * @param string $type The type of the match. Can be 'win', 'draw' or 'loss'
     */
    function incrementMatchCount($type) {
        $this->changeMatchCount(1, $type);
    }

    /**
     * Decrement the team's match count by one
     *
     * @param string $type The type of the match. Can be 'win', 'draw' or 'loss'
     */
    function decrementMatchCount($type) {
        $this->changeMatchCount(-1, $type);
    }

    /**
     * Increment the team's match count
     *
     * @param int $adjust The number to add to the current matches number (negative to substract)
     * @param string $type The match count that should be changed. Can be 'win', 'draw' or 'loss'
     */
    function changeMatchCount($adjust, $type) {
        $this->matches_total += $adjust;

        switch ($type) {
            case "win":
            case "won":
                $this->update("matches_won", $this->matches_won += $adjust, "i");
                return;
            case "loss":
            case "lost":
                $this->update("matches_lost", $this->matches_lost += $adjust, "i");
                return;
            default:
                $this->update("matches_draw", $this->matches_draw += $adjust, "i");
                return;
        }
    }

    /**
     * Get the current elo of the team
     *
     * @return int The elo of the team
     */
    function getElo() {
        return $this->elo;
    }

    /**
     * Increase or decrease the ELO of the team
     *
     * @param int $adjust The value to be added to the current ELO (negative to substract)
     */
    function changeElo($adjust) {
        $this->elo += $adjust;
        $this->update("elo", $this->elo, "i");
    }

    /**
     * Get the name of the team
     *
     * @return string The name of the team
     */
    function getName() {
        if (!$this->valid)
            return "<em>None</em>";
        return $this->name;
    }

    /**
     * Get the activity of the team
     *
     * @return double The team's activity formated to two decimal places
     */
    function getActivity() {
        return sprintf("%.2f", $this->activity);
    }

    /**
     * Get the URL that points to the team's page
     *
     * @param string $dir The virtual directory the URL should point to
     * @param string $default The value that should be used if the alias is NULL. The object's ID will be used if a default value is not specified
     * @return string The team's URL, without a trailing slash
     */
    function getURL($dir = "teams", $default = NULL) {
        return parent::getURL($dir, $default);
    }

    /**
     * Get the URL that points to the team's list of matches
     *
     * @param string $dir The virtual directory the URL should point to
     * @param string $default The value that should be used if the alias is NULL. The object's ID will be used if a default value is not specified
     * @return string The team's list of matches
     */
    function getMatchesURL($dir = "matches", $default = NULL) {
        return parent::getURL($dir, $default);
    }

    /**
     * Get the leader of the team
     *
     * @return Player The object representing the team leader
     */
    function getLeader() {
        return new Player($this->leader);
    }

    /**
     * Get the creation date of the team
     *
     * @return string The creation date of the team
     */
    function getCreationDate() {
        return $this->created->diffForHumans();
    }

    /**
     * Adds a new member to the team
     *
     * @param int $id The id of the player to add to the team
     */
    function addMember($id) {
        $this->db->query("UPDATE players SET team=? WHERE id=?", "ii", array(
            $this->id,
            $id
        ));
        $this->update('members', ++$this->members, "i");
    }

    /**
     * Removes a member from the team
     *
     * *Warning*: This method does not check whether the player is already
     * a member of the team
     *
     * @param int $id The id of the player to remove
     */
    function removeMember($id) {
        $this->db->query("UPDATE players SET team=0 WHERE id=?", "i", array(
            $id
        ));
        $this->update('members', --$this->members, "i");
    }

    /**
     * Get the matches this team has participated in
     *
     * @return array The array of match IDs this team has participated in
     */
    function getMatches() {
        return Match::fetchIds("WHERE team_a=? OR team_b=?", "ii", array(
            $this->id,
            $this->id
        ));
    }

    /**
     * Get all the teams in the database that are not disabled or deleted
     *
     * @return array An array of Team IDs
     */
    public static function getTeams() {
        return parent::fetchIdsFrom("status", array(
            "disabled",
            "deleted"
        ), "s", true, "ORDER BY elo DESC");
    }

    /**
     * Gets a team object from the supplied alias
     *
     * @param string $alias The team's alias
     * @return Team The team's id
     */
    public static function getFromAlias($alias) {
        return new Team(self::fetchIdFrom($alias, "alias"));
    }
}
