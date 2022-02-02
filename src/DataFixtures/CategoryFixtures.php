<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CategoryFixtures extends Fixture
{
    protected $faker;

    public function load(ObjectManager $manager): void
    {
        $this->faker = Factory::create();

        for ($i=0; $i<3; $i++){
            $category = new Category();
            $category->setName($this->faker->name);
            //$category->setDescription($this->faker->sentence($nbWords = 8, $variableNbWords = true));
            $category->setDescription('Possimus omnis aut incidunt sunt. Asperiores incidunt iure sequi cum culpa rem.');
            $this->addReference('category_'. $i, $category);

            $manager->persist($category);
        }

        $manager->flush();
    }
}
