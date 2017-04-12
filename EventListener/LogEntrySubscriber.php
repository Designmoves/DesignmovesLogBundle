<?php
/**
 * Designmoves (http://www.designmoves.nl)
 * 
 * @copyright Copyright (c) 2017, Designmoves (http://www.designmoves.nl)
 * @license   http://code.designmoves.nl/licence/new-bsd New BSD License
 */

namespace Designmoves\Bundle\LogBundle\EventListener;

use DateTime;
use Designmoves\Bundle\LogBundle\Entity\LogEntry as LogEntryEntity;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\ORM\Event\LifecycleEventArgs;

class LogEntrySubscriber implements EventSubscriber
{
    /**
     * {@inheritDoc}
     */
    public function getSubscribedEvents()
    {
        return array(
            Events::prePersist,
        );
    }

    /**
     * @param LifecycleEventArgs $arguments
     */
    public function prePersist(LifecycleEventArgs $arguments)
    {
        $entity = $arguments->getEntity();
        if (!$this->isTargetEntity($entity)) {
            return;
        }

        /* @var $entity LogEntryEntity */
        $entity->setLogDate(new DateTime());
    }
    
    /**
     * @param  mixed
     * @return bool
     */
    protected function isTargetEntity($entity)
    {
        return $entity instanceof LogEntryEntity;
    }
}
