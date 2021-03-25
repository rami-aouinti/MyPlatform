<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\FriendRepository;
use App\Trait\IdentifierTrait;
use App\Trait\TimestampsTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FriendRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Friend
{
    use IdentifierTrait;

    use TimestampsTrait;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="senders")
     */
    private ?User $sender = null;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="receivers")
     */
    private ?User $receiver = null;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $status = null;

    /**
     * @return User|null
     */
    public function getSender(): ?User
    {
        return $this->sender;
    }

    /**
     * @param User|null $sender
     * @return $this
     */
    public function setSender(?User $sender): self
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * @return User|null
     */
    public function getReceiver(): ?User
    {
        return $this->receiver;
    }

    /**
     * @param User|null $receiver
     * @return $this
     */
    public function setReceiver(?User $receiver): self
    {
        $this->receiver = $receiver;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return $this
     */
    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }
}
