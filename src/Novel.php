<?php
namespace Naloader;

use Symfony\Component\DomCrawler\Crawler;

/**
 * Class Novel
 * @package Naloader
 */
class Novel
{
    /**
     * the novel top page url.
     * @var string
     */
    public $url;
    public $title;
    public $author;
    public $textDownloadUrl;
    public $chapters;

    public function __construct($url, $html = null) {
        $this->url = $url;
    }

    public function crawl() {
        $client = Naloader::getHttpClient($this->url);
        $crawler = $client->request('GET', $this->url);
        $this->parseFromCrawler($crawler);
    }

    public function parseFromHtml($url, $html) {
        $this->url = $url;
        $crawler = new Crawler(null, $this->url);
        $crawler->addContent($html);
        $this->parseFromCrawler($crawler);
    }

    public function parseFromCrawler(Crawler $crawler) {
        $this->title = Naloader::unescapeText($crawler->filter('p.novel_title')->first()->text());

        $authorNode = $crawler->filter('div.novel_writername a')->first();
        $authorUrl = $authorNode->attr('href');
        $this->author = new Author($authorUrl);
        $this->author->name = Naloader::unescapeText($authorNode->text());

        $crawler->filter('ul.undernavi a')->each(function(Crawler $node) {
            $linkUrl = $node->attr('href');
            if (strpos($linkUrl, 'txtdownload') !== false) {
                $this->textDownloadUrl = $linkUrl;
            }
        });

        $this->chapters = [];
        $crawler->filter('div.index_box dl.novel_sublist2')->each(function (Crawler $itemNode) {
            $chapter = new Chapter($this, $itemNode);
            $this->chapters[] = $chapter;
        });
    }
}