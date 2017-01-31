<?php
namespace Naloader\Tests;

/**
 * Class NovelTest
 * @package Naloader\Tests
 */
class NovelTest extends \PHPUnit_Framework_TestCase
{
    /**
     * test crawl and parse from the yomou site.
     */
    public function testScrapeNovelInYomou() {
        $url = 'http://ncode.syosetu.com/n9669bk/';

        $expectedTitle = '無職転生　- 異世界行ったら本気だす -';
        $expectedAuthorName = '理不尽な孫の手';
        $expectedAuthorUrl = 'http://mypage.syosetu.com/288399/';
        $expectedTextDownloadTopUrl = 'http://ncode.syosetu.com/txtdownload/top/ncode/369633/';
        $expectedChapterCount = 286;

        $novel = new \Naloader\Novel($url);
        $novel->crawl();

        $this->assertEquals($expectedTitle, $novel->title);
        $this->assertEquals($expectedAuthorName, $novel->author->name);
        $this->assertEquals($expectedAuthorUrl, $novel->author->url);
        $this->assertEquals($expectedTextDownloadTopUrl, $novel->textDownloadTopUrl);
        $this->assertEquals($expectedChapterCount, count($novel->chapters));
    }

    /**
     * test crawl and parse from the nocturne site
     */
    public function testScrapeNovelInNocturne() {
        $url = 'http://novel18.syosetu.com/n9412dj/';

        $expectedTitle = '悦楽のノワール　～腰砕け吸血姫の快楽特訓～';
        $expectedAuthorName = '那羽都レン';
        $expectedAuthorUrl = 'http://xmypage.syosetu.com/x9748l/';
        $expectedTextDownloadTopUrl = 'http://novel18.syosetu.com/txtdownload/top/ncode/879325/';
        $expectedChapterCount = 24;

        $novel = new \Naloader\Novel($url);
        $novel->crawl();

        $this->assertEquals($expectedTitle, $novel->title);
        $this->assertEquals($expectedAuthorName, $novel->author->name);
        $this->assertEquals($expectedAuthorUrl, $novel->author->url);
        $this->assertEquals($expectedTextDownloadTopUrl, $novel->textDownloadTopUrl);
        $this->assertEquals($expectedChapterCount, count($novel->chapters));
    }

    /**
     * test crawl and parse from the moonlight site
     */
    public function testScrapeNovelInMoonlight() {
        $url = 'http://novel18.syosetu.com/n5989dh/';

        $expectedTitle = '大変なことになってしまった';
        $expectedAuthorName = '園内かな';
        $expectedAuthorUrl = 'http://xmypage.syosetu.com/x5800h/';
        $expectedTextDownloadTopUrl = 'http://novel18.syosetu.com/txtdownload/top/ncode/855904/';
        $expectedChapterCount = 14;

        $novel = new \Naloader\Novel($url);
        $novel->crawl();

        $this->assertEquals($expectedTitle, $novel->title);
        $this->assertEquals($expectedAuthorName, $novel->author->name);
        $this->assertEquals($expectedAuthorUrl, $novel->author->url);
        $this->assertEquals($expectedTextDownloadTopUrl, $novel->textDownloadTopUrl);
        $this->assertEquals($expectedChapterCount, count($novel->chapters));
    }

    /**
     * test crawl and parse from the midnight site
     */
    public function testScrapeNovelInMidnight() {
        $url = 'http://novel18.syosetu.com/n7126cq/';

        $expectedTitle = '下僕の俺が盲目の超わがままお嬢さまの性奴隷な件';
        $expectedAuthorName = '長谷川蒼箔';
        $expectedAuthorUrl = 'http://xmypage.syosetu.com/x3518m/';
        $expectedTextDownloadTopUrl = 'http://novel18.syosetu.com/txtdownload/top/ncode/687058/';
        $expectedTextDownloadUrl = 'http://novel18.syosetu.com/txtdownload/dlstart/ncode/687058/';
        $expectedChapterCount = 104;

        $novel = new \Naloader\Novel($url);
        $novel->crawl();

        $this->assertEquals($expectedTitle, $novel->title);
        $this->assertEquals($expectedAuthorName, $novel->author->name);
        $this->assertEquals($expectedAuthorUrl, $novel->author->url);
        $this->assertEquals($expectedTextDownloadTopUrl, $novel->textDownloadTopUrl);
        $this->assertEquals($expectedTextDownloadUrl, $novel->getTextDownloadUrl());
        $this->assertEquals($expectedChapterCount, count($novel->chapters));

        $url = 'http://novel18.syosetu.com/n7803cs/';

        $expectedTitle = '最凶魔術師の異常なる逃亡生活';
        $expectedAuthorName = 'ピンク色伯爵';
        $expectedAuthorUrl = 'http://xmypage.syosetu.com/x7234n/';
        $expectedTextDownloadTopUrl = 'http://novel18.syosetu.com/txtdownload/top/ncode/707733/';
        $expectedTextDownloadUrl = 'http://novel18.syosetu.com/txtdownload/dlstart/ncode/707733/';
        $expectedChapterCount = 190;

        $novel = new \Naloader\Novel($url);
        $novel->crawl();

        $this->assertEquals($expectedTitle, $novel->title);
        $this->assertEquals($expectedAuthorName, $novel->author->name);
        $this->assertEquals($expectedAuthorUrl, $novel->author->url);
        $this->assertEquals($expectedTextDownloadTopUrl, $novel->textDownloadTopUrl);
        $this->assertEquals($expectedTextDownloadUrl, $novel->getTextDownloadUrl());
        $this->assertEquals($expectedChapterCount, count($novel->chapters));
    }

    public function testScrapeSingleContent() {
        $url = 'http://novel18.syosetu.com/n4874dd/';

        $expectedTitle = '引きこもり少女は俺専用の肉便器';
        $expectedAuthorName = 'アルトワ';
        $expectedAuthorUrl = 'http://xmypage.syosetu.com/x0452b/';
        $expectedTextDownloadTopUrl = 'http://novel18.syosetu.com/txtdownload/top/ncode/814793/';
        $expectedTextDownloadUrl = 'http://novel18.syosetu.com/txtdownload/dlstart/ncode/814793/';
        $expectedChapterCount = 1;

        $novel = new \Naloader\Novel($url);
        $novel->crawl();

        $this->assertEquals($expectedTitle, $novel->title);
        $this->assertEquals($expectedAuthorName, $novel->author->name);
        $this->assertEquals($expectedAuthorUrl, $novel->author->url);
        $this->assertEquals($expectedTextDownloadTopUrl, $novel->textDownloadTopUrl);
        $this->assertEquals($expectedTextDownloadUrl, $novel->getTextDownloadUrl());
        $this->assertEquals($expectedChapterCount, count($novel->chapters));
    }
}
