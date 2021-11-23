<?php

namespace App\Entity;

use App\Repository\PresenceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PresenceRepository::class)
 */
class Presence
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Formation::class, inversedBy="Presences")
     * @ORM\JoinColumn(nullable=false)
     */
    private $formation_id;

    /**
     * @ORM\ManyToOne(targetEntity=Session::class, inversedBy="Presences")
     * @ORM\JoinColumn(nullable=false)
     */
    private $session_id;

    /**
     * @ORM\ManyToOne(targetEntity=Seance::class, inversedBy="Presences")
     * @ORM\JoinColumn(nullable=false)
     */
    private $seance_id;

    /**
     * @ORM\ManyToOne(targetEntity=Candidat::class, inversedBy="Presences")
     * @ORM\JoinColumn(nullable=false)
     */
    private $candidat_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFormationId(): ?Formation
    {
        return $this->formation_id;
    }

    public function setFormationId(?Formation $formation_id): self
    {
        $this->formation_id = $formation_id;

        return $this;
    }

    public function getSessionId(): ?Session
    {
        return $this->session_id;
    }

    public function setSessionId(?Session $session_id): self
    {
        $this->session_id = $session_id;

        return $this;
    }

    public function getSeanceId(): ?Seance
    {
        return $this->seance_id;
    }

    public function setSeanceId(?Seance $seance_id): self
    {
        $this->seance_id = $seance_id;

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
}
