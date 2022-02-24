<?php

namespace App\Controller;

use App\Entity\Console;
use App\Entity\Articles;
use App\Entity\Categorie;
use Doctrine\ORM\EntityManager;
use App\Repository\ArticlesRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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
                'label' => 'Résume'
            ])
            ->add('author', TextType::class, [
                'label' => 'auteur',
                'attr' => ['placeholder' => 'Entreprise de developpement du jeux']
            ])
            ->add('image', UrlType::class, [
                'label' => 'image Copier l\'adresse du lien',
                'attr' => ['placeholder' => 'image']
            ])
            ->add('idcategorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'categorie'
            ])
            ->add('idconsole', EntityType::class, [
                'class' => Console::class,
                'choice_label' => 'console'
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
        $this->addFlash('notice', 'L\'article a bien étais supprimer');
        return $this->redirectToRoute('article');
    }

    //modifier un article

    /**
     * @Route("/article/update/{id}", name="update")
     */
    public function update(Request $request, Articles $article, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(Articles::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($article);
            $manager->flush();
            $this->addFlash(
                'info',
                "L'article <strong>{$article->getTitle()}</strong> a bien été modifié"
            );
            return $this->redirectToRoute('card.article'[]);
        }
        return $this->render('article/update.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }
}