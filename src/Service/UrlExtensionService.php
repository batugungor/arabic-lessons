<?php

namespace App\Service;

class UrlExtensionService
{
    private static $chapter_pattern = '/\b(\d+)\b/';
    private static $verse_pattern = '/\b(\d+)-(\d+)\b/';

    public static function getUrlNumbers($string, $matches = []): ?array
    {
        preg_match(UrlExtensionService::$verse_pattern, $string, $matches);

        if (count($matches) === 3) {
            return [$matches[1], $matches[2]];
        }


        preg_match(UrlExtensionService::$chapter_pattern, $string, $matches);

        if (count($matches) === 2) {
            return [$matches[1], 0];
        }

        return [0, 0];
    }

    public static function isChapter($number): bool
    {
        return count($number) === 1;
    }

    public static function isChapterAndVerse($number): bool
    {
        return count($number) === 2;
    }
}