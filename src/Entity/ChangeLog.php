<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Table(name="change_log")
 * @ORM\Entity(repositoryClass="App\Repository\ChangeLogRepository")
 */
class ChangeLog
{

    /**
     * @var integer
     *
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer", length=11)
     */
    private $id;

    /**
     *
     * @var \DateTime A "Y-m-d H:i:s" formatted value
     *
     * @ORM\Column(name="date_created", type="datetime", nullable=true)
     */
    private $DateCreated;

    /**
     * @var \DateTime|null A "Y-m-d H:i:s" formatted value
     *
     * @ORM\Column(name="date_updated", type="datetime", nullable=true)
     */
    private $DateUpdated;

    /**
     * @return \DateTime|null A "Y-m-d H:i:s" formatted value
     */
    public function getDateCreated(): ?\DateTime
    {
        return $this->DateCreated;
    }

    /**
     * @return \DateTime|null A "Y-m-d H:i:s" formatted value
     */
    public function getDateUpdated(): ?\DateTime
    {
        return $this->DateUpdated;
    }

    /**
     * @var int|null
     * @ORM\Column(name="book_changed_id", type="integer")
     */
    private $BookChanged;

    /**
     * @var int|null
     * @ORM\Column(name="changed_by_id", type="integer")
     *
     */
    private $ChangedBy;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setDateCreated($DateCreated): self
    {
        $this->DateCreated = $DateCreated;

        return $this;
    }

    public function setDateUpdated($DateUpdated): self
    {
        $this->DateUpdated = $DateUpdated;

        return $this;
    }


    public function getBookChanged()
    {
        return $this->BookChanged;
    }

    public function setBookChanged($BookChanged): self
    {
        $this->BookChanged = $BookChanged;

        return $this;
    }

    public function getChangedBy(): ?int
    {
        return $this->ChangedBy;
    }

    public function setChangedBy(?int $ChangedBy): self
    {
        $this->ChangedBy = $ChangedBy;

        return $this;
    }
}
