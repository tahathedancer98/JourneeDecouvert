<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $name;

    #[ORM\ManyToOne(targetEntity: JourneeDecouverte::class, inversedBy: 'images')]
    #[ORM\JoinColumn(nullable: true)]
    private $jd_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getJdId(): ?JourneeDecouverte
    {
        return $this->jd_id;
    }

    public function setJdId(?JourneeDecouverte $jd_id): self
    {
        $this->jd_id = $jd_id;

        return $this;
    }
}
