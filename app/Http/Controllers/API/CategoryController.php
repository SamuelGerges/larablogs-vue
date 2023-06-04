<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ResponseTrait;
    public function index()
    {
        $categories = Category::has('posts')->get();
        return $this->sendResponse($categories);
    }
}
