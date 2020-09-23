<?php

namespace App\Http\Controllers;

use App\Diary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiaryController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $diaries = $user->diaries;

        \Debugbar::info("Found {$diaries->count()}");

        return view('diary.index', [
            'diaries' => $diaries,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("diary.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $diary = Diary::create($request->only([ "name" ]));
        $diary->save();
        $id = $diary->id;

        $user = Auth::user();
        $user->diaries()->attach($id);

        return redirect("/diary/$id");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Diary  $diary
     * @return \Illuminate\Http\Response
     */
    public function show(Diary $diary)
    {
        if (! $diary->users->contains(Auth::user())) {
            return abort(404);
        }

        return view("diary.show", [
            "diary" => $diary
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Diary  $diary
     * @return \Illuminate\Http\Response
     */
    public function edit(Diary $diary)
    {
        if (! $diary->users->contains(Auth::user())) {
            return abort(404);
        }

        return view("diary.edit", [
            "diary" => $diary,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Diary  $diary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Diary $diary)
    {
        if (! $diary->users->contains(Auth::user())) {
            return abort(404);
        }

        $diary->fill($request->only([ "name" ]));
        $diary->save();
        $id = $diary->id;

        return redirect("/diary/$id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Diary  $diary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diary $diary)
    {
        if (! $diary->users->contains(Auth::user())) {
            return abort(404);
        }

        $diary->delete();

        return redirect("/diary");
    }
}
