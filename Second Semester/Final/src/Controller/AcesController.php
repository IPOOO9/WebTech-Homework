<?php

namespace App\Controller;

use App\Entity\Aces;
use App\Form\AcesType;
use App\Repository\AcesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/aces")
 */
class AcesController extends AbstractController
{
    /**
     * @Route("/", name="app_aces_index", methods={"GET"})
     */
    public function index(AcesRepository $acesRepository): Response
    {
        return $this->render('aces/index.html.twig', [
            'aces' => $acesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_aces_new", methods={"GET", "POST"})
     */
    public function new(Request $request, AcesRepository $acesRepository): Response
    {
        $ace = new Aces();
        $form = $this->createForm(AcesType::class, $ace);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $acesRepository->add($ace, true);

            return $this->redirectToRoute('app_aces_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('aces/new.html.twig', [
            'ace' => $ace,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_aces_show", methods={"GET"})
     */
    public function show(Aces $ace): Response
    {
        return $this->render('aces/show.html.twig', [
            'ace' => $ace,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_aces_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Aces $ace, AcesRepository $acesRepository): Response
    {
        $form = $this->createForm(AcesType::class, $ace);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $acesRepository->add($ace, true);

            return $this->redirectToRoute('app_aces_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('aces/edit.html.twig', [
            'ace' => $ace,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_aces_delete", methods={"POST"})
     */
    public function delete(Request $request, Aces $ace, AcesRepository $acesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ace->getId(), $request->request->get('_token'))) {
            $acesRepository->remove($ace, true);
        }

        return $this->redirectToRoute('app_aces_index', [], Response::HTTP_SEE_OTHER);
    }
}
