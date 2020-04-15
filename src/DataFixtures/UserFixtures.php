<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Event;
use App\Entity\InternshipOffer;
use Faker\Provider\DateTime;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
class UserFixtures extends Fixture
{
    public const USER_REFERENCE = 'user';

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager) {

        $faker = \Faker\Factory::create('fr_FR');

        //Créer des évènements
        for ($i=1; $i<=10; $i++)
        {   $user = new User();
            $user ->setUsername($faker ->unique()->userName())
                ->setFirstName($faker->unique() ->firstName())
                ->setLastName($faker ->LastName())
                ->setEmail($faker ->email())
                ->setCity($faker ->city())
                ->setCorporation($faker ->company())
                ->setJob($faker ->jobTitle())
                ->setPromo($faker ->year())
                ->setRegisterDate($faker ->dateTime())
                ->setEntered($faker ->dateTime())
                ->setAssoPosition($faker ->jobTitle());

            $password = $this->encoder->encodePassword($user, $faker->password());
            $user->setPassword($password);

            $manager->persist($user);

            $evenement = new Event();
            $evenement  ->setName($faker ->sentence())
                        ->setDescription($faker ->paragraph())
                        ->setLocation($faker->city())
                        ->setStart($faker ->dateTimeThisYear())
                        ->setEnd($faker ->dateTimeThisYear())
                        ->setAddedBy($user);

            $manager ->persist($evenement);
        }

        for($i = 1; $i<=30; $i++){
            $user = new User();
            $user ->setUsername($faker ->unique()->userName())
                ->setFirstName($faker->unique() ->firstName())
                ->setLastName($faker ->LastName())
                ->setEmail($faker ->email())
                ->setCity($faker ->city())
                ->setCorporation($faker ->company())
                ->setJob($faker ->jobTitle())
                ->setPromo($faker ->year())
                ->setRegisterDate($faker ->dateTime())
                ->setEntered($faker ->dateTime())
                ->setAssoPosition($faker ->jobTitle());

            $password = $this->encoder->encodePassword($user, $faker->password());
            $user->setPassword($password);

            $manager->persist($user);

        }
        //Créer des offres de stage
        for ($i=1; $i<=10; $i++)
        {   $user = new User();
            $user ->setUsername($faker ->unique()->userName())
                ->setFirstName($faker->unique() ->firstName())
                ->setLastName($faker ->LastName())
                ->setEmail($faker ->email())
                ->setCity($faker ->city())
                ->setCorporation($faker ->company())
                ->setJob($faker ->jobTitle())
                ->setPromo($faker ->year())
                ->setRegisterDate($faker ->dateTime())
                ->setEntered($faker ->dateTime())
                ->setAssoPosition($faker ->jobTitle());

            $password = $this->encoder->encodePassword($user, $faker->password());
            $user->setPassword($password);

            $manager->persist($user);

            $offer = new InternshipOffer();
            $offer  ->setAddedBy($user)
                    ->setTitle($faker ->jobTitle())
                    ->setDescription($faker ->paragraph())
                    ->setContact($faker ->phoneNumber())
                    ->setStartingDate($faker->dateTimeThisMonth())
                    ->setFile($faker ->url())
                    ->setCompany($faker ->company())
                    ->setCity($faker->city())
                    ->setOnline(true);

            $manager ->persist($offer);
        }
        $manager->flush();

        // other fixtures can get this object using the UserFixtures::USER_REFERENCE constant
        $this->addReference(self::USER_REFERENCE, $user);
    }
}
