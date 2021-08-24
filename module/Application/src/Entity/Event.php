<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 * @ORM\Table(name="event")
 */
class Event
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="event_id", type="integer", nullable=false, options={"unsigned"=true})
     */
    protected int $eventId;

    /**
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    protected string $name;

    /**
     * @ORM\Column(name="description", type="text", length=0, nullable=false)
     */
    protected string $description;

    /**
     * @ORM\Column(name="date", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    protected \DateTime $date;

    /**
     * @ORM\OneToMany(targetEntity="\Application\Entity\Client", mappedBy="events")
     */
    protected Collection $clients;

    /**
     * Event constructor.
     */
    public function __construct()
    {
        $this->clients = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getEventId(): int
    {
        return $this->eventId;
    }

    /**
     * @param int $event_id
     * @return Event
     */
    public function setEventId(int $event_id): self
    {
        $this->eventId = $event_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Event
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Event
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     * @return Event
     */
    public function setDate(\DateTime $date): self
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getClients(): Collection
    {
        return $this->clients;
    }

    /**
     * @param Client $client
     * @return Event
     */
    public function setClient(Client $client): self
    {
        $this->clients[] = $client;
        return $this;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return [
            'event_id' => $this->getEventId(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'date' => $this->getDate()->format('Y-m-d'),
        ];
    }
}
