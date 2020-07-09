<?php

namespace App\Http\Controllers\PeminjamanLab;

use App\Http\Controllers\Controller;
use App\Jadwal;
use App\Lab;
use App\Mahasiswa;
use App\PeminjamanLab;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
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
        $data = [
            'PeminjamanLab' => PeminjamanLab::all(),
        ];
        return view('PeminjamanLab.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View
    {
        $data = [
            'Mahasiswa' => Mahasiswa::all(),
            'Jadwal' => Jadwal::all(),
            'Lab' => Lab::all()
        ];
        return view('PeminjamanLab.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        PeminjamanLab::create($request->all());
        return redirect()->route('PeminjamanLab.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param PeminjamanLab $PeminjamanLab
     * @return Application|Factory|View
     */
    public function edit(PeminjamanLab $PeminjamanLab): View
    {
        $data = [
            'PeminjamanLab' => $PeminjamanLab,
        ];
        return view('PeminjamanLab.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param PeminjamanLab $PeminjamanLab
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PeminjamanLab $PeminjamanLab)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PeminjamanLab $PeminjamanLab
     * @return RedirectResponse
     */
    public function destroy(PeminjamanLab $PeminjamanLab): RedirectResponse
    {
        PeminjamanLab::destroy($PeminjamanLab->id);
        return redirect()->route('PeminjamanLab.index');
    }
}
