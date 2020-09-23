<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Diary;
use App\Tag;

class DiaryTagController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a DiaryTag.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("diary.tag.create");
    }

    /**
     * Show the form for creating a DiaryTag.
     *
     * @param  \App\Diary  $diary
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Diary $diary, Request $request)
    {
        $tag = Tag::firstOrCreate([
            "name" => Str::title($request->input("tag")),
        ]);

        $diary->events()->attach($tag, $request->only([ "value" ]));
        $id = $diary->id;

        return redirect("/diary/$id");
    }
}
