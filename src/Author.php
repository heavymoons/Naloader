<?php
namespace Naloader;

use Symfony\Component\DomCrawler\Crawler;

/**
 * Class Author
 * @package Naloader
 */
class Author
{
    /**
     * the author top page url.
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $name;

    /**
     * @var array
     */
    public $series = [];

    /**
     * @var array
     */
    public $novels = [];

    /**
     * Author constructor.
     * @param $url
     * @throws \Exception
     */
    public function __construct($url) {
        if (!Naloader::isValidAuthorUrl($url)) {
            throw new \Exception("invalid author url: $url");
        }
        $this->url = $url;
    }

    /**
     * crawl author page
     */
    public function crawl() {
        $client = Naloader::getHttpClient($this->url);
        $crawler = $client->request('GET', $this->url);
        $this->parseFromCrawler($crawler);
    }

    /**
     * parse novel top html
     * @param $url
     * @param $html
     */
    public function parseFromHtml($url, $html) {
        $this->url = $url;
        $crawler = new Crawler(null, $this->url);
        $crawler->addContent($html);
        $this->parseFromCrawler($crawler);
    }

    /**
     * parse crawler object of novel top html
     * @param Crawler $crawler
     */
    public function parseFromCrawler(Crawler $crawler) {
        $this->name = $crawler->filter('title')->first()->text();

        $this->series = [];
        $crawler->filter('div#serieslist_top ul li a')->each(function(Crawler $seriesNode) {
            $series = new Series();
            $series->url = $seriesNode->attr('href');
            $series->title = $seriesNode->text();
            $this->series[] = $series;
        });

        $this->novels = [];

        // なろう
        $crawler->filter('div#novellist_top td.title a')->each(function(Crawler $novelNode) {
            $novel = new Novel($novelNode->attr('href'));
            $novel->title = $novelNode->text();
            $this->novels[] = $novel;
        });

        // R18
        $crawler->filter('div#novellist_top a.title')->each(function(Crawler $novelNode) {
            $novel = new Novel($novelNode->attr('href'));
            $novel->title = $novelNode->text();
            $this->novels[] = $novel;
        });
        // TODO - R18で10作品以上ある場合はページングされた作品一覧ページを王必要がある
    }
}
