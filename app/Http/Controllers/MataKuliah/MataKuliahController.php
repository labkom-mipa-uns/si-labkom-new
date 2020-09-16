<?php

namespace App\Http\Controllers\MataKuliah;

use App\Http\Controllers\Controller;
use App\Http\Requests\MataKuliahRequest;
use App\Http\Resources\MataKuliahResource;
use App\MataKuliah;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class MataKuliahController extends Controller
{
    /**
     * MataKuliahController constructor.
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
            $data = [
                'MataKuliah' => MataKuliah::orderBy('created_at', 'desc')->paginate(8)
            ];
            return view('MataKuliah.index', $data);
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
            return view('MataKuliah.create');
        } catch (Exception $exception) {
            return redirect()->route('MataKuliah.index')
                ->with('warning', "Silakan Coba Beberapa Saat Lagi! {$exception->getMessage()}");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MataKuliahRequest $request
     * @return RedirectResponse
     */
    public function store(MataKuliahRequest $request): ?RedirectResponse
    {
        try {
            MataKuliah::create($request->validated());
            return redirect()->route('MataKuliah.index')
                ->with('success', "Berhasil Ditambahkan!");
        } catch (Exception $exception) {
            return redirect()->route('MataKuliah.index')
                ->with('danger', "Gagal Ditambahkan! {$exception->getMessage()}");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param MataKuliah $MataKuliah
     * @return MataKuliahResource
     */
    public function show(MataKuliah $MataKuliah): MataKuliahResource
    {
        return new MataKuliahResource($MataKuliah);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param MataKuliah $MataKuliah
     * @return Application|Factory|RedirectResponse|Response|View
     */
    public function edit(MataKuliah $MataKuliah)
    {
        try {
            $data = [
                'MataKuliah' => $MataKuliah
            ];
            return view('MataKuliah.edit', $data);
        } catch (Exception $exception) {
            return redirect()->route('MataKuliah.index')
                ->with('warning', "Silakan Coba Beberapa Saat Lagi! {$exception->getMessage()}");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MataKuliahRequest $request
     * @param MataKuliah $MataKuliah
     * @return RedirectResponse
     */
    public function update(MataKuliahRequest $request, MataKuliah $MataKuliah): ?RedirectResponse
    {
        try {
            $MataKuliah->update($request->validated());
            return redirect()->route('MataKuliah.index')
                ->with('success', "Berhasil Diupdate!");
        } catch (Exception $exception) {
            return redirect()->route('MataKuliah.index')
                ->with('danger', "Gagal Diupdate! {$exception->getMessage()}");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param MataKuliah $MataKuliah
     * @return RedirectResponse
     */
    public function destroy(MataKuliah $MataKuliah): ?RedirectResponse
    {
        try {
            $this->authorize('delete-data');
            MataKuliah::destroy($MataKuliah->id);
            return redirect()->route('MataKuliah.index')
                ->with('success', 'Berhasil Dihapus!');
        } catch (Exception $exception) {
            return redirect()->route('MataKuliah.index')
                ->with('danger', "Gagal Dihapus! {$exception->getMessage()}");
        }
    }

    /**
     * @return MataKuliah
     */
    public function all(): MataKuliah
    {
        return new MataKuliah(MataKuliah::all());
    }
}
