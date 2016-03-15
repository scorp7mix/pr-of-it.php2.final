<?php

namespace AppBundle\Controller\Api;

use AppBundle\Entity\Series;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SeriesController extends Controller
{
    /**
     * @Route("/api/series/{id}/books")
     */
    public function booksAction(Series $series)
    {
        $books = $series->getBooks();

        $result = [];
        foreach ($books as $book) {
            $result[] = [
                'title' => $book->getTitle(),
                'origin' => $book->getOrigin(),
                'year' => $book->getYear(),
                'series' => $series->getTitle()
            ];
        }

        return new JsonResponse($result);
    }
}