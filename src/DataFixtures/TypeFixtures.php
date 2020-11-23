<?php

namespace App\DataFixtures;

use App\Entity\Type;
use App\Entity\Aliment;
use App\Repository\AlimentRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TypeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $t1 = new Type();
        $t1->setImage('fruits.jpg')
           ->setName('fruits');
        $manager->persist($t1);

        $t2 = new Type();
        $t2->setImage('legumes.jpg')
           ->setName('legumes');
        $manager->persist($t2);

        $aliment = $manager->getRepository(Aliment::class);
        
        $a1= $aliment->findOneBy(["name"=>"carotte"]);
        $a1->setType($t2);
        $manager->persist($a1);

        $a2= $aliment->findOneBy(["name"=>"patate"]);
        $a2->setType($t2);
        $manager->persist($a2);

        $a3= $aliment->findOneBy(["name"=>"tomate"]);
        $a3->setType($t2);
        $manager->persist($a3);

        $a4= $aliment->findOneBy(["name"=>"pomme"]);
        $a4->setType($t1);
        $manager->persist($a4);

        $manager->flush();
    }
}
