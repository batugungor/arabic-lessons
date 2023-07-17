<?php

namespace App\Controller;

use App\Entity\Dialogue;
use App\Entity\DialogueText;
use App\Entity\DialogueTextWords;
use App\Form\TextExplanationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function PHPUnit\Framework\isNull;

class BackofficeController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/backoffice/", name="app_backoffice")
     */
    public function index(): Response
    {
        $dialogue = $this->entityManager->getRepository(Dialogue::class)->findOneBy(["id" => 1]);

        return $this->render('backoffice/index.html.twig', [
            'dialogue' => $dialogue,
        ]);
    }

    /**
     * @Route("/backoffice/dialogues/{dialogueId}/", name="app_backoffice_dialogue")
     */
    public function view_dialogue($dialogueId): Response
    {
        $dialogue = $this->entityManager->getRepository(Dialogue::class)->findOneBy(["id" => 1]);

        if (!$dialogue) {
            return $this->redirectToRoute('app_backoffice');
        }

        return $this->render('backoffice/dialogue/index.html.twig', [
            'dialogue' => $dialogue,
        ]);
    }

    /**
     * @Route("/backoffice/dialogues/{dialogueId}/words/{dialogueTextId}", name="app_backoffice_dialogue_words")
     */
    public function view_dialogue_words(Request $request, $dialogueId, $dialogueTextId): Response
    {
        $dialogue = $this->entityManager->getRepository(Dialogue::class)->findOneBy(["id" => 1]);
        $dialogueWords = $this->entityManager->getRepository(DialogueText::class)->findOneBy(["id" => $dialogueTextId, 'dialogue' => $dialogue]);

        if (!$dialogue || !$dialogueWords) {
            return $this->redirectToRoute('app_backoffice');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $explanations = $_POST["explanation"];
            if (isset($explanations)) {
                foreach ($explanations as $key => $value) {
                    $found = $this->entityManager->getRepository(DialogueTextWords::class)->findOneBy(["id" => $key]);

                    if ($found) {
                        $found->setExplanation($value);
                        $this->entityManager->persist($found);
                    }
                }
                $this->entityManager->flush();
            }

            return $this->redirectToRoute('app_backoffice_dialogue_words', [
                "dialogueId" => $dialogueTextId,
                "dialogueTextId" => $dialogueTextId
            ]);
        }

        return $this->render('backoffice/dialogue/word-editor.html.twig', [
            'dialogue' => $dialogue,
            "dialogueWord" => $dialogueWords,
        ]);
    }

    /**
     * @Route("/backoffice/add/words/{dialogueId}/{dialogueTextId}", name="app_backoffice_add_words")
     */
    public function addWords(Request $request, $dialogueId, $dialogueTextId): Response
    {
        $dialogue = $this->entityManager->getRepository(DialogueText::class)->findOneBy(["id" => $dialogueTextId, "dialogue" => $dialogueId]);

        $words = json_decode($request->get("words"), true);

        if (!is_null($words)) {
            for ($i = 0; $i < count($words); $i++) {
                $current_word = $words[$i];

                $word = new DialogueTextWords();
                $word->setDialogueText($dialogue);
                $word->setText($current_word["value"]);
                $word->setWordOrder($i + 1);

                $word->setStartRegex($current_word["start"]);
                $word->setEndRegex($current_word["end"]);

                $this->entityManager->persist($word);
            }

            $this->entityManager->flush();
        }

        return $this->redirectToRoute('app_backoffice_dialogue_words', [
            "dialogueId" => $dialogueTextId,
            "dialogueTextId" => $dialogueTextId
        ]);
    }

    /**
     * @Route("/backoffice/remove/words/{dialogueId}/{dialogueTextId}", name="app_backoffice_remove_words")
     */
    public function removeWords(Request $request, $dialogueId, $dialogueTextId): Response
    {
        $dialogue = $this->entityManager->getRepository(DialogueText::class)->findOneBy(["id" => $dialogueTextId, "dialogue" => $dialogueId]);

        foreach ($dialogue->getDialogueTextWords() as $word) {
            $this->entityManager->remove($word);
        }
        $this->entityManager->flush();


        return $this->redirectToRoute('app_backoffice_dialogue_words', [
            "dialogueId" => $dialogueTextId,
            "dialogueTextId" => $dialogueTextId
        ]);
    }

}
