<?php

namespace App\Http\Controllers\PeminjamanLab;

use App\Http\Controllers\Controller;
use App\Http\Requests\PeminjamanLabRequest;
use App\Http\Resources\PeminjamanLabResource;
use App\Jadwal;
use App\Lab;
use App\Mahasiswa;
use App\PeminjamanLab;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
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
                'PeminjamanLab' => PeminjamanLab::with(['mahasiswa', 'lab','jadwal'])
                    ->orderBy('created_at','desc')
                    ->paginate(8),
            ];
            return view('PeminjamanLab.index', $data);
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
                'Jadwal' => Jadwal::with(['prodi','dosen','matakuliah'])->get(),
                'Mahasiswa' => Mahasiswa::orderBy('nama_mahasiswa', 'asc')->get(),
                'Lab' => Lab::orderBy('nama_lab', 'asc')->get()
            ];
            return view('PeminjamanLab.create', $data);
        } catch (Exception $exception) {
            return redirect()->route('PeminjamanLab.index')
                ->with('warning', "Silakan Coba Beberapa Saat Lagi! {$exception->getMessage()}");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PeminjamanLabRequest $request
     * @return RedirectResponse
     */
    public function store(PeminjamanLabRequest $request): ?RedirectResponse
    {
        try {
            PeminjamanLab::create($request->validated());
            return redirect()->route('PeminjamanLab.index')
                ->with('success', 'Berhasil Ditambahkan!');
        } catch (Exception $exception) {
            return redirect()->route('PeminjamanLab.index')
                ->with('danger', "Gagal Ditambahkan! {$exception->getMessage()}");
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
     * @return Application|Factory|RedirectResponse|View
     */
    public function edit(PeminjamanLab $PeminjamanLab)
    {
        try {
            $data = [
                'PeminjamanLab' => $PeminjamanLab::with(['mahasiswa','lab','jadwal'])
                    ->firstWhere('id',$PeminjamanLab->id),
                'Jadwal' => Jadwal::with(['prodi','dosen','matakuliah'])->get(),
                'Mahasiswa' => Mahasiswa::orderBy('nama_mahasiswa', 'asc')->get(),
                'Lab' => Lab::orderBy('nama_lab', 'asc')->get()
            ];
            return view('PeminjamanLab.edit', $data);
        } catch (Exception $exception) {
            return redirect()->route('PeminjamanLab.index')
                ->with('warning', "Silakan Coba Beberapa Saat Lagi! {$exception->getMessage()}");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PeminjamanLabRequest $request
     * @param PeminjamanLab $PeminjamanLab
     * @return RedirectResponse
     */
    public function update(PeminjamanLabRequest $request, PeminjamanLab $PeminjamanLab): ?RedirectResponse
    {
        try {
            $PeminjamanLab->update($request->validated());
            return redirect()->route('PeminjamanLab.index')
                ->with('success',"Berhasil Diupdate!");
        } catch (Exception $exception) {
            return redirect()->route('PeminjamanLab.index')
                ->with('danger',"Gagal Diupdate! {$exception->getMessage()}");
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
            PeminjamanLab::destroy($PeminjamanLab->id);
            return redirect()->route('PeminjamanLab.index')
                ->with('success', 'Berhasil Dihapus!');
        } catch (Exception $exception) {
            return redirect()->route('PeminjamanLab.index')
                ->with('danger',"Gagal Dihapus! {$exception->getMessage()}");
        }
    }

    /**
     * @return PeminjamanLabResource
     */
    public function all(): PeminjamanLabResource
    {
        return new PeminjamanLabResource(PeminjamanLab::with(['mahasiswa', 'lab', 'jadwal'])->get());
    }
}
