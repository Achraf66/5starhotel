<?php

namespace App\Entity;

use App\Repository\VolRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Airline;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=VolRepository::class)
 */
class Vol
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
    private $datedepart;

    /**
     * @ORM\Column(type="date")
     */
    private $datearrive;

    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *     min = 3,
     *     max = 15,
     *     minMessage ="La destination doit contenir 5 caractere minimum",
     *     maxMessage ="La destination doit contenir 15 caractere Maximum")
     * @ORM\Column(type="string", length=30)
     */
    private $destination;

    /**
     * @Assert\NotNull
     * @ORM\Column(type="integer")
     */
    private $place;

    /**
     * @ORM\Column(type="time")
     */
    private $heurearrive;

    /**
     * @ORM\Column(type="time")
     */
    private $heuredepart;

    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *     min = 5,
     *     max = 15,
     *     minMessage ="Le nom de vol doit etre compose de 3 caractere minimum",
     *     maxMessage ="Le nom de vol doit etre compose 15 caractere Maximum")
     * @ORM\Column(type="string", length=30)
     */
    private $nomvol;

    /**
     * @ORM\ManyToOne(targetEntity=Airline::class, inversedBy="Vol")
     * @ORM\JoinColumn(nullable=false)
     */
    private $airline;





    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatedepart(): ?\DateTimeInterface
    {
        return $this->datedepart;
    }

    public function setDatedepart(\DateTimeInterface $datedepart): self
    {
        $this->datedepart = $datedepart;

        return $this;
    }

    public function getDatearrive(): ?\DateTimeInterface
    {
        return $this->datearrive;
    }

    public function setDatearrive(\DateTimeInterface $datearrive): self
    {
        $this->datearrive = $datearrive;

        return $this;
    }

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function setDestination(string $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getPlace(): ?int
    {
        return $this->place;
    }

    public function setPlace(int $place): self
    {
        $this->place = $place;

        return $this;
    }

    public function getHeurearrive(): ?\DateTimeInterface
    {
        return $this->heurearrive;
    }

    public function setHeurearrive(\DateTimeInterface $heurearrive): self
    {
        $this->heurearrive = $heurearrive;

        return $this;
    }

    public function getHeuredepart(): ?\DateTimeInterface
    {
        return $this->heuredepart;
    }

    public function setHeuredepart(\DateTimeInterface $heuredepart): self
    {
        $this->heuredepart = $heuredepart;

        return $this;
    }

    public function getNomvol(): ?string
    {
        return $this->nomvol;
    }

    public function setNomvol(string $nomvol): self
    {
        $this->nomvol = $nomvol;

        return $this;
    }

    public function getAirline(): ?Airline
    {
        return $this->airline;
    }

    public function setAirline(?Airline $airline): self
    {
        $this->airline = $airline;

        return $this;
    }




}
