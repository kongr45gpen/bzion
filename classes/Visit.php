<?php

/**
 * A player's visit on the website
 */
class Visit extends Model
{

    /**
     * The id of the visiting user
     * @var int
     */
    protected $player;

    /**
     * The ip of the visiting user
     * @var string
     */
    protected $ip;

    /**
     * The host of the visiting user
     * @var string
     */
    protected $host;

    /**
     * The user agent of the visiting user
     * @var string
     */
    protected $user_agent;

    /**
     * The HTTP_REFERER of the visiting user
     * @var string
     */
    protected $referer;

    /**
     * The timestamp of the visit
     * @var DateTime
     */
    protected $timestamp;

    /**
     * The name of the database table used for queries
     */
    const TABLE = "visits";

    /**
     * @see Model::getColumns()
     */
    protected function getColumns() {
        $columns = parent::getColumns();
        $columns["player"] = Column::Int("player");
        $columns["ip"] = Column::String("ip");
        $columns["host"] = Column::String("host");
        $columns["user_agent"] = Column::String("user_agent");
        $columns["referer"] = Column::String("referer");
        $columns["timestamp"] = Column::DateTime("timestamp");

        return $columns;
    }

    /**
     * Enter a new visit into the database
     * @param int $visitor The visitor's id
     * @param string $ip The visitor's ip address
     * @param string $host The visitor's host
     * @param string $user_agent The visitor's user agent
     * @param string $referrer The HTTP_REFERRER of the visit
     * @param string $timestamp The timestamp of the visit
     * @return Visit An object representing the visit that was just entered
     */
    public static function enterVisit($visitor, $ip, $host, $user_agent, $referrer, $timestamp = "now") {
        $db = Database::getInstance();

        $timestamp = new DateTime($timestamp);

        $db->query("INSERT INTO visits (player, ip, host, user_agent, referer, timestamp) VALUES (?, ?, ?, ?, ?, ?)",
        "isssss", array($visitor, $ip, $host, $user_agent, $referrer, $timestamp->format(DATE_FORMAT)));

        return new Visit($db->getInsertId());
    }

}
