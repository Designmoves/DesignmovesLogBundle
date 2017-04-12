<?php
/**
 * Designmoves (http://www.designmoves.nl)
 * 
 * @copyright Copyright (c) 2017, Designmoves (http://www.designmoves.nl)
 * @license   http://code.designmoves.nl/licence/new-bsd New BSD License
 */

namespace Designmoves\Bundle\LogBundle\Processor;

use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Description of IpAddressProcessor
 */
class IpAddressProcessor
{
    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    /**
     * @param  array $record
     * @return array
     */
    public function __invoke(array $record)
    {
        /* @var Symfony\Component\HttpFoundation\Request $request */
        $request = $this->requestStack->getCurrentRequest();
        if (null === $request) {
            return $record;
        }

        $record['extra']['ip_address'] = $request->getClientIp();

        return $record;
    }
}
