<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Series;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SeriesController extends Controller
{
    /**
     * @Route("/admin/series/create")
     */
    public function createAction(Request $request)
    {
        $series = new Series();

        $form = $this->buildForm($series);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($series);
            $entityManager->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/series.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/admin/series/edit/{id}")
     */
    public function editAction(Series $series, Request $request)
    {
        $form = $this->buildForm($series);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/series.html.twig', ['form' => $form->createView()]);
    }

    private function buildForm($series) {
        return $this->createFormBuilder($series)
            ->add('title', TextType::class)
            ->add('origin', TextType::class, ['required' => false])
            ->add('parent', EntityType::class, [
                'class' => 'AppBundle:Series',
                'choice_label' => 'title',
                'placeholder' => '-',
                'required' => false,
            ])
            ->add('save', SubmitType::class)
            ->getForm();
    }

    /**
     * @Route("/admin/series/remove/{id}")
     */
    public function deleteAction(Series $series)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($series);
        $entityManager->flush();

        return $this->redirectToRoute('admin');
    }

}