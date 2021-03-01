<?php

declare(strict_types=1);

namespace App\EntityListener;


use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserListener
{

    private UserPasswordEncoderInterface $userPasswordEncode;

    /**
     * UserListener constructor.
     * @param UserPasswordEncoderInterface $userPasswordEncode
     */
    public function __construct(UserPasswordEncoderInterface $userPasswordEncode)
    {
        $this->userPasswordEncode = $userPasswordEncode;
    }


    public function prePersist(User  $user): void
    {
        $user->setPassword(
            $this->userPasswordEncode->encodePassword(
                $user,
                $user->getPlainPassword()
            )
        );
    }

}