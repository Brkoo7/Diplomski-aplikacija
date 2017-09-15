<?php

namespace IssueInvoices\Domain\Model\Administration;

interface ArticleRepository
{
	/**
     * Sprema artikl.
     *
     * @param Article $article
     *
     * @throws \Exception Ako se dogodi greška prilikom spremanja
     */
    public function store(Article $article);

    /**
     * Briše artikl.
     *
     * @param Article $article
     *
     * @throws \Exception Ako se dogodi greška tijekom brisanja
     */
    public function remove(Article $article);
}
