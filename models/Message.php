<?php
/**
 * This file contains functionality relating to all of actual messages sent by players
 *
 * @package    BZiON\Models
 * @license    https://github.com/allejo/bzion/blob/master/LICENSE.md GNU General Public License Version 3
 */

/**
 * A message between players or teams
 * @package    BZiON\Models
 */
class Message extends Model
{

    /**
     * The ID of the group this message belongs to
     * @var int
     */
    private $group_to;

    /**
     * The ID of the player who sent the message
     * @var int
     */
    private $player_from;

    /**
     * The timestamp of when the message was sent
     * @var TimeDate
     */
    private $timestamp;

    /**
     * The content of the message
     * @var string
     */
    private $message;

    /**
     * The status of the message
     *
     * Can be 'sent', 'hidden', 'deleted' or 'reported'
     * @var string
     */
    private $status;

    /**
     * The name of the database table used for queries
     */
    const TABLE = "messages";

    /**
     * Construct a new message
     * @param int $id The message's id
     */
    public function __construct($id)
    {
        parent::__construct($id);
        if (!$this->valid) return;

        $message = $this->result;

        $this->group_to = $message['group_to'];
        $this->player_from = $message['player_from'];
        $this->timestamp = new TimeDate($message['timestamp']);
        $this->message = $message['message'];
        $this->status = $message['status'];
    }

    /**
     * Get the content of the message
     * @return string The message itself
     */
    public function getContent()
    {
        return $this->message;
    }

    /**
     * Get a shorter, unformatted version of the message
     * @param  int    $maxlength The maximum characters of the summary
     * @return string
     */
    public function getSummary($maxlength=50)
    {
        $message = $this->message;

        if (mb_strlen($this->message) > $maxlength)
            return mb_substr($message, 0, $maxlength-1) . "...";

        return $message;
    }

    /**
     * Gets the creator of the message
     * @return Player An object representing the message's author
     */
    public function getAuthor()
    {
        return new Player($this->player_from);
    }

    /**
     * Gets a human-readable representation of the time when the message was sent
     * @return string
     */
    public function getCreationDate()
    {
        return $this->timestamp->diffForHumans();
    }

    /**
     * Create a new message
     *
     * @param  int     $to      The id of the group the message is sent to
     * @param  int     $from    The ID of the sender
     * @param  string  $message The body of the message
     * @param  string  $status  The status of the message - can be 'sent', 'hidden', 'deleted' or 'reported'
     * @return Message An object that represents the sent message
     */
    public static function sendMessage($to, $from, $message, $status='sent')
    {
        $query = "INSERT INTO messages VALUES(NULL, ?, ?, NOW(), ?, ?)";
        $params = array($to, $from, $message, $status);

        $db = Database::getInstance();
        $db->query($query, "iiss", $params);

        return new Message($db->getInsertId());
    }

    /**
     * Get all the messages in the database that are not disabled or deleted
     * @param  int       $id The id of the group whose messages are being retrieved
     * @return Message[] An array of message IDs
     */
    public static function getMessages($id)
    {
        return self::arrayIdToModel(self::fetchIds("WHERE status NOT IN (?,?) AND group_to = ? ORDER BY timestamp ASC",
                              "ssi", array("hidden", "deleted", $id)));
    }

}
