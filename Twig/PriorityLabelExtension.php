<?php
/**
 * Designmoves (http://www.designmoves.nl)
 * 
 * @copyright Copyright (c) 2017, Designmoves (http://www.designmoves.nl)
 * @license   http://code.designmoves.nl/licence/new-bsd New BSD License
 */

namespace Designmoves\Bundle\LogBundle\Twig;

use Monolog\Logger;
use ReflectionClass;
use Twig_Environment;
use Twig_Extension;
use Twig_SimpleFunction;

class PriorityLabelExtension extends Twig_Extension
{
    /**
     * @var array
     */
    private $priorityProperties = [
        Logger::DEBUG => [
            'labelType' => 'default',
            'icon'      => 'question',
        ],
        Logger::INFO => [
            'labelType' => 'info',
            'icon'      => 'info',
        ],
        Logger::NOTICE => [
            'labelType' => 'warning',
            'icon'      => 'info',
        ],
        Logger::WARNING => [            
            'labelType' => 'warning',
            'icon'      => 'warning',
        ],
        Logger::ERROR => [
            'labelType' => 'warning',
            'icon'      => 'warning',
        ],
        Logger::CRITICAL => [
            'labelType' => 'danger',
            'icon'      => 'bolt',
            
        ],
        Logger::ALERT => [
            'labelType' => 'danger',
            'icon'      => 'bolt',
        ],
        Logger::EMERGENCY => [
            'labelType' => 'danger',
            'icon'      => 'bolt',
        ],
    ];
  
    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        $options = [
            'is_safe'=> ['html'],
            'needs_environment' => true,
        ];

        return [
            new Twig_SimpleFunction(
                'log_priority_label',
                [$this, 'priorityLabel'],
                $options
            ),
        ];
    }

    /**
     * @param  Twig_Environment $twig
     * @param  string           $priorityLevel
     * @return string
     */
    public function priorityLabel(Twig_Environment $twig, $priorityLevel)
    {
        $properties = $this->priorityProperties[$priorityLevel];
        
        $labelType = isset($properties['labelType'])
            ? $properties['labelType']
            : 'primary';
        
        $icon = isset($properties['icon'])
            ? $properties['icon']
            : 'question';

        return sprintf(
            '<span class="label label-%s">%s | %s &middot; %s</span>',
            $labelType,
            $this->icon($twig, $icon),
            $this->priorityName($twig, $priorityLevel),
            $priorityLevel
        );
    }

    /**
     * @param  Twig_Environment $twig
     * @param  string $iconName
     * @return string
     */
    protected function icon(Twig_Environment $twig, $iconName)
    {
        $callable = $twig->getFunction('icon')->getCallable();
        
        return $callable($iconName);
    }
    
    /**
     * 
     * @param  Twig_Environment $twig
     * @param  int              $priorityLevel
     * @return string
     */
    protected function priorityName(Twig_Environment $twig, $priorityLevel)
    {
        $callable = $twig->getFilter('log_priority_name')->getCallable();
        
        return $callable($priorityLevel);
    }
}
