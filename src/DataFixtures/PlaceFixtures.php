<?php

namespace App\DataFixtures;

use App\Entity\Place;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PlaceFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $city1 = $this->getReference('city-rennes');

        // $product = new Product();
        // $manager->persist($product);
        $place1 = new Place();
        $place1->setName('The place to be');
        $place1->setStreet('de la soif');
        $place1->setLatitude('12');
        $place1->setLongitude('15');
        $place1-> setCity($city1);

        $manager->persist($place1);
        $manager->flush();
    }
    public function getDependencies(): array
    {
        // Spécifiez la classe de fixture sur laquelle cette fixture dépend
        return [
            CityFixtures::class,
        ];
    }
}
