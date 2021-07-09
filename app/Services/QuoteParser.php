<?php

namespace App\Services;

use Symfony\Component\DomCrawler\Crawler;

class QuoteParser
{
    /**
     * @param string $html
     * @return array
     */
    public function getTags($html)
    {
        $crawler = new Crawler($html);

        return $crawler->filter('.tag-item a')->each(function (Crawler $node, $i) {
            return $node->text();
        });
    }

    /**
     * @param string $html
     * @return string
     */
    public function getRandomQuote($html)
    {
        $crawler = new Crawler($html);

        $quotes = $crawler->filter('.quote')->each(function (Crawler $node, $i) {
            return sprintf('%s by %s', $node->children('.text')->text(), $node->children('span .author')->text());
        });

        if (empty($quotes)) {
            return 'Invalid tag';
        }

        return $quotes[rand(0, count($quotes) - 1)];
    }
}
