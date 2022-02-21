<?php

namespace App\Controller;

use App\Entity\Candidat;
use App\Form\UserType;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController
{
    /**
     * @Route("/register", name="user_registration")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // 1) build the form
        $user = new User();
        $candidat= new Candidat();
        $form = $this->createFormBuilder()
            ->add('nom',TextType::class)
            ->add('prenom',TextType::class)
            ->add('dat_naissance',DateType::class)
            ->add('email',EmailType::class)
            ->add('password',PasswordType::class)
            ->add('register',SubmitType::class)
            ->getForm();

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $candidat->setNom($form->get("nom")->getData());
            $candidat->setPrenom($form->get("prenom")->getData());
            $candidat->setDatNaissance($form->get("dat_naissance")->getData());
            $user->setPassword($form->get("password")->getData());
            $user->setEmail($form->get("email")->getData());
            $user->setRoles(["ROLE_USER"]);
            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);

            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $user=$this->getDoctrine()->getRepository(User::class)->findOneBy(["email"=>$user->getEmail()]);
            $candidat->setUser($user);
            $entityManager->persist($candidat);
            $entityManager->flush();
            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirect("/");
        }

        return $this->renderForm(
            'register/index.html.twig',
            array('form' => $form)
        );
    }
}
