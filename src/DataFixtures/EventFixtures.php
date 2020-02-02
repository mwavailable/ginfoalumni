<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Event;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
class EventFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i =1 ;$i<=10;$i++)
        {
            $event = new Event();
            $event ->setDescription("description")
                   ->setAddedBy($this->getReference(UserFixtures::USER_REFERENCE))
                   ->setEnd(new \DateTime())
                   ->setLocation("le Foys")
                   ->setName("name n°$i")
                   ->setStart(new \DateTime());
            $manager ->persist($event);
        }

        $manager->flush();
    }
    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }
}
