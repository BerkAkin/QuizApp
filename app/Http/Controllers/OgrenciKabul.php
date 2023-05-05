<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ogrenci;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class OgrenciKabul extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $onaylar = DB::table('users')->join('ogrencis', function ($join) {
            $join->on('users.id', '=', 'ogrencis.ogrenci_id')->where('ogrencis.ogretmen_id', '=', auth()->user()->id);
        })->get();
        return view('admin.ogrenciKabul.ogrenciKabul', compact('onaylar'));
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
        User::where('id', $id)->update(['ogretmen_id' => auth()->user()->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ogrenci = ogrenci::find($id);
        $ogrenci->delete();
    }

}