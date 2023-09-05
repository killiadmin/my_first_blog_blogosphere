<?php

class CommentRepository extends Model
{
    //Function that will retrieve comments from the comments table
    public function getComments()
    {
        return $this->getAll('comments', 'Comment');
    }

    public function getComment(int $id)
    {
        return $this->getOne('comments','users','Comment', $id);
    }

    public function createComment(int $id, int $idUser)
    {
        return $this->createOneComment('comments', 'posts', $id, $idUser);
    }
}