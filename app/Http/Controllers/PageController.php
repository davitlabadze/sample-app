<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {   
        $posts = Post::with('category')->whereHas('category')->get();
        return view('pages.index')->with('post', $posts);
    }
    
    public function singlePost($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
      
        return view('pages.singe-post')->with('post', $post);
    }

    public function singleCategory($slug)
    {
        $category = Category::where('slug', $slug)->with('posts')->firstOrFail();
        // $posts = Post::where('category_id', $category->id)->get();
        return view('pages.category')->with('category', $category);
    }
}
