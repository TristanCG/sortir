<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $campus1 = $this->getReference('campus-rennes');
        $campus2 = $this->getReference('campus-nantes');
        $campus3 = $this->getReference('campus-niort');


        // $product = new Product();
        // $manager->persist($product);
        $statut = new User();
        $statut->setLastname('DUPONT');
        $statut->setFirstname('Jean');
        $statut->setEmail('admin@admin.fr');
        $statut->setPhone('0748759784');
        $statut->setPassword('$2y$10$XnvQBU2iv/kLof3r51Mg4OGBpylJYDsged.KTv/etQVW4wN1pO1VS');
        $statut->setActive(true);
        $statut->setNickname('Administrator');
        $statut->setRoles(["ROLE_ADMIN"]);
        $statut->setCampus($campus1);
        $manager->persist($statut);

        $statut = new User();
        $statut->setLastname('BLANC');
        $statut->setFirstname('MOUCHOIR');
        $statut->setEmail('root@root.fr');
        $statut->setPhone('0748759784');
        $statut->setPassword('$2y$10$2Max6X/MeiT/UGUkFYzUruaCU4EVfcCd8uKyw50S1/89CNYqaafJm');
        $statut->setActive(true);
        $statut->setNickname('Rochambeau');
        $statut->setRoles(["ROLE_USER"]);
        $statut->setCampus($campus2);
        $manager->persist($statut);

        $statut = new User();
        $statut->setLastname('RANDOM');
        $statut->setFirstname('Michel');
        $statut->setEmail('test@root.fr');
        $statut->setPhone('0748759784');
        $statut->setPassword('$2y$10$2Max6X/MeiT/UGUkFYzUruaCU4EVfcCd8uKyw50S1/89CNYqaafJm');
        $statut->setActive(false);
        $statut->setNickname('Random');
        $statut->setRoles(["ROLE_USER"]);
        $statut->setCampus($campus3);
        $manager->persist($statut);


        
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CampusFixtures::class,
        ];
    }

}
