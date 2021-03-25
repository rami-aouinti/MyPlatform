<?php
/*
 *
 * Date : 12/03/2021, 01:43
 * Author : rami
 * Class IdentifierTrait.php
 */

declare(strict_types=1);

namespace App\Trait;

use Exception;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trait IdentifierTrait
 * @package App\Entity
 */
trait IdentifierTrait
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected ?int $id = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
