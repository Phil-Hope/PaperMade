<?php

namespace App\Controller;

use App\Entity\Books;
use App\Entity\ChangeLog;
use App\Form\BooksType;
use App\Repository\AuthorRepository;
use App\Repository\BooksRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/books")
 */
class BooksController extends AbstractController
{
    /**
     * In this function I have added with it the authors entity repository which allows me to make some nice if statements in twig
     * and show some extra data.
     *
     * @Route("/", name="books_index", methods={"GET"})
     * @param AuthorRepository $authorRepository
     * @param BooksRepository $booksRepository
     * @return Response
     */
    public function index(AuthorRepository $authorRepository, BooksRepository $booksRepository): Response
    {
        return $this->render('books/index.html.twig', ['books' => $booksRepository->findAll(),
                                                 'authors' => $authorRepository->findAll()]);
    }

    /**
     * This is the create book function.
     * I have instantiated the changelog class
     * Intercepting the data from the form submission
     * I can capture the Book ID created
     * I then call my setters for the changelog class
     * and set the book changed. I created A variable that calls from
     * the datetime function and sends it through as a timestamp to date created.
     *
     * to log the user I simply called the getUser()->getId method
     * to capture the user id and submit it along with all the other details
     * to the changelog table.
     *
     * @Route("/new", name="books_new", methods={"GET","POST"})
     * @param EntityManagerInterface $em
     * @param Request $request
     * @param AuthorRepository $authorRepository
     * @param BooksRepository $booksRepository
     * @return Response
     */
    public function new(EntityManagerInterface $em, Request $request, AuthorRepository $authorRepository, BooksRepository $booksRepository): Response
    {

        $book = new Books();
        $form = $this->createForm(BooksType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($book);
            $entityManager->flush();

            $object = $form->getData();
            $data = reset($object);
            $date = new DateTime();

            $changeLog = new ChangeLog;
            $changeLog->setBookChanged($data);
            $changeLog->setDateCreated($date);
            $changeLog->setChangedBy($this->getUser()->getId());
            $em->persist($changeLog);
            $em->flush();

            return $this->redirectToRoute('books_index');
        }

        return $this->render('books/new.html.twig', [
            'book' => $book,
            'books' => $booksRepository->findAll(),
            'authors' => $authorRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }


    /**
     *
     * using the routes Annotations it use the GET method
     * and completes the request on the rendered page passing
     * this book id in the url and in the the variable $book
     * which is assigned in an array below.
     *
     *
     * @Route("/{id}", name="books_show", methods={"GET"})
     * @param Books $book
     * @param AuthorRepository $authorRepository
     * @return Response
     */
    public function show(Books $book, AuthorRepository $authorRepository): Response
    {

        return $this->render('books/show.html.twig', [
            'book' => $book,
            'authors' => $authorRepository->findAll(),
        ]);
    }

    /**
     *
     * Same as the create books function the same logic is applied
     * except rather then calling the getDateCreated method
     * the getDateUpdated method is called from the ChangeLog class.
     *
     *
     *
     * @Route("/{id}/edit", name="books_edit", methods={"GET","POST"})
     * @param EntityManagerInterface $em
     * @param Request $request
     * @param Books $book
     * @return Response
     */
    public function edit(EntityManagerInterface $em, Request $request, Books $book): Response
    {

        $form = $this->createForm(BooksType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           $object = $form->getData();
            $data = reset($object);
            $date = new DateTime();

            $changeLog = new ChangeLog;
            $changeLog->setBookChanged($data);
            $changeLog->setDateUpdated($date);
            $changeLog->setChangedBy($this->getUser()->getId());
            $em->persist($changeLog);
            $em->flush();

            $this->getDoctrine()->getManager()->flush();


            return $this->redirectToRoute('books_index');
        }

        return $this->render('books/edit.html.twig', [
            'book' => $book,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="books_delete", methods={"DELETE"})
     * @param Request $request
     * @param Books $book
     * @return Response
     */
    public function delete(Request $request, Books $book): Response
    {
        if ($this->isCsrfTokenValid('delete'.$book->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($book);
            $entityManager->flush();
        }

        return $this->redirectToRoute('books_index');
    }
}
