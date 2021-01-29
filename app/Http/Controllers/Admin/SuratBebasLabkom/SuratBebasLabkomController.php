<?php

namespace App\Http\Controllers\Admin\SuratBebasLabkom;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuratBebasLabkomRequest;
use App\Http\Resources\SuratBebasLabkomResource;
use App\Models\Mahasiswa;
use App\Models\SuratBebasLabkom;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Inertia\Response;

class SuratBebasLabkomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('SuratBebasLabkom/Index', [
            'filters' => Request::all(['search', 'trashed']),
            'surat' => SuratBebasLabkom::with(['mahasiswa'])
                ->orderBy('created_at', 'desc')
                ->filter(Request::only(['search', 'trashed']))
                ->paginate()
                ->transform(function ($surat) {
                    return [
                        'id' => $surat->id,
                        'mahasiswa' => $surat->mahasiswa,
                        'tanggal' => $surat->tanggal,
                    ];
                })
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('SuratBebasLabkom/Create', [
            'mahasiswa' => Mahasiswa::orderBy('nama_mahasiswa', 'asc')
                ->get()
                ->map
                ->only('id', 'nama_mahasiswa')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SuratBebasLabkomRequest $request
     * @return RedirectResponse
     */
    public function store(SuratBebasLabkomRequest $request): ?RedirectResponse
    {
        try {
            SuratBebasLabkom::create($request->validated());
            return Redirect::route('SuratBebasLabkom.index')
                ->with([
                    'name' => 'Surat Bebas Labkom',
                    'success' => 'Berhasil Ditambahkan!']);
        } catch (Exception $exception) {
            return Redirect::route('SuratBebasLabkom.index')
                ->with([
                    'name' => 'Surat Bebas Labkom',
                    'error' => "Gagal Dihapus! {$exception->getMessage()}"
                ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param SuratBebasLabkom $SuratBebasLabkom
     * @return SuratBebasLabkomResource
     */
    public function show(SuratBebasLabkom $SuratBebasLabkom): SuratBebasLabkomResource
    {
        return new SuratBebasLabkomResource($SuratBebasLabkom::with(['mahasiswa'])
            ->firstWhere('id', $SuratBebasLabkom->id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param SuratBebasLabkom $SuratBebasLabkom
     * @return Response
     */
    public function edit(SuratBebasLabkom $SuratBebasLabkom): Response
    {
        return Inertia::render('SuratBebasLabkom/Edit', [
            'surat' => [
                'id' => $SuratBebasLabkom->id,
                'id_mahasiswa' => $SuratBebasLabkom->id_mahasiswa,
                'mahasiswa' => $SuratBebasLabkom->mahasiswa,
                'tanggal' => $SuratBebasLabkom->tanggal,
            ],
            'mahasiswa' => Mahasiswa::orderBy('nama_mahasiswa', 'asc')
                ->get()
                ->map
                ->only('id', 'nama_mahasiswa')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SuratBebasLabkomRequest $request
     * @param SuratBebasLabkom $SuratBebasLabkom
     * @return RedirectResponse
     */
    public function update(SuratBebasLabkomRequest $request, SuratBebasLabkom $SuratBebasLabkom): ?RedirectResponse
    {
        try {
            $SuratBebasLabkom->update($request->validated());
            return Redirect::route('SuratBebasLabkom.index')
                ->with([
                    'name' => 'Surat Bebas Labkom',
                    'success' => 'Berhasil Diubah!'
                ]);
        } catch (Exception $exception) {
            return Redirect::route('SuratBebasLabkom.index')
                ->with([
                    'name' => 'Data Surat Bebas Labkom',
                    'error' => "Gagal Diubah! {$exception->getMessage()}"
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param SuratBebasLabkom $SuratBebasLabkom
     * @return RedirectResponse
     */
    public function destroy(SuratBebasLabkom $SuratBebasLabkom): ?RedirectResponse
    {
        try {
            $this->authorize('delete-data');
            $SuratBebasLabkom->delete();
            return Redirect::route('SuratBebasLabkom.index')
                ->with([
                    'name' => 'Surat Bebas Labkom',
                    'success' => 'Berhasil Dihapus!']);
        } catch (Exception $exception) {
            return Redirect::route('SuratBebasLabkom.index')
                ->with([
                    'name' => 'Surat Bebas Labkom',
                    'error' => "Gagal Dihapus! {$exception->getMessage()}"
                ]);
        }
    }

    /**
     * @param SuratBebasLabkom $SuratBebasLabkom
     * @return RedirectResponse
     */
    public function restore(SuratBebasLabkom $SuratBebasLabkom): RedirectResponse
    {
        $SuratBebasLabkom->restore();
        return Redirect::route('SuratBebasLabkom.index')
            ->with([
                'name' => 'Surat Bebas Labkom',
                'success' => 'Berhasil Dipulihkan!']);
    }
}
