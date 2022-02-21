<?php

namespace App\Controller;

use App\Entity\Formateur;
use App\Entity\User;
use App\Form\FormateurType;
use App\Repository\FormateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/formateur")
 */
class FormateurController extends AbstractController
{
    /**
     * @Route("/", name="formateur_index", methods={"GET"})
     */
    public function index(FormateurRepository $formateurRepository): Response
    {
        return $this->render('formateur/index.html.twig', [
            'formateurs' => $formateurRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="formateur_new", methods={"GET","POST"})
     */
    public function new(Request $request,UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $formateur = new Formateur();
        $user= new User();
        $form = $this->createFormBuilder()
            ->add('nom',TextType::class)
            ->add('prenom',TextType::class)
            ->add('datenaissance',DateType::class)
            ->add('email',EmailType::class)
            ->add('domaine',TextType::class)
            ->add('email',EmailType::class)
            ->add('password',PasswordType::class)
            ->add('register',SubmitType::class)
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formateur->setNom($form->get("nom")->getData());
            $formateur->setPrenom($form->get("prenom")->getData());
            $formateur->setDatenaissance($form->get("datenaissance")->getData());
            $user->setEmail($form->get("email")->getData());
            $user->setPassword($form->get("password")->getData());

            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $user=$this->getDoctrine()->getRepository(User::class)->findOneBy(["email"=>$user->getEmail()]);
            $formateur->setUser($user);
            $entityManager->persist($formateur);
            $entityManager->flush();

            return $this->redirectToRoute('formateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('formateur/new.html.twig', [
            'formateur' => $formateur,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="formateur_show", methods={"GET"})
     */
    public function show(Formateur $formateur): Response
    {
        return $this->render('formateur/show.html.twig', [
            'formateur' => $formateur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="formateur_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Formateur $formateur): Response
    {
        $form = $this->createForm(FormateurType::class, $formateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('formateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('formateur/edit.html.twig', [
            'formateur' => $formateur,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="formateur_delete", methods={"POST"})
     */
    public function delete(Request $request, Formateur $formateur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formateur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($formateur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('formateur_index', [], Response::HTTP_SEE_OTHER);
    }
}
