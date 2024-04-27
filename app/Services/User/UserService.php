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
        $userDTO = (new UserDTOBuilder())
            ->setSlug(auth()->user()->slug)
            ->build();

        return $this->userRepository->getWholeUserProfileBySlug($userDTO);
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

    /**
     * @param string $slug
     * @return mixed
     */
    public function getHiddenUserProfileBySlug(string $slug): mixed
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

        $user_existing = $this->userRepository->checkUserExistingBySlug($userDTO);

        throw_if($user_existing == false,
            new NotFoundHttpException("User cannot be found.")
        );
    }

    /**
     * @throws \Throwable
     */
    public function validateUserExistingById(int $id): void
    {
        $userDTO = (new UserDTOBuilder())
            ->setSlug($id)
            ->build();

        $user_existing = $this->userRepository->checkUserExistingById($userDTO);

        throw_if($user_existing == false,
            new NotFoundHttpException("User cannot be found.")
        );
    }

    /**
     * @param string $slug
     * @return mixed
     */
    public function getUserHiddenStatusBySlug(string $slug): mixed
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
     * @param bool $is_hidden
     * @void
     */
    public function setViewProfileStrategyByHiddenStatus(bool $is_hidden): void
    {
       if (! $is_hidden) {
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
