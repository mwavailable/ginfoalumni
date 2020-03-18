<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Event;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\InternshipOffer;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Form\EvenementType;
use App\Form\InternshipOfferType;
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

    /**
     * @Route("/Offre_de_stage", name="internshipOffer")
     */
    public function internshipOffer(){
        $repo = $this ->getDoctrine()->getRepository(InternshipOffer::class);
        $internshipOffers = $repo->findAll();
        return $this->render('alumni/internshipOffer.html.twig',[
            'controller_name' =>'AlumniController',
            'internshipOffers' => $internshipOffers
        ]);
    }

    /**
     * @Route("/evenements/new", name="create_evenements")
     * @Route("/evenements/{id}/edit", name="modify_evenements")
     */
    public function FormEvenements(Event $evenement= null, Request $request){
        $manager = $this->getDoctrine()->getManager();

        if(!$evenement){
            $evenement = new Event();
        }

        $form = $this ->createForm(EvenementType::class, $evenement);

        $form ->handleRequest($request);
        $evenement ->setAddedBy($this->getUser());

        if ($form ->isSubmitted() && $form->isValid()) {
            $manager->persist($evenement);
            $manager->flush();

            return $this->redirectToRoute('/evenements');
                }

        return $this -> render('alumni/CreateEvenements.html.twig', [
            'formEvent' => $form -> createView(),
            'editMode' => $evenement -> getId() !==null
        ]);
    }

    /**
     * @Route("/Offre_de_stage/new", name="create_internshipOffer")
     * @Route("/Offre_de_stage/{id}/edit", name="modify_internshipOffer")
     */
    public function FormInternshipOffer(InternshipOffer $internshipOffer= null, Request $request){
        $manager = $this->getDoctrine()->getManager();

        if(!$internshipOffer){
            $internshipOffer = new Event();
        }

        $form = $this ->createForm(InternshipOfferType::class, $internshipOffer);

        $form ->handleRequest($request);

        if ($form ->isSubmitted() && $form->isValid()) {
            $manager->persist($internshipOffer);
            $manager->flush();

            return $this->redirectToRoute('/Offre_de_stage/{id}');
        }

        return $this -> render('alumni/CreateInternshipOffer.html.twig', [
            'formInternshipOffer' => $form -> createView(),
            'editMode' => $internshipOffer -> getId() !==null
        ]);
    }
}
