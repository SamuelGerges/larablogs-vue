<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\PostService;
use App\Traits\Response;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use Response;
    protected  $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        $posts = $this->postService->getPosts();
        foreach ($posts as $post){
            $post->setAttribute('added_at',$post->created_at->diffForHumans());
            $post->setAttribute('comments_count',$post->comments->count());
        }
        return $this->sendResponse($posts);
    }

    public function show(Post $post)
    {
        return $this->sendResponse([
            'id' => $post->id,
            'slug' => $post->slug,
            'body' => $post->body,
            'title' => $post->title,
            'added_at' => $post->created_at->diffForHumans(),
            'comment_count' => $post->comments->count(),
            'image' => $post->image,
            'user' => $post->user,
            'category' => $post->category,
            'comments' => $this->commentsFormatted($post->comments) ,
        ]);
    }
    public function commentsFormatted($comments) : array
    {
        $newComments = [];
        foreach ($comments as $comment)
        {
            $newComments[] = [
              'id' => $comment->id,
              'body' => $comment->body,
              'user' => $comment->user,
              'added_at' => $comment->created_at->diffForHumans(),
            ];
        }
        return $newComments;
    }

}
