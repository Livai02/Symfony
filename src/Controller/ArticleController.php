<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Repository\ArticlesRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article/formulaire", name="formulaire")
     */
    public function formulaire(Request $request, EntityManagerInterface $manager): Response
    {
        $article = new Articles();
        $article->setDateArticles(new \DateTime());
        $form = $this->createFormBuilder($article)
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'attr' => ['placeholder' => 'titre de l\'article']
            ])
            ->add('intro', TextType::class, [
                'label' => 'Intro'
            ])
            ->add('author', TextType::class, [
                'label' => 'auteur',
                'attr' => ['placeholder' => 'Auteur de l\'article']
            ])
            ->add('image', UrlType::class, [
                'label' => 'image',
                'attr' => ['placeholder' =>  'Image de l\'article']
            ])
            ->add('save', SubmitType::class, ['label' => 'Create Articles'])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($article);
            $manager->flush();
        }


        return $this->render('article/formulaire.html.twig', [
            'controller_name' => 'ArticleController',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/article", name="article")
     */
    public function index(ArticlesRepository $articleRepository): Response
    {
        $articles = $articleRepository->findBydate_articles(null);

        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'articles' => $articles,
        ]);
    }


    /**
     * @Route("/article/detaille/{id}", name="detaille")
     */
    public function detaille(ArticlesRepository $articleRepository, $id): Response
    {

        $article = $articleRepository->find($id);

        return $this->render('article/detaille.html.twig', [
            'article' => $article,
        ]);
    }


    // supprimer un article
    /**
     * @Route("/article/delete/{id}", name="delete")
     */
    public function delete(int $id, EntityManagerInterface $manager): Response
    {
        $article = $this->getDoctrine()
            ->getRepository(Articles::class)
            ->find($id);

        $manager->remove($article);
        $manager->flush();
        $this->addFlash('delete', 'L\'article a bien étais supprimer');
        return $this->redirectToRoute('article');
    }

    public function update(Request $request): Response
    {

        if ($form->isSubmitted() && $form->isValid()) {
            // do some sort of processing

            $this->addFlash(
                'notice',
                'Vous avez bien supprimer l\'article'
            );

            return $this->redirectToRoute("article");
        }
    }
}