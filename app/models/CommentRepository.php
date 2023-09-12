<?php

class CommentRepository extends Model
{
    //Function that will retrieve comments from the comments table
    public function getComments(): array
    {
        return $this->getAll('comments', 'Comment');
    }

    //Function that will retrieve comment from the comments table with his id
    public function getComment(int $id): array
    {
        return $this->getOne('comments','users','Comment', $id);
    }

    //Function that will create comment from the comments table
    public function createComment(int $id, int $idUser): void
    {
        $this->createOneComment('comments', 'posts', $id, $idUser);
    }

    //Function that validates a comment from the comments table for it to be published
    public function validateComment (int $id): void
    {
        $this->updateOneComment('comments', $id);
    }
}
