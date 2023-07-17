<?php

namespace App\Service;


use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class QuranHttpClient extends ServiceHttpClient
{
    public $api_url = "https://api.quran.com/api/v4/";

    public $get_all_chapters = "chapters";
    public $get_chapter = "chapters/%s";
    public $get_verses_by_chapter = "verses/by_chapter/%s?words=true";
    public $get_random_verses = "verses/by_chapter/%s?words=true";


    /**
     * @var HttpClientInterface
     */
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getChapterById($chapterId)
    {
        return $this->encode(
            $this->client->request('GET',
                sprintf(
                    "%s%s",
                    $this->api_url,
                    sprintf($this->get_chapter, $chapterId)
                )
            )
        );
    }

    public function getVersesByChapterId($chapterId, int $from = 0, int $to = 0)
    {
        return $this->encode(
            $this->client->request('GET',
                sprintf(
                    "%s%s" . ($from != 0 ? '&from=' . $from : '') . ($to != 0 ? '&to=' . $to : ''),
                    $this->api_url,
                    sprintf($this->get_verses_by_chapter, $chapterId)
                )
            )
        );
    }

    public function getAllChapters()
    {
        return $this->encode(
            $this->client->request('GET',
                sprintf(
                    "%s%s",
                    $this->api_url,
                    $this->get_all_chapters
                )
            )
        );
    }

    public function GetRandomVerses()
    {
        return $this->encode(
            $this->client->request('GET',
                sprintf(
                    "%s%s",
                    $this->api_url,
                    $this->get_random_verses
                )
            )
        );
    }

}