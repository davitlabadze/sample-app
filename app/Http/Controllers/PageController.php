<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {   
        $posts = Post::join('categories', 'posts.category_id', '=', 'categories.id')
        ->select(
        'posts.*',
        'categories.name as category_name',
        'categories.slug as category_slug'
         )
        ->get();
      

    return view('pages.index')->with('posts', $posts);
        return view('pages.index')->with('posts', $posts);
    }
    
    public function singlePost($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
      
        return view('pages.singe-post')->with('post', $post);
    }

    public function singleCategory($slug)
    {
        $posts = Post::join('categories', 'categories.id', '=', 'posts.category_id')
      ->where('categories.slug', '=', $slug)
      ->select(
        'posts.*',
        'categories.name as category_name',
        'categories.slug as category_slug'
      )->get();


    return view('pages.category')->with('posts', $posts);
    }
}
