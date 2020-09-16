<?php

namespace App\Http\Controllers\Lab;

use App\Http\Controllers\Controller;
use App\Http\Requests\LabRequest;
use App\Http\Resources\LabResource;
use App\Lab;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LabController extends Controller
{
    /**
     * LabController constructor.
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
                'Laboratorium' => Lab::orderBy('created_at', 'desc')->paginate(8),
            ];
            return view('Lab.index', $data);
        } catch (Exception $exception) {
            return redirect()->home()->with('warning',"Silakan Coba Beberapa Saat Lagi! {$exception->getMessage()}");
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
            return view('Lab.create');
        } catch (Exception $exception) {
            return redirect()->route('Laboratorium.index')
                ->with('warning', "Silakan Coba Beberapa Saat Lagi! {$exception->getMessage()}");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LabRequest $request
     * @return RedirectResponse
     */
    public function store(LabRequest $request): ?RedirectResponse
    {
        try {
            Lab::create($request->validated());
            return redirect()->route('Laboratorium.index')
                ->with('success', 'Berhasil Ditambahkan!');
        } catch (Exception $exception) {
            return redirect()->route('Laboratorium.index')
                ->with('danger', "Gagal Ditambahkan! {$exception->getMessage()}");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Lab $Laboratorium
     * @return LabResource
     */
    public function show(Lab $Laboratorium): LabResource
    {
        return new LabResource($Laboratorium);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Lab $Laboratorium
     * @return Application|Factory|RedirectResponse|View
     */
    public function edit(Lab $Laboratorium)
    {
        try {
            $data = [
                'Laboratorium' => $Laboratorium
            ];
            return view('Lab.edit', $data);
        } catch (Exception $exception) {
            return redirect()->route("Laboratorium.index")
                ->with('warning', "Silakan Coba Beberapa Saat Lagi! {$exception->getMessage()}");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LabRequest $request
     * @param Lab $Laboratorium
     * @return RedirectResponse
     */
    public function update(LabRequest $request, Lab $Laboratorium): ?RedirectResponse
    {
        try {
            $Laboratorium->update($request->validated());
            return redirect()->route('Laboratorium.index')->with('success', "Berhasil Diupdate!");
        } catch (Exception $exception) {
            return redirect()->route('Laboratorium.index')->with('danger', "Gagal Diupdate! {$exception->getMessage()}");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Lab $Laboratorium
     * @return RedirectResponse
     */
    public function destroy(Lab $Laboratorium): RedirectResponse
    {
        try {
            $this->authorize('delete-data');
            Lab::destroy($Laboratorium->id);
            return redirect()->route('Laboratorium.index')->with('success', 'Berhasil Dihapus!');
        } catch (Exception $exception) {
            return redirect()->route("Laboratorium.index")->with('danger', "Gagal Dihapus! {$exception->getMessage()}");
        }
    }

    /**
     * @return LabResource
     */
    public function all(): LabResource
    {
        return new LabResource(Lab::all());
    }
}
