<?php
namespace Naloader;

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
     * Author constructor.
     * @param $url
     */
    public function __construct($url) {
        $this->url = $url;
    }
}