<?php
namespace Naloader\Tests;

use Naloader\Naloader;

/**
 * Class NaloaderTest
 * @package Naloader\Tests
 */
class NaloaderTest extends \PHPUnit_Framework_TestCase
{
    public function testUnescapeText() {
        $originalText = '&amp;&quot;';
        $expected = '&"';
        $escaped = Naloader::unescapeText($originalText);
        $this->assertEquals($expected, $escaped);
    }

}