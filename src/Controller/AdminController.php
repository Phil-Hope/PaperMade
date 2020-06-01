<?php

namespace App\Controller;


use App\Entity\Author;
use App\Entity\Books;
use App\Repository\AuthorRepository;
use App\Repository\BooksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{


    /**
     * this is the admin index method, it fetches the Books Class and The Authors Class repositories so I am able to
     * use them to as the assigned $books and $authors variables to then create some  'foreach' and if statements to show
     * the content more freely.
     *
     * @Route("/")
     * @return Response
     */
    public function index(): Response
    {
        $books = $this->getDoctrine()
            ->getRepository(Books::class)
            ->findAll();

        $authors = $this->getDoctrine()
            ->getRepository(Author::class)
            ->findAll();

        return $this->render('admin/index.html.twig', ['books' => $books, 'authors' => $authors
        ]);
    }

}
