<?php

namespace BZIon\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Player
 */
class Player
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $bzid;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $alias;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $avatar;

    /**
     * @var string
     */
    private $description;

    /**
     * @var integer
     */
    private $timezone;

    /**
     * @var \DateTime
     */
    private $joined;

    /**
     * @var \DateTime
     */
    private $lastLogin;

    /**
     * @var string
     */
    private $adminNotes;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set bzid
     *
     * @param string $bzid
     * @return Player
     */
    public function setBzid($bzid)
    {
        $this->bzid = $bzid;

        return $this;
    }

    /**
     * Get bzid
     *
     * @return string 
     */
    public function getBzid()
    {
        return $this->bzid;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return Player
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set alias
     *
     * @param string $alias
     * @return Player
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias
     *
     * @return string 
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Player
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     * @return Player
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return string 
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Player
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set timezone
     *
     * @param integer $timezone
     * @return Player
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;

        return $this;
    }

    /**
     * Get timezone
     *
     * @return integer 
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * Set joined
     *
     * @param \DateTime $joined
     * @return Player
     */
    public function setJoined($joined)
    {
        $this->joined = $joined;

        return $this;
    }

    /**
     * Get joined
     *
     * @return \DateTime 
     */
    public function getJoined()
    {
        return $this->joined;
    }

    /**
     * Set lastLogin
     *
     * @param \DateTime $lastLogin
     * @return Player
     */
    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    /**
     * Get lastLogin
     *
     * @return \DateTime 
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * Set adminNotes
     *
     * @param string $adminNotes
     * @return Player
     */
    public function setAdminNotes($adminNotes)
    {
        $this->adminNotes = $adminNotes;

        return $this;
    }

    /**
     * Get adminNotes
     *
     * @return string 
     */
    public function getAdminNotes()
    {
        return $this->adminNotes;
    }
    /**
     * @var \BZIon\Bundle\Entity\Country
     */
    private $country;


    /**
     * Set country
     *
     * @param \BZIon\Bundle\Entity\Country $country
     * @return Player
     */
    public function setCountry(\BZIon\Bundle\Entity\Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \BZIon\Bundle\Entity\Country 
     */
    public function getCountry()
    {
        return $this->country;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $bans;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->bans = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add bans
     *
     * @param \BZIon\Bundle\Entity\Ban $bans
     * @return Player
     */
    public function addBan(\BZIon\Bundle\Entity\Ban $bans)
    {
        $this->bans[] = $bans;

        return $this;
    }

    /**
     * Remove bans
     *
     * @param \BZIon\Bundle\Entity\Ban $bans
     */
    public function removeBan(\BZIon\Bundle\Entity\Ban $bans)
    {
        $this->bans->removeElement($bans);
    }

    /**
     * Get bans
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBans()
    {
        return $this->bans;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $discussions;


    /**
     * Add discussions
     *
     * @param \BZIon\Bundle\Entity\Discussion $discussions
     * @return Player
     */
    public function addDiscussion(\BZIon\Bundle\Entity\Discussion $discussions)
    {
        $this->discussions[] = $discussions;

        return $this;
    }

    /**
     * Remove discussions
     *
     * @param \BZIon\Bundle\Entity\Discussion $discussions
     */
    public function removeDiscussion(\BZIon\Bundle\Entity\Discussion $discussions)
    {
        $this->discussions->removeElement($discussions);
    }

    /**
     * Get discussions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDiscussions()
    {
        return $this->discussions;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $invitationsReceived;


    /**
     * Add invitationsReceived
     *
     * @param \BZIon\Bundle\Entity\Invitation $invitationsReceived
     * @return Player
     */
    public function addInvitationsReceived(\BZIon\Bundle\Entity\Invitation $invitationsReceived)
    {
        $this->invitationsReceived[] = $invitationsReceived;

        return $this;
    }

    /**
     * Remove invitationsReceived
     *
     * @param \BZIon\Bundle\Entity\Invitation $invitationsReceived
     */
    public function removeInvitationsReceived(\BZIon\Bundle\Entity\Invitation $invitationsReceived)
    {
        $this->invitationsReceived->removeElement($invitationsReceived);
    }

    /**
     * Get invitationsReceived
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInvitationsReceived()
    {
        return $this->invitationsReceived;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $messagesSent;


    /**
     * Add messagesSent
     *
     * @param \BZIon\Bundle\Entity\Message $messagesSent
     * @return Player
     */
    public function addMessagesSent(\BZIon\Bundle\Entity\Message $messagesSent)
    {
        $this->messagesSent[] = $messagesSent;

        return $this;
    }

    /**
     * Remove messagesSent
     *
     * @param \BZIon\Bundle\Entity\Message $messagesSent
     */
    public function removeMessagesSent(\BZIon\Bundle\Entity\Message $messagesSent)
    {
        $this->messagesSent->removeElement($messagesSent);
    }

    /**
     * Get messagesSent
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMessagesSent()
    {
        return $this->messagesSent;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $notifications;


    /**
     * Add notifications
     *
     * @param \BZIon\Bundle\Entity\Notification $notifications
     * @return Player
     */
    public function addNotification(\BZIon\Bundle\Entity\Notification $notifications)
    {
        $this->notifications[] = $notifications;

        return $this;
    }

    /**
     * Remove notifications
     *
     * @param \BZIon\Bundle\Entity\Notification $notifications
     */
    public function removeNotification(\BZIon\Bundle\Entity\Notification $notifications)
    {
        $this->notifications->removeElement($notifications);
    }

    /**
     * Get notifications
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNotifications()
    {
        return $this->notifications;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $pastCallsigns;


    /**
     * Add pastCallsigns
     *
     * @param \BZIon\Bundle\Entity\PastCallsign $pastCallsigns
     * @return Player
     */
    public function addPastCallsign(\BZIon\Bundle\Entity\PastCallsign $pastCallsigns)
    {
        $this->pastCallsigns[] = $pastCallsigns;

        return $this;
    }

    /**
     * Remove pastCallsigns
     *
     * @param \BZIon\Bundle\Entity\PastCallsign $pastCallsigns
     */
    public function removePastCallsign(\BZIon\Bundle\Entity\PastCallsign $pastCallsigns)
    {
        $this->pastCallsigns->removeElement($pastCallsigns);
    }

    /**
     * Get pastCallsigns
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPastCallsigns()
    {
        return $this->pastCallsigns;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $roles;


    /**
     * Add roles
     *
     * @param \BZIon\Bundle\Entity\Role $roles
     * @return Player
     */
    public function addRole(\BZIon\Bundle\Entity\Role $roles)
    {
        $this->roles[] = $roles;

        return $this;
    }

    /**
     * Remove roles
     *
     * @param \BZIon\Bundle\Entity\Role $roles
     */
    public function removeRole(\BZIon\Bundle\Entity\Role $roles)
    {
        $this->roles->removeElement($roles);
    }

    /**
     * Get roles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRoles()
    {
        return $this->roles;
    }
    /**
     * @var \BZIon\Bundle\Entity\Team
     */
    private $team;


    /**
     * Set team
     *
     * @param \BZIon\Bundle\Entity\Team $team
     * @return Player
     */
    public function setTeam(\BZIon\Bundle\Entity\Team $team = null)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return \BZIon\Bundle\Entity\Team 
     */
    public function getTeam()
    {
        return $this->team;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $visits;


    /**
     * Add visits
     *
     * @param \BZIon\Bundle\Entity\Visit $visits
     * @return Player
     */
    public function addVisit(\BZIon\Bundle\Entity\Visit $visits)
    {
        $this->visits[] = $visits;

        return $this;
    }

    /**
     * Remove visits
     *
     * @param \BZIon\Bundle\Entity\Visit $visits
     */
    public function removeVisit(\BZIon\Bundle\Entity\Visit $visits)
    {
        $this->visits->removeElement($visits);
    }

    /**
     * Get visits
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVisits()
    {
        return $this->visits;
    }
}
