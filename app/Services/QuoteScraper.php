<?php

namespace App\Services;

use Symfony\Component\DomCrawler\Crawler;

class QuoteScraper
{
    const BASE_URL = 'http://quotes.toscrape.com/';

    public function getTags()
    {
        $html = file_get_contents(self::BASE_URL);
        $crawler = new Crawler($html);

        return $crawler->filter('.tag-item a')->each(function (Crawler $node, $i) {
            return $node->text();
        });
    }

    /**
     * @param string $tag
     * @return string
     */
    public function getRandomQuote($tag)
    {
        $html = file_get_contents(sprintf('%s/tag/%s', self::BASE_URL, $tag));
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
