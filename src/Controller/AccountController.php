<?php

namespace App\Controller;

use App\Entity\Articles;
use Doctrine\ORM\EntityManager;
use App\Repository\ArticlesRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccountController extends AbstractController
{
    // /**
    //  * @Route("/home/account", name="account")
    //  */
    // public function index(): Response
    // {
    //     return $this->render('account/dashboard.html.twig', [
    //         'controller_name' => 'AccountController',

    //     ]);
    // }

    /**
     * @Route("/home/account", name="account")
     */
    public function dashboard(ArticlesRepository $articleRepository): Response
    {
        $articles = $articleRepository->findBydate_articles(null);

        return $this->render('account/dashboard.html.twig', [
            'controller_name' => 'ArticleController',
            'articles' => $articles,
        ]);
    }


    /**
     * @Route("/article/account/detaille/{id}", name="detaille")
     */
    public function detaille(ArticlesRepository $articleRepository, $id): Response
    {

        $article = $articleRepository->find($id);

        return $this->render('article/detaille.html.twig', [
            'article' => $article,
        ]);
    }
}