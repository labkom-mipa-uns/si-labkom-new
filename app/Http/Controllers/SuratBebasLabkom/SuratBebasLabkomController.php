<?php

namespace App\Http\Controllers\SuratBebasLabkom;

use App\Http\Controllers\Controller;
use App\SuratBebasLabkom;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SuratBebasLabkomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View
    {
        return view('SuratBebasLabkom.index');
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
     * @param  \App\SuratBebasLabkom  $SuratBebasLabkom
     * @return \Illuminate\Http\Response
     */
    public function show(SuratBebasLabkom $SuratBebasLabkom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SuratBebasLabkom  $SuratBebasLabkom
     * @return \Illuminate\Http\Response
     */
    public function edit(SuratBebasLabkom $SuratBebasLabkom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SuratBebasLabkom  $SuratBebasLabkom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuratBebasLabkom $SuratBebasLabkom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SuratBebasLabkom  $SuratBebasLabkom
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratBebasLabkom $SuratBebasLabkom)
    {
        //
    }
}
