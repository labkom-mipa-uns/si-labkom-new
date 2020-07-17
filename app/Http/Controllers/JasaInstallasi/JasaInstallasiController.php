<?php

namespace App\Http\Controllers\JasaInstallasi;

use App\Http\Controllers\Controller;
use App\Http\Resources\JasaInstallasiResource;
use App\JasaInstallasi;
use App\Mahasiswa;
use App\Software;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class JasaInstallasiController extends Controller
{
    /**
     * JasaInstallasiController constructor.
     */
    public function __construct()
    {
        $this->middleware('verified');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|RedirectResponse|Response|View
     */
    public function index()
    {
        try {
            $data = [
                'JasaInstallasi' => JasaInstallasi::with(['mahasiswa', 'software'])->get()
            ];
            return view('JasaInstallasi.index', $data);
        } catch (Exception $exception) {
            return redirect()->home()->with('warning', "Silakan Coba Beberapa Saat Lagi! Problem: {$exception->getMessage()}");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|RedirectResponse|Response|View
     */
    public function create()
    {
        try {
            $data = [
                'Mahasiswa' => Mahasiswa::all(),
                'Software' => Software::all()
            ];
            return view('JasaInstallasi.create', $data);
        } catch (Exception $exception) {
            return redirect()->route('JasaInstallasi.index')->with('warning', "Silakan Coba Beberapa Saat Lagi! Problem: {$exception->getMessage()}");
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
            'laptop' => 'required|string|max:50',
            'kelengkapan' => 'required|string',
            'tanggal' => 'required|date',
            'id_software' => 'required',
            'jenis' => 'required',
            'keterangan' => 'required',
            'jam_ambil' => 'required|time'
        ]);
        try {
            JasaInstallasi::create($request->all());
            return redirect()->route('JasaInstallasi.index')->with('success', "Berhasil Ditambahkan!");
        } catch (Exception $exception) {
            return redirect()->route('JasaInstallasi.index')->with('danger', "Gagal Ditambahkan! Error: {$exception->getMessage()}");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param JasaInstallasi $JasaInstallasi
     * @return JasaInstallasiResource
     */
    public function show(JasaInstallasi $JasaInstallasi): JasaInstallasiResource
    {
        return new JasaInstallasiResource($JasaInstallasi::with(['mahasiswa', 'software']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param JasaInstallasi $JasaInstallasi
     * @return Application|Factory|RedirectResponse|Response|View
     */
    public function edit(JasaInstallasi $JasaInstallasi)
    {
        try {
            $data = [
                'JasaInstallasi' => $JasaInstallasi::with(['mahasiswa', 'software']),
                'Mahasiswa' => Mahasiswa::all(),
                'Software' => Software::all()
            ];
            return view('JasaInstallasi.edit', $data);
        } catch (Exception $exception) {
            return redirect()->route('JasaInstallasi.index')->with('warning', "Silakan Coba Beberapa Saat Lagi! Problem: {$exception->getMessage()}");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param JasaInstallasi $JasaInstallasi
     * @return RedirectResponse
     */
    public function update(Request $request, JasaInstallasi $JasaInstallasi): ?RedirectResponse
    {
        $request->validate([
            'id_mahasiswa' => 'required',
            'laptop' => 'required|string|max:50',
            'kelengkapan' => 'required|string',
            'tanggal' => 'required|date',
            'id_software' => 'required',
            'jenis' => 'required',
            'keterangan' => 'required',
            'jam_ambil' => 'required|time'
        ]);
        try {
            JasaInstallasi::whereId($JasaInstallasi->id)->update($request->except(['_method','_token']));
            return redirect()->route('JasaInstallasi.index')->with('success', "Berhasil Diupdate!");
        } catch (Exception $exception) {
            return redirect()->route('JasaInstallasi.index')->with('danger', "Gagal Diupdate! Error: {$exception->getMessage()}");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param JasaInstallasi $JasaInstallasi
     * @return RedirectResponse
     */
    public function destroy(JasaInstallasi $JasaInstallasi): ?RedirectResponse
    {
        try {
            JasaInstallasi::destroy($JasaInstallasi->id);
            return redirect()->route('JasaInstallasi.index')->with('success', "Berhasil Dihapus!");
        } catch (Exception $exception) {
            return redirect()->route('JasaInstallasi.index')->with('danger', "Gagal Dihapus! Error: {$exception->getMessage()}");
        }
    }
}
