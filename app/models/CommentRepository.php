<?php

class CommentRepository extends Model
{
    //Function that will retrieve comments from the comments table
    public function getComment($id)
    {
        return $this->getOne('comments','users','Comment', $id);
    }
}