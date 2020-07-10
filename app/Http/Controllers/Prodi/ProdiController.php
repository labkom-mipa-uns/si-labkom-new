<?php

namespace App\Http\Controllers\Prodi;

use App\Http\Controllers\Controller;
use App\Prodi;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View
    {
        $data = [
            'Prodi' => Prodi::all(),
        ];
        return view('Prodi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View
    {
        return view('Prodi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        Prodi::create($request->all());
        return redirect()->route('Prodi.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Prodi $Prodi
     * @return Application|Factory|View
     */
    public function edit(Prodi $Prodi): View
    {
        $data = [
            'Prodi' => $Prodi
        ];
        return view('Prodi.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
