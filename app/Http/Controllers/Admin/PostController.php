<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Mail\CreatePostMail;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = [
            'posts' => Post::with('category')->paginate(10),
        ];

        return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'categories' => Category::All(),
            'tags' => Tag::all()
        ];

        return view('admin.posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $newPost = new Post();

        // upload immagini

        if( array_key_exists('image',$data)){
            $cover_url = Storage::put('post_covers', $data['image']);
            $data['cover'] = $cover_url;
        }

        $newPost->fill($data);
        $newPost->save();

        // controllo se l'utente ha selezionato le checkbox (N) a (N)
        if( array_key_exists('tags',$data) ){
            $newPost->tags()->sync( $data['tags'] );
        }


        // invio mail

        $mail = new CreatePostMail($newPost);
        $email_utente = Auth::user()->email;
        Mail::to($email_utente)->send($mail);


        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $singolo_post = Post::findOrFail($id);
        return view('admin.posts.show', compact('singolo_post'));
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
        $categories = Category::All();

        $tags = Tag::all();

        return view('admin.posts.edit',compact('post','categories','tags'));
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
        $data = $request->all();
        $singoloPost = Post::findOrFail($id);

        $singoloPost->update($data);

        // controlla se l'utente ha cliccato o erano già selezionate delle checkbox
           if( array_key_exists('tags',$data) ){
            $singoloPost->tags()->sync( $data['tags'] );
        } else {
            // non c'è alcun elemento selezionato
            $singoloPost->tags()->sync([]);
        }

        return redirect()->route('admin.posts.show', $singoloPost->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $singoloPost = Post::findOrFail($id);
        $singoloPost->tags()->sync([]);
        $singoloPost->delete();

        return redirect()->route('admin.posts.index');
    }
}
