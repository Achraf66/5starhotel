<?php

namespace App\Entity;

use App\Repository\AirlineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Vol;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=AirlineRepository::class)
 */
class Airline
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *     min = 5,
     *     max = 15,
     *     minMessage ="Le nom de l'airline doit etre compose de 3 caractere minimum",
     *     maxMessage ="Le nom de l'airline doit etre compose 15 caractere Maximum")
     * @ORM\Column(type="string", length=30)
     */
    private $nom;

    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *     min = 5,
     *     max = 15,
     *     minMessage ="Le pays de airline doit etre compose de 3 caractere minimum",
     *     maxMessage ="Le pays de airline doit etre compose 15 caractere Maximum")
     * @ORM\Column(type="string", length=30)
     */
    private $pays;

    /**
     * @ORM\OneToMany(targetEntity=Vol::class, mappedBy="airline")
     */
    private $Vol;

    public function __construct()
    {
        $this->Vol = new ArrayCollection();
    }

    /**
     * @return Collection<int, Vol>
     */
    public function getVol(): Collection
    {
        return $this->Vol;
    }

    public function addVol(Vol $vol): self
    {
        if (!$this->Vol->contains($vol)) {
            $this->Vol[] = $vol;
            $vol->setAirline($this);
        }

        return $this;
    }

    public function removeVol(Vol $vol): self
    {
        if ($this->Vol->removeElement($vol)) {
            // set the owning side to null (unless already changed)
            if ($vol->getAirline() === $this) {
                $vol->setAirline(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * @param mixed $pays
     */
    public function setPays($pays): void
    {
        $this->pays = $pays;
    }

}
