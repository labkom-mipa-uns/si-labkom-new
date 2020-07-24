<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Http\Resources\MahasiswaResource;
use App\Mahasiswa;
use App\Prodi;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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
                'Mahasiswa' => Mahasiswa::with(['prodi'])->orderBy('created_at', 'desc')->paginate(8),
            ];
            return view('Mahasiswa.index', $data);
        } catch (Exception $exception) {
            return redirect()->route('home')->with('warning',"Silakan Coba Beberapa Saat! Problem: {$exception->getMessage()}");
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
            return redirect()->route('Mahasiswa.index')->with('warning', "Silakan Coba Beberapa Saat Lagi! Problem: {$exception->getMessage()}");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nim' => 'required|size:8',
            'nama_mahasiswa' => 'required|string|max:60',
            'jenis_kelamin' => 'required|string',
            'kelas' => 'required|string|max:5',
            'id_prodi' => 'required',
            'angkatan' => 'required',
            'no_hp' => 'required|max:13'
        ]);
        try {
            Mahasiswa::create($request->all());
            return redirect()->route('Mahasiswa.index')->with('success','Berhasil Ditambahkan!');
        } catch (Exception $exception) {
            return redirect()->route('Mahasiswa.index')->with('danger',"Gagal Ditambahkan! Error: {$exception->getMessage()}");
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
        return new MahasiswaResource($Mahasiswa::with(['prodi'])->firstWhere('id', $Mahasiswa->id));
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
                'Mahasiswa' => $Mahasiswa::with(['prodi'])->firstWhere('id', $Mahasiswa->id),
                'Prodi' => Prodi::orderBy('nama_prodi','asc')->get()
            ];
            return view('Mahasiswa.edit', $data);
        } catch (Exception $exception) {
            return redirect()->route('Mahasiswa.index')->with('warning', "Silakan Coba Beberapa Saat Lagi! Problem: {$exception->getMessage()}");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Mahasiswa $Mahasiswa
     * @return RedirectResponse
     */
    public function update(Request $request, Mahasiswa $Mahasiswa): ?RedirectResponse
    {
        $request->validate([
            'nim' => 'required|size:8',
            'nama_mahasiswa' => 'required|string|max:60',
            'jenis_kelamin' => 'required|string',
            'kelas' => 'required|string|max:5',
            'id_prodi' => 'required',
            'angkatan' => 'required',
            'no_hp' => 'required|max:13'
        ]);
        try {
            Mahasiswa::whereId($Mahasiswa->id)->update($request->except(['_token', '_method']));
            return redirect()->route('Mahasiswa.index')->with('success', "Berhasil Diupdate!");
        } catch (Exception $exception) {
            return redirect()->route('Mahasiswa.index')->with('danger',"Gagal Diupdate! Error: {$exception->getMessage()}");
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
            Gate::authorize('delete-data');
            Mahasiswa::destroy($Mahasiswa->id);
            return redirect()->route('Mahasiswa.index')->with('success', 'Berhasil Dihapus!');
        } catch (Exception $exception) {
            return redirect()->route('Mahasiswa.index')->with('danger',"Gagal Dihapus! Error: {$exception->getMessage()}");
        }
    }
}
