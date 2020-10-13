<?php

namespace App\Entity\Mailer;

use App\Repository\Mailer\UniversityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UniversityRepository::class)
 */
class University
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Preinscription::class, mappedBy="university")
     */
    private $preinscriptions;

    public function __construct()
    {
        $this->preinscriptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Preinscription[]
     */
    public function getPreinscriptions(): Collection
    {
        return $this->preinscriptions;
    }

    public function addPreinscription(Preinscription $preinscription): self
    {
        if (!$this->preinscriptions->contains($preinscription)) {
            $this->preinscriptions[] = $preinscription;
            $preinscription->setUniversity($this);
        }

        return $this;
    }

    public function removePreinscription(Preinscription $preinscription): self
    {
        if ($this->preinscriptions->contains($preinscription)) {
            $this->preinscriptions->removeElement($preinscription);
            // set the owning side to null (unless already changed)
            if ($preinscription->getUniversity() === $this) {
                $preinscription->setUniversity(null);
            }
        }

        return $this;
    }
}
