<?php

namespace App\Http\Controllers\SuratBebasLabkom;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuratBebasLabkomRequest;
use App\Http\Resources\SuratBebasLabkomResource;
use App\Mahasiswa;
use App\SuratBebasLabkom;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SuratBebasLabkomController extends Controller
{
    /**
     * SuratBebasLabkomController constructor.
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
                'SuratBebasLabkom' => SuratBebasLabkom::with('mahasiswa')
                    ->orderBy('created_at', 'desc')
                    ->paginate(8)
            ];
            return view('SuratBebasLabkom.index', $data);
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
                'Mahasiswa' => Mahasiswa::orderBy('nama_mahasiswa','asc')->get()
            ];
            return view('SuratBebasLabkom.create', $data);
        } catch (Exception $exception) {
            return redirect()->route('SuratBebasLabkom.index')
                ->with('warning', "Silakan Coba Beberapa Saat Lagi! {$exception->getMessage()}");
        }
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
            return redirect()->route('SuratBebasLabkom.index')
                ->with('success', "Berhasil Ditambahkan!");
        } catch (Exception $exception) {
            return redirect()->route('SuratBebasLabkom.index')
                ->with('danger', "Gagal Ditambahkan! {$exception->getMessage()}");
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
     * @return Application|Factory|RedirectResponse|View
     */
    public function edit(SuratBebasLabkom $SuratBebasLabkom)
    {
        try {
            $data = [
                'SuratBebasLabkom' => $SuratBebasLabkom::with(['mahasiswa'])
                    ->firstWhere('id', $SuratBebasLabkom->id),
                'Mahasiswa' => Mahasiswa::orderBy('nama_mahasiswa', 'asc')->get()
            ];
            return view('SuratBebasLabkom.edit', $data);
        } catch (Exception $exception) {
            return redirect()->route('SuratBebasLabkom.index')
                ->with('warning', "Silakan Coba Beberapa Saat Lagi! {$exception->getMessage()}");
        }
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
            return redirect()->route('SuratBebasLabkom.index')
                ->with('success', "Berhasil Diupdate!");
        } catch (Exception $exception) {
            return redirect()->route('SuratBebasLabkom.index')
                ->with('danger', "Gagal Diupdate! {$exception->getMessage()}");
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
            SuratBebasLabkom::destroy($SuratBebasLabkom->id);
            return redirect()->route('SuratBebasLabkom.index')
                ->with('success', "Berhasil Dihapus!");
        } catch (Exception $exception) {
            return redirect()->route('SuratBebasLabkom.index')
                ->with('danger', "Gagal Dihapus! {$exception->getMessage()}");
        }
    }
}
