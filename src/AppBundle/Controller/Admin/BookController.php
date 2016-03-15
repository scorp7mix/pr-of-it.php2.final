<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Book;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class BookController extends Controller
{

    /**
     * @Route("/admin/book/create")
     */
    public function createAction(Request $request)
    {
        $book = new Book();

        $form = $this->buildForm($book);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($book);
            $entityManager->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/book.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/admin/book/edit/{id}")
     */
    public function editAction(Book $book, Request $request)
    {
        $form = $this->buildForm($book);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/book.html.twig', ['form' => $form->createView()]);
    }

    private function buildForm($book) {
        return $this->createFormBuilder($book)
            ->add('title', TextType::class)
            ->add('origin', TextType::class, ['required' => false])
            ->add('year', NumberType::class, ['required' => false])
            ->add('series', EntityType::class, [
                'class' => 'AppBundle:Series',
                'choice_label' => 'title',
            ])
            ->add('save', SubmitType::class)
            ->getForm();
    }

    /**
     * @Route("/admin/book/remove/{id}")
     */
    public function deleteAction(Book $book)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($book);
        $entityManager->flush();

        return $this->redirectToRoute('admin');
    }
}