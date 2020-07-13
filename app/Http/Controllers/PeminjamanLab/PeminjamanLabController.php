<?php

namespace App\Http\Controllers\PeminjamanLab;

use App\Http\Controllers\Controller;
use App\Http\Resources\PeminjamanLabResource;
use App\Jadwal;
use App\Lab;
use App\Mahasiswa;
use App\PeminjamanLab;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PeminjamanLabController extends Controller
{
    /**
     * PeminjamanLabController constructor.
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
                'PeminjamanLab' => PeminjamanLab::with(['mahasiswa', 'lab','jadwal'])->get(),
            ];
            return view('PeminjamanLab.index', $data);
        } catch (Exception $exception) {
            return redirect()->route('home')->with('warning', "Silakan Coba Beberapa Saat Lagi! Problem: {$exception->getMessage()}");
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
                'Mahasiswa' => Mahasiswa::all(),
                'Jadwal' => Jadwal::with(['prodi','dosen','matakuliah'])->get(),
                'Lab' => Lab::all()
            ];
            return view('PeminjamanLab.create', $data);
        } catch (Exception $exception) {
            return redirect()->route('PeminjamanLab.index')->with('warning', "Silakan Coba Beberapa Saat Lagi! Problem: {$exception->getMessage()}");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_mahasiswa' => 'required',
            'id_lab' => 'required',
            'id_jadwal' => 'required',
            'tanggal' => 'required|date',
            'jam_pinjam' => 'required',
            'jam_kembali' => 'required',
            'keperluan' => 'required|string',
            'kategori' => 'required|string',
            'status' => 'required|string',
        ]);
        try {
            PeminjamanLab::create($request->all());
            return redirect()->route('PeminjamanLab.index')->with('success', 'Berhasil Ditambahkan!');
        } catch (Exception $exception) {
            return redirect()->route('PeminjamanLab.create')->with('danger', "Gagal Ditambahkan! Error: {$exception->getMessage()}");
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
        return new PeminjamanLabResource($PeminjamanLab::with(['mahasiswa', 'lab', 'jadwal'])->firstWhere('id', $PeminjamanLab->id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param PeminjamanLab $PeminjamanLab
     * @return Application|Factory|RedirectResponse|View
     */
    public function edit(PeminjamanLab $PeminjamanLab)
    {
        try {
            $data = [
                'PeminjamanLab' => $PeminjamanLab::with(['mahasiswa','lab','jadwal'])->firstWhere('id',$PeminjamanLab->id),
                'Mahasiswa' => Mahasiswa::all(),
                'Jadwal' => Jadwal::with(['prodi','dosen','matakuliah'])->get(),
                'Lab' => Lab::all()
            ];
            return view('PeminjamanLab.edit', $data);
        } catch (Exception $exception) {
            return redirect()->route('PeminjamanLab.index')->with('warning', "Silakan Coba Beberapa Saat Lagi! Problem: {$exception->getMessage()}");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param PeminjamanLab $PeminjamanLab
     * @return RedirectResponse
     */
    public function update(Request $request, PeminjamanLab $PeminjamanLab): RedirectResponse
    {
        try {
            PeminjamanLab::whereId($PeminjamanLab->id)->update($request->except(['_token', '_method']));
            return redirect()->route('PeminjamanLab.index')->with('success',"Berhasil Diupdate!");
        } catch (Exception $exception) {
            return redirect()->route('PeminjamanLab.index')->with('danger',"Gagal Diupdate! Error: {$exception->getMessage()}");
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
            PeminjamanLab::destroy($PeminjamanLab->id);
            return redirect()->route('PeminjamanLab.index')->with('success', 'Berhasil Dihapus!');
        } catch (Exception $exception) {
            return redirect()->route('PeminjamanLab.index')->with('danger',"Gagal dihapus! Error: {$exception->getMessage()}");
        }
    }
}
