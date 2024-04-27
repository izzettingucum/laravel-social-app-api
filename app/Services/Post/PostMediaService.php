<?php

namespace App\Services\Post;

use App\Builders\PostMediaDTOBuilder;
use App\Enums\PostMedia\PostMediaEnum;
use App\Http\Requests\Post\CreatePostRequest;
use App\Repositories\Interfaces\PostMediaRepositoryInterface;
use Illuminate\Validation\ValidationException;

class PostMediaService
{
    private PostMediaRepositoryInterface $postMediaRepository;

    /**
     * @param PostMediaRepositoryInterface $postMediaRepository
     */
    public function __construct(PostMediaRepositoryInterface $postMediaRepository)
    {
        $this->postMediaRepository = $postMediaRepository;
    }

    /**
     * @param CreatePostRequest $request
     * @param int $post_id
     * @return void
     * @throws ValidationException
     */
    public function createPostMedia(CreatePostRequest $request, int $post_id): void
    {
        try {
            $uploaded_media = collect($request->file("media"))
                ->filter()
                ->map(function ($file) use ($post_id) {
                    $encrypted_file_name = $file->getClientOriginalName();
                    $path = $file->storeAs("post", $encrypted_file_name);
                    $media_type = $file->getClientOriginalExtension() == "mp4" ? PostMediaEnum::getTypeReels() : PostMediaEnum::getTypeImage();

                    $postMediaDTO = (new PostMediaDTOBuilder())
                        ->setPostId($post_id)
                        ->setPath($path)
                        ->setMediaType($media_type)
                        ->build();

                    $this->postMediaRepository->createMedia($postMediaDTO);
                });
        }
        catch (ValidationException $exception) {
            throw ValidationException::withMessages("An error occurred while creating the post media.");
        }
    }
}
