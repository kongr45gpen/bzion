<?php

/**
 * A league player
 */
class Player extends Model
{

    /**
     * The bzid of the player
     * @var int
     */
    protected $bzid;

    /**
     * The id of the player's team
     * @var int
     */
    protected $team;

    /**
     * The username of the player
     * @var string
     */
    protected $username;

    /**
     * The player's status
     * @var string
     */
    protected $status;

    /**
     * The access level of the player
     * @var int
     */
    protected $access;

    /**
     * The url of the player's profile avatar
     * @var string
     */
    protected $avatar;

    /**
     * The player's profile description
     * @var string
     */
    protected $description;

    /**
     * The id of the player's country
     * @var int
     */
    protected $country;

    /**
     * The player's timezone, in terms of distance from UTC (i.e. -5 for UTC-5)
     * @var int
     */
    protected $timezone;

    /**
     * The date the player joined the site
     * @var TimeDate
     */
    protected $joined;

    /**
     * The date of the player's last login
     * @var TimeDate
     */
    protected $last_login;

    /**
     * A section for admins to write notes about players
     * @var string
     */
    protected $admin_notes;

    /**
     * The name of the database table used for queries
     */
    const TABLE = "players";

    /**
     * @see Model::getColumns()
     */
    protected function getColumns() {
        $columns = parent::getColumns();
        $columns["bzid"] = Column::Int("bzid");
        $columns["username"] = Column::String("username");
        $columns["alias"] = Column::String("alias");
        $columns["team"] = Column::Int("team");
        $columns["status"] = Column::String("status");
        $columns["access"] = Column::Int("access");
        $columns["avatar"] = Column::String("avatar");
        $columns["description"] = Column::String("description");
        $columns["country"] = Column::Int("country");
        $columns["timezone"] = Column::Double("timezone");
        $columns["joined"] = Column::DateTime("joined");
        $columns["last_login"] = Column::DateTime("last_login");
        $columns["admin_notes"] = Column::String("admin_notes");

        return $columns;
    }

    /**
     * Updates this player's last login
     * @param string $when The date of the last login
     */
    function updateLastLogin($when = "now") {
        $last = new TimeDate($when);
        $this->db->query("UPDATE players SET last_login = ? WHERE id = ?", "si", array($last->format(DATE_FORMAT), $this->id));
    }

    /**
     * Get the player's username
     * @return string The username
     */
    function getUsername() {
        return $this->username;
    }

    /**
     * Get the player's BZID
     * @return int The BZID
     */
    function getBZID() {
        return $this->bzid;
    }

    /**
     * Get a player's alias
     * @return string|int The alias (or BZID if the alias doesn't exist)
     */
    public function getAlias() {
        if ($this->alias != null)
            return $this->alias;
        return $this->getBZID();
    }

    /**
     * Get the player's avatar
     * @return string The URL for the avatar
     */
    function getAvatar() {
        return $this->avatar;
    }

    /**
     * Set the player's avatar
     * @param string $avatar The URL for the avatar
     */
    function setAvatar($avatar) {
        $this->db->query("UPDATE players SET avatar = ? WHERE id = ?", "si", array($avatar, $this->id));
    }

    /**
     * Get the player's sanitized description
     * @return string The description
     */
    function getDescription() {
        return htmlspecialchars($this->description);
    }

    /**
     * Get the player's description, exactly as it is saved in the database
     * @return string The description
     */
    function getRawDescription() {
        return $this->description;
    }

    /**
     * Set the player's description
     * @param string $description The description
     */
    function setDescription($description) {
        $this->db->query("UPDATE players SET description = ? WHERE id = ?", "si", array($description, $this->id));
    }

    /**
     * Get the player's timezone
     * @return string The timezone
     */
    function getTimezone() {
        return $this->timezone;
    }

    /**
     * Set the player's timezone
     * @param string $timezone The timezone
     */
    function setTimezone($timezone) {
        $this->db->query("UPDATE players SET timezone = ? WHERE id = ?", "si", array($timezone, $this->id));
    }

    /**
     * Get the notes admins have left about a player
     * @return string The notes
     */
    function getAdminNotes() {
        return $this->admin_notes;
    }

    /**
     * Get the player's team
     * @return Team The object representing the team
     */
    function getTeam() {
        return new Team($this->team);
    }

    /**
     * Get the joined date of the player
     * @return string The joined date of the player
     */
    function getJoinedDate() {
        return $this->joined->diffForHumans();
    }

    /**
     * Get the last login for a player
     * @param bool $human Whether to get the literal time stamp or a relative time
     * @return string The date of the last login
     */
    function getLastLogin($human = true) {
        if ($human)
            return $this->last_login->diffForHumans();
        else
            return $this->last_login;
    }

