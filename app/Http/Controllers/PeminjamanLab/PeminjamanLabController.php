<?php

namespace App\Http\Controllers\PeminjamanLab;

use App\Http\Controllers\Controller;
use App\PeminjamanLab;
use Illuminate\Http\Request;

class PeminjamanLabController extends Controller
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
     * @param  \App\PeminjamanLab  $peminjamanLab
     * @return \Illuminate\Http\Response
     */
    public function show(PeminjamanLab $peminjamanLab)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PeminjamanLab  $peminjamanLab
     * @return \Illuminate\Http\Response
     */
    public function edit(PeminjamanLab $peminjamanLab)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PeminjamanLab  $peminjamanLab
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PeminjamanLab $peminjamanLab)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PeminjamanLab  $peminjamanLab
     * @return \Illuminate\Http\Response
     */
    public function destroy(PeminjamanLab $peminjamanLab)
    {
        //
    }
}
