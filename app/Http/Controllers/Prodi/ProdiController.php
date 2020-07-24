<?php

namespace App\Http\Controllers\Prodi;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProdiResource;
use App\Prodi;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ProdiController extends Controller
{
    /**
     * ProdiController constructor.
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
                'Prodi' => Prodi::orderBy('created_at', 'desc')->paginate(8),
            ];
            return view('Prodi.index', $data);
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
            return view('Prodi.create');
        } catch (Exception $exception) {
            return redirect()->route('Prodi.index')->with('warning', "Silakan Coba Beberapa Saat Lagi! Problem: {$exception->getMessage()}");
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
            'nama_prodi' => 'required|string'
        ]);
        try {
            Prodi::create($request->all());
            return redirect()->route('Prodi.index')->with('success', "Berhasil Ditambahkan!");
        } catch (Exception $exception) {
            return redirect()->route('Prodi.index')->with('danger',"Gagal Ditambahkan! Error: {$exception->getMessage()}");
        }
    }

    /**
     * @param Prodi $Prodi
     * @return ProdiResource
     */
    public function show(Prodi $Prodi): ProdiResource
    {
        return new ProdiResource($Prodi);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Prodi $Prodi
     * @return Application|Factory|RedirectResponse|View
     */
    public function edit(Prodi $Prodi)
    {
        try {
            $data = [
                'Prodi' => $Prodi
            ];
            return view('Prodi.edit', $data);
        } catch (Exception $exception) {
            return redirect()->route('Prodi.index')->with('warning', "Silakan Coba Beberapa Saat Lagi! Problem: {$exception->getMessage()}");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Prodi $Prodi
     * @return RedirectResponse
     */
    public function update(Request $request, Prodi $Prodi): ?RedirectResponse
    {
        $request->validate([
            'nama_prodi' => 'required|string'
        ]);
        try {
            Prodi::whereId($Prodi->id)->update($request->except(['_token', '_method']));
            return redirect()->route('Prodi.index')->with('success', "Berhasil Diupdate!");
        } catch (Exception $exception) {
            return redirect()->route('Prodi.index')->with('danger', "Gagal Diupdate! Error: {$exception->getMessage()}");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Prodi $Prodi
     * @return RedirectResponse
     */
    public function destroy(Prodi $Prodi): ?RedirectResponse
    {
        try {
            Gate::authorize('delete-data');
            Prodi::destroy($Prodi->id);
            return redirect()->route('Prodi.index')->with('success', "Berhasil Dihapus!");
        } catch (Exception $exception) {
            return redirect()->route('Prodi.index')->with('danger', "Gagal Dihapus! Error: {$exception->getMessage()}");
        }
    }
}
