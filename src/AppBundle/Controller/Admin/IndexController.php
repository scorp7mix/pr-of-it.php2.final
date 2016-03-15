<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
    public function indexAction()
    {
        $books = $this->getDoctrine()
            ->getRepository('AppBundle:Book')
            ->findAll();

        $series = $this->getDoctrine()
            ->getRepository('AppBundle:Series')
            ->childrenHierarchy();

        return $this->render(
            'admin/index.html.twig',
            [
                'books' => $books,
                'series' => $series,
            ]);
    }
}