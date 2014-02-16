<?php

/**
 * A message between players or teams
 */
class Message extends Model
{

    /**
     * The ID of the group this message belongs to
     * @var int
     */
    protected $group_to;

    /**
     * The ID of the player who sent the message
     * @var int
     */
    protected $player_from;

    /**
     * The timestamp of when the message was sent
     * @var TimeDate
     */
    protected $timestamp;

    /**
     * The content of the message
     * @var string
     */
    protected $message;

    /**
     * The status of the message
     *
     * Can be 'sent', 'hidden', 'deleted' or 'reported'
     * @var string
     */
    protected $status;

    /**
     * The name of the database table used for queries
     */
    const TABLE = "messages";

    /**
     * @see Model::getColumns()
     */
    protected function getColumns() {
        $columns = parent::getColumns();
        $columns["group_to"] = Column::Int("group_to");
        $columns["player_from"] = Column::Int("player_from");
        $columns["timestamp"] = Column::DateTime("timestamp");
        $columns["message"] = Column::String("message");
        $columns["status"] = Column::String("status");

        return $columns;
    }

    /**
     * Get the content of the message
     * @return string The message itself
     */
    public function getContent() {
        return $this->message;
    }

    /**
     * Get a shorter, unformatted version of the message
     * @param int $maxlength The maximum characters of the summary
     * @return string
     */
    public function getSummary($maxlength=50) {
        $message = $this->message;

        if (mb_strlen($this->message) > $maxlength)
            return mb_substr($message, 0, $maxlength-1) . "...";

        return $message;
    }

    /**
     * Gets the creator of the message
     * @return Player An object representing the message's author
     */
    public function getAuthor() {
        return new Player($this->player_from);
    }

    /**
     * Gets a human-readable representation of the time when the message was sent
     * @return string
     */
    public function getCreationDate() {
        return $this->timestamp->diffForHumans();
    }

    /**
     * Create a new message
     *
     * @param int $to The id of the group the message is sent to
     * @param int $from The ID of the sender
     * @param string $message The body of the message
     * @param string $status The status of the message - can be 'sent', 'hidden', 'deleted' or 'reported'
     * @return Message An object that represents the sent message
     */
    public static function sendMessage($to, $from, $message, $status='sent')
    {
        $query = "INSERT INTO messages VALUES(NULL, ?, ?, NOW(), ?, ?)";
        $params = array($to, $from, $message, $status);

        $db = Database::getInstance();
        $db->query($query, "iiss", $params);

        $query = "UPDATE groups SET last_activity = NOW() WHERE id = ?";
        $params = array($to);
        $db->query($query, "i", $params);

        return new Message($db->getInsertId());
    }

    /**
     * Get all the messages in the database that are not disabled or deleted
     * @param int $id The id of the group whose messages are being retrieved
     * @return array An array of message IDs
     */
    public static function getMessages($id) {
        return parent::fetchIds("WHERE status NOT IN (?,?) AND group_to = ? ORDER BY timestamp ASC",
                              "ssi", array("hidden", "deleted", $id));
    }

}
