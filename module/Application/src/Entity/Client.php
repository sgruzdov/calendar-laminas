<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="client")
 */
class Client extends \Doctrine\Common\Collections\ArrayCollection
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="client_id", type="integer", nullable=false, options={"unsigned"=true})
     */
    protected int $client_id;

    /**
     * @ORM\Column(name="initials", type="string", length=255, nullable=false)
     */
    protected string $initials;

    /**
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    protected string $email;

    /**
     * @var \Application\Entity\Event
     * @ORM\ManyToOne(targetEntity="Application\Entity\Event", inversedBy="clients", cascade={"persist"})
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="event_id", referencedColumnName="event_id")
     * })
     */
    protected Event $event;

    /**
     * @return int
     */
    public function getClientId(): int
    {
        return $this->clientId;
    }

    /**
     * @param int $client_id
     * @return Client
     */
    public function setClientId(int $client_id): self
    {
        $this->clientId = $client_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getInitials(): string
    {
        return $this->initials;
    }

    /**
     * @param string $initials
     * @return Client
     */
    public function setInitials(string $initials): self
    {
        $this->initials = $initials;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Client
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return Event
     */
    public function getEvent(): Event
    {
        return $this->event;
    }

    /**
     * @param Event $event
     * @return Client
     */
    public function setEvent(Event $event): self
    {
        $this->event = $event;
        return $this;
    }
}
