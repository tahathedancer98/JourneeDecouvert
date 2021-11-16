<?php

namespace App\Entity;

use App\Repository\ParticipationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParticipationRepository::class)]
class Participation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'participations')]
    private $user_id;

    #[ORM\ManyToOne(targetEntity: JourneeDecouverte::class, inversedBy: 'participations')]
    private $jd_id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
