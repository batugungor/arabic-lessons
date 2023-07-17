<?php

namespace App\Entity;

use App\Repository\PageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PageRepository::class)
 */
class Page
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity=Lesson::class, inversedBy="pages")
     */
    private $lesson;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pageOrder;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity=Question::class, inversedBy="pages")
     */
    private $question;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $video;

    /**
     * @ORM\ManyToOne(targetEntity=Dialogue::class, inversedBy="pages")
     */
    private $dialogue;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getLesson(): ?Lesson
    {
        return $this->lesson;
    }

    public function setLesson(?Lesson $lesson): self
    {
        $this->lesson = $lesson;

        return $this;
    }

    public function getPageOrder(): ?int
    {
        return $this->pageOrder;
    }

    public function setPageOrder(?int $pageOrder): self
    {
        $this->pageOrder = $pageOrder;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getVideo(): ?string
    {
        return $this->video;
    }

    public function setVideo(string $video): self
    {
        $this->video = $video;

        return $this;
    }

    public function getDialogue(): ?Dialogue
    {
        return $this->dialogue;
    }

    public function setDialogue(?Dialogue $dialogue): self
    {
        $this->dialogue = $dialogue;

        return $this;
    }

    public function isCorrectAnswer($input): bool
    {
        $questions = $this->getQuestion();

        foreach ($questions->getQuestionOptions() as $question) {
            if($question->isCorrect()) {
                if($question->getTitle() == $input) {
                    return true;
                }
            }
        }

        return false;
    }
}
