<?php

declare(strict_types=1);

namespace App\Entity;

use App\Trait\IdentifierTrait;
use App\Trait\TimestampsTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Media
 * @package App\Entity
 * @ORM\Entity
 * @ORM\EntityListeners({"App\EntityListener\MediaListener"})
 * @ORM\HasLifecycleCallbacks()
 */
class Media
{
    use IdentifierTrait;

    use TimestampsTrait;

    /**
     * @var string|null
     * @ORM\Column
     * @Groups({"get"})
     */
    private ?string $path = null;

    /**
     * @var UploadedFile|null
     * @Assert\Image
     */
    private ?UploadedFile $file = null;

    /**
     * @var Reference|null
     * @ORM\ManyToOne(targetEntity="Reference", inversedBy="medias")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private ?Reference $reference;

    /**
     * @return string|null
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * @param string|null $path
     */
    public function setPath(?string $path): void
    {
        $this->path = $path;
    }

    /**
     * @return Reference|null
     */
    public function getReference(): ?Reference
    {
        return $this->reference;
    }

    /**
     * @param Reference|null $reference
     */
    public function setReference(?Reference $reference): void
    {
        $this->reference = $reference;
    }

    /**
     * @return UploadedFile|null
     */
    public function getFile(): ?UploadedFile
    {
        return $this->file;
    }

    /**
     * @param UploadedFile|null $file
     */
    public function setFile(?UploadedFile $file): void
    {
        $this->file = $file;
    }
}
