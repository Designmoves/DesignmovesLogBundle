<?php
/**
 * Designmoves (http://www.designmoves.nl)
 * 
 * @copyright Copyright (c) 2017, Designmoves (http://www.designmoves.nl)
 * @license   http://code.designmoves.nl/licence/new-bsd New BSD License
 */

namespace Designmoves\Bundle\LogBundle\Service;

use Designmoves\Bundle\LogBundle\Repository\LogEntryRepositoryInterface;

/**
 * Description of LogEntryService
 */
class LogEntryService
{
    /**
     * @var LogEntryRepositoryInterface
     */
    protected $repository;
    
    /**
     * @param LogEntryRepositoryInterface $repository
     */
    public function __construct(LogEntryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * @param  int $page
     * @return Paginator
     */
    public function getByPage($page = 1)
    {
        return $this->repository->findByPage($page);
    }
    
    /**
     * @param  int $limit
     * @return array
     */
    public function getLatest($limit = 10)
    {
        return $this->repository->findLatest($limit);
    }
}
