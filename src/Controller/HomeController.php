<?php

namespace App\Controller;


use stdClass;

use App\Entity\Articles;
use App\Repository\ArticlesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    // EntityManagerInterface $manager
    public function index(ArticlesRepository $articleRepository): Response
    {
        // $article = new Articles();
        // $article->setTitle('Monster Hunter');
        // $article->setIntro('Vous incarne un chasseur dans un environnement fantasy qui complète des quêtes ayant principalement pour but de chasser ou capturer des monstres et aussi de collecter des minéraux, poissons ou petits monstres');
        // $article->setAuthor('Capcom');
        // $article->setImage('https://cdn-ext.fanatical.com/production/product/1280x720/7f6e4bbc-69a4-4910-a424-8b4f14100c12.jpeg');
        // $article->setDateArticles(new \DateTime());
        // // persister l'objet
        // $manager->persist($article);
        // // envoyer l'objet a la DB
        // $manager->flush();
        $articles = $articleRepository->findBydate_articles(3);

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'articles' => $articles
        ]);
    }
}