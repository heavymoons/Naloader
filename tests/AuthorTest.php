<?php
namespace Naloader\Tests;

use Naloader\Author;

/**
 * Class AuthorTest
 * @package Naloader\Tests
 */
class AuthorTest extends \PHPUnit_Framework_TestCase
{
    public function testYomouAuthor() {
        $url = 'http://mypage.syosetu.com/64980/';
        $name = '池中織奈';
        $seriesCount = 21;
        $novelCount = 10;

        $author = new Author($url);
        $author->crawl();
        $this->assertEquals($url, $author->url);
        $this->assertEquals($name, $author->name);
        $this->assertEquals($seriesCount, count($author->series));
        $this->assertEquals($novelCount, count($author->novels));
    }

    public function testXAuthor() {
        $url = 'http://xmypage.syosetu.com/x5800h/';
        $name = '園内かな';
        $seriesCount = 1;
        $novelCount = 10; // 19だが作家ページには10件までしか表示されない

        $author = new Author($url);
        $author->crawl();
        $this->assertEquals($url, $author->url);
        $this->assertEquals($name, $author->name);
        $this->assertEquals($seriesCount, count($author->series));
        $this->assertEquals($novelCount, count($author->novels));
    }
}