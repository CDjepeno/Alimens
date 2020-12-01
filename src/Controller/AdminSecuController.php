<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminSecuController extends AbstractController
{
    /**
     * Permet d'afficher le formulaire d'enregistrement
     *
     * @Route("/register", name="register") 
     * 
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param UserPasswordEncoderInterface $encoder
     * 
     * @return Response
     */
    public function register(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder): Response
    {
        $user = new User();
        
        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($user, $user->getPassword());

            $user   ->setPassword($hash);
            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('aliments');
        }
        return $this->render('admin_secu/registration.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Permet de logger un utilisateur
     *
     * @Route("/login", name="login")
     * 
     * @param EntityManagerInterface $manager
     * 
     * @return Response
     */
    public function login(AuthenticationUtils $authUtils)
    {
        return $this->render('admin_secu/login.html.twig',[
            'last_username' => $authUtils->getLastUsername(), 
            'error'         => $authUtils->getLastAuthenticationError()
        ]);
    }

    /**
     * Permet de se déconnecter
     *
     * @Route("/logout", name="logout")
     * 
     * @return void
     */
    public function logout()
    {

    }
}
