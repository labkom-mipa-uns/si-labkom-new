<?php

namespace App\Http\Controllers\Dosen;

use App\Dosen;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View
    {
        $data = [
            'Dosen' => Dosen::all(),
        ];
        return view('Dosen.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View
    {
        return view('Dosen.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        Dosen::create($request->all());
        return redirect()->route('Dosen.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Dosen $Dosen
     * @return Application|Factory|View
     */
    public function edit(Dosen $Dosen): View
    {
        $data = [
            'Dosen' => $Dosen
        ];
        return view('Dosen.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dosen $dosen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Dosen $Dosen
     * @return RedirectResponse
     */
    public function destroy(Dosen $Dosen): RedirectResponse
    {
        Dosen::destroy($Dosen->id);
        return redirect()->route('Dosen.index');
    }
}
