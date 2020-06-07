<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TagRepository")
 * @ORM\Table(name="tags")
 */
class Tag
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $name_tag;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameTag(): ?string
    {
        return $this->name_tag;
    }

    public function setNameTag(string $name_tag): self
    {
        $this->name_tag = $name_tag;

        return $this;
    }
}
