<?php

class CommentRepository extends Model
{
    //Function that will retrieve comments from the comments table
    public function getComments(): array
    {
        return $this->getAll('comments', 'Comment');
    }

    public function getComment(int $id): array
    {
        return $this->getOne('comments','users','Comment', $id);
    }

    public function createComment(int $id, int $idUser): void
    {
        $this->createOneComment('comments', 'posts', $id, $idUser);
    }

    public function validateComment (int $id): void
    {
        $this->updateOneComment('comments', $id);
    }
}
