<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\TransaksiPeminjamanAlat;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TransaksiPeminjamanAlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('Transaksi.peminjamanalat');
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
     * @param  \App\TransaksiPeminjamanAlat  $transaksiPeminjamanAlat
     * @return \Illuminate\Http\Response
     */
    public function show(TransaksiPeminjamanAlat $transaksiPeminjamanAlat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TransaksiPeminjamanAlat  $transaksiPeminjamanAlat
     * @return \Illuminate\Http\Response
     */
    public function edit(TransaksiPeminjamanAlat $transaksiPeminjamanAlat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TransaksiPeminjamanAlat  $transaksiPeminjamanAlat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransaksiPeminjamanAlat $transaksiPeminjamanAlat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TransaksiPeminjamanAlat  $transaksiPeminjamanAlat
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransaksiPeminjamanAlat $transaksiPeminjamanAlat)
    {
        //
    }
}
