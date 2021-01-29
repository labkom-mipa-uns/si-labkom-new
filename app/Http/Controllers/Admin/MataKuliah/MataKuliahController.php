<?php

namespace App\Http\Controllers\Admin\MataKuliah;

use App\Http\Controllers\Controller;
use App\Http\Requests\MataKuliahRequest;
use App\Http\Resources\MataKuliahResource;
use App\Models\MataKuliah;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Inertia\Response;

class MataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('MataKuliah/Index', [
            'filters' => Request::all(['search', 'trashed']),
            'matkul' => MataKuliah::orderBy('created_at', 'desc')
                ->filter(Request::only(['search', 'trashed']))
                ->paginate()
                ->transform(function ($matkul) {
                    return [
                        'id' => $matkul->id,
                        'nama_matkul' => $matkul->nama_matkul,
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
        return Inertia::render('MataKuliah/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MataKuliahRequest $request
     * @return RedirectResponse
     */
    public function store(MataKuliahRequest $request): ?RedirectResponse
    {
        try {
            MataKuliah::create($request->validated());
            return Redirect::route('MataKuliah.index')
                ->with([
                    'name' => 'Mata Kuliah',
                    'success' => 'Berhasil Ditambahkan!'
                ]);
        } catch (Exception $exception) {
            return Redirect::route('MataKuliah.index')
                ->with([
                    'name' => 'Mata Kuliah',
                    'error' => "Gagal Ditambahkan! {$exception->getMessage()}"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param MataKuliah $MataKuliah
     * @return MataKuliahResource
     */
    public function show(MataKuliah $MataKuliah): MataKuliahResource
    {
        return new MataKuliahResource($MataKuliah);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param MataKuliah $MataKuliah
     * @return Response
     */
    public function edit(MataKuliah $MataKuliah): Response
    {
        return Inertia::render('MataKuliah/Edit', [
            'matkul' => [
                'id' => $MataKuliah->id,
                'nama_matkul' => $MataKuliah->nama_matkul,
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MataKuliahRequest $request
     * @param MataKuliah $MataKuliah
     * @return RedirectResponse
     */
    public function update(MataKuliahRequest $request, MataKuliah $MataKuliah): ?RedirectResponse
    {
        try {
            $MataKuliah->update($request->validated());
            return Redirect::route('MataKuliah.index')
                ->with([
                    'name' => 'Mata Kuliah',
                    'success' => "Berhasil Diubah!"]);
        } catch (Exception $exception) {
            return Redirect::route('MataKuliah.index')
                ->with([
                    'name' => 'Mata Kuliah',
                    'error' => "Gagal Diubah! {$exception->getMessage()}"
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param MataKuliah $MataKuliah
     * @return RedirectResponse
     */
    public function destroy(MataKuliah $MataKuliah): ?RedirectResponse
    {
        try {
            $this->authorize('delete-data');
            $MataKuliah->delete();
            return Redirect::route('MataKuliah.index')
                ->with([
                    'name' => 'Mata Kuliah',
                    'success' => "Berhasil Dihapus!"
                ]);
        } catch (Exception $exception) {
            return Redirect::route('MataKuliah.index')
                ->with([
                    'name' => 'Mata Kuliah',
                    'error' => "Gagal Dihapus! {$exception->getMessage()}"
                ]);
        }
    }

    /**
     * @param MataKuliah $MataKuliah
     * @return RedirectResponse
     */
    public function restore(MataKuliah $MataKuliah): RedirectResponse
    {
        $MataKuliah->restore();
        return Redirect::route('MataKuliah.index')
            ->with([
                'name' => 'Mata Kuliah',
                'success' => 'Berhasil Dipulihkan!'
            ]);
    }
}
