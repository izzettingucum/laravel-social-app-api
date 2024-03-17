<?php

namespace App\Builders;

use App\DTO\CommentDTO;

final class CommentObjectBuilder
{
    private int $id;
    private string $comment;
    private int $user_id;
    private int $post_id;

    /**
     * @param int $id
     * @return $this
     */
    public function setId(int $id): CommentObjectBuilder
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $comment
     * @return $this
     */
    public function setComment(string $comment): CommentObjectBuilder
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * @param int $user_id
     * @return $this
     */
    public function setUserId(int $user_id): CommentObjectBuilder
    {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * @param int $post_id
     * @return $this
     */
    public function setPostId(int $post_id): CommentObjectBuilder
    {
        $this->post_id = $post_id;
        return $this;
    }

    /**
     * @return CommentDTO
     */
    public function build(): CommentDTO
    {
        return new CommentDTO($this->id, $this->comment, $this->user_id, $this->post_id);
    }

}
