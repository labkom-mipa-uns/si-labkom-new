<?php

namespace App\Http\Controllers\Prodi;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProdiRequest;
use App\Http\Resources\ProdiResource;
use App\Prodi;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
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
            return view('Prodi.create');
        } catch (Exception $exception) {
            return redirect()->route('Prodi.index')
                ->with('warning', "Silakan Coba Beberapa Saat Lagi! {$exception->getMessage()}");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProdiRequest $request
     * @return RedirectResponse
     */
    public function store(ProdiRequest $request): RedirectResponse
    {
        try {
            Prodi::create($request->validated());
            return redirect()->route('Prodi.index')
                ->with('success', "Berhasil Ditambahkan!");
        } catch (Exception $exception) {
            return redirect()->route('Prodi.index')
                ->with('danger',"Gagal Ditambahkan! {$exception->getMessage()}");
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
            return redirect()->route('Prodi.index')
                ->with('warning', "Silakan Coba Beberapa Saat Lagi! {$exception->getMessage()}");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProdiRequest $request
     * @param Prodi $Prodi
     * @return RedirectResponse
     */
    public function update(ProdiRequest $request, Prodi $Prodi): ?RedirectResponse
    {
        try {
            $Prodi->update($request->validated());
            return redirect()->route('Prodi.index')
                ->with('success', "Berhasil Diupdate!");
        } catch (Exception $exception) {
            return redirect()->route('Prodi.index')
                ->with('danger', "Gagal Diupdate! {$exception->getMessage()}");
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
            $this->authorize('delete-data');
            Prodi::destroy($Prodi->id);
            return redirect()->route('Prodi.index')
                ->with('success', "Berhasil Dihapus!");
        } catch (Exception $exception) {
            return redirect()->route('Prodi.index')
                ->with('danger', "Gagal Dihapus! {$exception->getMessage()}");
        }
    }

    /**
     * @return ProdiResource
     */
    public function all(): ProdiResource
    {
        return new ProdiResource(Prodi::all());
    }
}
