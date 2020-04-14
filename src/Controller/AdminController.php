<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * @IsGranted("ROLE_ADMIN")
 */

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/administrator", name="list_admin")
     */
    public function admin (){

        $repo = $this->getDoctrine()->getRepository(User::class);

        $users = $repo->findAll();
        $useronline = $this->getUser();

        return $this->render('admin/admin.html.twig', [
            'users' => $users,
            'userOnline' => $useronline
        ]);
    }

    /**
     * @Route("admin/{id}/nameadmin", name="name_admin")
     */

    public function nameadmin(User $user)
    {
        $manager = $this->getDoctrine()->getManager();
        $user -> setRoles(["ROLE_ADMIN"]);

        $manager->persist($user);
        $manager->flush();

        $this->addFlash(
            'success',
            ($user->getLastName()) . ' est maintenant administrateur.'
        );


        return $this->redirectToRoute('list_admin');

    }

    /**
     * @Route("admin/{id}/blockadmin", name="block_admin")
     */

    public function blockadmin(User $user)
    {
        $manager = $this->getDoctrine()->getManager();
        $useronline = $this->getUser();
        if (($user->getRoles()[0]) == "ROLE_ADMIN"){
            if ($user->getId() == $useronline->getId()){
                $this->addFlash(
                    'warning',
                    'Vous ne pouvez pas vous destituer vous-même.'
                );
            } else {
                $user -> setRoles(["ROLE_USER"]);
                $this->addFlash(
                    'warning',
                    'Vous avez destitué ' . ($user->getLastName()) . ' de son rôle d\'administrateur.'
                );
                $manager->persist($user);
                $manager->flush();
            }
        }else{
            $this->addFlash(
                'warning',
                ($user->getLastName()) . ' n\'est pas administrateur.'
            );
        }


        return $this->redirectToRoute('list_admin');

    }
}
