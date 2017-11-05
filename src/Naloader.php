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
    const R18_HOST_NAMES = [
        'noc.syosetu.com',
        'mnlt.syosetu.com',
        'mid.syosetu.com',
        'novel18.syosetu.com',
        'xmypage.syosetu.com',
    ];

    /**
     * hostname list of novel top page
     */
    const NOVEL_TOP_HOST_NAMES = [
        'ncode.syosetu.com',
        'novel18.syosetu.com',
    ];

    /**
     * hostname list of author top page
     */
    const AUTHOR_TOP_HOST_NAMES = [
        'mypage.syosetu.com',
        'xmypage.syosetu.com',
    ];

    /**
     * check whether url is valid novel top url
     * @param $url
     * @return int
     */
    public static function isValidNovelUrl($url) {
        $hostnames = static::NOVEL_TOP_HOST_NAMES;
        array_walk($hostnames, function($hostname) {
            return preg_quote($hostname);
        });
        return preg_match('/^https?:\/\/(' . implode($hostnames, '|') . ')\/n\d+\w+\/$/', $url);
    }

    /**
     * check whether url is valid author url
     * @param $url
     * @return int
     */
    public static function isValidAuthorUrl($url) {
        $hostnames = static::AUTHOR_TOP_HOST_NAMES;
        array_walk($hostnames, function($hostname) {
            return preg_quote($hostname);
        });
        return preg_match('/^https?:\/\/(' . implode($hostnames, '|') . ')\/x?\d+\w+\/$/', $url);
    }

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
        foreach (static::R18_HOST_NAMES as $hostname) {
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