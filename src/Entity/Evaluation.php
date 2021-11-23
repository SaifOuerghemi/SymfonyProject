<?php

namespace App\Entity;

use App\Repository\EvaluationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EvaluationRepository::class)
 */
class Evaluation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $note;

    /**
     * @ORM\ManyToOne(targetEntity=Candidat::class, inversedBy="evaluations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $candidat_id;

    /**
     * @ORM\ManyToOne(targetEntity=Formation::class, inversedBy="evaluations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $formation_id;

    /**
     * @ORM\ManyToOne(targetEntity=Formateur::class, inversedBy="evaluations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $formateur_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?float
    {
        return $this->note;
    }

    public function setNote(float $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getCandidatId(): ?Candidat
    {
        return $this->candidat_id;
    }

    public function setCandidatId(?Candidat $candidat_id): self
    {
        $this->candidat_id = $candidat_id;

        return $this;
    }

    public function getFormationId(): ?Formation
    {
        return $this->formation_id;
    }

    public function setFormationId(?Formateur $formation_id): self
    {
        $this->formation_id = $formation_id;

        return $this;
    }

    public function getFormateurId(): ?Formateur
    {
        return $this->formateur_id;
    }

    public function setFormateurId(?Formateur $formateur_id): self
    {
        $this->formateur_id = $formateur_id;

        return $this;
    }
}
