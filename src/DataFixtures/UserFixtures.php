<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=1; $i<=10; $i++)
        {
            $user = new User();
            $user ->setUsername("vieilleLoutre n°$i")
                  ->setFirstName("Jeff n°$i")
                  ->setLastName("Lastname n°$i")
                  ->setEmail("jLastnamen°$i@ec-m.fr")
                  ->setPassword("password n°$i")
                  ->setCity("city n°$i")
                  ->setCorporation("corporation du n°$i")
                  ->setJob("job du n°$i")
                  ->setPromo($i + 1985)
                  ->setRegisterDate(new \DateTime())
                  ->setEntered(new \DateTime())
                  ->setAssoPosition("loutre énervée n°$i")
                  ->setRoles();
            $manager->persist($user);
        }
        $manager->flush();
    }
}
