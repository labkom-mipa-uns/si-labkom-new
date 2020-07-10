<?php

namespace App\Http\Controllers\Lab;

use App\Http\Controllers\Controller;
use App\Lab;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View
    {
        $data = [
            'Laboratorium' => Lab::all(),
        ];
        return view('Lab.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View
    {
        return view('Lab.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        Lab::create($request->all());
        return redirect()->route('Lab.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Lab $Lab
     * @return Application|Factory|View
     */
    public function edit(Lab $Lab)
    {
        $data = [
            'Lab' => $Lab
        ];
        return view('Lab.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Lab  $lab
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lab $lab)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Lab $Lab
     * @return RedirectResponse
     */
    public function destroy(Lab $Lab): RedirectResponse
    {
        Lab::destroy($Lab->id);
        return redirect()->route('Laboratorium.index');
    }
}
