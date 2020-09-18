<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;
use Illuminate\support\Facades\Storage;

class PostController extends Controller
{
    public function __construct(){
        Carbon::setlocale("es");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts= Post::orderBy('updated_at','DESC')->get();
        return view('welcome', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('createPost');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,['title'=>'required','content' => 'required','url_img'=>'required']);

        $post = new Post($request->all());
        $id = auth()->user()->id;
        $post->user_id = $id;
        $post->url_img = $request->file('url_img')->store('images','public');
       /* if($request->hasFile('url_img')){
            $file = $request->file('url_img');
            $nameFile = $file->getClientOriginalName();
            $file->move(public_path("img/"),$nameFile);
            $post->url_img=$nameFile;
        }*/
 
        $post->save();
 
        return redirect('/account');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    $post= Post::findOrFail($id);
    return view('post', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        Gate::authorize('update-post', $post);
        return view('editPost', compact('post'));
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
        $this->validate($request,['title'=>'required','content' => 'required','url_img'=>'required']);

        $post = Post::findOrFail($id);
        $post->title = request()->title;
        $post->content = request()->content;
        $post->url_img = $request->file('url_img')->store('images','public');

        $post->save();

        return redirect('/account');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        Gate::authorize('update-post', $post);

        $post->delete();

        return redirect('/account');
    }
}
