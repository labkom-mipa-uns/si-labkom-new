<?php

namespace App\Http\Controllers\Jadwal;

use App\Dosen;
use App\Http\Controllers\Controller;
use App\Http\Requests\JadwalRequest;
use App\Http\Resources\JadwalResource;
use App\Jadwal;
use App\MataKuliah;
use App\Prodi;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
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
                'Jadwal' => Jadwal::with(['prodi','dosen', 'matakuliah'])
                    ->orderBy('created_at','desc')
                    ->paginate(8)
            ];
            return view('Jadwal.index', $data);
        } catch (Exception $exception) {
            return redirect()->home()->with('warning', "Silakan Coba Beberapa Saat Lagi! {$exception->getMessage()}");
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
            return redirect()->route('Jadwal.index')
                ->with('warning', "Silakan Coba Beberapa Saat Lagi! {$exception->getMessage()}");
        }
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
            return redirect()->route('Jadwal.index')
                ->with('success', 'Berhasil Ditambahkan!');
        } catch (Exception $exception) {
            return redirect()->route('Jadwal.index')
                ->with('danger', "Gagal Ditambahkan! {$exception->getMessage()}");
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
     * @return Application|Factory|RedirectResponse|Response|View
     */
    public function edit(Jadwal $Jadwal)
    {
        try {
            $data = [
                'Jadwal' => $Jadwal::with(['prodi', 'dosen', 'matakuliah'])
                    ->firstWhere('id', $Jadwal->id),
                'Prodi' => Prodi::orderBy('nama_prodi', 'asc')->get(),
                'Dosen' => Dosen::orderBy('nama_dosen', 'asc')->get(),
                'MataKuliah' => MataKuliah::orderBy('nama_matkul', 'asc')->get()
            ];
            return view('Jadwal.edit', $data);
        } catch (Exception $exception) {
            return redirect()->route('Jadwal.index')
                ->with('warning', "Silakan Coba Beberapa Saat Lagi! {$exception->getMessage()}");
        }
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
            return redirect()->route('Jadwal.index')
                ->with('success', "Berhasil Diupdate!");
        } catch (Exception $exception) {
            return redirect()->route('Jadwal.index')
                ->with('danger', "Gagal Diupdate! {$exception->getMessage()}");
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
            Jadwal::destroy($Jadwal->id);
            return redirect()->route('Jadwal.index')
                ->with('success', "Berhasil Dihapus!");
        } catch (Exception $exception) {
            return redirect()->route('Jadwal.index')
                ->with('danger', "Gagal Dihapus! {$exception->getMessage()}");
        }
    }

    /**
     * @return JadwalResource
     */
    public function all(): JadwalResource
    {
        return new JadwalResource(Jadwal::with(['prodi', 'dosen', 'matakuliah'])->get());
    }
}
