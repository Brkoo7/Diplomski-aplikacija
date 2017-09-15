<?php
namespace IssueInvoices\Infrastructure\Doctrine2;

use Doctrine\ORM\EntityRepository;
use IssueInvoices\Domain\Model\Administration\Article;
use IssueInvoices\Domain\Model\Administration\ArticleRepository;

class ArticleRepositoryImpl extends EntityRepository implements ArticleRepository
{
	public function store(Article $article)
    {
        $this->_em->persist($article);
        $this->_em->flush();
    }

    public function remove(Article $article)
    {
    	$this->_em->remove($article);
    	$this->_em->flush();
    }
}

