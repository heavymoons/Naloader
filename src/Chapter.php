<?php
namespace Naloader;

use Symfony\Component\DomCrawler\Crawler;
use Carbon\Carbon;
use Naloader\Naloader;

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
    public function parseFromCrawler(Crawler $crawler)
    {
        if ($crawler->attr('id') == 'novel_honbun') {
            $this->parseFromCrawlerForContent($crawler);
        } else {
            $this->parseFromCrawlerForChapterItem($crawler);
        }
    }

    /**
     * paarse from the novel page with the only single chapter
     * @param Crawler $crawler
     */
    public function parseFromCrawlerForContent(Crawler $crawler)
    {
        $this->number = 1;
        $this->title = null;
        $this->created_on = Carbon::now();
        $this->updated_on = null;
    }

    public function parseFromCrawlerForChapterItem(Crawler $crawler) {
        $aNode = $crawler->filter('a')->first();
        $paths = explode('/', trim($aNode->attr('href'), '/'));
        $this->number = (int)array_pop($paths);
        $this->title = Naloader::unescapeText($aNode->text());

        $dateNode = $crawler->filter('dt.long_update')->first();
        $this->created_on = Naloader::regulateDateString($dateNode->text());

        $updateNode = $dateNode->filter('span')->first();
        $this->updated_on = $updateNode->count() ? Naloader::regulateDateString($updateNode->attr('title')) : null;
    }
}