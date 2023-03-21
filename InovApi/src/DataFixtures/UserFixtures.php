<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
class UserFixtures extends Fixture
{
    private $faker;
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher){
        $this->faker=Factory::create("fr_FR");
        $this->passwordHasher= $passwordHasher;
 }

    public function load(ObjectManager $manager): void
    {
        for($i=0;$i<12;$i++){
            $user = new User();
            if ($i==0) {
                $user->setUsername('dawa19')
                    ->setNom('ibou')
                    ->setRoles(array('ROLE_ADMIN'))
                    ->setPrenom('boui')
                    ->setPassword('btsinfo');     
            } else if ($i==1) {
                $user->setUsername('user')
                    ->setNom('dewa')
                    ->setRoles(array('ROLE_ADMIN'))
                    ->setPrenom('ibra')
                    ->setPassword('btsinfo');     
            } else {
                $nom=$this->faker->lastName();
                $prenom=$this->faker->firstName();
                $user->setUsername($nom.''.$prenom)
                    ->setNom($nom)
                    ->setPrenom($prenom)
                    ->setPassword($prenom);
            }
            
            $this->addReference('user'.$i, $user);
            $manager->persist($user);
        }
        $manager->flush();
    }
}