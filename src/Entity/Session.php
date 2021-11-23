<?php

namespace App\Entity;

use App\Repository\SessionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SessionRepository::class)
 */
class Session
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date_debut;

    /**
     * @ORM\Column(type="date")
     */
    private $date_fin;

    /**
     * @ORM\OneToMany(targetEntity=FormSesSeance::class, mappedBy="session_id", orphanRemoval=true)
     */
    private $formSesSeances;

    /**
     * @ORM\OneToMany(targetEntity=Presence::class, mappedBy="session_id", orphanRemoval=true)
     */
    private $presences;

    public function __construct()
    {
        $this->formSesSeances = new ArrayCollection();
        $this->presences = new ArrayCollection();
    }




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): self
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeInterface $date_fin): self
    {
        $this->date_fin = $date_fin;

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
            $formSesSeance->setSessionId($this);
        }

        return $this;
    }

    public function removeFormSesSeance(FormSesSeance $formSesSeance): self
    {
        if ($this->formSesSeances->removeElement($formSesSeance)) {
            // set the owning side to null (unless already changed)
            if ($formSesSeance->getSessionId() === $this) {
                $formSesSeance->setSessionId(null);
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
            $presence->setSessionId($this);
        }

        return $this;
    }

    public function removePresence(Presence $presence): self
    {
        if ($this->presences->removeElement($presence)) {
            // set the owning side to null (unless already changed)
            if ($presence->getSessionId() === $this) {
                $presence->setSessionId(null);
            }
        }

        return $this;
    }



}
