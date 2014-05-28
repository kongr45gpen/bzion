<?php
/**
 * This file contains functionality relating to the participants of a group message
 *
 * @package    BZiON\Models
 * @license    https://github.com/allejo/bzion/blob/master/LICENSE.md GNU General Public License Version 3
 */

/**
 * A discussion (group of messages)
 * @package    BZiON\Models
 */
class Group extends UrlModel
{
    /**
     * The subject of the group
     * @var string
     */
    private $subject;

    /**
     * The time of the last message to the group
     * @var TimeDate
     */
    private $last_activity;

    /**
     * The id of the creator of the group
     * @var int
     */
    private $creator;

    /**
     * The status of the group
     *
     * Can be 'active', 'disabled', 'deleted' or 'reported'
     * @var string
     */
    private $status;

    /**
     * The name of the database table used for queries
     */
    const TABLE = "groups";

    /**
     * Construct a new group
     * @param int $id The group's id
     */
    public function __construct($id)
    {
        parent::__construct($id);
        if (!$this->valid) return;

        $group = $this->result;

        $this->subject = $group['subject'];
        $this->last_activity = TimeDate::parse($group['last_activity']);
        $this->creator = $group['creator'];
        $this->status = $group['status'];
    }

    /**
     * Get the subject of the discussion
     *
     * @return string
     **/
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Get the creator of the discussion
     *
     * @return Player
     */
    public function getCreator()
    {
        return new Player($this->creator);
    }

    /**
     * Determine whether a player is the one who created the message group
     *
     * @param  int  $id The ID of the player to test for
     * @return bool
     */
    public function isCreator($id)
    {
        return ($this->creator == $id);
    }

    /**
     * Get the time when the group was most recently active
     *
     * @param  bool            $human True to output the last activity in a human-readable string, false to return a TimeDate object
     * @return string|TimeDate
     */
    public function getLastActivity($human = true)
    {
        if ($human)
            return $this->last_activity->diffForHumans();
        else
            return $this->last_activity;
    }

    /**
     * Update the team's last activity timestamp
     *
     * @return void
     */
    public function updateLastActivity()
    {
        $this->last_activity = TimeDate::now();
        $this->update('last_activity', $this->last_activity->format("Y-m-d H:i:s"), 's');
    }

    /**
     * Get the last message of the group
     *
     * @return Message
     */
    public function getLastMessage()
    {
        $ids = self::fetchIdsFrom('group_to', array($this->id), 'i', false, 'ORDER BY id DESC LIMIT 0,1', 'messages');

        return new Message($ids[0]);
    }

    /**
     * {@inheritDoc}
     */
    protected static function getRouteName($action='show')
    {
        return "message_" . $action . "_discussion";
    }

    /**
     * {@inheritDoc}
     */
    public static function getParamName()
    {
        return "discussion";
    }

    /**
     * Get a list containing the IDs of each member of the group
     * @param  int|null $hide The ID of a player to ignore
     * @return Player[] An array of players
     */
    public function getMembers($hide=null)
    {
        $additional_query = "WHERE `group` = ?";
        $types = "i";
        $params = array($this->id);

        if ($hide) {
            $additional_query .= " AND `player` != ?";
            $types .= "i";
            $params[] = $hide;
        }

        return Player::arrayIdToModel(parent::fetchIds($additional_query, $types, $params, "player_groups", "player"));
    }

    /**
     * Create a new message group
     *
     * @param  string $subject   The subject of the group
     * @param  int    $creatorId The ID of the player who created the group
     * @param  array  $members   A list of IDs representing the group's members
     * @return Group  An object that represents the created group
     */
    public static function createGroup($subject, $creatorId, $members=array())
    {
        $query = "INSERT INTO groups(subject, creator, last_activity, status) VALUES(?, ?, NOW(), ?)";
        $params = array($subject, $creatorId, "active");

        $db = Database::getInstance();
        $db->query($query, "sis", $params);
        $groupid = $db->getInsertId();

        foreach ($members as $mid) {
            $query = "INSERT INTO `player_groups` (`player`, `group`) VALUES(?, ?)";
            $db->query($query, "ii", array($mid, $groupid));
        }

        return new Group($groupid);
    }

    /**
     * Send a new message to the group's members
     * @param  Player  $from    The sender
     * @param  string  $message The body of the message
     * @param  string  $status  The status of the message - can be 'sent', 'hidden', 'deleted' or 'reported'
     * @return Message An object that represents the sent message
     */
    public function sendMessage(&$from, $message, $status='sent')
    {
        $message = Message::sendMessage($this->getId(), $from->getId(), $message, $status);

        $this->updateLastActivity();
        foreach ($this->getMembers($from->getId()) as $member) {
            $member->notify("{$from->getUsername()} has sent you a new message in {$this->getSubject()}");
        }

        return $message;
    }

    /**
     * Get all the groups in the database a player belongs to that are not disabled or deleted
     * @todo Move this to the Player class
     * @param  int     $id The id of the player whose groups are being retrieved
     * @return Group[] An array of group objects
     */
    public static function getGroups($id)
    {
        $additional_query = "LEFT JOIN groups ON player_groups.group=groups.id
                             WHERE player_groups.player = ? AND groups.status
                             NOT IN (?, ?) ORDER BY last_activity DESC";
        $params = array($id, "disabled", "deleted");

        return self::arrayIdToModel(self::fetchIds($additional_query, "iss", $params, "player_groups", "groups.id"));
    }

    /**
     * Checks if a player belongs in the group
     * @param  int  $id The ID of the player
     * @return bool True if the player belongs in the group, false if they don't
     */
    public function isMember($id)
    {
        $result = $this->db->query("SELECT 1 FROM `player_groups` WHERE `group` = ?
                                    AND `player` = ?", "ii", array($this->id, $id));

        return count($result) > 0;
    }

    /**
     * Checks if a player has a new message in the group
     *
     * @todo Make this method work
     * @param  int     $id The ID of the player
     * @return boolean True if the player has a new message
     */
    public static function hasNewMessage($id)
    {
        $groups = self::getGroups($id);
        $me = new Player($id);

        foreach ($groups as $group) {

            // THIS DOESNT WORK
            if ($me->getLastlogin(false)->gt($group->getLastActivity(false))) {
                return true;
            }
        }

        return false;
    }

}
