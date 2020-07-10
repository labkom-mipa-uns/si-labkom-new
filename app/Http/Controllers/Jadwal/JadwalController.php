<?php

namespace App\Http\Controllers\Jadwal;

use App\Dosen;
use App\Http\Controllers\Controller;
use App\Jadwal;
use App\MataKuliah;
use App\Prodi;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View
    {
        $data = [
            'Jadwal' => Jadwal::all()
        ];
        return view('Jadwal.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View
    {
        $data = [
            'Prodi' => Prodi::all(),
            'Dosen' => Dosen::all(),
            'MataKuliah' => MataKuliah::all(),
        ];
        return view('Jadwal.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        Jadwal::create($request->all());
        return redirect()->route('Jadwal.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Jadwal $jadwal
     * @return \Illuminate\Http\Response
     */
    public function show(Jadwal $Jadwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Jadwal $jadwal
     * @return \Illuminate\Http\Response
     */
    public function edit(Jadwal $jadwal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Jadwal $jadwal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Jadwal $jadwal
     * @return RedirectResponse
     */
    public function destroy(Jadwal $Jadwal): RedirectResponse
    {
        Jadwal::destroy($Jadwal->id);
        return redirect()->route('Jadwal.index');
    }
}
