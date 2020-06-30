<?php

namespace App\Http\Controllers\PeminjamanAlat;

use App\Http\Controllers\Controller;
use App\PeminjamanAlat;
use Illuminate\Http\Request;

class PeminjamanAlatController extends Controller
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
     * @param  \App\PeminjamanAlat  $peminjamanAlat
     * @return \Illuminate\Http\Response
     */
    public function show(PeminjamanAlat $peminjamanAlat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PeminjamanAlat  $peminjamanAlat
     * @return \Illuminate\Http\Response
     */
    public function edit(PeminjamanAlat $peminjamanAlat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PeminjamanAlat  $peminjamanAlat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PeminjamanAlat $peminjamanAlat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PeminjamanAlat  $peminjamanAlat
     * @return \Illuminate\Http\Response
     */
    public function destroy(PeminjamanAlat $peminjamanAlat)
    {
        //
    }
}
