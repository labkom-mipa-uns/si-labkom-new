<?php

namespace App\Http\Controllers\Lab;

use App\Http\Controllers\Controller;
use App\Http\Resources\LabResource;
use App\Lab;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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
            return redirect()->route('home')->with('warning',"Silakan Coba Beberapa Saat Lagi! Problem: {$exception->getMessage()}");
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
            return redirect()->route('Laboratorium.index')->with('warning', "Silakan Coba Beberapa Saat Lagi! Problem: {$exception->getMessage()}");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): ?RedirectResponse
    {
        $request->validate([
            'nama_lab' => 'required|max:50'
        ]);
        try {
            Lab::create($request->all());
            return redirect()->route('Laboratorium.index')->with('success', 'Berhasil Ditambahkan!');
        } catch (Exception $exception) {
            return redirect()->route('Laboratorium.index')->with('danger', "Gagal Ditambahkan! Error: {$exception->getMessage()}");
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
            return redirect()->route("Laboratorium.index")->with('warning', "Silakan Coba Beberapa Saat Lagi! Problem: {$exception->getMessage()}");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Lab $Laboratorium
     * @return RedirectResponse
     */
    public function update(Request $request, Lab $Laboratorium): ?RedirectResponse
    {
        $request->validate([
            'nama_lab' => 'required|max:50'
        ]);
        try {
            Lab::whereId($Laboratorium->id)->update($request->except(['_token', '_method']));
            return redirect()->route('Laboratorium.index')->with('success', "Berhasil Diupdate!");
        } catch (Exception $exception) {
            return redirect()->route('Laboratorium.index')->with('danger', "Gagal Diupdate! Error: {$exception->getMessage()}");
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
            Gate::authorize('delete-data');
            Lab::destroy($Laboratorium->id);
            return redirect()->route('Laboratorium.index')->with('success', 'Berhasil Dihapus!');
        } catch (Exception $exception) {
            return redirect()->route("Laboratorium.index")->with('danger', "Gagal Dihapus! Error: {$exception->getMessage()}");
        }
    }
}
