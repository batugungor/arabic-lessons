<?php

namespace App\Entity;

use App\Repository\DialogueTextWordsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DialogueTextWordsRepository::class)
 */
class DialogueTextWords
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity=DialogueText::class, inversedBy="dialogueTextWords")
     */
    private $dialogueText;

    /**
     * @ORM\Column(type="integer")
     */
    private $wordOrder;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $explanation;

    /**
     * @ORM\Column(type="integer")
     */
    private $startRegex;

    /**
     * @ORM\Column(type="integer")
     */
    private $endRegex;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getDialogueText(): ?DialogueText
    {
        return $this->dialogueText;
    }

    public function setDialogueText(?DialogueText $dialogueText): self
    {
        $this->dialogueText = $dialogueText;

        return $this;
    }

    public function getWordOrder(): ?int
    {
        return $this->wordOrder;
    }

    public function setWordOrder(int $wordOrder): self
    {
        $this->wordOrder = $wordOrder;

        return $this;
    }

    public function getExplanation(): ?string
    {
        return $this->explanation;
    }

    public function setExplanation(string $explanation): self
    {
        $this->explanation = $explanation;

        return $this;
    }

    public function getStartRegex(): ?int
    {
        return $this->startRegex;
    }

    public function setStartRegex(int $startRegex): self
    {
        $this->startRegex = $startRegex;

        return $this;
    }

    public function getEndRegex(): ?int
    {
        return $this->endRegex;
    }

    public function setEndRegex(int $endRegex): self
    {
        $this->endRegex = $endRegex;

        return $this;
    }
}
