<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Flash;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class FlashFixtures extends Fixture
{

    protected $faker;

    public const FLASHS = [
        ["photo" => "flash1.png" , "category" => 'category_0'],
        ["photo" => "flash2.png" , "category" => 'category_0'],
        ["photo" => "flash3.png" , "category" => 'category_0'],
        ["photo" => "flash4.png" , "category" => 'category_0'],
        ["photo" => "flash5.png" , "category" => 'category_0'],
        ["photo" => "flash6.png" , "category" => 'category_0'],
        ["photo" => "flash7.png" , "category" => 'category_0'],
        ["photo" => "flash8.png" , "category" => 'category_0'],
        ["photo" => "flash9.png" , "category" => 'category_0'],

        ["photo" => "illustratif1.png" , "category" => 'category_1'],
        ["photo" => "illustratif1.png" , "category" => 'category_1'],
        ["photo" => "illustratif3.png" , "category" => 'category_1'],
        ["photo" => "illustratif4.png" , "category" => 'category_1'],
        ["photo" => "illustratif5.png" , "category" => 'category_1'],
        ["photo" => "illustratif6.png" , "category" => 'category_1'],
        ["photo" => "illustratif7.png" , "category" => 'category_1'],
        ["photo" => "illustratif8.png" , "category" => 'category_1'],

        ["photo" => "jap1.png" , "category" => 'category_2'],
        ["photo" => "jap2.png" , "category" => 'category_2'],
        ["photo" => "jap2.png" , "category" => 'category_2'],
        ["photo" => "jap4.png" , "category" => 'category_2'],
        ["photo" => "jap5.png" , "category" => 'category_2'],
        ["photo" => "jap6.png" , "category" => 'category_2'],
        ["photo" => "jap7.png" , "category" => 'category_2']
    ];


    public function load(ObjectManager $manager): void
    {
        $this->faker = Factory::create();

        foreach (self::FLASHS as $key => $flashInfos) {
            $flash = new Flash();
            $flash->setName($this->faker->name);
            $flash->setPhoto($flashInfos["photo"]);
            $flash->setReserved($this->faker->boolean);
            $flash->setOnline(true);
            $flash->setCategory($this->getReference($flashInfos["category"]));
            //$flash->addReservation($flashInfos["reservations"]);
            $this->addReference('flash_' . $key, $flash);

            $manager->persist($flash);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          CategoryFixtures::class,
        ];
    }
}
