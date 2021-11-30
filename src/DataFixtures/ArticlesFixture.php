<?php

namespace App\DataFixtures;

use App\Entity\Articles;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Validator\Constraints\Length;
use Faker;


class ArticlesFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 20; $i++) {
            $article = new Articles();
            $article->setTitle($faker->sentence(3));
            $article->setIntro($faker->paragraph(2));
            $article->setAuthor($faker->name());
            $article->setImage('https://picsum.photos/id/237/536/354');
            $article->setDateArticles($faker->dateTime());

            // persister l'objet
            $manager->persist($article);
        }
        // envoyer l'objet a la DB
        $manager->flush();
    }
}