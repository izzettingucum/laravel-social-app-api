<?php

namespace App\Services\User;

use App\Builders\User\UserDTOBuilder;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Strategies\UserProfile\ViewProfileStrategyContext;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserService
{
    private UserRepositoryInterface $userRepository;
    private ViewProfileStrategyContext $viewProfileStrategy;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return User
     */
    public function getCurrentLoggedInUserProfile(): User
    {
        $user = auth()->user();

        return $this->userRepository->getWholeUserProfileByUserModel($user);
    }

    /**
     * @param string $slug
     * @return mixed
     */
    public function getWholeUserProfileBySlug(string $slug): mixed
    {
        $userDTO = (new UserDTOBuilder())
            ->setSlug($slug)
            ->build();

        return $this->userRepository->getWholeUserProfileBySlug($userDTO);
    }

    public function getHiddenUserProfileBySlug(string $slug)
    {
        $userDTO = (new UserDTOBuilder())
            ->setSlug($slug)
            ->build();

        return $this->userRepository->getHiddenUserProfileBySlug($userDTO);
    }

    /**
     * @throws \Throwable
     */
    public function validateUserExistingBySlug(string $slug): void
    {
        $userDTO = (new UserDTOBuilder())
            ->setSlug($slug)
            ->build();

        $userExisting = $this->userRepository->checkUserExisting($userDTO);

        throw_if($userExisting == false,
            new NotFoundHttpException("User cannot be found.")
        );
    }

    public function getUserHiddenStatusBySlug(string $slug)
    {
        $userDTO = (new UserDTOBuilder())
            ->setSlug($slug)
            ->build();

        return $this->userRepository->getUserHiddenStatusBySlug($userDTO)->is_hidden;
    }

    /**
     * @param User $user
     * @param int $userId
     * @return mixed
     */
    public function checkUserFollowingStatusById(User $user, int $userId): mixed
    {
        $userDTO = (new UserDTOBuilder())
            ->setId($userId)
            ->build();

        return $this->userRepository->checkIfUserIsFollowing($user, $userDTO);
    }

    /**
     * @param string $slug
     * @return mixed
     */
    public function getUserIdBySlug(string $slug): mixed
    {
        $userDTO = (new UserDTOBuilder())
            ->setSlug($slug)
            ->build();

        return $this->userRepository->getUserIdBySlug($userDTO);
    }

    /**
     * @param bool $isHidden
     * @void
     */
    public function setViewProfileStrategyByHiddenStatus(bool $isHidden): void
    {
       if (! $isHidden) {
           $strategy = new ViewProfileStrategyContext("openProfile");
       }
       else {
           $strategy = new ViewProfileStrategyContext("hiddenProfile");
       }

       $this->viewProfileStrategy = $strategy;
    }

    /**
     * @param string $slug
     * @return mixed
     */
    public function executeViewProfileStrategy(string $slug): mixed
    {
        return $this->viewProfileStrategy->viewProfile($slug);
    }

    /**
     * @param User $user
     * @return int
     */
    public function setViewProfileStatus(User $user): int
    {
         if ($this->userRepository->checkIfPostLoaded($user)) {
             $status = Response::HTTP_OK;
         }
         else {
             $status = Response::HTTP_UNAUTHORIZED;
         }

         return $status;
    }
}
