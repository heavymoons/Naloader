<?php
namespace Naloader\Tests;

/**
 * Class DownloadTest
 * @package Naloader\Tests
 */
class DownloadTest extends \PHPUnit_Framework_TestCase
{
    /**
     * test crawl and parse from the yomou site.
     */
    public function testDownloadInYomou() {
        $url = 'http://ncode.syosetu.com/n9669bk/';

        $novel = new \Naloader\Novel($url);
        $novel->crawl();

        $chapter = $novel->chapters[0];
    }

    /**
     * test crawl and parse from the nocturne site.
     */
    public function testDownloadInNocturne() {
        $url = 'http://novel18.syosetu.com/n9412dj/';

        $novel = new \Naloader\Novel($url);
        $novel->crawl();

        $chapter = $novel->chapters[0];
    }

    /**
     * test crawl and parse from the moonlight site.
     */
    public function testDownloadInMoonlight() {
        $url = 'http://novel18.syosetu.com/n5989dh/';

        $novel = new \Naloader\Novel($url);
        $novel->crawl();

        $chapter = $novel->chapters[0];
    }

    /**
     * test crawl and parse from the midnight site.
     */
    public function testDownloadInMidnight() {
        $url = 'http://novel18.syosetu.com/n7126cq/';

        $novel = new \Naloader\Novel($url);
        $novel->crawl();

        $chapter = $novel->chapters[0];
    }
}