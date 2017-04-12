<?php
/**
 * Designmoves (http://www.designmoves.nl)
 * 
 * @copyright Copyright (c) 2017, Designmoves (http://www.designmoves.nl)
 * @license   http://code.designmoves.nl/licence/new-bsd New BSD License
 */

namespace Designmoves\Bundle\LogBundle\Logger;

use Exception;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of DatabaseHandler
 */
class DatabaseHandler extends AbstractProcessingHandler
{
    /**
     * @var string
     */
    const LOG_QUERY = "
        INSERT INTO
          application_log
          (
            log_date,
            message,
            context,
            priority,
            channel,
            status_code,
            ip_address,
            the_request,
            referrer,
            user_agent
          )
          VALUES
          (
            NOW(),
            :message,
            :context,
            :priority,
            :channel,
            :statusCode,
            :ipAddress,
            :theRequest,
            :referrer,
            :userAgent
          )";

    /**
     * @var ContainerInterface
     */
    protected $container;
        
    /**
     * @var bool
     * 
     * Internal flag
     */
    private $initialized = false;
    
    /**
     * @param integer $level  The minimum logging level at which this handler will be triggered
     * @param boolean $bubble Whether the messages that are handled can bubble up the stack or not
     */
    public function __construct($level = Logger::DEBUG, $bubble = true)
    {
        parent::__construct($level, $bubble);
    }

    /**
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }
        
    /**
     * {@inheritdoc}
     */
    protected function write(array $record)
    {
        if (!$this->initialized) {
            $this->initialize();
        }

        try {
            $params = [
//                'dateTime' => $record['datetime'],
                'message' => isset($record['message'])
                    ? $record['message']
                    : null,
                'context' => null,
//                'context' => isset($record['context'])
//                    ? $record['context']
//                    : null,
                'priority' => isset($record['level'])
                    ? $record['level']
                    : null,
                'channel' => isset($record['channel'])
                    ? $record['channel']
                    : null,
                'statusCode' => isset($record['extra']['status_code'])
                    ? $record['extra']['status_code']
                    : null,
                'ipAddress' => isset($record['extra']['ip'])
                    ? $record['extra']['ip']
                    : null,
                'theRequest' => isset($record['extra']['the_request'])
                    ? $record['extra']['the_request']
                    : null,
                'referrer' => isset($record['extra']['referrer'])
                    ? $record['extra']['referrer']
                    : null,
                'userAgent'  => isset($record['extra']['user_agent'])
                    ? $record['extra']['user_agent']
                    : null,
            ];

            $this->statement->execute($params);
        } catch(Exception $exception) {
            // Fallback to just writing to php error logs if something really bad happens
            error_log($record['message']);
            error_log($exception->getMessage());                
        }
    }

    /**
     * Initialize DatabaseHandler
     * - get database connection
     * - initialize prepared statement
     */
    private function initialize()
    {
        $entityManager   = $this->container->get('doctrine')->getManager();
        $dbConnection    = $entityManager->getConnection();
        $this->statement = $dbConnection->prepare(self::LOG_QUERY);

        $this->initialized = true;
    }
}