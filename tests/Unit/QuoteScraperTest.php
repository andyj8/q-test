<?php

namespace Tests\Unit;

use App\Services\QuoteParser;
use Tests\TestCase;

class QuoteScraperTest extends TestCase
{
    public function testGetsTags()
    {
        $scraper = new QuoteParser();
        $fixture = file_get_contents(__DIR__ . '/../Fixtures/quotes.html');
        $expected = ['love', 'life'];
        $this->assertEquals($expected, $scraper->getTags($fixture));
    }

    public function testGetsRandomQuote()
    {
        $scraper = new QuoteParser();
        $fixture = file_get_contents(__DIR__ . '/../Fixtures/quotes.html');
        $expected = ['good by bob', 'bad by fred'];
        $this->assertContains($scraper->getRandomQuote($fixture), $expected);
    }
}
