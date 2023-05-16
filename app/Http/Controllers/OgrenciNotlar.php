<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Quiz;
use App\Models\Result;
use Illuminate\Support\Facades\DB;

class OgrenciNotlar extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notlar = DB::table('results')
            ->join('users', function ($join) {
                $join->on('results.user_id', '=', 'users.id')->where('users.type', '=', 'user')->where('users.ogretmen_id', '=', auth()->user()->id);
            })
            ->join('quizzes', function ($join) {
                $join->on('quizzes.id', '=', 'results.quiz_id');
            })
            ->get(['name', 'title', 'score', 'email', 'profile_photo_path', 'correct', 'wrong', 'gereken_min_not']);
        return view('admin.ogrenciNot.ogrenciNot', compact('notlar'));
        return $notlar;
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