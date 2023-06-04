<?php

namespace App\Services;

use App\Models\Post;

class PostService
{
    public function getPosts()
    {
         return Post::with('user')->latest()->paginate(1);
    }

    public function createPost($data) : Product
    {
       $post = Post::create($data);
       return $post;
    }


    public function updatePost($id,$data) : Product
    {
        $product = $this->getPostById($id);
        $product->title = $data['title'];
//        $product->description = $data['description'];
        $product->details->size = $data['size'];
        $product->details->color = $data['color'];
        $product->details->price = $data['price'];
        $product->save();
        return $product;
    }


    public function deletePost($id)
    {
        $product = $this->getPostById($id);
        if($product->details){
            $product->details()->delete();
        }
        if($product->reviews){
            $product->reviews()->delete();
        }
        if($product->imagable){
            $product->imagable()->delete();
        }
        $product->delete();
    }


    public function getPostById($id)
    {
        return Product::find($id)->first();
    }

}
