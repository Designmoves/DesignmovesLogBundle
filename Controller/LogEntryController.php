<?php
/**
 * Designmoves (http://www.designmoves.nl)
 * 
 * @copyright Copyright (c) 2017, Designmoves (http://www.designmoves.nl)
 * @license   http://code.designmoves.nl/licence/new-bsd New BSD License
 */

namespace Designmoves\Bundle\LogBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

/**
 * @Route("/log", service="designmoves_log.entry.controller")
 */
class LogEntryController extends Controller
{
    /**
     * @var EngineInterface $templating
     */
    private $templating;
    
    /**
     * @param EngineInterface $templating
     */
    public function __construct(EngineInterface $templating)
    {
        $this->templating = $templating;
    }

    /**
     * @Route("/test", name="designmoves_log.log.test")
     * @Method("GET")
     * 
     * @return Response
     */
    public function testAction()
    {     
        $logger = $this->container->get('logger');
        $logger->info(
            'Test vanuit: {classMethod}',
            ['classMethod' => __METHOD__]
        );
      
        return $this->templating->renderResponse(
            'DesignmovesLogBundle:log:test.html.twig', [
                'logger' => $logger,
            ]
        );
    }

    /**
     * @Route("/test-exception", name="designmoves_log.log.test-exception")
     * @Method("GET")
     *
     * @throws \RuntimeException
     */
    public function testExceptionAction()
    {
        throw new \RuntimeException(sprintf(
            'Test-exception vanuit: %s',
            __METHOD__
        ));
    }

    /**
     * @Route("/list/{page}", name="designmoves_log.log.list", requirements={
     *    "page": "\d+"
     * })
     * @Method("GET")
     * 
     * @return Response
     */
    public function listAction($page = 1)
    {
        return $this->templating->renderResponse(
            'DesignmovesLogBundle:log:list.html.twig', [
                'page' => $page,
            ]
        );
    }
}
