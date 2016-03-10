<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Book;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BookController extends Controller
{
    /**
     * @Route("/book/index", name="book_index")
     */
    public function indexAction()
    {
        $books = $this->getDoctrine()
            ->getRepository('AppBundle:Book')
            ->findAll();

        return $this->render('book/index.html.twig', ['books' => $books]);
    }

    /**
     * @Route("/book/show/{id}")
     */
    public function showAction(Book $book)
    {
        var_dump($book);
        return new Response('Shown details for book id ' . $book->getId());
    }

    /**
     * @Route("/book/create")
     */
    public function createAction()
    {
        $book = new Book();
        $book->setTitle('Сталкивающиеся солнца');
        $book->setOrigin('Crushing Suns');
        $book->setYear(1928);

        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->persist($book);
        $entityManager->flush();

        return new Response('Created book id ' . $book->getId());
    }

    /**
     * @Route("/book/update/{id}")
     */
    public function updateAction(Book $book)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $book->setYear(1900);
        $entityManager->flush();

        return $this->redirectToRoute('book_index');
    }

    /**
     * @Route("/book/delete/{id}")
     */
    public function deleteAction(Book $book)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($book);
        $entityManager->flush();

        return $this->redirectToRoute('book_index');
    }
}