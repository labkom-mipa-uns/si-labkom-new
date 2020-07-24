<?php

namespace App\Http\Controllers\Jadwal;

use App\Dosen;
use App\Http\Controllers\Controller;
use App\Http\Resources\JadwalResource;
use App\Jadwal;
use App\MataKuliah;
use App\Prodi;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class JadwalController extends Controller
{
    /**
     * JadwalController constructor.
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
                'Jadwal' => Jadwal::with(['prodi','dosen', 'matakuliah'])->orderBy('created_at','desc')->paginate(8)
            ];
            return view('Jadwal.index', $data);
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
                'Prodi' => Prodi::orderBy('nama_prodi', 'asc')->get(),
                'Dosen' => Dosen::orderBy('nama_dosen', 'asc')->get(),
                'MataKuliah' => MataKuliah::orderBy('nama_matkul', 'asc')->get()
            ];
            return view('Jadwal.create', $data);
        } catch (Exception $exception) {
            return redirect()->route('Jadwal.index')->with('warning', "Silakan Coba Beberapa Saat Lagi! Problem: {$exception->getMessage()}");
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
            'id_prodi' => 'required',
            'id_dosen' => 'required',
            'id_matkul' => 'required',
        ]);
        try {
            Jadwal::create($request->all());
            return redirect()->route('Jadwal.index')->with('success', 'Berhasil Ditambahkan!');
        } catch (Exception $exception) {
            return redirect()->route('Jadwal.index')->with('danger', "Gagal Ditambahkan! Error: {$exception->getMessage()}");
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
        return new JadwalResource($Jadwal::with(['prodi', 'dosen', 'matakuliah'])->firstWhere('id',$Jadwal->id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Jadwal $Jadwal
     * @return Application|Factory|RedirectResponse|Response|View
     */
    public function edit(Jadwal $Jadwal)
    {
        try {
            $data = [
                'Jadwal' => $Jadwal::with(['prodi', 'dosen', 'matakuliah'])->firstWhere('id', $Jadwal->id),
                'Prodi' => Prodi::orderBy('nama_prodi', 'asc')->get(),
                'Dosen' => Dosen::orderBy('nama_dosen', 'asc')->get(),
                'MataKuliah' => MataKuliah::orderBy('nama_matkul', 'asc')->get()
            ];
            return view('Jadwal.edit', $data);
        } catch (Exception $exception) {
            return redirect()->route('Jadwal.index')->with('warning', "Silakan Coba Beberapa Saat Lagi! Problem: {$exception->getMessage()}");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Jadwal $Jadwal
     * @return RedirectResponse
     */
    public function update(Request $request, Jadwal $Jadwal): ?RedirectResponse
    {
        $request->validate([
            'id_prodi' => 'required',
            'id_dosen' => 'required',
            'id_matkul' => 'required',
        ]);
        try {
            Jadwal::whereId($Jadwal->id)->update($request->except('_token', '_method'));
            return redirect()->route('Jadwal.index')->with('success', "Berhasil Diupdate!");
        } catch (Exception $exception) {
            return redirect()->route('Jadwal.index')->with('danger', "Gagal Diupdate! Error: {$exception->getMessage()}");
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
            Gate::authorize('delete-data');
            Jadwal::destroy($Jadwal->id);
            return redirect()->route('Jadwal.index')->with('success', "Berhasil Dihapus!");
        } catch (Exception $exception) {
            return redirect()->route('Jadwal.index')->with('danger', "Gagal Dihapus! Error: {$exception->getMessage()}");
        }
    }
}
