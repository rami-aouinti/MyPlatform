<?php

namespace App\Service;

use App\Repository\FriendRepository;
use Symfony\Component\Security\Core\Security;

/**
 * Class FriendsListe
 * @package App\Service
 */
class FriendsListe
{
    /**
     * @var Security
     */
    private Security $security;

    /**
     * @var FriendRepository
     */
    private FriendRepository $friendRepository;

    /**
     * FriendsListe constructor.
     * @param Security $security
     * @param FriendRepository $friendRepository
     */
    public function __construct(Security $security, FriendRepository $friendRepository)
    {
        $this->security = $security;
        $this->friendRepository = $friendRepository;
    }


    /**
     * @return mixed
     */
    public function list(): mixed
    {
        return $this->friendRepository->findByUser($this->security->getUser());
    }
}
