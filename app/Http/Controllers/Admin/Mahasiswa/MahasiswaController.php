<?php

namespace App\Http\Controllers\Admin\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Http\Requests\MahasiswaRequest;
use App\Http\Resources\MahasiswaResource;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return InertiaResponse
     */
    public function index(): InertiaResponse
    {
        return Inertia::render('Admin/Mahasiswa/Index', [
            'filters' => Request::all(['search', 'trashed']),
            'mahasiswa' => Mahasiswa::with(['prodi'])
                ->orderBy('created_at', 'desc')
                ->filter(Request::only(['search', 'trashed']))
                ->paginate()
                ->transform(function ($mahasiswa) {
                    return [
                        'id' => $mahasiswa->id,
                        'nama' => $mahasiswa->nama_mahasiswa,
                        'nim' => $mahasiswa->nim,
                        'jenis_kelamin' => $mahasiswa->jenis_kelamin,
                        'kelas' => $mahasiswa->kelas,
                        'prodi' => $mahasiswa->prodi,
                        'angkatan' => $mahasiswa->angkatan,
                        'no_hp' => $mahasiswa->no_hp,
                        'email' => $mahasiswa->email,
                        'deleted_at' => $mahasiswa->deleted_at
                    ];
                })
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return InertiaResponse
     */
    public function create(): InertiaResponse
    {
        return Inertia::render('Admin/Mahasiswa/Create', [
            'prodi' => Prodi::orderBy('nama_prodi', 'asc')
                ->get()
                ->map
                ->only('id', 'nama_prodi')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MahasiswaRequest $request
     * @return RedirectResponse
     */
    public function store(MahasiswaRequest $request): ?RedirectResponse
    {
        try {
            Mahasiswa::create($request->validated());
            return Redirect::route('Mahasiswa.index')
                ->with([
                    'name' => 'Data Mahasiswa',
                    'success' => 'Berhasil Ditambahkan!']);
        } catch (Exception $exception) {
            return Redirect::route('Mahasiswa.index')
                ->with([
                    'name' => 'Data Mahasiswa',
                    'error' => "Gagal Ditambahkan! {$exception->getMessage()}"
                ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Mahasiswa $Mahasiswa
     * @return MahasiswaResource
     */
    public function show(Mahasiswa $Mahasiswa): MahasiswaResource
    {
        return new MahasiswaResource($Mahasiswa::with(['prodi'])
            ->firstWhere('id', $Mahasiswa->id));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Mahasiswa $Mahasiswa
     * @return InertiaResponse
     */
    public function edit(Mahasiswa $Mahasiswa): InertiaResponse
    {
        return Inertia::render('Admin/Mahasiswa/Edit', [
            'mahasiswa' => [
                'id' => $Mahasiswa->id,
                'nama_mahasiswa' => $Mahasiswa->nama_mahasiswa,
                'nim' => $Mahasiswa->nim,
                'jenis_kelamin' => $Mahasiswa->jenis_kelamin,
                'kelas' => $Mahasiswa->kelas,
                'id_prodi' => $Mahasiswa->id_prodi,
                'prodi' => $Mahasiswa->prodi,
                'angkatan' => $Mahasiswa->angkatan,
                'no_hp' => $Mahasiswa->no_hp,
                'email' => $Mahasiswa->email,
                'deleted_at' => $Mahasiswa->deleted_at
            ],
            'prodi' => Prodi::orderBy('nama_prodi', 'asc')
                ->get()
                ->map
                ->only('id', 'nama_prodi')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MahasiswaRequest $request
     * @param Mahasiswa $Mahasiswa
     * @return RedirectResponse
     */
    public function update(MahasiswaRequest $request, Mahasiswa $Mahasiswa): ?RedirectResponse
    {
        try {
            $Mahasiswa->update($request->validated());
            return Redirect::route('Mahasiswa.index')
                ->with([
                    'name' => 'Data Mahasiswa',
                    'success' => 'Berhasil Diubah!'
                ]);
        } catch (Exception $exception) {
            return Redirect::route('Mahasiswa.index')
                ->with([
                    'name' => 'Data Mahasiswa',
                    'error' => "Gagal Diubah! {$exception->getMessage()}"
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Mahasiswa $Mahasiswa
     * @return RedirectResponse
     */
    public function destroy(Mahasiswa $Mahasiswa): ?RedirectResponse
    {
        try {
            $this->authorize('delete-data');
            $Mahasiswa->delete();
            return Redirect::route('Mahasiswa.index')
                ->with([
                    'name' => 'Data Mahasiswa',
                    'success' => 'Berhasil Dihapus!']);
        } catch (Exception $exception) {
            return Redirect::route('Mahasiswa.index')
                ->with([
                    'name' => 'Data Mahasiswa',
                    'error' => "Gagal Dihapus! {$exception->getMessage()}"
                ]);
        }
    }

    /**
     * @param Mahasiswa $Mahasiswa
     * @return RedirectResponse
     */
    public function restore(Mahasiswa $Mahasiswa): RedirectResponse
    {
        $Mahasiswa->restore();
        return Redirect::route('Mahasiswa.index')
            ->with([
                'name' => 'Data Mahasiswa',
                'success' => 'Berhasil Dipulihkan!'
            ]);
    }
}
