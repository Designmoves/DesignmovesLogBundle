<?php
/**
 * Designmoves (http://www.designmoves.nl)
 * 
 * @copyright Copyright (c) 2017, Designmoves (http://www.designmoves.nl)
 * @license   http://code.designmoves.nl/licence/new-bsd New BSD License
 */

namespace Designmoves\Bundle\LogBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * Description of LogEntryRepository
 */
class LogEntryRepository extends EntityRepository implements LogEntryRepositoryInterface
{
    /**
     * @var array
     */
    private $defaultOrderBy = [
        'logDate' => 'DESC',
        'logEntryId' => 'DESC',
    ];

    /**
     * @param  int $page
     * @param  int $limit
     * @return Paginator
     */
    public function findByPage($page = 1, $limit = 50)
    {
        $query = $this->createQueryBuilder('a')
            ->orderBy('a.logDate', 'DESC')
            ->addOrderBy('a.logEntryId', 'DESC')
            ->getQuery();

        return $this->paginate($query, $page, $limit);
    }
  
    /**
     * @return array
     */
    public function findAll()
    {
        $criteria = [];
        $limit    = null;
        $offset   = null;

        return $this->findBy($criteria, $this->defaultOrderBy, $limit, $offset);
    }

    /**
     * Find the latest logs
     */
    public function findLatest($limit = 10)
    {
        $criteria = [];
        $offset   = null;

        return $this->findBy($criteria, $this->defaultOrderBy, $limit, $offset);
    }
    
    /**
     * @param  Query $query
     * @param  int   $page
     * @param  int   $limit
     * @return Paginator
     */
    protected function paginate(Query $query, $page = 1, $limit = 50)
    {
        $paginator = new Paginator($query);
        $offset    = $limit * ($page - 1);

        $paginator->getQuery()
            ->setFirstResult($offset)
            ->setMaxResults($limit);

        return $paginator;
    }
}
