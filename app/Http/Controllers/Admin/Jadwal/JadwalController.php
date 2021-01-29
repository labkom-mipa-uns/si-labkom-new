<?php

namespace App\Http\Controllers\Admin\Jadwal;

use App\Models\Dosen;
use App\Http\Controllers\Controller;
use App\Http\Requests\JadwalRequest;
use App\Http\Resources\JadwalResource;
use App\Models\Jadwal;
use App\Models\MataKuliah;
use App\Models\Prodi;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Inertia\Response;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('Jadwal/Index', [
            'filters' => Request::all(['search', 'trashed']),
            'jadwal' => Jadwal::with(['prodi', 'dosen', 'matakuliah'])
                ->orderBy('created_at', 'desc')
                ->filter(Request::only(['search', 'trashed']))
                ->paginate()
                ->transform(function ($jadwal) {
                    return [
                        'id' => $jadwal->id,
                        'dosen' => $jadwal->dosen,
                        'matkul' => $jadwal->matakuliah,
                        'prodi' => $jadwal->prodi
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
        return Inertia::render('Jadwal/Create', [
            'dosen' => Dosen::orderBy('nama_dosen', 'asc')
                ->get()
                ->map
                ->only('id', 'nama_dosen'),
            'matkul' => MataKuliah::orderBy('nama_matkul', 'asc')
                ->get()
                ->map
                ->only('id', 'nama_matkul'),
            'prodi' => Prodi::orderBy('nama_prodi', 'asc')
                ->get()
                ->map
                ->only('id', 'nama_prodi')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param JadwalRequest $request
     * @return RedirectResponse
     */
    public function store(JadwalRequest $request): ?RedirectResponse
    {
        try {
            Jadwal::create($request->validated());
            return Redirect::route('Jadwal.index')
                ->with([
                    'name' => 'Jadwal',
                    'success' => 'Berhasil Ditambahkan!']);
        } catch (Exception $exception) {
            return Redirect::route('Jadwal.index')
                ->with([
                    'name' => 'Jadwal',
                    'error' => "Gagal Dihapus! {$exception->getMessage()}"
                ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Jadwal $Jadwal
     * @return JadwalResource
     */
    public function show(Jadwal $Jadwal): JadwalResource
    {
        return new JadwalResource($Jadwal::with(['prodi', 'dosen', 'matakuliah'])
            ->firstWhere('id',$Jadwal->id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Jadwal $Jadwal
     * @return Response
     */
    public function edit(Jadwal $Jadwal): Response
    {
        return Inertia::render('Jadwal/Edit', [
            'jadwal' => [
                'id' => $Jadwal->id,
                'id_dosen' => $Jadwal->id_dosen,
                'dosen' => $Jadwal->dosen,
                'id_matkul' => $Jadwal->id_matkul,
                'matkul' => $Jadwal->matkul,
                'id_prodi' => $Jadwal->id_prodi,
                'prodi' => $Jadwal->prodi
            ],
            'dosen' => Dosen::orderBy('nama_dosen', 'asc')
                ->get()
                ->map
                ->only('id', 'nama_dosen'),
            'matkul' => MataKuliah::orderBy('nama_matkul', 'asc')
                ->get()
                ->map
                ->only('id', 'nama_matkul'),
            'prodi' => Prodi::orderBy('nama_prodi', 'asc')
                ->get()
                ->map
                ->only('id', 'nama_prodi')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param JadwalRequest $request
     * @param Jadwal $Jadwal
     * @return RedirectResponse
     */
    public function update(JadwalRequest $request, Jadwal $Jadwal): ?RedirectResponse
    {
        try {
            $Jadwal->update($request->validated());
            return Redirect::route('Jadwal.index')
                ->with([
                    'name' => 'Jadwal',
                    'success' => 'Berhasil Diubah!'
                ]);
        } catch (Exception $exception) {
            return Redirect::route('Jadwal.index')
                ->with([
                    'name' => 'Jadwal',
                    'error' => "Gagal Diubah! {$exception->getMessage()}"
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Jadwal $Jadwal
     * @return RedirectResponse
     */
    public function destroy(Jadwal $Jadwal): ?RedirectResponse
    {
        try {
            $this->authorize('delete-data');
            $Jadwal->delete();
            return Redirect::route('Jadwal.index')
                ->with([
                    'name' => 'Jadwal',
                    'success' => 'Berhasil Dihapus!']);
        } catch (Exception $exception) {
            return Redirect::route('Jadwal.index')
                ->with([
                    'name' => 'Jadwal',
                    'error' => "Gagal Dihapus! {$exception->getMessage()}"
                ]);
        }
    }

    /**
     * @param Jadwal $Jadwal
     * @return RedirectResponse
     */
    public function restore(Jadwal $Jadwal): RedirectResponse
    {
        $Jadwal->restore();
        return Redirect::route('Jadwal.index')
            ->with([
                'name' => 'Jadwal',
                'success' => 'Berhasil Dipulihkan!',
            ]);
    }
}
