<?php

namespace App\DataFixtures;

use App\Entity\City;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CityFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $city1 = new City();
        $city1->setName('Rennes');
        $city1->setZipcode('35000');
        $manager->persist($city1);
        $this->addReference('city-rennes', $city1);

        $city2 = new City();
        $city2->setName('Chartres-de-Bretagne');
        $city2->setZipcode('35131');
        $manager->persist($city2);
        $this->addReference('city-chartres', $city2);

        $city3 = new City();
        $city3->setName('Nantes');
        $city3->setZipcode('44000 ');
        $manager->persist($city3);
        $this->addReference('city-nantes', $city3);

        $city4 = new City();
        $city4->setName('Saint-Herblain');
        $city4->setZipcode('44800 ');
        $manager->persist($city4);
        $this->addReference('city-saint-herblain', $city4);

        $city5 = new City();
        $city5->setName('Niort');
        $city5->setZipcode('79000 ');
        $manager->persist($city5);
        $this->addReference('city-niort', $city5);


        $manager->flush();
    }
}
