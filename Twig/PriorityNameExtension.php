<?php
/**
 * Designmoves (http://www.designmoves.nl)
 * 
 * @copyright Copyright (c) 2017, Designmoves (http://www.designmoves.nl)
 * @license   http://code.designmoves.nl/licence/new-bsd New BSD License
 */

namespace Designmoves\Bundle\LogBundle\Twig;

use ReflectionClass;
use Twig_Extension;
use Twig_SimpleFilter;

class PriorityNameExtension extends Twig_Extension
{
    /**
     * @var array
     */
    private $priorities;
  
    /**
     * {@inheritDoc}
     */
    public function getFilters()
    {
        return [
            new Twig_SimpleFilter(
                'log_priority_name',
                [$this, 'priorityName']
            ),
        ];
    }

    /**
     * @param  string $priorityLevel
     * @return string
     */
    public function priorityName($priorityLevel)
    {
        $priorityName = array_search($priorityLevel, $this->getPriorities());
        
        return false === $priorityName
            ? $priorityLevel
            : $priorityName;
    }

    /**
     * @return array
     */
    private function getPriorities()
    {
        if (!$this->priorities) {
            $reflectionClass  = new ReflectionClass('Monolog\Logger');
            $this->priorities = $reflectionClass->getConstants();
        }

        return $this->priorities;
    }
}
