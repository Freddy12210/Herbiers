<?php

namespace App\Entity;

use App\Repository\RelevesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RelevesRepository::class)]
class Releves
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(targetEntity: Lieu::class)] // Lieu est la classe cible
    #[ORM\JoinColumn(name: 'lieu_id', referencedColumnName: 'id')] // Lien vers la clé primaire de la classe cible
    private ?Lieu $lieu = null;

    #[ORM\Column(length: 255)]
    private ?string $releve_brut = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getLieu(): ?Lieu
    {
        return $this->lieu;
    }

    public function setLieu(Lieu $lieu): static
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getReleveBrut(): ?string
    {
        return $this->releve_brut;
    }

    public function setReleveBrut(string $releve_brut): static
    {
        $this->releve_brut = $releve_brut;

        return $this;
    }

    public function getChampTableau(): array
    {
        return explode('/', $this->releve_brut);
    }

    // Ajout de la méthode pour accéder directement à un élément du tableau
    public function getChampTableauElement(int $index): ?string
    {
        $tableau = $this->getChampTableau();

        return $tableau[$index] ?? null;
    }
}
