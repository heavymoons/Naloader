<?php
namespace Naloader\Tests;

/**
 * Class NovelTest
 * @package Naloader\Tests
 */
class NovelTest extends \PHPUnit_Framework_TestCase
{
    /**
     * test crawl and parse from the midnight site
     */
    public function testScrapeNovelInMidnight() {
        $url = 'http://novel18.syosetu.com/n7126cq/';

        $expectedTitle = '下僕の俺が盲目の超わがままお嬢さまの性奴隷な件';
        $expectedAuthorName = '長谷川蒼箔';
        $expectedAuthorUrl = 'http://xmypage.syosetu.com/x3518m/';
        $expectedTextDownloadUrl = 'http://novel18.syosetu.com/txtdownload/top/ncode/687058/';
        $expectedChapterCount = 104;

        $novel = new \Naloader\Novel($url);
        $novel->crawl();

        $this->assertEquals($expectedTitle, $novel->title);
        $this->assertEquals($expectedAuthorName, $novel->author->name);
        $this->assertEquals($expectedAuthorUrl, $novel->author->url);
        $this->assertEquals($expectedTextDownloadUrl, $novel->textDownloadUrl);
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
        $expectedTextDownloadUrl = 'http://novel18.syosetu.com/txtdownload/top/ncode/855904/';
        $expectedChapterCount = 14;

        $novel = new \Naloader\Novel($url);
        $novel->crawl();

        $this->assertEquals($expectedTitle, $novel->title);
        $this->assertEquals($expectedAuthorName, $novel->author->name);
        $this->assertEquals($expectedAuthorUrl, $novel->author->url);
        $this->assertEquals($expectedTextDownloadUrl, $novel->textDownloadUrl);
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
        $expectedTextDownloadUrl = 'http://novel18.syosetu.com/txtdownload/top/ncode/879325/';
        $expectedChapterCount = 24;

        $novel = new \Naloader\Novel($url);
        $novel->crawl();

        $this->assertEquals($expectedTitle, $novel->title);
        $this->assertEquals($expectedAuthorName, $novel->author->name);
        $this->assertEquals($expectedAuthorUrl, $novel->author->url);
        $this->assertEquals($expectedTextDownloadUrl, $novel->textDownloadUrl);
        $this->assertEquals($expectedChapterCount, count($novel->chapters));
    }

    /**
     * test crawl and parse from the yomou site.
     */
    public function testScrapeNovelInYomou() {
        $url = 'http://ncode.syosetu.com/n9669bk/';

        $expectedTitle = '無職転生　- 異世界行ったら本気だす -';
        $expectedAuthorName = '理不尽な孫の手';
        $expectedAuthorUrl = 'http://mypage.syosetu.com/288399/';
        $expectedTextDownloadUrl = 'http://ncode.syosetu.com/txtdownload/top/ncode/369633/';
        $expectedChapterCount = 286;

        $novel = new \Naloader\Novel($url);
        $novel->crawl();

        $this->assertEquals($expectedTitle, $novel->title);
        $this->assertEquals($expectedAuthorName, $novel->author->name);
        $this->assertEquals($expectedAuthorUrl, $novel->author->url);
        $this->assertEquals($expectedTextDownloadUrl, $novel->textDownloadUrl);
        $this->assertEquals($expectedChapterCount, count($novel->chapters));
    }
}
