<?php

namespace App\DataFixtures;

use App\Entity\Rank;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RankFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $rank1 = new Rank();
        $rank1->setWording('Administrateur');
        $manager->persist($rank1);
        $this->addReference('rank-administrateur', $rank1);

        $rank2 = new Rank();
        $rank2->setWording('Utilisateur');
        $manager->persist($rank2);
        $this->addReference('rank-user', $rank2);


        $manager->flush();
    }
}
