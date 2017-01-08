<?php
namespace Naloader;

use Symfony\Component\DomCrawler\Crawler;
use Carbon\Carbon;

/**
 * Class Chapter
 * @package Naloader
 */
class Chapter
{
    /**
     * parent novel object
     * @var Novel
     */
    private $novel;

    /**
     * @var int
     */
    public $number;

    /**
     * @var string
     */
    public $title;

    /**
     * @var Carbon
     */
    public $created_on;

    /**
     * the last update date if exists
     * @var Carbon|null
     */
    public $updated_on;

    /**
     * Chapter constructor.
     * @param Novel $novel
     * @param Crawler $crawler
     */
    public function __construct(Novel $novel, Crawler $crawler) {
        $this->novel = $novel;
        $this->parseFromCrawler($crawler);
    }

    /**
     * parse from the chapter node in a novel html page.
     * @param Crawler $crawler
     */
    public function parseFromCrawler(Crawler $crawler) {
        $aNode = $crawler->filter('a')->first();
        $paths = explode('/', trim($aNode->attr('href'), '/'));
        $this->number = (int)array_pop($paths);
        $this->title = $aNode->text();

        $dateNode = $crawler->filter('dt.long_update')->first();
        $this->created_on = Naloader::regulateDateString($dateNode->text());

        $updateNode = $dateNode->filter('span')->first();
        $this->updated_on = $updateNode->count() ? Naloader::regulateDateString($updateNode->attr('title')) : null;
    }
}