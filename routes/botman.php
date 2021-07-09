<?php

use App\Services\InstanceManagement;
use App\Services\QuoteParser;
use App\Services\QuoteScraper;

$botman = resolve('botman');

$botman->hears('create {id} {class} {engine}', function($bot, $id, $class, $engine) {
    $manager = $this->app->make(InstanceManagement::class);
    $bot->reply($manager->create($id, $class, $engine));
});

$botman->hears('delete {id}', function($bot, $id) {
    $manager = $this->app->make(InstanceManagement::class);
    $bot->reply($manager->delete($id));
});

$botman->hears('start {id}', function($bot, $id) {
    $manager = $this->app->make(InstanceManagement::class);
    $bot->reply($manager->start($id));
});

$botman->hears('stop {id}', function($bot, $id) {
    $manager = $this->app->make(InstanceManagement::class);
    $bot->reply($manager->stop($id));
});

$botman->hears('status {id}', function($bot, $id) {
    $manager = $this->app->make(InstanceManagement::class);
    $bot->reply(view('status', ['instance' => $manager->status($id)])->render());
});

$botman->hears('list', function($bot) {
    $manager = $this->app->make(InstanceManagement::class);
    $bot->reply(view('list', ['instances' => $manager->list()])->render());
});

$botman->hears('help', function($bot) {
    $bot->reply(view('help')->render());
});

$botman->hears('tags', function($bot) {
    $scraper = $this->app->make(QuoteScraper::class);
    $parser = $this->app->make(QuoteParser::class);
    $bot->reply(view('tags', ['tags' => $parser->getTags($scraper->getTagsContent())])->render());
});

$botman->hears('quote {tag}', function($bot, $tag) {
    $scraper = $this->app->make(QuoteScraper::class);
    $parser = $this->app->make(QuoteParser::class);
    $bot->reply($parser->getRandomQuote($scraper->getQuotesContent($tag), $tag));
});
