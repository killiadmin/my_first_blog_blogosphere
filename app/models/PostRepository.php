<?php

class PostRepository extends Model
{
    //Function that will retrieve post from the posts table
    public function getPosts(): array
    {
        return $this->getAll('posts', 'Post');
    }

    //Function that will retrieve post from the posts table with his id
    public function getPost(int $id): array
    {
        return $this->getOne(
            'posts',
            'users',
            'Post',
            $id);
    }

    //Function that modify a post from the posts table
    public function updatePost(int $id): ?array
    {
        return $this->updateOne(
            'posts' ,
            'users',
            'title',
            'chapo',
            'content',
            $id);
    }

    //Function that create a post from the posts table
    public function createPost(): ?string
    {
        return $this->createOne('posts');
    }

    //Function that deleted a posts from the posts table with this comments associated
    public function deletePost(int $id): void
    {
        $this->deleteOne('posts','comments', $id);
    }
}
