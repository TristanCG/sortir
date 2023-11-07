<?php

namespace App\DataFixtures;

use App\Entity\Campus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CampusFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $campus1 = new Campus();
        $campus1->setName('Rennes');
        $manager->persist($campus1);
        $this->addReference('campus-rennes', $campus1);

        $campus2 = new Campus();
        $campus2->setName('Nantes');
        $manager->persist($campus2);
        $this->addReference('campus-nantes', $campus2);

        $campus3 = new Campus();
        $campus3->setName('Niort');
        $manager->persist($campus3);
        $this->addReference('campus-niort', $campus3);

        $manager->flush();
    }
}
