<?php

class PostRepository extends Model
{
    //Function that will retrieve post from the post table
    public function getPosts()
    {
        return $this->getAll('posts', 'Post');
    }

    public function getPost($id)
    {
        return $this->getOne('posts', 'users', 'Post', $id);
    }

    public function createPost()
    {
        return $this->createOne('posts', 'Post');
    }

    public function deletePost($id)
    {
        return $this->deleteOne('posts', $id);
    }
}