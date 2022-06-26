<?php

namespace App\Controller;

use App\Entity\Battles;
use App\Form\BattlesType;
use App\Repository\BattlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/battles")
 */
class BattlesController extends AbstractController
{
    /**
     * @Route("/", name="app_battles_index", methods={"GET"})
     */
    public function index(BattlesRepository $battlesRepository): Response
    {
        return $this->render('battles/index.html.twig', [
            'battles' => $battlesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_battles_new", methods={"GET", "POST"})
     */
    public function new(Request $request, BattlesRepository $battlesRepository): Response
    {
        $battle = new Battles();
        $form = $this->createForm(BattlesType::class, $battle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $battlesRepository->add($battle, true);

            return $this->redirectToRoute('app_battles_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('battles/new.html.twig', [
            'battle' => $battle,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_battles_show", methods={"GET"})
     */
    public function show(Battles $battle): Response
    {
        return $this->render('battles/show.html.twig', [
            'battle' => $battle,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_battles_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Battles $battle, BattlesRepository $battlesRepository): Response
    {
        $form = $this->createForm(BattlesType::class, $battle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $battlesRepository->add($battle, true);

            return $this->redirectToRoute('app_battles_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('battles/edit.html.twig', [
            'battle' => $battle,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_battles_delete", methods={"POST"})
     */
    public function delete(Request $request, Battles $battle, BattlesRepository $battlesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$battle->getId(), $request->request->get('_token'))) {
            $battlesRepository->remove($battle, true);
        }

        return $this->redirectToRoute('app_battles_index', [], Response::HTTP_SEE_OTHER);
    }
}
