<?php

include_once(DOC_ROOT . "/includes/bzfquery.php");

/**
 * A BZFlag server
 */
class Server extends Model
{

    /**
     * The name of the server
     * @var string
     */
    protected $name;

    /**
     * The address of the server
     * @var string
     */
    protected $address;

    /**
     * The id of the owner of the server
     * @var int
     */
    protected $owner;

    /**
     * The server's bzfquery information
     * @var array
     */
    protected $info;

    /**
     * The date of the last bzfquery of the server
     * @var TimeDate
     */
    protected $updated;

    /**
     * The server's status
     * @var string
     */
    protected $status;

    /**
     * The name of the database table used for queries
     */
    const TABLE = "servers";

    /**
     * @see Model::getColumns()
     */
    protected function getColumns() {
        $columns = parent::getColumns();
        $columns["name"] = Column::String("name");
        $columns["address"] = Column::String("address");
        $columns["owner"] = Column::Int("owner");
        $columns["info"] = Column::DBArray("info");
        $columns["updated"] = Column::DateTime("updated");

        return $columns;
    }

    /**
     * Add a new server
     *
     * @param string $name The name of the server
     * @param string $address The address of the server (e.g: server.com:5155)
     * @param int $owner The ID of the server owner
     * @return Server An object that represents the sent message
     */
    static function addServer($name, $address, $owner) {
        $query = "INSERT INTO servers VALUES(NULL, ?, ?, ?, '', NOW(), 'active')";
        $params = array($name, $address, $owner);

        $db = Database::getInstance();
        $db->query($query, "ssi", $params);

        $server = new Server($db->getInsertId());
        $server->forceUpdate();

        return $server;
    }

    /**
     * Update the server with current bzfquery information
     */
    function forceUpdate() {
        $this->info = bzfquery($this->address);
        $this->updated = TimeDate::now();
        $this->db->query("UPDATE servers SET info = ?, updated = NOW() WHERE id = ?", "si", array(serialize($this->info), $this->id));
    }

    /**
     * Checks if the server is online (listed on the public list server)
     * @return bool Whether the server is online
     */
    function isOnline() {
        $servers = file(LIST_SERVER);
        foreach ($servers as $server) {
            list($host, $protocol, $hex, $ip, $title) = explode(' ', $server, 5);
            if ($this->address == $host) {
                return true;
            }
        }
        return false;
    }

    /**
     * Checks if the server has players
     * @return bool Whether the server has any players
     */
    function hasPlayers() {
        return $this->info['numPlayers'] > 0;
    }

    /**
     * Gets the number of players on the server
     * @return int The number of players
     */
    function numPlayers() {
        return $this->info['numPlayers'];
    }

    /**
     * Gets the players on the server
     * @return array The players on the server
     */
    function getPlayers() {
        return $this->info['player'];
    }

    /**
     * Checks if the last update is older than or equal to the update interval
     * @return bool Whether the information is older than the update interval
     */
    function staleInfo() {
        $update_time = $this->updated->copy();
        $update_time->addMinutes(UPDATE_INTERVAL);
        return TimeDate::now()->gte($update_time);
    }

    /**
     * Gets the server's ip address
     * @return string The server's ip address
     */
    function getServerIp() {
        return $this->info['ip'];
    }

    /**
     * Get the server's name
     * @return string
     */
    function getName() {
        return $this->name;
    }

    /**
     * Get the server's IP address or hostname
     * @return string
     */
    function getAddress() {
        return $this->address;
    }

    /**
     * Get when the server information was last updated
     * @return string
     */
    function getUpdated() {
        return $this->updated->format(DATE_FORMAT);
    }

    /**
     * Returns the amount of time passed since the server was
     * last updated in a human-readable form
     * @return string
     */
    function lastUpdate() {
        return $this->updated->diffForHumans();
    }

    /**
     * Get all the servers in the database that have an active status
     * @return array An array of server IDs
     */
    public static function getServers() {
        return parent::fetchIdsFrom("status", array("active"), "s");
    }

}
