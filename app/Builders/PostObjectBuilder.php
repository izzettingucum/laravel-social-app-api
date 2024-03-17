<?php

namespace App\Builders;

use App\DTO\PostDTO;

final class PostObjectBuilder
{
    private int $id;
    private string $title;
    private int $user_id;
    private int $is_archived;

    /**
     * @param int $id
     * @return $this
     */
    public function setId(int $id): PostObjectBuilder
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title): PostObjectBuilder
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param int $user_id
     * @return $this
     */
    public function setUserId(int $user_id): PostObjectBuilder
    {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * @param int $is_archived
     * @return $this
     */
    public function setIsArchived (int $is_archived): PostObjectBuilder
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
