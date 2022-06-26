<?php

namespace App\Controller;

use App\Entity\Nations;
use App\Form\NationsType;
use App\Repository\NationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/nations")
 */
class NationsController extends AbstractController
{
    /**
     * @Route("/", name="app_nations_index", methods={"GET"})
     */
    public function index(NationsRepository $nationsRepository): Response
    {
        return $this->render('nations/index.html.twig', [
            'nations' => $nationsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_nations_new", methods={"GET", "POST"})
     */
    public function new(Request $request, NationsRepository $nationsRepository): Response
    {
        $nation = new Nations();
        $form = $this->createForm(NationsType::class, $nation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $nationsRepository->add($nation, true);

            return $this->redirectToRoute('app_nations_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('nations/new.html.twig', [
            'nation' => $nation,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_nations_show", methods={"GET"})
     */
    public function show(Nations $nation): Response
    {
        return $this->render('nations/show.html.twig', [
            'nation' => $nation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_nations_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Nations $nation, NationsRepository $nationsRepository): Response
    {
        $form = $this->createForm(NationsType::class, $nation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $nationsRepository->add($nation, true);

            return $this->redirectToRoute('app_nations_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('nations/edit.html.twig', [
            'nation' => $nation,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_nations_delete", methods={"POST"})
     */
    public function delete(Request $request, Nations $nation, NationsRepository $nationsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$nation->getId(), $request->request->get('_token'))) {
            $nationsRepository->remove($nation, true);
        }

        return $this->redirectToRoute('app_nations_index', [], Response::HTTP_SEE_OTHER);
    }
}
