<?php

namespace App\Entity;

use App\Repository\InscritRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InscritRepository::class)
 */
class Inscrit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="Inscrits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $candidat_id;

    /**
     * @ORM\ManyToOne(targetEntity=Formation::class, inversedBy="Inscrits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $formation_id;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCandidatId(): ?User
    {
        return $this->candidat_id;
    }

    public function setCandidatId(?User $candidat_id): self
    {
        $this->candidat_id = $candidat_id;

        return $this;
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


}
