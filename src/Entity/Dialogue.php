<?php

namespace App\Entity;

use App\Repository\DialogueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DialogueRepository::class)
 */
class Dialogue
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=DialogueText::class, mappedBy="dialogue", orphanRemoval=true)
     */
    private $dialogueTexts;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity=Page::class, mappedBy="dialogue")
     */
    private $pages;

    public function __construct()
    {
        $this->dialogueTexts = new ArrayCollection();
        $this->pages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, DialogueText>
     */
    public function getDialogueTexts(): Collection
    {
        return $this->dialogueTexts;
    }

    public function addDialogueText(DialogueText $dialogueText): self
    {
        if (!$this->dialogueTexts->contains($dialogueText)) {
            $this->dialogueTexts[] = $dialogueText;
            $dialogueText->setDialogue($this);
        }

        return $this;
    }

    public function removeDialogueText(DialogueText $dialogueText): self
    {
        if ($this->dialogueTexts->removeElement($dialogueText)) {
            // set the owning side to null (unless already changed)
            if ($dialogueText->getDialogue() === $this) {
                $dialogueText->setDialogue(null);
            }
        }

        return $this;
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

    /**
     * @return Collection<int, Page>
     */
    public function getPages(): Collection
    {
        return $this->pages;
    }

    public function addPage(Page $page): self
    {
        if (!$this->pages->contains($page)) {
            $this->pages[] = $page;
            $page->setDialogue($this);
        }

        return $this;
    }

    public function removePage(Page $page): self
    {
        if ($this->pages->removeElement($page)) {
            // set the owning side to null (unless already changed)
            if ($page->getDialogue() === $this) {
                $page->setDialogue(null);
            }
        }

        return $this;
    }
}
