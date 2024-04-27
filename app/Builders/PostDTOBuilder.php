<?php

namespace App\Builders;

use App\DTO\Post\PostDTO;

final class PostDTOBuilder
{
    private ?int $id = null;
    private ?string $title = null;
    private ?int $user_id = null;
    private ?int $is_archived = null;

    /**
     * @param int $id
     * @return $this
     */
    public function setId(int $id): PostDTOBuilder
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title): PostDTOBuilder
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param int $user_id
     * @return $this
     */
    public function setUserId(int $user_id): PostDTOBuilder
    {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * @param ?int $is_archived
     * @return $this
     */
    public function setIsArchived (?int $is_archived): PostDTOBuilder
    {
        $this->is_archived = $is_archived;
        return $this;
    }

    /**
     * @return PostDTO
     */
    public function build(): PostDTO
    {
        return new PostDTO($this->id, $this->title, $this->user_id, $this->is_archived);
    }
}
