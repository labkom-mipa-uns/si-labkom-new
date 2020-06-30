<?php

namespace App\Http\Controllers\SuratBebasLabkom;

use App\Http\Controllers\Controller;
use App\SuratBebasLabkom;
use Illuminate\Http\Request;

class SuratBebasLabkomController extends Controller
{
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
        //
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
     * @param  \App\SuratBebasLabkom  $suratBebasLabkom
     * @return \Illuminate\Http\Response
     */
    public function show(SuratBebasLabkom $suratBebasLabkom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SuratBebasLabkom  $suratBebasLabkom
     * @return \Illuminate\Http\Response
     */
    public function edit(SuratBebasLabkom $suratBebasLabkom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SuratBebasLabkom  $suratBebasLabkom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuratBebasLabkom $suratBebasLabkom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SuratBebasLabkom  $suratBebasLabkom
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratBebasLabkom $suratBebasLabkom)
    {
        //
    }
}
