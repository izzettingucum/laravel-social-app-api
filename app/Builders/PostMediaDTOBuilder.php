<?php

namespace App\Builders;

use App\DTO\Post\PostMediaDTO;

final class PostMediaDTOBuilder
{
    private ?int $id = null;
    private ?int $post_id = null;
    private ?string $path = null;
    private ?string $media_type = null;

    /**
     * @param int|null $id
     * @return $this
     */
    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param int|null $postId
     * @return $this
     */
    public function setPostId(?int $postId): self
    {
        $this->post_id = $postId;
        return $this;
    }

    /**
     * @param string|null $path
     * @return $this
     */
    public function setPath(?string $path): self
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @param string|null $mediaType
     * @return $this
     */
    public function setMediaType(?string $mediaType): self
    {
        $this->media_type = $mediaType;
        return $this;
    }

    /**
     * @return PostMediaDTO
     */
    public function build(): PostMediaDTO
    {
        return new PostMediaDTO($this->id, $this->post_id, $this->path, $this->media_type);
    }

}
