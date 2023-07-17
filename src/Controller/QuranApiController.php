<?php

namespace App\Controller;

use App\Service\QuranHttpClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class QuranApiController extends AbstractController
{
    private $client;
    private $quranHttpClient;

    public function __construct(HttpClientInterface $client, QuranHttpClient $quranHttpClient)
    {
        $this->client = $client;
        $this->quranHttpClient = $quranHttpClient;
    }

    /**
     * @Route("/api/quran/chapters", name="app_quran_api")
     */
    public function index(): Response
    {
        $chapters = $this->client->request(
            'GET',
            'https://api.quran.com/api/v4/chapters'
        );

        return new Response(
            $this->renderView('quran_api/chapters/index.html.twig', [
                "chapters" => json_decode($chapters->getContent(), JSON_OBJECT_AS_ARRAY)
            ])
        );
    }

    /**
     * @Route("/api/quran/randomverses", name="app_quran_api_random_verses")
     */
    public function randomVerses(): Response
    {
        $chapters = $this->client->request(
            'GET',
            'https://api.quran.com/api/v4/chapters'
        );

        return new Response(
            $this->renderView('quran_api/chapters/index.html.twig', [
                "chapters" => json_decode($chapters->getContent(), JSON_OBJECT_AS_ARRAY)
            ])
        );
    }

    public function getChapterRecitationByRecitationAndChapter()
    {
        $recitationId = 1;
        $chapterId = 1;

        $a = $this->client->request(
            'GET',
            sprintf('https://api.quran.com/api/v4/chapter_recitations/%s/%s', $recitationId, $chapterId)
        );

        // Get the audio file link
        json_decode($a->getContent(), JSON_OBJECT_AS_ARRAY)["audio_file"]["audio_url"];
    }

    public function getAllReciters()
    {
        $t = $this->client->request(
            'GET',
            'https://api.quran.com/api/v4/resources/recitations'
        );
    }
}
