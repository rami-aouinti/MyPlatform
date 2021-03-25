<?php

declare(strict_types=1);

namespace App\Entity;

use App\Trait\IdentifierTrait;
use App\Trait\TimestampsTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class Hobby
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\HobbyRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Hobby
{
    use IdentifierTrait;

    use TimestampsTrait;

    /**
     * @var string|null
     * @ORM\Column
     * @Assert\NotBlank(message="Ce champs ne peut pas être vide.")
     * @Groups({"get_hobbies"})
     */
    private ?string $name = null;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="hobbies")
     */
    private User $user;

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return $this
     */
    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
