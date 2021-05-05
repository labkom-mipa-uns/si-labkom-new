<?php

namespace App\Http\Controllers\Admin\PeminjamanLab;

use App\Http\Controllers\Controller;
use App\Http\Requests\PeminjamanLabRequest;
use App\Http\Resources\PeminjamanLabResource;
use App\Models\Dosen;
use App\Models\Lab;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\PeminjamanLab;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use RuntimeException;

class PeminjamanLabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return InertiaResponse
     */
    public function index(): InertiaResponse
    {
        return Inertia::render('Admin/PeminjamanLab/Index', [
            'filters' => Request::all(['search', 'trashed']),
            'peminjamanlab' => PeminjamanLab::with(['mahasiswa', 'lab'])
                ->orderBy('created_at', 'desc')
                ->filter(Request::only(['search', 'trashed']))
                ->paginate()
                ->transform(function ($peminjamanlab) {
                    return [
                        'id' => $peminjamanlab->id,
                        'mahasiswa' => $peminjamanlab->mahasiswa,
                        'lab' => $peminjamanlab->lab,
                        'dosen' => $peminjamanlab->dosen,
                        'matakuliah' => $peminjamanlab->matakuliah,
                        'tanggal' => date("d M Y", strtotime($peminjamanlab->tanggal)),
                        'jam_pinjam' => date("H:i", strtotime($peminjamanlab->jam_pinjam)),
                        'jam_kembali' => date("H:i", strtotime($peminjamanlab->jam_kembali)),
                        'keperluan' => $peminjamanlab->keperluan,
                        'kategori' => $peminjamanlab->kategori,
                        'status' => $peminjamanlab->status,
                        'proses' => $peminjamanlab->proses,
                        'deleted_at' => $peminjamanlab->deleted_at
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
        return Inertia::render('Admin/PeminjamanLab/Create', [
            'mahasiswa' => Mahasiswa::orderBy('nama_mahasiswa', 'asc')
                ->get()
                ->map
                ->only('id', 'nama_mahasiswa'),
            'lab' => Lab::orderBy('nama_lab', 'asc')
                ->get()
                ->map
                ->only('id', 'nama_lab'),
            'dosen' => Dosen::orderBy('nama_dosen', 'asc')
                ->get()
                ->map
                ->only('id', 'nama_dosen'),
            'matakuliah' => MataKuliah::orderBy('nama_matkul', 'asc')
                ->get()
                ->map
                ->only('id', 'nama_matkul')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PeminjamanLabRequest $request
     * @return RedirectResponse|null
     */
    public function store(PeminjamanLabRequest $request): ?RedirectResponse
    {
        try {
//            if (PeminjamanLab::with(['mahasiswa', 'dosen', 'matakuliah'])
//                ->whereDate('tanggal', $request->tanggal)
//                ->whereTime('jam_kembali','>=', $request->jam_pinjam)
//                ->whereTime('jam_pinjam', '<=', $request->jam_kembali)
//                ->where('status', '==', '0')->get()
//            ) {
//                throw new RuntimeException('Lab Sedang Dipinjam!');
//            }
            PeminjamanLab::create($request->validated());
            return Redirect::route('PeminjamanLab.index')
                ->with([
                    'name' => 'Data Peminjam Lab',
                    'success' => 'Berhasil Ditambahkan!']);
        } catch (Exception $exception) {
            return Redirect::route('PeminjamanLab.index')
                ->with([
                    'name' => 'Data Peminjam Lab',
                    'error' => "Gagal Ditambahkan! {$exception->getMessage()}"
                ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param PeminjamanLab $PeminjamanLab
     * @return PeminjamanLabResource
     */
    public function show(PeminjamanLab $PeminjamanLab): PeminjamanLabResource
    {
        return new PeminjamanLabResource($PeminjamanLab::with(['mahasiswa', 'lab', 'jadwal'])
            ->firstWhere('id', $PeminjamanLab->id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param PeminjamanLab $PeminjamanLab
     * @return InertiaResponse
     */
    public function edit(PeminjamanLab $PeminjamanLab): InertiaResponse
    {
        return Inertia::render('Admin/PeminjamanLab/Edit', [
            'peminjamanlab' => [
                'id' => $PeminjamanLab->id,
                'id_mahasiswa' => $PeminjamanLab->id_mahasiswa,
                'mahasiswa' => $PeminjamanLab->mahasiswa,
                'id_lab' => $PeminjamanLab->id_lab,
                'lab' => $PeminjamanLab->lab,
                'id_dosen' => $PeminjamanLab->id_dosen,
                'dosen' => $PeminjamanLab->dosen,
                'id_matkul' => $PeminjamanLab->id_matkul,
                'matakuliah' => $PeminjamanLab->matakuliah,
                'tanggal' => $PeminjamanLab->tanggal,
                'jam_pinjam' => $PeminjamanLab->jam_pinjam,
                'jam_kembali' => $PeminjamanLab->jam_kembali,
                'keperluan' => $PeminjamanLab->keperluan,
                'kategori' => $PeminjamanLab->kategori,
                'proses' => $PeminjamanLab->proses,
                'status' => $PeminjamanLab->status,
                'deleted_at' => $PeminjamanLab->deleted_at
            ],
            'mahasiswa' => Mahasiswa::orderBy('nama_mahasiswa', 'asc')
                ->get()
                ->map
                ->only('id', 'nama_mahasiswa'),
            'lab' => Lab::orderBy('nama_lab', 'asc')
                ->get()
                ->map
                ->only('id', 'nama_lab'),
            'dosen' => Dosen::orderBy('nama_dosen', 'asc')
                ->get()
                ->map
                ->only('id', 'nama_dosen'),
            'matakuliah' => MataKuliah::orderBy('nama_matkul', 'asc')
                ->get()
                ->map
                ->only('id', 'nama_matkul')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PeminjamanLabRequest $request
     * @param PeminjamanLab $PeminjamanLab
     * @return RedirectResponse|null
     */
    public function update(PeminjamanLabRequest $request, PeminjamanLab $PeminjamanLab): ?RedirectResponse
    {
        try {
            $PeminjamanLab->update($request->validated());
            return Redirect::route('PeminjamanLab.index')
                ->with([
                    'name' => 'Data Peminjam Lab',
                    'success' => 'Berhasil Diubah!'
                ]);
        } catch (Exception $exception) {
            return Redirect::route('PeminjamanLab.index')
                ->with([
                    'name' => 'Data Peminjam Lab',
                    'error' => "Gagal Diubah! {$exception->getMessage()}"
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PeminjamanLab $PeminjamanLab
     * @return RedirectResponse
     */
    public function destroy(PeminjamanLab $PeminjamanLab): RedirectResponse
    {
        try {
            $this->authorize('delete-data');
            $PeminjamanLab->delete();
            return Redirect::route('PeminjamanLab.index')
                ->with([
                    'name' => 'Data Peminjam Lab',
                    'success' => 'Berhasil Dihapus!']);
        } catch (Exception $exception) {
            return Redirect::route('PeminjamanLab.index')
                ->with([
                    'name' => 'Data Peminjam Lab',
                    'error' => "Gagal Dihapus! {$exception->getMessage()}"
                ]);
        }
    }

    /**
     * @param PeminjamanLab $PeminjamanLab
     * @return RedirectResponse
     */
    public function restore(PeminjamanLab $PeminjamanLab): RedirectResponse
    {
        $PeminjamanLab->restore();
        return Redirect::route('PeminjamanLab.index')
            ->with([
                'name' => 'Data Peminjam Lab',
                'success' => 'Berhasil Dipulihkan!'
            ]);
    }
}
