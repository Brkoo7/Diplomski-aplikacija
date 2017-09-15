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
        $articles = $userAdministration->getArticles();

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
            $article = new Article(
                $formArticle->name,
                $formArticle->totalPrice,
                $formArticle->taxRate
            );
            $userAdministration->addArticle($article);

            // Spremiti
            $this->get('app.administration_repository')->store($userAdministration);

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
        $article = $this->get('app.article_repository')->find($articleId);

        $formArticle->name = $article->getName();
        $formArticle->totalPrice = $article->getTotalPrice();
        $formArticle->taxRate = $article->getTaxRate();

        $form = $this->createForm(ArticleType::class, $formArticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formArticle = $form->getData();
            
            $article->setName($formArticle->name);
            $article->setTotalPrice($formArticle->totalPrice);
            $article->setTaxRate($formArticle->taxRate);

            $this->get('app.article_repository')->store($article);

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
        $article = $this->get('app.article_repository')->find($articleId);
        $this->get('app.article_repository')->remove($article);

        return $this->redirectToRoute('AppBundle_Administration_articles');
    }
}
