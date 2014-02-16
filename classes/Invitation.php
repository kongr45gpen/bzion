<?php

/**
 * An invitation sent to a player asking them to join a team
 */
class Invitation extends Model
{

    /**
     * The ID of the player receiving the invite
     * @var int
     */
    protected $invited_player;

    /**
     * The ID of the sender of the invite
     * @var int
     */
    protected $sent_by;

    /**
     * The ID of the team a player was invited to
     * @var int
     */
    protected $team;

    /**
     * The time the invitation will expire (Format: YYYY-MM-DD HH:MM:SS)
     * @var DateTime
     */
    protected $expiration;

    /**
     * The optional message sent to a player to join a team
     * @var string
     */
    protected $text;

    /**
     * The name of the database table used for queries
     */

    const TABLE = "invitations";

    /**
     * @see Model::getColumns()
     */
    protected function getColumns() {
        $columns = parent::getColumns();
        $columns["invited_player"] = Column::Int("invited_player");
        $columns["sent_by"] = Column::Int("sent_by");
        $columns["team"] = Column::Int("team");
        $columns["expiration"] = Column::DateTime("expiration");
        $columns["text"] = Column::String("text");

        return $columns;
    }

    /**
     * Send an invitation to join a team
     * @param int $to The ID of the player who will receive the invitation
     * @param int $from The ID of the player who sent it
     * @param int $teamid The team ID to which a player has been invited to
     * @param string $message (Optional) The message that will be displayed to the person receiving the invitation
     * @return Invitation The object of the invitation just sent
     */
    public static function sendInvite($to, $from, $teamid, $message = "") {
        $db = Database::getInstance();
        $db->query("INSERT INTO invitations VALUES (NULL, ?, ?, ?, ADDDATE(NOW(), INTERVAL 7 DAY), ?)", "iis", array($to, $from, $teamid, $message));

        return new Invitation($db->getInsertId());
    }

}
