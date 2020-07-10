<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Mahasiswa;
use App\Prodi;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View
    {
        $data = [
            'Mahasiswa' => Mahasiswa::all(),
        ];
        return view('Mahasiswa.index', $data);
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
        ];
        return view('Mahasiswa.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        Mahasiswa::create($request->all());
        return redirect()->route('Mahasiswa.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Mahasiswa $Mahasiswa
     * @return Application|Factory|View
     */
    public function edit(Mahasiswa $Mahasiswa)
    {
        $data = [
            'Mahasiswa' => $Mahasiswa,
        ];
        return view('Mahasiswa.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        //
    }
}
