<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FormationRepository::class)
 */
class Formation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $duree;

    /**
     * @ORM\OneToMany(targetEntity=Inscrit::class, mappedBy="formation_id", orphanRemoval=true)
     */
    private $inscrits;

    /**
     * @ORM\OneToMany(targetEntity=Evaluation::class, mappedBy="formation_id", orphanRemoval=true)
     */
    private $evaluations;

    /**
     * @ORM\OneToMany(targetEntity=FormSesSeance::class, mappedBy="formation_id", orphanRemoval=true)
     */
    private $formSesSeances;

    /**
     * @ORM\OneToMany(targetEntity=Presence::class, mappedBy="formation_id", orphanRemoval=true)
     */
    private $presences;

    public function __construct()
    {
        $this->inscrits = new ArrayCollection();
        $this->evaluations = new ArrayCollection();
        $this->formSesSeances = new ArrayCollection();
        $this->presences = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(string $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * @return Collection|Inscrit[]
     */
    public function getInscrits(): Collection
    {
        return $this->inscrits;
    }

    public function addInscrit(Inscrit $inscrit): self
    {
        if (!$this->inscrits->contains($inscrit)) {
            $this->inscrits[] = $inscrit;
            $inscrit->setFormationId($this);
        }

        return $this;
    }

    public function removeInscrit(Inscrit $inscrit): self
    {
        if ($this->inscrits->removeElement($inscrit)) {
            // set the owning side to null (unless already changed)
            if ($inscrit->getFormationId() === $this) {
                $inscrit->setFormationId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Evaluation[]
     */
    public function getEvaluations(): Collection
    {
        return $this->evaluations;
    }

    public function addEvaluation(Evaluation $evaluation): self
    {
        if (!$this->evaluations->contains($evaluation)) {
            $this->evaluations[] = $evaluation;
            $evaluation->setFormationId($this);
        }

        return $this;
    }

    public function removeEvaluation(Evaluation $evaluation): self
    {
        if ($this->evaluations->removeElement($evaluation)) {
            // set the owning side to null (unless already changed)
            if ($evaluation->getFormationId() === $this) {
                $evaluation->setFormationId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|FormSesSeance[]
     */
    public function getFormSesSeances(): Collection
    {
        return $this->formSesSeances;
    }

    public function addFormSesSeance(FormSesSeance $formSesSeance): self
    {
        if (!$this->formSesSeances->contains($formSesSeance)) {
            $this->formSesSeances[] = $formSesSeance;
            $formSesSeance->setFormationId($this);
        }

        return $this;
    }

    public function removeFormSesSeance(FormSesSeance $formSesSeance): self
    {
        if ($this->formSesSeances->removeElement($formSesSeance)) {
            // set the owning side to null (unless already changed)
            if ($formSesSeance->getFormationId() === $this) {
                $formSesSeance->setFormationId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Presence[]
     */
    public function getPresences(): Collection
    {
        return $this->presences;
    }

    public function addPresence(Presence $presence): self
    {
        if (!$this->presences->contains($presence)) {
            $this->presences[] = $presence;
            $presence->setFormationId($this);
        }

        return $this;
    }

    public function removePresence(Presence $presence): self
    {
        if ($this->presences->removeElement($presence)) {
            // set the owning side to null (unless already changed)
            if ($presence->getFormationId() === $this) {
                $presence->setFormationId(null);
            }
        }

        return $this;
    }
}
