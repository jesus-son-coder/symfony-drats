<?php

namespace App\DataFixtures;

use App\Entity\MicroPost;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $micropost = new MicroPost();
            $micropost->setText('Some random text ' . rand(0, 100));
            $micropost->setTime(new \DateTime());
            $manager->persist($micropost);
        }

        $manager->flush();
    }
}
