<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Event;
class EventFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i =1 ;$i<=10;$i++)
        {
            $event = new Event();
            $event ->setDescription("description")
                   ->setAddedBy()
                   ->setEnd(new \DateTime())
                   ->setLocation("le Foys")
                   ->setName("name n°$i")
                   ->setStart(new \DateTime());
            $manager ->persist($event);
        }

        $manager->flush();
    }
}
