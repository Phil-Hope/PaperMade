<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="author")
 * @ORM\Entity(repositoryClass="App\Repository\AuthorRepository")
 */
class Author
{
    /**
     * @var integer
     *
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer", length=11)
     * @ORM\OneToMany(targetEntity="App\Enity\Books", mappedBy="author", cascade={"persist", "remove"})
     * @ORM\Id()
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=30)
     */
    private $Name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=30)
     */
    private $Surname;

    /**
     * @var string
     *
     * @ORM\Column(name="nationality", type="string", length=30)
     */
    private $Nationality;

    /**
     * @var integer
     *
     * @ORM\Column(name="birth_year", type="integer", length=4)
     */
    private $BirthYear;

    /**
     * @var integer
     *
     * @ORM\Column(name="death_year", type="integer", length=4, nullable=true)
     */
    private $DeathYear;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->Surname;
    }

    public function setSurname(string $Surname): self
    {
        $this->Surname = $Surname;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->Nationality;
    }

    public function setNationality(string $Nationality): self
    {
        $this->Nationality = $Nationality;

        return $this;
    }

    public function getBirthYear(): ?string
    {
        return $this->BirthYear;
    }

    public function setBirthYear(string $BirthYear): self
    {
        $this->BirthYear = $BirthYear;

        return $this;
    }

    public function getDeathYear(): ?string
    {
        return $this->DeathYear;
    }

    public function setDeathYear(?string $DeathYear): self
    {
        $this->DeathYear = $DeathYear;

        return $this;
    }

}
