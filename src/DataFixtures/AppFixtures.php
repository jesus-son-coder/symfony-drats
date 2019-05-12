<?php

namespace App\DataFixtures;

use App\Entity\MicroPost;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $this->loadMicroPosts($manager);
        $this->loadUsers($manager);

    }

    private function loadUsers(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('john_doe');
        $user->setEmail('john_doe@doe.com');
        $user->setFullName('John Doe');
        $user->setPassword(
            $this->passwordEncoder->encodePassword(
                $user,
                'password'
            )
        );

        $manager->persist($user);
        $manager->flush();
    }

    private function loadMicroPosts(ObjectManager $manager)
    {
        for ($i = 0; $i < 5; $i++) {
            $micropost = new MicroPost();
            $micropost->setText('Some random text ' . rand(0, 100));
            $micropost->setTime(new \DateTime());
            $manager->persist($micropost);
        }

        $manager->flush();
    }
}
