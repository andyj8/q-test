<?php

namespace Tests\BotMan;

use App\Services\QuoteParser;
use App\Services\QuoteScraper;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class QuoteBotTest extends TestCase
{
    public function testListsTags()
    {
        $tags = ['one', 'two'];

        $this->instance(QuoteScraper::class,
            Mockery::mock(QuoteScraper::class, function (MockInterface $mock) {
                $mock->shouldReceive('getTagsContent')->andReturn('html');
            })
        );
        $this->instance(QuoteParser::class,
            Mockery::mock(QuoteParser::class, function (MockInterface $mock) use ($tags) {
                $mock->shouldReceive('getTags')->with('html')->andReturn($tags);
            })
        );

        $expected = view('tags', ['tags' => $tags])->render();
        $this->bot->receives('tags')->assertReply($expected);
    }

    public function testGetsQuote()
    {
        $this->instance(QuoteScraper::class,
            Mockery::mock(QuoteScraper::class, function (MockInterface $mock) {
                $mock->shouldReceive('getQuotesContent')->with('tag')->andReturn('html');
            })
        );
        $this->instance(QuoteParser::class,
            Mockery::mock(QuoteParser::class, function (MockInterface $mock) {
                $mock->shouldReceive('getRandomQuote')->andReturn('quote');
            })
        );

        $this->bot->receives('quote tag')->assertReply('quote');
    }
}
