<?php

namespace App\Entity;

use App\Repository\DialogueTextRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DialogueTextRepository::class)
 */
class DialogueText
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
     * @ORM\ManyToOne(targetEntity=Dialogue::class, inversedBy="dialogueTexts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dialogue;

    /**
     * @ORM\OneToMany(targetEntity=DialogueTextWords::class, mappedBy="dialogueText")
     */
    private $dialogueTextWords;

    /**
     * @ORM\Column(type="integer")
     */
    private $dialogueOrder;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $saidBy;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $identifier;

    public function __construct()
    {
        $this->dialogueTextWords = new ArrayCollection();
    }

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

    public function getDialogue(): ?Dialogue
    {
        return $this->dialogue;
    }

    public function setDialogue(?Dialogue $dialogue): self
    {
        $this->dialogue = $dialogue;

        return $this;
    }

    /**
     * @return Collection<int, DialogueTextWords>
     */
    public function getDialogueTextWords(): Collection
    {
        return $this->dialogueTextWords;
    }

    public function addDialogueTextWord(DialogueTextWords $dialogueTextWord): self
    {
        if (!$this->dialogueTextWords->contains($dialogueTextWord)) {
            $this->dialogueTextWords[] = $dialogueTextWord;
            $dialogueTextWord->setRelation($this);
        }

        return $this;
    }

    public function removeDialogueTextWord(DialogueTextWords $dialogueTextWord): self
    {
        if ($this->dialogueTextWords->removeElement($dialogueTextWord)) {
            // set the owning side to null (unless already changed)
            if ($dialogueTextWord->getRelation() === $this) {
                $dialogueTextWord->setRelation(null);
            }
        }

        return $this;
    }

    public function getDialogueOrder(): ?int
    {
        return $this->dialogueOrder;
    }

    public function setDialogueOrder(int $dialogueOrder): self
    {
        $this->dialogueOrder = $dialogueOrder;

        return $this;
    }

    public function getSaidBy(): ?string
    {
        return $this->saidBy;
    }

    public function setSaidBy(string $saidBy): self
    {
        $this->saidBy = $saidBy;

        return $this;
    }

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }
}
