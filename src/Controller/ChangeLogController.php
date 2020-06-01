<?php

namespace App\Controller;

use App\Entity\ChangeLog;
use App\Form\ChangeLogType;
use App\Repository\BooksRepository;
use App\Repository\ChangeLogRepository;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/change/log")
 */
class ChangeLogController extends AbstractController
{
    /**
     * @Route("/", name="change_log_index", methods={"GET"})
     * @param ChangeLogRepository $changeLogRepository
     * @param UsersRepository $UsersRepository
     * @param BooksRepository $booksRepository
     * @return Response
     */
    public function index(ChangeLogRepository $changeLogRepository, UsersRepository $UsersRepository, BooksRepository $booksRepository): Response
    {
        return $this->render('change_log/index.html.twig', [
            'change_logs' => $changeLogRepository->findAll(),
            'books' => $booksRepository->findAll(),
            'users' => $UsersRepository->findAll()
        ]);
    }

    /**
     * @Route("/new", name="change_log_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $changeLog = new ChangeLog();
        $form = $this->createForm(ChangeLogType::class, $changeLog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($changeLog);
            $entityManager->flush();

            return $this->redirectToRoute('change_log_index');
        }

        return $this->render('change_log/new.html.twig', [
            'change_log' => $changeLog,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="change_log_show", methods={"GET"})
     */
    public function show(ChangeLog $changeLog): Response
    {
        return $this->render('change_log/show.html.twig', [
            'change_log' => $changeLog,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="change_log_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ChangeLog $changeLog): Response
    {
        $form = $this->createForm(ChangeLogType::class, $changeLog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('change_log_index');
        }

        return $this->render('change_log/edit.html.twig', [
            'change_log' => $changeLog,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="change_log_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ChangeLog $changeLog): Response
    {
        if ($this->isCsrfTokenValid('delete'.$changeLog->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($changeLog);
            $entityManager->flush();
        }

        return $this->redirectToRoute('change_log_index');
    }
}
