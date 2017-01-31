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

    /**
     * @var string
     */
    public $title;

    /**
     * @var Author
     */
    public $author;

    /**
     * @var string
     */
    public $textDownloadTopUrl;

    /**
     * @var array
     */
    public $chapters;

    /**
     * Novel constructor.
     * @param $url
     * @param null $html
     * @throws \Exception
     */
    public function __construct($url, $html = null) {
        if (!Naloader::isValidNovelUrl($url)) {
            throw new \Exception("invalid novel url: $url");
        }
        $this->url = $url;
    }

    /**
     * crawl novel top page
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
        $this->title = Naloader::unescapeText($crawler->filter('p.novel_title')->first()->text());

        $authorNode = $crawler->filter('div.novel_writername')->first();
        $authorUrl = $crawler->filter('div#novel_footer a')->first()->attr('href');
        $this->author = new Author($authorUrl);
        $authorName = trim($authorNode->text());
        $authorName = mb_substr($authorName, 3, null, 'utf-8'); // "作者："
        $this->author->name = Naloader::unescapeText($authorName);

        $crawler->filter('ul.undernavi a')->each(function(Crawler $node) {
            $linkUrl = $node->attr('href');
            if (strpos($linkUrl, 'txtdownload') !== false) {
                $this->textDownloadTopUrl = $linkUrl;
            }
        });

        $this->chapters = [];
        $crawler->filter('div.index_box dl.novel_sublist2')->each(function (Crawler $itemNode) {
            $chapter = new Chapter($this, $itemNode);
            $this->chapters[] = $chapter;
        });
        if (empty($this->chapters)) {
            $contentNode = $crawler->filter('div#novel_honbun')->first();
            $chapter = new Chapter($this, $contentNode);
            $this->chapters[] = $chapter;
        }
    }

    /**
     * convert text download top url to text download url
     * @return string
     */
    public function getTextDownloadUrl() {
        return str_replace('/top/', '/dlstart/', $this->textDownloadTopUrl);
    }
}