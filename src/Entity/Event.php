<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
 */
class Event
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $location;

    /**
     * @ORM\Column(type="datetime")
     */
    private $start;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $end;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\user")
     * @ORM\JoinColumn(nullable=false)
     */
    private $addedBy;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\user")
     */
    private $attendees;

    public function __construct()
    {
        $this->attendees = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(?\DateTimeInterface $end): self
    {
        $this->end = $end;

        return $this;
    }

    public function getAddedBy(): ?user
    {
        return $this->addedBy;
    }

    public function setAddedBy(?user $addedBy): self
    {
        $this->addedBy = $addedBy;

        return $this;
    }

    /**
     * @return Collection|user[]
     */
    public function getAttendees(): Collection
    {
        return $this->attendees;
    }

    public function addAttendee(user $attendee): self
    {
        if (!$this->attendees->contains($attendee)) {
            $this->attendees[] = $attendee;
        }

        return $this;
    }

    public function removeAttendee(user $attendee): self
    {
        if ($this->attendees->contains($attendee)) {
            $this->attendees->removeElement($attendee);
        }

        return $this;
    }
}
