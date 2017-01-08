<?php
namespace Naloader;

use Goutte\Client;
use Carbon\Carbon;

/**
 * Class Naloader
 * @package Naloader
 */
class Naloader
{
    /**
     * R18 site hostname list.
     */
    const R18HOSTNAMES = [
        'noc.syosetu.com',
        'mnlt.syosetu.com',
        'mid.syosetu.com',
        'novel18.syosetu.com',
    ];

    /**
     * get HTTP client with the auth cookies.
     * @param $url
     * @return Client
     */
    public static function getHttpClient($url) {
        $client = new Client();
        $isR18 = static::isR18Url($url);
        if ($isR18) {
            $client->getCookieJar()->set(new \Symfony\Component\BrowserKit\Cookie('over18', 'yes'));
        }
        return $client;
    }

    /**
     * detect the R18 site from URL.
     * @param $url
     * @return bool
     */
    public static function isR18Url($url) {
        foreach (static::R18HOSTNAMES as $hostname) {
            if (strpos($url, $hostname) !== false) {return true;}
        }
        return false;
    }

    /**
     * convert a Japanese date string to Carbon.
     * @param $text
     * @return Carbon|null
     */
    public static function regulateDateString($text) {
        if (preg_match('/(\d{4})[^\d]+(\d+)[^\d]+(\d+)/', $text, $matches)) {
            $dateString = "$matches[1]-$matches[2]-$matches[3]";
            return new Carbon($dateString);
        }
        return null;
    }

    /**
     * unescape htmlencoded text
     * @param $text
     * @return string
     */
    public static function unescapeText($text) {
        return html_entity_decode($text);
    }
}