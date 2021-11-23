<?php

namespace App\Entity;

use App\Repository\SeanceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SeanceRepository::class)
 */
class Seance
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dat_heure;

    /**
     * @ORM\OneToMany(targetEntity=FormSesSeance::class, mappedBy="seance_id", orphanRemoval=true)
     */
    private $formSesSeances;

    /**
     * @ORM\OneToMany(targetEntity=Presence::class, mappedBy="seance_id")
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

    public function getDatHeure(): ?\DateTimeInterface
    {
        return $this->dat_heure;
    }

    public function setDatHeure(\DateTimeInterface $dat_heure): self
    {
        $this->dat_heure = $dat_heure;

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
            $formSesSeance->setSeanceId($this);
        }

        return $this;
    }

    public function removeFormSesSeance(FormSesSeance $formSesSeance): self
    {
        if ($this->formSesSeances->removeElement($formSesSeance)) {
            // set the owning side to null (unless already changed)
            if ($formSesSeance->getSeanceId() === $this) {
                $formSesSeance->setSeanceId(null);
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
            $presence->setSeanceId($this);
        }

        return $this;
    }

    public function removePresence(Presence $presence): self
    {
        if ($this->presences->removeElement($presence)) {
            // set the owning side to null (unless already changed)
            if ($presence->getSeanceId() === $this) {
                $presence->setSeanceId(null);
            }
        }

        return $this;
    }
}
