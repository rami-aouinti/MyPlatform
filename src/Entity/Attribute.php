<?php

declare(strict_types=1);

namespace App\Entity;

use App\Trait\IdentifierTrait;
use App\Trait\TimestampsTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class Attribute
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\AttributeRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Attribute
{
    use IdentifierTrait;

    use TimestampsTrait;

    /**
     * @var string|null
     * @ORM\Column
     * @Assert\NotBlank(message="Ce champs ne peut pas être vide.")
     * @Groups({"get_attributes"})
     */
    private ?string $name = null;

    /**
     * @var string|null
     * @ORM\Column
     * @Assert\NotBlank(message="Ce champs ne peut pas être vide.")
     * @Groups({"get_attributes"})
     */
    private ?string $description = null;

    /**
     * @var string|null
     * @ORM\Column
     * @Assert\NotBlank(message="Ce champs ne peut pas être vide.")
     * @Groups({"get_attributes"})
     */
    private ?string $url = null;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="attributes")
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
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string|null $url
     */
    public function setUrl(?string $url): void
    {
        $this->url = $url;
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
