<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="security_registration")
     */
    public function registration(Request $request, UserPasswordEncoderInterface $encoder ){
        if($this->isGranted('ROLE_USER')){
            return $this->redirectToRoute('home');
        }
        $manager=$this->getDoctrine()->getManager();
        $user= new User();

        $form = $this->createForm(RegistrationType::class, $user);

        $form -> handleRequest($request);
        $user ->setRegisterDate(new \DateTime());

        if ($form->isSubmitted() && $form ->isValid()){
            $hash = $encoder ->encodePassword($user, $user-> getPassword());
            $user ->setPassword($hash);
            $user->setRoles(['ROLE_USER']);
            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre inscription a bien été enregistré'
            );

            return $this ->redirectToRoute("security_login");
        }

        return $this->render('security/registration.html.twig',[
            "formRegistration" => $form ->createView()]);
    }

    /**
     * @Route("/connexion", name="security_login")
     */
    public function login(){
        if($this->isGranted('ROLE_USER')){
            return $this->redirectToRoute('home');
        }
        return $this->render('security/login.html.twig');
    }

    /**
     * @Route("/deconnexion", name= "security_logout")
     */
    public function logout() {}
}
