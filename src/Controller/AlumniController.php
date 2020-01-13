<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
class AlumniController extends AbstractController
{
    /**
     * @Route("/",name="home")
     */
    public function home() {
        return $this -> render('alumni/home.html.twig',[
            'title' => "Bienvenue sur le site des Alumni du Ginfo",
            'age' => 31
        ]);
    }

}
