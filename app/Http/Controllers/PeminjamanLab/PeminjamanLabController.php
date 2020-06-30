<?php

namespace App\Http\Controllers\PeminjamanLab;

use App\Http\Controllers\Controller;
use App\PeminjamanLab;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PeminjamanLabController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View
    {
        return view('PeminjamanLab.index');
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
     * @param  \App\PeminjamanLab  $PeminjamanLab
     * @return \Illuminate\Http\Response
     */
    public function show(PeminjamanLab $PeminjamanLab)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PeminjamanLab  $PeminjamanLab
     * @return \Illuminate\Http\Response
     */
    public function edit(PeminjamanLab $PeminjamanLab)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PeminjamanLab  $PeminjamanLab
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PeminjamanLab $PeminjamanLab)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PeminjamanLab  $PeminjamanLab
     * @return \Illuminate\Http\Response
     */
    public function destroy(PeminjamanLab $PeminjamanLab)
    {
        //
    }
}
