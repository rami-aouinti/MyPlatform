<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ProfileRepository;
use App\Trait\IdentifierTrait;
use App\Trait\TimestampsTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProfileRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Profile
{
    use IdentifierTrait;

    use TimestampsTrait;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $firstname = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $lastname = null;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\Email
     * @Assert\NotBlank
     */
    private ?string $email = null;

    /**
     * @ORM\Column(type="string", length=180, nullable=true)
     * @Assert\NotBlank
     */
    private ?string $sex = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $title = null;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $description = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $country = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $state = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $street = null;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $houseNumber = null;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $postcode = null;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $birthdayDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $nationality = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $phone = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $linkdIn= null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $facebook = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $tweeter = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $skype = null;

    /**
     * @ORM\Column(type="string")
     */
    private ?string $brochureFilename = null;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="profile")
     */
    private User $user;

    /**
     * @return string|null
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     * @return $this
     */
    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     * @return $this
     */
    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

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
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getSex(): ?string
    {
        return $this->sex;
    }

    /**
     * @param string|null $sex
     */
    public function setSex(?string $sex): void
    {
        $this->sex = $sex;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
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
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return $this
     */
    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * @param string $state
     * @return $this
     */
    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @param string $street
     * @return $this
     */
    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getHouseNumber(): ?int
    {
        return $this->houseNumber;
    }

    /**
     * @param int $houseNumber
     * @return $this
     */
    public function setHouseNumber(int $houseNumber): self
    {
        $this->houseNumber = $houseNumber;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPostcode(): ?int
    {
        return $this->postcode;
    }

    /**
     * @param int|null $postcode
     */
    public function setPostcode(?int $postcode): void
    {
        $this->postcode = $postcode;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getBirthdayDate(): ?\DateTimeInterface
    {
        return $this->birthdayDate;
    }

    /**
     * @param \DateTimeInterface $birthdayDate
     * @return $this
     */
    public function setBirthdayDate(\DateTimeInterface $birthdayDate): self
    {
        $this->birthdayDate = $birthdayDate;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    /**
     * @param string $nationality
     * @return $this
     */
    public function setNationality(string $nationality): self
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getLinkdIn()
    {
        return $this->linkdIn;
    }

    /**
     * @param mixed $linkdIn
     */
    public function setLinkdIn($linkdIn): void
    {
        $this->linkdIn = $linkdIn;
    }

    /**
     * @return mixed
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * @param mixed $facebook
     */
    public function setFacebook($facebook): void
    {
        $this->facebook = $facebook;
    }

    /**
     * @return mixed
     */
    public function getTweeter()
    {
        return $this->tweeter;
    }

    /**
     * @param mixed $tweeter
     */
    public function setTweeter($tweeter): void
    {
        $this->tweeter = $tweeter;
    }

    /**
     * @return mixed
     */
    public function getSkype()
    {
        return $this->skype;
    }

    /**
     * @param mixed $skype
     */
    public function setSkype(mixed $skype): void
    {
        $this->skype = $skype;
    }

    /**
     * @return string|null
     */
    public function getBrochureFilename()
    {
        return $this->brochureFilename;
    }

    /**
     * @param $brochureFilename
     * @return $this
     */
    public function setBrochureFilename($brochureFilename)
    {
        $this->brochureFilename = $brochureFilename;

        return $this;
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
