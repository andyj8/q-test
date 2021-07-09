<?php

namespace App\Services;

class QuoteScraper
{
    const BASE_URL = 'http://quotes.toscrape.com/';

    /**
     * @return string
     */
    public function getTagsContent()
    {
        return file_get_contents(self::BASE_URL);
    }

    /**
     * @param string $tag
     * @return string
     */
    public function getQuotesContent($tag)
    {
        return file_get_contents(sprintf('%s/tag/%s', self::BASE_URL, $tag));
    }
}
