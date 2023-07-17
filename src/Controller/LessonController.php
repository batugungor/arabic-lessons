<?php

namespace App\Controller;

use App\Entity\Lesson;
use App\Entity\Page;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LessonController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/lesson", name="app_all_lessons")
     */
    public function index(): Response
    {
        $lessons = $this->entityManager->getRepository(Lesson::class)->findAll();

        return $this->render('lesson/index.html.twig', [
            'lessons' => $lessons,
        ]);
    }

    /**
     * @Route("/lesson/{lesson_slug}", name="app_single_lesson")
     */
    public function lessonIndex(Request $request, $lesson_slug): Response
    {
        $lesson = $this->entityManager->getRepository(Lesson::class)->findOneBy(["slug" => $lesson_slug]);
        $pages = $this->entityManager->getRepository(Page::class)->findBy(["lesson" => $lesson], ["pageOrder" => "ASC"]);


        return $this->render('lesson/single.lesson.html.twig', [
            'lesson' => $lesson,
            'pages' => $pages
        ]);
    }

    /**
     * @Route("/lesson/{lesson_slug}/{page_slug}", name="app_page_index")
     */
    public function pageShow(Request $request, $lesson_slug, $page_slug): Response
    {
        $lesson = $this->entityManager->getRepository(Lesson::class)->findOneBy(["slug" => $lesson_slug]);
        $page = $this->entityManager->getRepository(Page::class)->findOneBy(["slug" => $page_slug, "lesson" => $lesson]);

        $previous_choices = [];

        if (!$page) {
            return $this->redirectToRoute('app_home');
        }

        if ($request->isMethod('post')) {
            if(isset($_POST["previous_choices"])) {
                $previous_choices = json_decode($_POST["previous_choices"], true);
            }

            if ($page->isCorrectAnswer($_POST["selected_option"])) {
                $previous_choices[$_POST["selected_option"]] = true;
            } else {
                $previous_choices[$_POST["selected_option"]] = false;
            }
        }



        $nextPage = $this->entityManager->getRepository(Page::class)->findOneBy(["lesson" => $lesson, 'pageOrder' => ($page->getPageOrder() + 1)]);

        if (!$nextPage) {
            $nextPage = null;
        }

        if(!is_null($page->getDialogue())) {
//            dd($page);

            return $this->render('lesson/dialogue.page.html.twig', [
                'page' => $page,
                'nextPage' => $nextPage,
                'selected_answer' => $previous_choices
            ]);
        }

        return $this->render('lesson/single.page.html.twig', [
            'page' => $page,
            'nextPage' => $nextPage,
            'selected_answer' => $previous_choices
        ]);
    }
}
