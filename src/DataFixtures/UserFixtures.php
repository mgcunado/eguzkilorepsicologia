<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use App\Entity\User;

class UserFixtures extends Fixture
{
   private $passwordEncoder;

   public function __construct(UserPasswordEncoderInterface $passwordEncoder)
   {
       $this->passwordEncoder = $passwordEncoder;
   }

  public function load(ObjectManager $manager)
    {
        $user = new User();
        // $manager->persist($product);

        $user->setEmail('gloria@orbelanet.com');        
       $user->setPassword($this->passwordEncoder->encodePassword(
           $user,
           'mikelito'
       ));
        $user->setRoles(['ROLE_USER']);
      
        $manager->persist($user);
        $manager->flush();
    }
}
