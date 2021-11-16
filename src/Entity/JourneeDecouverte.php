<?php

namespace App\Entity;

use App\Repository\JourneeDecouverteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JourneeDecouverteRepository::class)]
class JourneeDecouverte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $title;

    #[ORM\Column(type: 'date', nullable: true)]
    private $date;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $lieu;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $nb_max_grimpeurs;

    #[ORM\ManyToOne(targetEntity: Niveau::class, inversedBy: 'journeeDecouvertes')]
    #[ORM\JoinColumn(nullable: false)]
    private $niveau_minimum;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'journeeDecouvertes')]
    #[ORM\JoinColumn(nullable: false)]
    private $organisateur_id;

    #[ORM\OneToMany(mappedBy: 'jd_id', targetEntity: Image::class)]
    private $images;

    #[ORM\OneToMany(mappedBy: 'jd_id', targetEntity: Participation::class)]
    private $participations;


    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->participations = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(?string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getNbMaxGrimpeurs(): ?int
    {
        return $this->nb_max_grimpeurs;
    }

    public function setNbMaxGrimpeurs(?int $nb_max_grimpeurs): self
    {
        $this->nb_max_grimpeurs = $nb_max_grimpeurs;

        return $this;
    }

    public function getNiveauMinimum(): ?Niveau
    {
        return $this->niveau_minimum;
    }

    public function setNiveauMinimum(?Niveau $niveau_minimum): self
    {
        $this->niveau_minimum = $niveau_minimum;

        return $this;
    }

    public function getOrganisateurId(): ?User
    {
        return $this->organisateur_id;
    }

    public function setOrganisateurId(?User $organisateur_id): self
    {
        $this->organisateur_id = $organisateur_id;

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setJdId($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getJdId() === $this) {
                $image->setJdId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Participation[]
     */
    public function getParticipations(): Collection
    {
        return $this->participations;
    }

    public function addParticipation(Participation $participation): self
    {
        if (!$this->participations->contains($participation)) {
            $this->participations[] = $participation;
            $participation->setJdId($this);
        }

        return $this;
    }

    public function removeParticipation(Participation $participation): self
    {
        if ($this->participations->removeElement($participation)) {
            // set the owning side to null (unless already changed)
            if ($participation->getJdId() === $this) {
                $participation->setJdId(null);
            }
        }

        return $this;
    }

}
