<?php

namespace App\Http\Controllers\Admin\Lab;

use App\Http\Controllers\Controller;
use App\Http\Requests\LabRequest;
use App\Http\Resources\LabResource;
use App\Models\Lab;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Inertia\Response;

class LabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('Lab/Index', [
            'filters' => Request::all(['search', 'trashed']),
            'lab' => Lab::orderBy('created_at', 'desc')
                ->filter(Request::only(['search', 'trashed']))
                ->paginate()
                ->transform(function ($lab) {
                    return [
                        'id' => $lab->id,
                        'nama_lab' => $lab->nama_lab
                    ];
                })
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Lab/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LabRequest $request
     * @return RedirectResponse
     */
    public function store(LabRequest $request): ?RedirectResponse
    {
        try {
            Lab::create($request->validated());
            return Redirect::route('Laboratorium.index')
                ->with([
                    'name' => 'Data Laboratorium',
                    'success' => 'Berhasil Ditambahkan!'
                ]);
        } catch (Exception $exception) {
            return Redirect::route('Laboratorium.index')
                ->with([
                    'name' => 'Data Laboratorium',
                    'error' => "Gagal Ditambahkan! {$exception->getMessage()}"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Lab $Laboratorium
     * @return LabResource
     */
    public function show(Lab $Laboratorium): LabResource
    {
        return new LabResource($Laboratorium);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Lab $Laboratorium
     * @return Response
     */
    public function edit(Lab $Laboratorium): Response
    {
        return Inertia::render('Lab/Edit', [
            'lab' => [
                'id' => $Laboratorium->id,
                'nama_lab' => $Laboratorium->nama_lab,
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LabRequest $request
     * @param Lab $Laboratorium
     * @return RedirectResponse
     */
    public function update(LabRequest $request, Lab $Laboratorium): ?RedirectResponse
    {
        try {
            $Laboratorium->update($request->validated());
            return Redirect::route('Laboratorium.index')
                ->with([
                    'name' => 'Data Laboratorium',
                    'success' => "Berhasil Diubah!"
                ]);
        } catch (Exception $exception) {
            return Redirect::route('Laboratorium.index')
                ->with([
                    'name' => 'Data Laboratorium',
                    'error' => "Gagal Diubah! {$exception->getMessage()}"
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Lab $Laboratorium
     * @return RedirectResponse
     */
    public function destroy(Lab $Laboratorium): RedirectResponse
    {
        try {
            $this->authorize('delete-data');
            $Laboratorium->delete();
            return Redirect::route('Laboratorium.index')
                ->with([
                    'name' => 'Data Laboratorium',
                    'success' => 'Berhasil Dihapus!']);
        } catch (Exception $exception) {
            return Redirect::route("Laboratorium.index")
                ->with([
                    'name' => 'Data Laboratorium',
                    'error' => "Gagal Dihapus! {$exception->getMessage()}"
                ]);
        }
    }

    /**
     * @param Lab $Laboratorium
     * @return RedirectResponse
     */
    public function restore(Lab $Laboratorium): RedirectResponse
    {
        $Laboratorium->restore();
        return Redirect::route('Laboratorium.index')
            ->with([
                'name' => 'Data Laboratorium',
                'success' => 'Berhasil Dipulihkan!']
            );
    }
}
