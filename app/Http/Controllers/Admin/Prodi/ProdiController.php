<?php

namespace App\Http\Controllers\Admin\Prodi;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProdiRequest;
use App\Http\Resources\ProdiResource;
use App\Models\Prodi;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return InertiaResponse
     */
    public function index(): InertiaResponse
    {
        return Inertia::render('Admin/Prodi/Index', [
            'filters' => Request::all(['search', 'trashed']),
            'prodi' => Prodi::orderBy('created_at', 'desc')
                ->filter(Request::only(['search', 'trashed']))
                ->paginate()
                ->transform(function ($prodi) {
                    return [
                        'id' => $prodi->id,
                        'nama_prodi' => $prodi->nama_prodi,
                        'deleted_at' => $prodi->deleted_at
                    ];
                })
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return InertiaResponse
     */
    public function create(): InertiaResponse
    {
        return Inertia::render('Admin/Prodi/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProdiRequest $request
     * @return RedirectResponse
     */
    public function store(ProdiRequest $request): RedirectResponse
    {
        try {
            Prodi::create($request->validated());
            return Redirect::route('Prodi.index')
                ->with([
                    'name' => 'Data Prodi',
                    'success' => 'Berhasil Ditambahkan!'
                ]);
        } catch (Exception $exception) {
            return Redirect::route('Prodi.index')
                ->with([
                    'name' => 'Data Prodi',
                    'error' => "Gagal Ditambahkan! {$exception->getMessage()}"]);
        }
    }

    /**
     * @param Prodi $Prodi
     * @return ProdiResource
     */
    public function show(Prodi $Prodi): ProdiResource
    {
        return new ProdiResource($Prodi);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Prodi $Prodi
     * @return InertiaResponse
     */
    public function edit(Prodi $Prodi): InertiaResponse
    {
        return Inertia::render('Admin/Prodi/Edit', [
            'prodi' => [
                'id' => $Prodi->id,
                'nama_prodi' => $Prodi->nama_prodi,
                'deleted_at' => $Prodi->deleted_at
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProdiRequest $request
     * @param Prodi $Prodi
     * @return RedirectResponse
     */
    public function update(ProdiRequest $request, Prodi $Prodi): ?RedirectResponse
    {
        try {
            $Prodi->update($request->validated());
            return Redirect::route('Prodi.index')
                ->with([
                    'name' => 'Data Prodi',
                    'success' => "Berhasil Diubah!"]);
        } catch (Exception $exception) {
            return Redirect::route('Prodi.index')
                ->with([
                    'name' => 'Data Prodi',
                    'error' => "Gagal Diubah! {$exception->getMessage()}"
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Prodi $Prodi
     * @return RedirectResponse
     */
    public function destroy(Prodi $Prodi): ?RedirectResponse
    {
        try {
            $this->authorize('delete-data');
            $Prodi->delete();
            return Redirect::route('Prodi.index')
                ->with([
                    'name' => 'Data Prodi',
                    'success' => "Berhasil Dihapus!"
                ]);
        } catch (Exception $exception) {
            return Redirect::route('Prodi.index')
                ->with([
                    'name' => 'Data Prodi',
                    'error' => "Gagal Dihapus! {$exception->getMessage()}"
                ]);
        }
    }

    /**
     * @param Prodi $Prodi
     * @return RedirectResponse
     */
    public function restore(Prodi $Prodi): RedirectResponse
    {
        $Prodi->restore();
        return Redirect::route('Prodi.index')
            ->with([
                'name' => 'Data Prodi',
                'success' => 'Berhasil Dipulihkan!',
            ]);
    }
}
