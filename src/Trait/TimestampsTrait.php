<?php
/*
 *
 * Date : 12/03/2021, 01:43
 * Author : rami
 * Class TimestampsTrait.php
 */

declare(strict_types=1);

namespace App\Trait;

use DateTime;
use DateTimeInterface;
use Exception;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trait TimestampsTrait
 * @package App\Entity
 */
trait TimestampsTrait
{
    /**
     * @ORM\Column(type="datetime")
     */
    private ?DateTimeInterface $createdAt = null;

    /**
     * @ORM\Column(type="datetime")
     */
    private ?DateTimeInterface $updatedAt = null;

    /**
     * @return DateTimeInterface|null
     * @throws Exception
     */
    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt ?? new DateTime();
    }

    /**
     * @param DateTimeInterface $createdAt
     * @return $this
     */
    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt ?? new DateTime();
    }

    /**
     * @param DateTimeInterface $updatedAt
     * @return $this
     */
    public function setUpdatedAt(DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function updateTimestamps(): void
    {
        $now = new DateTime();
        $this->setUpdatedAt($now);
        if ($this->getId() === null) {
            $this->setCreatedAt($now);
        }
    }
}
