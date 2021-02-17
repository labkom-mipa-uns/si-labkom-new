<?php

namespace App\Http\Controllers\User\SuratBebasLabkom;

use App\Http\Controllers\Controller;
use App\Models\SuratBebasLabkom;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SuratBebasLabkomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('User.SuratBebasLabkom.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('User.SuratBebasLabkom.create');
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
     * @param  \App\Models\SuratBebasLabkom  $suratBebasLabkom
     * @return \Illuminate\Http\Response
     */
    public function show(SuratBebasLabkom $suratBebasLabkom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuratBebasLabkom  $suratBebasLabkom
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
     * @param  \App\Models\SuratBebasLabkom  $suratBebasLabkom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuratBebasLabkom $suratBebasLabkom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuratBebasLabkom  $suratBebasLabkom
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratBebasLabkom $suratBebasLabkom)
    {
        //
    }
}
