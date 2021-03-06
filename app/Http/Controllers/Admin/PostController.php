<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\support\Str;

use function PHPUnit\Framework\returnSelf;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.post.index')->with('post',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $categories = Category::all();
        return view('admin.post.form')->with('categories', $categories)->with('action', 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
        $request->validate([
            'title' => ['required','min:2','max:150'],
            'slug' => ['nullable','max:150'],
            'text' =>['required'],
            'image' => ['required','image'],
            'category_id' => ['required', 'numeric']
        ]);
        
        $filename = $request->file('image')->getClientOriginalName();
        $savedFileName = time(). '-' . $filename;
        $request->file('image')->move(public_path('images'), $savedFileName);
        $fileUrl='/images/' . $savedFileName;

        Post::create([
            'title' => $request->title,
            'slug' => Str::slug($request->slug ? $request->slug : $request->title),
            'category_id' => $request->category_id,
            'text' =>$request->text,
            'image' => $fileUrl,
            
        ]);

        return redirect()->route('admin.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts = Post::where('id',$id)->first();
        $categories=Category::all();
        return view('admin.post.form')->with('post',$posts)->with('categories', $categories)->with('action', 'edit');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $posts = Post::where('id',$id)->first();
        $request->validate([
            'title' => ['required','min:2','max:150'],
            'slug' => ['nullable','max:150'],
            'text' =>['required'],
            'image' => ['nullable','image'],
            'category_id' => ['required', 'numeric']
        ]);
        if ($request->file('image')) {
            $filename = $request->file('image')->getClientOriginalName();
        $savedFileName = time(). '-' . $filename;
        $request->file('image')->move(public_path('images'), $savedFileName);
        $fileUrl='/images/' . $savedFileName;
        $posts->image = $fileUrl;
        }
        
       
        $posts->title = $request->title;
        $posts->slug = Str::slug($request->slug ? $request->slug : $request->title);
        $posts->category_id = $request->category_id;
        $posts->text = $request->text;
        $posts->save();


        return redirect()->route('admin.post.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::where('id',$id)->delete();


        return redirect()->route('admin.post.index');
    }
}
