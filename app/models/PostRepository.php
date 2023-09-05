<?php

class PostRepository extends Model
{
    //Function that will retrieve post from the post table
    public function getPosts()
    {
        return $this->getAll('posts', 'Post');
    }

    public function getPost(int $id)
    {
        return $this->getOne(
            'posts',
            'users',
            'Post',
            $id);
    }

    public function updatePost(int $id)
    {
        return $this->updateOne(
            'posts' ,
            'users',
            'title',
            'chapo',
            'content',
            $id);
    }

    public function createPost()
    {
        return $this->createOne('posts', 'Post');
    }

    public function deletePost(int $id)
    {
        return $this->deleteOne('posts','comments', $id);
    }
}