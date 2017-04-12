<?php
/**
 * Designmoves (http://www.designmoves.nl)
 * 
 * @copyright Copyright (c) 2017, Designmoves (http://www.designmoves.nl)
 * @license   http://code.designmoves.nl/licence/new-bsd New BSD License
 */

namespace Designmoves\Bundle\LogBundle\Twig;

use Designmoves\Bundle\LogBundle\Exception;
use Designmoves\Bundle\LogBundle\Service\LogEntryService;
use Twig_Environment;
use Twig_Extension;
use Twig_SimpleFunction;

class EntriesExtension extends Twig_Extension
{
    /**
     * @var array
     */
    private $entries;
  
    /**
     * @var LogEntryService
     */
    private $logEntryService;

    /**
     * @var int
     */
    private $page;

    /**
     * @param LogEntryService $logEntryService
     */
    public function __construct(LogEntryService $logEntryService)
    {
        $this->logEntryService = $logEntryService;
    }
    
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
                'log_entries_set_page',
                [$this, 'setPage']
            ),
            new Twig_SimpleFunction(
                'log_entries_get_entries',
                [$this, 'getEntries']
            ),
            new Twig_SimpleFunction(
                'log_entries',
                [$this, 'renderLogEntries'],
                $options
            ),
        ];
    }

    /**
     * @param  Twig_Environment $twig
     * @param  array            $options
     * @return string
     * @throws Exception\InvalidArgumentException
     */
    public function renderLogEntries(Twig_Environment $twig, array $options = [])
    {
        if (isset($options['page'])) {
            $this->setPage($options['page']);
        }

        return $twig->render('DesignmovesLogBundle:helper:entries.html.twig', [
            'entries' => $this->getEntries(),
        ]);
    }
    
    /**
     * @param int $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

    /**
     * @return int
     */
    public function getPage()
    {
        if (!isset($this->page)) {
            $this->page = 1;
        }
        
        return $this->page;
    }
    
    /**
     * @return array
     */
    public function getEntries()
    {
        if (!$this->entries) {
            $this->entries = $this->logEntryService->getByPage($this->getPage());
        }
        
        return $this->entries;
    }
}
