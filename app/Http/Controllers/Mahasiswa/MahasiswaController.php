<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Http\Requests\MahasiswaRequest;
use App\Http\Resources\MahasiswaResource;
use App\Mahasiswa;
use App\Prodi;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MahasiswaController extends Controller
{
    /**
     * MahasiswaController constructor.
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
                'Mahasiswa' => Mahasiswa::with(['prodi'])
                    ->orderBy('created_at', 'desc')
                    ->paginate(8),
            ];
            return view('Mahasiswa.index', $data);
        } catch (Exception $exception) {
            return redirect()->home()->with('warning',"Silakan Coba Beberapa Saat! {$exception->getMessage()}");
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
            ];
            return view('Mahasiswa.create', $data);
        } catch (Exception $exception) {
            return redirect()->route('Mahasiswa.index')
                ->with('warning', "Silakan Coba Beberapa Saat Lagi! {$exception->getMessage()}");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MahasiswaRequest $request
     * @return RedirectResponse
     */
    public function store(MahasiswaRequest $request): RedirectResponse
    {
        $request->validate([
        ]);
        try {
            Mahasiswa::create($request->validated());
            return redirect()->route('Mahasiswa.index')
                ->with('success','Berhasil Ditambahkan!');
        } catch (Exception $exception) {
            return redirect()->route('Mahasiswa.index')
                ->with('danger',"Gagal Ditambahkan! {$exception->getMessage()}");
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
     * @return Application|Factory|RedirectResponse|View
     */
    public function edit(Mahasiswa $Mahasiswa)
    {
        try {
            $data = [
                'Mahasiswa' => $Mahasiswa::with(['prodi'])
                    ->firstWhere('id', $Mahasiswa->id),
                'Prodi' => Prodi::orderBy('nama_prodi','asc')->get()
            ];
            return view('Mahasiswa.edit', $data);
        } catch (Exception $exception) {
            return redirect()->route('Mahasiswa.index')
                ->with('warning', "Silakan Coba Beberapa Saat Lagi! {$exception->getMessage()}");
        }
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
            return redirect()->route('Mahasiswa.index')
                ->with('success', "Berhasil Diupdate!");
        } catch (Exception $exception) {
            return redirect()->route('Mahasiswa.index')
                ->with('danger',"Gagal Diupdate! {$exception->getMessage()}");
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
            Mahasiswa::destroy($Mahasiswa->id);
            return redirect()->route('Mahasiswa.index')
                ->with('success', 'Berhasil Dihapus!');
        } catch (Exception $exception) {
            return redirect()->route('Mahasiswa.index')
                ->with('danger',"Gagal Dihapus! {$exception->getMessage()}");
        }
    }

    /**
     * @return MahasiswaResource
     */
    public function all(): MahasiswaResource
    {
        return new MahasiswaResource(Mahasiswa::with(['prodi'])->get());
    }
}
