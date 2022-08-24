<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Http\Request;
use Carbon\Carbon;


class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::get();
        $tags_name = [];
        $tagCount = [];
        foreach ($tags as $tag) {
            $tags_name[] = $tag->name;
            $tagCount[] = $tag->posts->count();
        }

        $posts = Post::get();
        $followings = ['รับเรื่องร้องเรียน','กำลังดำเนินการ','ดำเนินการเสร็จสมบูรณ์'];
        $followingCount = [0,0,0];

        foreach ($posts as $post){
            if($post->following == $followings[0])
                $followingCount[0] +=1;
            else if($post->following == $followings[1])
                $followingCount[1] +=1;
            else if($post->following == $followings[2])
                $followingCount[2] +=1;
        }

        return view('charts.index',['tags_name'=>$tags_name,'tagCount' => $tagCount, 'followings'=>$followings, 'followingCount'=>$followingCount]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::where('name', $id)->firstOrFail();
        return view('tags.show', ['tag' => $tag]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}