<?php

/**
 * A ban imposed by an admin on a player
 */
class Ban extends Model {

    /**
     * The id of the banned player
     * @var int
     */
    protected $player;

    /**
     * The IP of the banned player if the league would like to implement a global ban list
     * @var string
     */
    protected $ipAddress;

    /**
     * The ban expiration date
     * @var TimeDate
     */
    protected $expiration;

    /**
     * The ban reason
     * @var string
     */
    protected $reason;

    /**
     * The ban creation date
     * @var TimeDate
     */
    protected $created;

    /**
     * The date the ban was last updated
     * @var TimeDate
     */
    protected $updated;

    /**
     * The id of the ban author
     * @var int
     */
    protected $author;

    /**
     * The name of the database table used for queries
     */
    const TABLE = "bans";

    /**
     * @see Model::getColumns()
     */
    protected function getColumns() {
        $columns = parent::getColumns();
        $columns["player"] = Column::Int("player");
        $columns["ipAddress"] = Column::String("ip_address");
        $columns["expiration"] = Column::DateTime("expiration");
        $columns["reason"] = Column::String("reason");
        $columns["created"] = Column::DateTime("created");
        $columns["updated"] = Column::DateTime("updated");
        $columns["author"] = Column::Int("expiration");

        return $columns;
    }

    /**
     * Get the player who was banned
     * @return Player The banned player
     */
    function getPlayer() {
        return new Player($this->player);
    }

    /**
     * Get the IP address of the banned player
     * @return string
     */
    function getIpAddress() {
        return $this->ipAddress;
    }

    /**
     * Get the expiration time of the ban
     * @return string The expiration time in a human readable form
     */
    function getExpiration() {
        return $this->expiration->diffForHumans();
    }

    /**
     * Get the ban's description
     * @return string
     */
    function getReason() {
        return $this->reason;
    }

    /**
     * Get the creation time of the ban
     * @return string The creation time in a human readable form
     */
    function getCreated() {
        return $this->created->diffForHumans();
    }

    /**
     * Get the time when the ban was last updated
     * @return string
     */
    function getUpdated() {
        return $this->updated->diffForHumans();
    }

    /**
     * Get the user who imposed the ban
     * @return Player The banner
     */
    function getAuthor() {
        return new Player($this->author);
    }

    /**
     * Checks whether the ban has expired
     * @return boolean True if the ban's expiration time has already passed
     */
    function hasExpired() {
        return TimeDate::now()->gte($this->expiration);
    }

    /**
     * Get all the bans in the database that aren't disabled or deleted
     * @return array An array of ban IDs
     */
    public static function getBans() {
        return parent::fetchIds("ORDER BY updated DESC");
    }

}
