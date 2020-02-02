<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\InternshipOffer;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
class InternshipOfferFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i =1; $i<=10; $i++)
        {
            $IntershipOffer = new InternshipOffer();
            $IntershipOffer ->setAddedBy($this->getReference(UserFixtures::USER_REFERENCE))
                            ->setCity("city n°$i")
                            ->setCompany("$i company")
                            ->setContact("loutre@email.fr n°$i")
                            ->setDescription("faire du sale sale sale")
                            ->setFile("url")
                            ->setOnline(True)
                            ->setStartingDate(new \DateTime())
                            ->setTitle("Faire du sale là n°$i");
            $manager->persist($IntershipOffer);
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
