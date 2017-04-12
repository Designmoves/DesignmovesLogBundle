<?php
/**
 * Designmoves (http://www.designmoves.nl)
 * 
 * @copyright Copyright (c) 2017, Designmoves (http://www.designmoves.nl)
 * @license   http://code.designmoves.nl/licence/new-bsd New BSD License
 */

namespace Designmoves\Bundle\LogBundle\Processor;

use RuntimeException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Description of UserProcessor
 */
class UserProcessor
{
    /**
     * @var TokenStorage
     */
    protected $tokenStorage;
  
    /**
     * @param TokenStorage $tokenStorage
     */
    public function __construct(TokenStorage $tokenStorage)
    {
        throw new RuntimeException(sprintf(
            'Class "%s" can not be used (yet)',
            __CLASS__
        ));
     
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @return UserInterface|null
     */
    protected function getUser()
    {
        $token = $this->tokenStorage->getToken();
        echo '<pre>'; var_dump(__METHOD__, $token); exit;
      
        $token = $this->tokenStorage->getToken();
        if (null === $token) {
            return;
        }
      
        $user = $token->getUser();
        if (!$user instanceof UserInterface) {
            return;
        }
        
        return $user;
    }

    /**
     * @param  array $record
     * @return array
     */
    public function processRecord(array $record)
    {
        /* @var UserInterface $user */
        $user = $this->getUser();
        
        echo '<pre>'; var_dump($user); exit;
        
        if ($user) {
            $record['extra']['username'] = $user->getUsername();
        }
        
        return $record;
    }
}
