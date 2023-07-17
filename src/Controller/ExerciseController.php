<?php

namespace App\Controller;

use App\Service\QuranHttpClient;
use App\Service\UrlExtensionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ExerciseController extends AbstractController
{
    private $quranHttpClient;

    public function __construct(QuranHttpClient $quranHttpClient)
    {
        $this->quranHttpClient = $quranHttpClient;
    }


    /**
     * @Route("/exercise", name="app_exercise")
     */
    public function index(): Response
    {
        $chapters = $this->quranHttpClient->getAllChapters();

        return $this->render('exercise/index.html.twig', [
            "chapters" => $chapters
        ]);
    }

    /**
     * @Route("/exercise/{chapter}", name="app_exercise_chapter")
     */
    public function chapter_index($chapter): Response
    {
        $chapter = $this->quranHttpClient->getChapterById($chapter);

        return $this->render('exercise/chapter.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }


    /**
     * @Route("/exercise/{chapter}/{verse}", name="app_exercise_chapter_with_verses")
     */
    public function chapterAndVerse($chapter, $verse): Response
    {
        $urlNumbers = UrlExtensionService::getUrlNumbers($verse);

        $verses = $this->quranHttpClient->getVersesByChapterId($chapter, $urlNumbers[0], $urlNumbers[1]);

        if (count($verses["verses"]) <= 0) {
            return $this->redirectToRoute('app_exercise_chapter', [
                'chapter' => $chapter
            ]);
        }

        $chapter = $this->quranHttpClient->getChapterById($chapter);

        return $this->render('exercise/verses.html.twig', [
            "verses" => $verses,
            "chapter" => $chapter
        ]);
    }
}
