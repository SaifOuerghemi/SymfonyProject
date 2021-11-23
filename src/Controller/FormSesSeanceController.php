<?php

namespace App\Controller;

use App\Entity\FormSesSeance;
use App\Form\FormSesSeanceType;
use App\Repository\FormSesSeanceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/form/ses/seance")
 */
class FormSesSeanceController extends AbstractController
{
    /**
     * @Route("/", name="form_ses_seance_index", methods={"GET"})
     */
    public function index(FormSesSeanceRepository $formSesSeanceRepository): Response
    {
        return $this->render('form_ses_seance/index.html.twig', [
            'form_ses_seances' => $formSesSeanceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="form_ses_seance_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $formSesSeance = new FormSesSeance();
        $form = $this->createForm(FormSesSeanceType::class, $formSesSeance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($formSesSeance);
            $entityManager->flush();

            return $this->redirectToRoute('form_ses_seance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('form_ses_seance/new.html.twig', [
            'form_ses_seance' => $formSesSeance,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="form_ses_seance_show", methods={"GET"})
     */
    public function show(FormSesSeance $formSesSeance): Response
    {
        return $this->render('form_ses_seance/show.html.twig', [
            'form_ses_seance' => $formSesSeance,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="form_ses_seance_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, FormSesSeance $formSesSeance): Response
    {
        $form = $this->createForm(FormSesSeanceType::class, $formSesSeance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('form_ses_seance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('form_ses_seance/edit.html.twig', [
            'form_ses_seance' => $formSesSeance,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="form_ses_seance_delete", methods={"POST"})
     */
    public function delete(Request $request, FormSesSeance $formSesSeance): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formSesSeance->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($formSesSeance);
            $entityManager->flush();
        }

        return $this->redirectToRoute('form_ses_seance_index', [], Response::HTTP_SEE_OTHER);
    }
}
