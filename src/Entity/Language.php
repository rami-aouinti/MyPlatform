<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class Language
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\LanguageRepository")
 */
class Language
{
    /**
     * @var int|null
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     * @Groups({"get_languages"})
     */
    private ?int $id = null;

    /**
     * @var string|null
     * @ORM\Column
     * @Assert\NotBlank(message="Ce champs ne peut pas être vide.")
     * @Groups({"get_languages"})
     */
    private ?string $name = null;

    /**
     * @var int|null
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Ce champs ne peut pas être vide.")
     * @Assert\Range(
     *     min=1,
     *     max=10,
     *     minMessage="Le niveau doit être supérieur ou égal à 1",
     *     maxMessage="Le niveau doit être inférieur ou égal à 10"
     * )
     * @Groups({"get_languages"})
     */
    private ?int $level = null;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="languages")
     */
    private User $user;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

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
     * @return int|null
     */
    public function getLevel(): ?int
    {
        return $this->level;
    }

    /**
     * @param int|null $level
     */
    public function setLevel(?int $level): void
    {
        $this->level = $level;
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
