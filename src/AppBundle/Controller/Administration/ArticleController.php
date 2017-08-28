<?php
namespace AppBundle\Controller\Administration;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Model\Administration\Article as FormArticle;
use AppBundle\Form\Type\Administration\ArticleType;
use IssueInvoices\Domain\Model\Administration\Article;

class ArticleController extends Controller
{
    /**
     * @Route("/administration/articles", name="AppBundle_Administration_articles")
     */
    public function articlesAction(Request $request)
    {
        $userAdministration = $this->getUser()->getAdministration();
        $userAdministrationId = $userAdministration->getId();

        $articles = $this->get('app.article_repository')
                ->findAllForUserAdministration($userAdministrationId);

        return $this->render('AppBundle:Administration:articles.html.twig', [
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/administration/article/add", name="AppBundle_Administration_addArticle")
     */
    public function addArticleAction(Request $request)
    {
        $formArticle = new FormArticle();
        $form = $this->createForm(ArticleType::class, $formArticle);

        $form->handleRequest($request);

        $userAdministration = $this->getUser()->getAdministration();

        if ($form->isSubmitted() && $form->isValid()) {
            $formArticle = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $article = new Article();
            $article->setName($formArticle->name);
            $article->setTotalPrice($formArticle->totalPrice);
            $article->setTaxRate($formArticle->taxRate);
            $article->setAdministration($userAdministration);

            $userAdministration->addArticle($article);

            // Spremiti
            $entityManager->persist($userAdministration);
            $entityManager->flush();

            return $this->redirectToRoute('AppBundle_Administration_articles');
        }

        return $this->render('AppBundle:Administration:addArticle.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/administration/article/edit/{articleId}", name="AppBundle_Administration_editArticle")
     */
    public function editArticleAction(Request $request, int $articleId)
    {
        $formArticle = new FormArticle();

        $article = $this->get('app.article_repository')->findOneById($articleId);

        $formArticle->name = $article->getName();
        $formArticle->totalPrice = $article->getTotalPrice();
        $formArticle->taxRate = $article->getTaxRate();

        $form = $this->createForm(ArticleType::class, $formArticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formArticle = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            
            $article->setName($formArticle->name);
            $article->setTotalPrice($formArticle->totalPrice);
            $article->setTaxRate($formArticle->taxRate);

            $entityManager->flush();
            return $this->redirectToRoute('AppBundle_Administration_articles'); 
        }

        return $this->render('AppBundle:Administration:addArticle.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/administration/article/delete/{articleId}", name="AppBundle_Administration_deleteArticle")
     */
    public function deleteArticleAction(int $articleId)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $article = $this->get('app.article_repository')->findOneById($articleId);

        $entityManager->remove($article);
        $entityManager->flush();

        return $this->redirectToRoute('AppBundle_Administration_articles');
    }
}
