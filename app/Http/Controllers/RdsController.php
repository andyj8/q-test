<?php

namespace App\Http\Controllers;

use App\Services\InstanceManagement;
use App\Services\QuoteScraper;
use Illuminate\Support\Facades\App;
use Symfony\Component\DomCrawler\Crawler;

class RdsController extends Controller
{
    /**
     * @var InstanceManagement
     */
    private $instanceManagement;

    public function __construct()
    {
        $this->instanceManagement = App::make(InstanceManagement::class);
    }

    public function list()
    {
        return $this->instanceManagement->list();
    }

    public function status()
    {
        return $this->instanceManagement->status('database-1-instance-1');
    }

    public function create()
    {
        return $this->instanceManagement->create('new-1', 'db.t2.micro', 'postgres');
    }

    public function delete()
    {
        return $this->instanceManagement->delete('database-2');
    }

    public function start()
    {
        return $this->instanceManagement->start('database-2');
    }

    public function stop()
    {
        return $this->instanceManagement->stop('database-2');
    }

    public function tags()
    {
        $scraper = new QuoteScraper();
        return $scraper->getTags();
    }

    public function quote()
    {
        return QuoteScraper::getRandomQuote('humor');
    }
}
