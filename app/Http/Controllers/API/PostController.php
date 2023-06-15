<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Services\PostService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use ResponseTrait;

    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {

        $posts = $this->postService->getPosts();
        foreach ($posts as $post) {
            $post->setAttribute('added_at', $post->created_at->diffForHumans());
            $post->setAttribute('comments_count', $post->comments->count());
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
            'user' => $post->user->name,
            'category' => $post->category,
            'comments' => $this->commentsFormatted($post->comments),
        ]);
    }

    public function commentsFormatted($comments)
    {
        $newComments = [];
        foreach ($comments as $comment) {
            $newComments[] = [
                'id' => $comment->id,
                'body' => $comment->body,
                'user' => $comment->user,
                'added_at' => $comment->created_at->diffForHumans(),
            ];
        }
        return $newComments;
    }

    public function showCourseByCategory($catSlug)
    {
        $category = Category::where('slug', $catSlug)->first();
        $posts = Post::with('user')->whereCategoryId($category->id)->get();
//        $posts = Post::with('user')->where('category_id',$category->id)->get();
        foreach ($posts as $post) {
            $post->setAttribute('added_at', $post->created_at->diffForHumans());
            $post->setAttribute('comments_count', $post->comments->count());
        }
        return $this->sendResponse($posts);
    }

    public function searchPosts($query)
    {
        $posts = Post::with('user')->where('title', 'like', "%$query%");
        $nbPosts = count($posts->get());
        foreach ($posts->get() as $post) {
            $post->setAttribute('added_at', $post->created_at->diffForHumans());
            $post->setAttribute('comments_count', $post->comments->count());
        }
        $posts = $posts->paginate(intval($nbPosts));
        return $this->sendResponse($posts);
    }

}
