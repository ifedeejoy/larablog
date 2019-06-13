<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        // $posts =  Post::orderBy('created_at', 'desc')->get();
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('posts.index')->with('posts', $posts);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'article' => 'required',
            'cover_image' => 'image|nullable|max:2499'
        ]);

        //check for file
        if($request->hasFile('cover_image')){
            //Get Filename With Extension
            $filenameWithExt =  $request->file('cover_image')->getClientOriginalName();
            //Get FileName Alone
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get Extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //File Name To Store
            $fileNameToStore = $filename. '_' . time(). '.' . $extension;
            //Store Image
            $path = $request->file('cover_image')->storeAs('/public/cover_images', $fileNameToStore);
        }
        else{
            $fileNameToStore = 'noimage.jpg';
        }


        $post = new Post;
        $post->title = $request->input('title');
        $post->article = $request->input('article');
        $post->video_links = $request->input('videolinks');
        $post->user_id = auth()->user()->id;
        $post->image = $fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success', 'Article Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts =  Post::find($id);
        return view('posts.show')->with('post', $posts);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts =  Post::find($id);
        if (auth()->user()->id !== $posts->user_id) {
            return redirect('/posts')->with('error', 'You\'re not the author of the article therefore you can\'t edit it');
        }
        return view('posts.edit')->with('post', $posts);
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
        $this->validate($request, [
            'title' => 'required',
            'article' => 'required'
        ]);
        if($request->hasFile('cover_image')){
            //Get Filename With Extension
            $filenameWithExt =  $request->file('cover_image')->getClientOriginalName();
            //Get FileName Alone
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get Extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //File Name To Store
            $fileNameToStore = $filename. '_' . time(). '.' . $extension;
            //Store Image
            $path = $request->file('cover_image')->storeAs('/public/cover_images', $fileNameToStore);
        }
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->article = $request->input('article');
        $post->video_links = $request->input('videolinks');
        if($post->image != 'noimage.jpg')
        {
            Storage::delete('public/cover_images'.$post->image);
        }
        if($request->hasFile('cover_image'))
        {
            $post->image = $fileNameToStore;
        }
        $post->save();

        return redirect('/posts')->with('success', 'Article Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if ($post->image != 'noimage.jpg') {
            Storage::delete('public/cover_images'.$post->image);
        }
        $post->delete();
        return redirect('/posts')->with('success', 'Article Deleted');
    }
}
