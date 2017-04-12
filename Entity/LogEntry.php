<?php
/**
 * Designmoves (http://www.designmoves.nl)
 * 
 * @copyright Copyright (c) 2017, Designmoves (http://www.designmoves.nl)
 * @license   http://code.designmoves.nl/licence/new-bsd New BSD License
 */

namespace Designmoves\Bundle\LogBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Description of LogEntry
 *
 * @ORM\Entity(repositoryClass="Designmoves\Bundle\LogBundle\Repository\LogEntryRepository")
 * @ORM\Table(name="application_log")
 */
class LogEntry
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="application_log_id")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $logEntryId;
    
    /**
     * @ORM\Column(type="datetime")
     */
    private $logDate;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private $message;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $context;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $priority;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $channel;
    
    /**
     * @var type* @ORM\Column(type="string", length=255, nullable=true)
     */
    private $statusCode;
    
    /**
     * @var type* @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ipAddress;

    /**
     * @var type* @ORM\Column(type="string", length=255, nullable=true)
     */
    private $theRequest;

    /**
     * @var type* @ORM\Column(type="string", length=255, nullable=true)
     */
    private $referrer;

    /**
     * @var type* @ORM\Column(type="string", length=255, nullable=true)
     */
    private $userAgent;
    
    /**
     * @ORM\PrePersist
     */
    public function setLogDateValue()
    {
        $this->logDate = new DateTime();
    }

    /**
     * Get LogEntryId
     *
     * @return integer
     */
    public function getLogEntryId()
    {
        return $this->logEntryId;
    }

    /**
     * Set logDate
     *
     * @param  DateTime $logDate
     * @return LogEntry
     */
    public function setLogDate(DateTime $logDate)
    {
        $this->logDate = $logDate;

        return $this;
    }

    /**
     * Get logDate
     *
     * @return DateTime
     */
    public function getLogDate()
    {
        return $this->logDate;
    }

    /**
     * Set message
     *
     * @param  string $message
     * @return LogEntry
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set context
     *
     * @param  string $context
     * @return LogEntry
     */
    public function setContext($context)
    {
        $this->context = $context;

        return $this;
    }

    /**
     * Get context
     *
     * @return string
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * Set priority
     *
     * @param  string $priority
     * @return LogEntry
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return string
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set channel
     *
     * @param  string $channel
     * @return LogEntry
     */
    public function setChannel($channel)
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * Get channel
     *
     * @return string
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * Set statusCode
     *
     * @param  string $statusCode
     * @return LogEntry
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * Get statusCode
     *
     * @return string
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Set ipAddress
     *
     * @param  string $ipAddress
     * @return LogEntry
     */
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;

        return $this;
    }

    /**
     * Get ipAddress
     *
     * @return string
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * Set theRequest
     *
     * @param  string $theRequest
     * @return LogEntry
     */
    public function setTheRequest($theRequest)
    {
        $this->theRequest = $theRequest;

        return $this;
    }

    /**
     * Get theRequest
     *
     * @return string
     */
    public function getTheRequest()
    {
        return $this->theRequest;
    }

    /**
     * Set referer
     *
     * @param  string $referrer
     * @return LogEntry
     */
    public function setReferrer($referrer)
    {
        $this->referrerer = $referrer;

        return $this;
    }

    /**
     * Get referrer
     *
     * @return string
     */
    public function getReferrer()
    {
        return $this->referrer;
    }

    /**
     * Set userAgent
     *
     * @param  string $userAgent
     * @return LogEntry
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    /**
     * Get userAgent
     *
     * @return string
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }
}
