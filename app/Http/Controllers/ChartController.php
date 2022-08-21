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
//        $data = Post::select('id','created_at')
//                ->get()->groupBy(function ($data){
//                    return Carbon::parse($data->created_at)->format('M');
//            });
//
//        $months = [];
//        $monthCount = [];
//
//        foreach ($data as $month => $values){
//            $months[] = $month;
//            $monthCount = count($values);
//        }
        $data = Post::select('id','created_at')
            ->get()->groupBy(function ($data){
                return Carbon::parse($data->created_at)->format('Y');
            });

        $days = [];
        $dayCount = [];

        foreach ($data as $day => $values){
            $days[] = $day;
            $dayCount = count($values);
        }

        return view('charts.index',['data'=>$data, 'days'=>$days, 'dayCount'=>$dayCount]);

//        return view('charts.index',['data'=>$data, 'months'=>$months, 'monthCount'=>$monthCount]);
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
