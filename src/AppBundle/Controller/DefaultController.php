<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Book;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction()
    {
        $series = $this->getDoctrine()
            ->getRepository('AppBundle:Series')
            ->childrenHierarchy();

        return $this->render(
            'default/index.html.twig',
            ['series' => $series]
        );
    }

}