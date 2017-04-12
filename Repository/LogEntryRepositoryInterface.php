<?php
/**
 * Designmoves (http://www.designmoves.nl)
 * 
 * @copyright Copyright (c) 2017, Designmoves (http://www.designmoves.nl)
 * @license   http://code.designmoves.nl/licence/new-bsd New BSD License
 */

namespace Designmoves\Bundle\LogBundle\Repository;

/**
 * Description of LogEntryRepositoryInterface
 */
interface LogEntryRepositoryInterface
{
    /**
     * @param  int $page
     * @return Paginator
     */
    public function findByPage($page = 1);
  
    /**
     * @return array
     */
    public function findAll();

    /**
     * Find the latest logs
     */
    public function findLatest($limit = 10);
}
