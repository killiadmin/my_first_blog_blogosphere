<?php

class CommentRepository extends Model
{
    //Function that will retrieve comments from the comments table
    public function getComment($id)
    {
        return $this->getOne('comments','users','Comment', $id);
    }

    public function createComment($id)
    {
        return$this->createOneComment('comments', 'posts', $id);
    }
}