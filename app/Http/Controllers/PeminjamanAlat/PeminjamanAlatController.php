<?php

namespace App\Http\Controllers\PeminjamanAlat;

use App\Http\Controllers\Controller;
use App\PeminjamanAlat;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PeminjamanAlatController extends Controller
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
        return view('PeminjamanAlat.index');
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
     * @param  \App\PeminjamanAlat  $PeminjamanAlat
     * @return \Illuminate\Http\Response
     */
    public function show(PeminjamanAlat $PeminjamanAlat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PeminjamanAlat  $PeminjamanAlat
     * @return \Illuminate\Http\Response
     */
    public function edit(PeminjamanAlat $PeminjamanAlat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PeminjamanAlat  $PeminjamanAlat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PeminjamanAlat $PeminjamanAlat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PeminjamanAlat  $PeminjamanAlat
     * @return \Illuminate\Http\Response
     */
    public function destroy(PeminjamanAlat $PeminjamanAlat)
    {
        //
    }
}
