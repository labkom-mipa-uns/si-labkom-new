<?php

namespace App\Http\Controllers\Admin\Alat;

use App\Models\Alat;
use App\Http\Controllers\Controller;
use App\Http\Requests\AlatRequest;
use App\Http\Resources\AlatResource;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class AlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return InertiaResponse
     */
    public function index(): InertiaResponse
    {
        return Inertia::render('Admin/Alat/Index', [
            'filters' => Request::all(['search', 'trashed']),
            'alat' => Alat::orderBy('created_at', 'desc')
                ->filter(Request::only(['search', 'trashed']))
                ->paginate()
                ->transform(function ($alat) {
                    return [
                        'id' => $alat->id,
                        'nama_alat' => $alat->nama_alat,
                        'harga_alat' => number_format($alat->harga_alat),
                        'stok_alat' => $alat->stok_alat,
                        'deleted_at' => $alat->deleted_at
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
        return Inertia::render('Admin/Alat/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AlatRequest $request
     * @return RedirectResponse
     */
    public function store(AlatRequest $request): ?RedirectResponse
    {
        try {
            Alat::create($request->validated());
            return Redirect::route('Alat.index')
                ->with([
                    'name' => 'Data Alat',
                    'success' => 'Berhasil Ditambahkan!'
                ]);
        } catch (Exception $exception) {
            return Redirect::route('Alat.index')
                ->with([
                    'name' => 'Data Alat',
                    'error' => "Gagal Ditambahkan! {$exception->getMessage()}"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Alat $Alat
     * @return AlatResource
     */
    public function show(Alat $Alat): AlatResource
    {
        return new AlatResource($Alat);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Alat $Alat
     * @return InertiaResponse
     */
    public function edit(Alat $Alat): InertiaResponse
    {
        return Inertia::render('Admin/Alat/Edit', [
            'alat' => [
                'id' => $Alat->id,
                'nama_alat' => $Alat->nama_alat,
                'harga_alat' => $Alat->harga_alat,
                'stok_alat' => $Alat->stok_alat,
                'deleted_at' => $Alat->deleted_at
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AlatRequest $request
     * @param Alat $Alat
     * @return RedirectResponse
     */
    public function update(AlatRequest $request, Alat $Alat): ?RedirectResponse
    {
        try {
            $Alat->update($request->validated());
            return Redirect::route('Alat.index')
                ->with([
                    'name' => 'Data Alat',
                    'success' => "Berhasil Diubah!"]);
        } catch (Exception $exception) {
            return Redirect::route('Alat.index')
                ->with([
                    'name' => 'Data Alat',
                    'error' => "Gagal Diubah! {$exception->getMessage()}"
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Alat $Alat
     * @return RedirectResponse
     */
    public function destroy(Alat $Alat): ?RedirectResponse
    {
        try {
            $this->authorize('delete-data');
            $Alat->delete();
            return Redirect::route('Alat.index')
                ->with([
                    'name' => 'Data Alat',
                    'success' => "Berhasil Dihapus!"
                ]);
        } catch (Exception $exception) {
            return Redirect::route('Alat.index')
                ->with([
                    'name' => 'Data Alat',
                    'error' => "Gagal Dihapus! {$exception->getMessage()}"
                ]);
        }
    }

    /**
     * @param Alat $Alat
     * @return RedirectResponse
     */
    public function restore(Alat $Alat): RedirectResponse
    {
        $Alat->restore();
        return Redirect::route('Alat.index')
            ->with([
                'name' => 'Data Alat',
                'success' => 'Berhasil Dipulihkan!',
            ]);
    }
}
