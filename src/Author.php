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
     * @throws \Exception
     */
    public function __construct($url) {
        if (!Naloader::isValidAuthorUrl($url)) {
            throw new \Exception("invalid author url: $url");
        }
        $this->url = $url;
    }
}