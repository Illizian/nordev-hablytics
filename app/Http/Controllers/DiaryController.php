<?php

namespace App\Http\Controllers;

use App\Diary;
use App\Http\Requests\CreateDiaryRequest;
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
        $this->authorizeResource(Diary::class, 'diary');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('diary.index', [
            'diaries' => Auth::user()->diaries,
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
     * @param  \App\Http\Requests\CreateDiaryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDiaryRequest $request)
    {
        $diary = Diary::create($request->only([ "name" ]));
        Auth::user()->diaries()->attach($diary);

        return redirect()->route('diary.show', [
            'diary' => $diary->id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Diary  $diary
     * @return \Illuminate\Http\Response
     */
    public function show(Diary $diary)
    {
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
        return view("diary.edit", [
            "diary" => $diary,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CreateDiaryRequest  $request
     * @param  \App\Diary  $diary
     * @return \Illuminate\Http\Response
     */
    public function update(CreateDiaryRequest $request, Diary $diary)
    {
        $diary->fill($request->only([ "name" ]));
        $diary->save();

        return redirect()->route('diary.show', [
            'diary' => $diary->id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Diary  $diary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diary $diary)
    {
        $diary->delete();

        return redirect()->route('diary.index');
    }
}
