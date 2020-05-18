<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuestionRepository")
 * @ORM\Table(name="questions")
 */
class Question
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $title_question;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $content;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitleQuestion(): ?string
    {
        return $this->title_question;
    }


    public function setTitleQuestion(string $title_question): void
    {
        $this->title_question = $title_question;
    }


    public function getContent(): ?string
    {
        return $this->content;
    }


    public function setContent(string $content): void
    {
        $this->content = $content;

    }
}
