<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Event;
use App\Entity\InternshipOffer;
class AlumniController extends AbstractController
{
    /**
     * @Route("/annuaire", name="annuaire")
     */
    public function annuaire(){
        $repo = $this ->getDoctrine()->getRepository(User::class);
        $users = $repo->findAll();
        return $this->render('alumni/annuaire.html.twig',[
            'controller_name' =>'AlumniController',
            'users' => $users
        ]);
    }

    /**
     * @Route("/",name="home")
     */
    public function home(){
        return $this -> render('alumni/home.html.twig',[
            'title' => "Bienvenue sur le site des Alumni du Ginfo"
        ]);
    }

    /**
     * @Route("/evenements", name="evenements")
     */
    public function evenements(){
        $repo = $this ->getDoctrine()->getRepository(Event::class);
        $events = $repo->findAll();
        return $this->render('alumni/evenement.html.twig',[
            'controller_name' =>'AlumniController',
            'events' => $events
        ]);
    }

}
