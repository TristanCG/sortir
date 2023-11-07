<?php

namespace App\DataFixtures;

use App\Entity\Statut;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StatutFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $statut = new Statut();
        $statut->setWording('Créée');
        $manager->persist($statut);

        $statut = new Statut();
        $statut->setWording('Ouverte');
        $manager->persist($statut);

        $statut = new Statut();
        $statut->setWording('Clôturée');
        $manager->persist($statut);

        $statut = new Statut();
        $statut->setWording('Activité en cours');
        $manager->persist($statut);

        $statut = new Statut();
        $statut->setWording('Passée');
        $manager->persist($statut);

        $statut = new Statut();
        $statut->setWording('Annulée');
        $manager->persist($statut);


        
        $manager->flush();
    }
}
