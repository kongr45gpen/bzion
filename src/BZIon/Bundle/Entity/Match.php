<?php

namespace BZIon\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Match
 */
class Match
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $teamAPoints;

    /**
     * @var integer
     */
    private $teamBPoints;

    /**
     * @var integer
     */
    private $teamAEloNew;

    /**
     * @var integer
     */
    private $teamBEloNew;

    /**
     * @var string
     */
    private $mapPlayed;

    /**
     * @var array
     */
    private $matchDetails;

    /**
     * @var integer
     */
    private $port;

    /**
     * @var string
     */
    private $server;

    /**
     * @var string
     */
    private $replayFile;

    /**
     * @var integer
     */
    private $eloDiff;

    /**
     * @var \DateTime
     */
    private $timestamp;

    /**
     * @var \DateTime
     */
    private $updated;

    /**
     * @var integer
     */
    private $duration;

    /**
     * @var string
     */
    private $status;


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
     * Set teamAPoints
     *
     * @param integer $teamAPoints
     * @return Game
     */
    public function setTeamAPoints($teamAPoints)
    {
        $this->teamAPoints = $teamAPoints;

        return $this;
    }

    /**
     * Get teamAPoints
     *
     * @return integer
     */
    public function getTeamAPoints()
    {
        return $this->teamAPoints;
    }

    /**
     * Set teamBPoints
     *
     * @param integer $teamBPoints
     * @return Game
     */
    public function setTeamBPoints($teamBPoints)
    {
        $this->teamBPoints = $teamBPoints;

        return $this;
    }

    /**
     * Get teamBPoints
     *
     * @return integer
     */
    public function getTeamBPoints()
    {
        return $this->teamBPoints;
    }

    /**
     * Set teamAEloNew
     *
     * @param integer $teamAEloNew
     * @return Game
     */
    public function setTeamAEloNew($teamAEloNew)
    {
        $this->teamAEloNew = $teamAEloNew;

        return $this;
    }

    /**
     * Get teamAEloNew
     *
     * @return integer
     */
    public function getTeamAEloNew()
    {
        return $this->teamAEloNew;
    }

    /**
     * Set teamBEloNew
     *
     * @param integer $teamBEloNew
     * @return Game
     */
    public function setTeamBEloNew($teamBEloNew)
    {
        $this->teamBEloNew = $teamBEloNew;

        return $this;
    }

    /**
     * Get teamBEloNew
     *
     * @return integer
     */
    public function getTeamBEloNew()
    {
        return $this->teamBEloNew;
    }

    /**
     * Set mapPlayed
     *
     * @param string $mapPlayed
     * @return Game
     */
    public function setMapPlayed($mapPlayed)
    {
        $this->mapPlayed = $mapPlayed;

        return $this;
    }

    /**
     * Get mapPlayed
     *
     * @return string
     */
    public function getMapPlayed()
    {
        return $this->mapPlayed;
    }

    /**
     * Set matchDetails
     *
     * @param array $matchDetails
     * @return Game
     */
    public function setMatchDetails($matchDetails)
    {
        $this->matchDetails = $matchDetails;

        return $this;
    }

    /**
     * Get matchDetails
     *
     * @return array
     */
    public function getMatchDetails()
    {
        return $this->matchDetails;
    }

    /**
     * Set port
     *
     * @param integer $port
     * @return Game
     */
    public function setPort($port)
    {
        $this->port = $port;

        return $this;
    }

    /**
     * Get port
     *
     * @return integer
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Set server
     *
     * @param string $server
     * @return Game
     */
    public function setServer($server)
    {
        $this->server = $server;

        return $this;
    }

    /**
     * Get server
     *
     * @return string
     */
    public function getServer()
    {
        return $this->server;
    }

    /**
     * Set replayFile
     *
     * @param string $replayFile
     * @return Game
     */
    public function setReplayFile($replayFile)
    {
        $this->replayFile = $replayFile;

        return $this;
    }

    /**
     * Get replayFile
     *
     * @return string
     */
    public function getReplayFile()
    {
        return $this->replayFile;
    }

    /**
     * Set eloDiff
     *
     * @param integer $eloDiff
     * @return Game
     */
    public function setEloDiff($eloDiff)
    {
        $this->eloDiff = $eloDiff;

        return $this;
    }

    /**
     * Get eloDiff
     *
     * @return integer
     */
    public function getEloDiff()
    {
        return $this->eloDiff;
    }

    /**
     * Set timestamp
     *
     * @param \DateTime $timestamp
     * @return Game
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timestamp
     *
     * @return \DateTime
     */
    public function getTimestamp($timestamp)
    {
        return $this->$timestamp;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Game
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     * @return Game
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return integer
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Game
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
     * @var array
     */
    private $teamAPlayers;

    /**
     * @var array
     */
    private $teamBPlayers;


    /**
     * Set teamAPlayers
     *
     * @param array $teamAPlayers
     * @return Match
     */
    public function setTeamAPlayers($teamAPlayers)
    {
        $this->teamAPlayers = $teamAPlayers;

        return $this;
    }

    /**
     * Get teamAPlayers
     *
     * @return array 
     */
    public function getTeamAPlayers()
    {
        return $this->teamAPlayers;
    }

    /**
     * Set teamBPlayers
     *
     * @param array $teamBPlayers
     * @return Match
     */
    public function setTeamBPlayers($teamBPlayers)
    {
        $this->teamBPlayers = $teamBPlayers;

        return $this;
    }

    /**
     * Get teamBPlayers
     *
     * @return array 
     */
    public function getTeamBPlayers()
    {
        return $this->teamBPlayers;
    }
    /**
     * @var \BZIon\Bundle\Entity\team
     */
    private $teamA;

    /**
     * @var \BZIon\Bundle\Entity\team
     */
    private $teamB;


    /**
     * Set teamA
     *
     * @param \BZIon\Bundle\Entity\team $teamA
     * @return Match
     */
    public function setTeamA(\BZIon\Bundle\Entity\team $teamA = null)
    {
        $this->teamA = $teamA;

        return $this;
    }

    /**
     * Get teamA
     *
     * @return \BZIon\Bundle\Entity\team 
     */
    public function getTeamA()
    {
        return $this->teamA;
    }

    /**
     * Set teamB
     *
     * @param \BZIon\Bundle\Entity\team $teamB
     * @return Match
     */
    public function setTeamB(\BZIon\Bundle\Entity\team $teamB = null)
    {
        $this->teamB = $teamB;

        return $this;
    }

    /**
     * Get teamB
     *
     * @return \BZIon\Bundle\Entity\team 
     */
    public function getTeamB()
    {
        return $this->teamB;
    }
    /**
     * @var \BZIon\Bundle\Entity\Player
     */
    private $enteredBy;


    /**
     * Set enteredBy
     *
     * @param \BZIon\Bundle\Entity\Player $enteredBy
     * @return Match
     */
    public function setEnteredBy(\BZIon\Bundle\Entity\Player $enteredBy)
    {
        $this->enteredBy = $enteredBy;

        return $this;
    }

    /**
     * Get enteredBy
     *
     * @return \BZIon\Bundle\Entity\Player 
     */
    public function getEnteredBy()
    {
        return $this->enteredBy;
    }
}
