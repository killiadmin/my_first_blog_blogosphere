<?php

class PostRepository extends Model
{
    //Function that will retrieve post from the post table
    public function getPosts(): array
    {
        return $this->getAll('posts', 'Post');
    }

    public function getPost(int $id): array
    {
        return $this->getOne(
            'posts',
            'users',
            'Post',
            $id);
    }

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

    public function createPost(): ?string
    {
        return $this->createOne('posts', 'Post');
    }

    public function deletePost(int $id): void
    {
        $this->deleteOne('posts','comments', $id);
    }
}