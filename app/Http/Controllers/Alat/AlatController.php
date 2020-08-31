<?php

namespace App\Http\Controllers\Alat;

use App\Alat;
use App\Http\Controllers\Controller;
use App\Http\Requests\AlatRequest;
use App\Http\Resources\AlatResource;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class AlatController extends Controller
{
    /**
     * AlatController constructor.
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
            $data= [
                'Alat' => Alat::orderBy('created_at', 'desc')->paginate(8)
            ];
            return view('Alat.index', $data);
        } catch (Exception $exception) {
            return redirect()->home()->with('warning', "Silakan Coba Beberapa Saat Lagi! {$exception->getMessage()}");
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
            return view('Alat.create');
        } catch (Exception $exception) {
            return redirect()->route('Alat.index')
                ->with('warning', "Silakan Coba Beberapa Saat Lagi! {$exception->getMessage()}");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AlatRequest $request
     * @return RedirectResponse|Response
     */
    public function store(AlatRequest $request)
    {
        try {
            Alat::create($request->validated());
            return redirect()->route('Alat.index')
                ->with('success', "Berhasil Ditambahkan!");
        } catch (Exception $exception) {
            return redirect()->route('Alat.index')
                ->with('danger', "Gagal Ditambahkan! {$exception->getMessage()}");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Alat $Alat
     * @return AlatResource|Response
     */
    public function show(Alat $Alat): AlatResource
    {
        return new AlatResource($Alat);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Alat $Alat
     * @return Application|Factory|RedirectResponse|Response|View
     */
    public function edit(Alat $Alat)
    {
        try {
            $data = [
                'Alat' => $Alat
            ];
            return view('Alat.edit', $data);
        } catch (Exception $exception) {
            return redirect()->route('Alat.index')
                ->with('warning', "Silakan Coba Beberapa Saat Lagi! {$exception->getMessage()}");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AlatRequest $request
     * @param Alat $Alat
     * @return RedirectResponse
     */
    public function update(AlatRequest $request, Alat $Alat): ?RedirectResponse
    {
        try {
            $Alat->update($request->validated());
            return redirect()->route('Alat.index')
                ->with('success', "Berhasil Diupdate!");
        } catch (Exception $exception) {
            return redirect()->route('Alat.index')
                ->with('danger', "Gagal Diupdate! {$exception->getMessage()}");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Alat $Alat
     * @return RedirectResponse
     */
    public function destroy(Alat $Alat): ?RedirectResponse
    {
        try {
            $this->authorize('delete-data');
            Alat::destroy($Alat->id);
            return redirect()->route('Alat.index')
                ->with('success', "Berhasil Dihapus!");
        } catch (Exception $exception) {
            return redirect()->route('Alat.index')
                ->with('danger', "Gagal Dihapus! {$exception->getMessage()}");
        }
    }
}
