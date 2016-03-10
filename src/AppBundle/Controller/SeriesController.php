<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Series;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SeriesController extends Controller
{
    /**
     * @Route("/series/index", name="series_index")
     */
    public function indexAction()
    {
        $repository = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Series');

        $series = $repository->childrenHierarchy();

        return $this->render('series/index.html.twig', ['series' => $series]);
    }

    /**
     * @Route("/series/show/{id}")
     */
    public function showAction(Series $series)
    {
        return $this->render('series/show.html.twig', ['series' => $series]);
    }

    /**
     * @Route("/series/create")
     */
    public function createAction()
    {
/*        $cycles = new Series();
        $cycles->setTitle('Циклы произведений');

        $cycle = new Series();
        $cycle->setTitle('Межзвездный патруль');
        $cycle->setOrigin('Interstellar Patrol');
        $cycle->setParent($cycles);*/

        $romans = new Series();
        $romans->setTitle('Романы');

        $entityManager = $this->getDoctrine()->getManager();

/*        $entityManager->persist($cycles);
        $entityManager->persist($cycle);*/
        $entityManager->persist($romans);
        $entityManager->flush();

        return $this->redirectToRoute('series_index');
    }

    /**
     * @Route("/series/update/{id}")
     */
    public function updateAction(Series $series)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $series->setParent($entityManager->getRepository('AppBundle:Series')->find(1));
        $entityManager->flush();

        return $this->redirectToRoute('series_index');
    }

    /**
     * @Route("/series/delete/{id}")
     */
    public function deleteAction(Series $series)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($series);
        $entityManager->flush();

        return $this->redirectToRoute('series_index');
    }
}