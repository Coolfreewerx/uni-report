<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Sector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(50);
        return view("posts.index", ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Post::class);

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
        $this->authorize('create', Post::class);

        $validated = $request->validate([
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => ['required', 'max:255', 'min:5'],
            'description' => ['required', 'max:1000'],
            'place' => ['required', 'max:1000'],
            'sector' => ['required', 'max:1000']
        ]);

        $newImageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $newImageName);

        $post = new Post();
        $post->image_path = $newImageName;
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->user_id = $request->user()->id;
        $post->place = $request->input('place');
        $post->save();


        $tags = $request->get('tags');
        $sectors = $request->get('sectors');

        $tag_ids = $this->syncTags($tags);
        // $sector_ids = $this->syncSectors($sectors);

        $post->tags()->sync($tag_ids);
        $post->sectors()->sync((int)$sectors);

        return redirect()->route('posts.show', ['post' => $post->id]);
        //                     -------------------------^
        //                    |
        // GET|HEAD  posts/{post} ......... posts.show › PostController@show
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)    // Dependency Injection
    {
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        $tags = implode(', ', $post->tags->pluck('name')->all());

        return view('posts.edit', ['post' => $post, 'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => ['required', 'max:255', 'min:5'],
            'description' => ['required', 'max:1000'],
            'place' => ['required', 'max:1000'],
            'sector' => ['required', 'max:1000']
        ]);

        $newImageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $newImageName);

        $post = new Post();
        $post->image_path = $newImageName;
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->user_id = $request->user()->id;
        $post->place = $request->input('place');
        $post->sector = $request->input('sector');
        $post->save();

        $tags = $request->get('tags');
        $sectors = $request->get('sectors');

        $tag_ids = $this->syncTags($tags);
        // $sector_ids = $this->syncSectors($sectors);

        $post->tags()->sync($tag_ids);
        $post->sectors()->sync($sectors);

        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    private function syncTags($tags)
    {
        $tags = explode(',', $tags);
        $tags = array_map(function($v) {
            // use Illuminate\Support\Str; ก่อน class
            return Str::ucfirst(trim($v));
        }, $tags);

        $tag_ids = [];
        foreach($tags as $tag_name) {
            $tag = Tag::where('name', $tag_name)->first();
            if (!$tag) {
                $tag = new Tag();
                $tag->name = $tag_name;
                $tag->save();
            }
            $tag_ids[] = $tag->id;
        }
        return $tag_ids;
    }

    // private function syncSectors($sectors)
    // {
    //     $sectors = explode(',', $sectors);
    //     $sectors = array_map(function($v) {
    //         // use Illuminate\Support\Str; ก่อน class
    //         return Str::ucfirst(trim($v));
    //     }, $sectors);

    //     $sector_ids = [];
    //     foreach($sectors as $sector_name) {
    //         $sector = Sector::where('name', $sector_name)->first();
            
    //     }
    //     return $sector_ids;
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Post $post)
    {
        $this->authorize('delete', $post);

        $title = $request->input('title');
        if ($title == $post->title) {
            $post->delete();
            return redirect()->route('posts.index');
        }
        return redirect()->back();
    }

    public function storeComment(Request $request, Post $post)
    {
        $comment = new Comment();
        $comment->message = $request->get('message');
        $post->comments()->save($comment);
        return redirect()->route('posts.show', ['post' => $post->id]);
    }
}
