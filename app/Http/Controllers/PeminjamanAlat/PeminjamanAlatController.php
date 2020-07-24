<?php

namespace App\Http\Controllers\PeminjamanAlat;

use App\Alat;
use App\Http\Controllers\Controller;
use App\Http\Resources\PeminjamanAlatResource;
use App\Mahasiswa;
use App\PeminjamanAlat;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class PeminjamanAlatController extends Controller
{
    /**
     * PeminjamanAlatController constructor.
     */
    public function __construct()
    {
        $this->middleware('verified');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|RedirectResponse|View
     */
    public function index()
    {
        try {
            $data = [
                'PeminjamanAlat' => PeminjamanAlat::with(['alat','mahasiswa'])->orderBy('created_at', 'desc')->paginate(8)
            ];
            return view('PeminjamanAlat.index', $data);
        } catch (Exception $exception) {
            return redirect()->home()->with('warning', "Silakan Coba Beberapa Saat Lagi! Problem: {$exception->getMessage()}");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|RedirectResponse|View
     */
    public function create()
    {
        try {
            $data = [
                'Mahasiswa' => Mahasiswa::orderBy('nama_mahasiswa', 'asc')->get(),
                'Alat' => Alat::orderBy('nama_alat', 'asc')->get()
            ];
            return view('PeminjamanAlat.create', $data);
        } catch (Exception $exception) {
            return redirect()->route('PeminjamanAlat.index')->with('warning', "Silakan Coba Beberapa Saat Lagi! Problem: {$exception->getMessage()}");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): ?RedirectResponse
    {
        $request->validate([
            'id_mahasiswa' => 'required',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date',
            'id_alat' => 'required',
            'keperluan' => 'required|string',
            'status' => 'required'
        ]);
        try {
            PeminjamanAlat::create($request->all());
            return redirect()->route('PeminjamanAlat.index')->with('success', "Berhasil Ditambahkan!");
        } catch (Exception $exception) {
            return redirect()->route('PeminjamanAlat.index')->with('danger', "Gagal Ditambahkan! Error: {$exception->getMessage()}");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param PeminjamanAlat $PeminjamanAlat
     * @return PeminjamanAlatResource
     */
    public function show(PeminjamanAlat $PeminjamanAlat): PeminjamanAlatResource
    {
        return new PeminjamanAlatResource($PeminjamanAlat::with(['mahasiswa','alat'])->firstWhere('id',$PeminjamanAlat->id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param PeminjamanAlat $PeminjamanAlat
     * @return Application|Factory|RedirectResponse|Response|View
     */
    public function edit(PeminjamanAlat $PeminjamanAlat)
    {
        try {
            $data = [
                'PeminjamanAlat' => $PeminjamanAlat::with(['alat','mahasiswa'])->firstWhere('id',$PeminjamanAlat->id),
                'Mahasiswa' => Mahasiswa::orderBy('nama_mahasiswa', 'asc')->get(),
                'Alat' => Alat::orderBy('nama_alat', 'asc')->get()
            ];
            return view('PeminjamanAlat.edit', $data);
        } catch (Exception $exception) {
            return redirect()->route('PeminjamanAlat.index')->with('warning', "Silakan Coba Beberapa Saat Lagi! Problem: {$exception->getMessage()}");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param PeminjamanAlat $PeminjamanAlat
     * @return RedirectResponse
     */
    public function update(Request $request, PeminjamanAlat $PeminjamanAlat): ?RedirectResponse
    {
        $request->validate([
            'id_mahasiswa' => 'required',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date',
            'id_alat' => 'required',
            'keperluan' => 'required|string',
            'status' => 'required'
        ]);
        try {
            PeminjamanAlat::whereId($PeminjamanAlat->id)->update($request->except(['_method','_token']));
            return redirect()->route('PeminjamanAlat.index')->with('success', "Berhasil Diupdate!");
        } catch (Exception $exception) {
            return redirect()->route('PeminjamanAlat.index')->with('danger', "Gagal Diupdate! Error: {$exception->getMessage()}");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PeminjamanAlat $PeminjamanAlat
     * @return RedirectResponse
     */
    public function destroy(PeminjamanAlat $PeminjamanAlat): ?RedirectResponse
    {
        try {
            Gate::authorize('delete-data');
            PeminjamanAlat::destroy($PeminjamanAlat->id);
            return redirect()->route('PeminjamanAlat.index')->with('success', "Berhasil Dihapus!");
        } catch (Exception $exception) {
            return redirect()->route('PeminjamanAlat.index')->with('danger', "Gagal Dihapus! Error: {$exception->getMessage()}");
        }
    }
}