    /**
     * Get all of the callsigns a player has used to log in to the website
     * @todo Fix for bzids
     */
    function getPastCallsigns() {
        return Parent::fetchIds("username", "WHERE player = ?", "i", array($this->id), "past_callsigns");
    }

    /**
     * Enter a new player to the database
     * @param int $bzid The player's bzid
     * @param string $username The player's username
     * @param int $team The player's team
     * @param string $status The player's status
     * @param int $access The player's access level
     * @param string $avatar The player's profile avatar
     * @param string $description The player's profile description
     * @param int $country The player's country
     * @param int $timezone The player's timezone
     * @param string|\TimeDate $joined The date the player joined
     * @param string|\TimeDate $last_login The timestamp of the player's last login
     * @return Player An object representing the player that was just entered
     */
    public static function newPlayer($bzid, $username, $team=0, $status="active", $access=0, $avatar="", $description="", $country=0, $timezone=0, $joined="now", $last_login="now") {

        $db = Database::getInstance();

        $joined = new TimeDate($joined);
        $last_login = new TimeDate($last_login);

        $db->query("INSERT INTO players (bzid, team, username, alias, status, access, avatar, description, country, timezone, joined, last_login) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
        "iisssissiiss", array($bzid, $team, $username, Player::generateAlias($username), $status, $access, $avatar, $description, $country, $timezone, $joined->format(DATE_FORMAT), $last_login->format(DATE_FORMAT)));

        return new Player($db->getInsertId());
    }

    /**
     * Determine if a player exists in the database
     * @param int $bzid The player's bzid
     * @return bool Whether the player exists in the database
     */
    public static function playerBZIDExists($bzid) {
        return self::getFromBZID($bzid)->isValid();
    }

    /**
     * Given a player's BZID, get a player object
     *
     * @param int $bzid The player's BZID
     * @return Player
     */
    public static function getFromBZID($bzid) {
        return new Player(self::fetchIdFrom($bzid, "bzid", "s"));
    }

    /**
     * Get all the players in the database that have an active status
     * @return array An array of player BZIDs
     */
    public static function getPlayers() {
        return parent::fetchIdsFrom("status", array("active"), "s", false);
    }

    /**
     * Get a URL that points to the player's page
     * @param string $dir The virtual directory the URL should point to
     * @param string $default The value that should be used if the alias is NULL. The object's ID will be used if a default value is not specified
     * @return string The URL
     */
    function getURL($dir="players", $default="id") {
        return parent::getURL($dir, $this->$default);
    }

    /**
     * Generate a URL-friendly unique alias for a username
     * @param string $name The original username
     * @return string The generated alias
     */
    static function generateAlias($name) {
        $name = strtolower($name);
        $name = str_replace(' ', '-', $name);

        // An alias name can't only contain numbers, because it will be
        // indistinguishable from an ID. If it does, add a dash in the end.
        if (preg_match("/^[0-9]+$/", $name)) {
            $name = $name . '-';
        }

        // Try to find duplicates
        $db = Database::getInstance();
        $result = $db->query("SELECT alias FROM players WHERE alias REGEXP ?", 's',
                  array("^". preg_quote($name) ."[0-9]*$"));

        // The functionality of the following code block is provided in PHP 5.5's
        // array_column function. What is does is convert the multi-dimensional
        // array that $db->query() gave us into a single-dimensional one.
        $aliases = array();
        if (is_array($result)) {
            foreach ($result as $r) {
                $aliases[] = $r['alias'];
            }
        }

        // No duplicates found
        if (!in_array($name, $aliases))
            return $name;

        // If there's already an entry with the alias we generated, put a number
        // in the end of it and keep incrementing it until there is we find
        // an open spot.
        $i = 2;
        while(in_array($name.$i, $aliases)) {
            $i++;
        }

        return $name.$i;
    }

    /**
     * Gets a player object from the supplied alias
     * @param string $alias The player's alias
     * @return Player The player
     */
    public static function getFromAlias($alias) {
        return new Player(parent::fetchIdFrom($alias, "alias", "s"));
    }

    /**
     * Add a player's callsign to the database if it does not exist as a past callsign
     * @param string $id The ID for the player whose callsign we're saving
     * @param string $username The callsign which we are saving if it doesn't exist
     */
    public static function saveUsername($id, $username) {
        $db = Database::getInstance();

        $db->query("INSERT IGNORE INTO `past_callsigns` (id, player, username) VALUES (?, ?, ?)", "iis", array(NULL, $id, $username));
    }
}
