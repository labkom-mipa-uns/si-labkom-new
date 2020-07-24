<?php

namespace App\Http\Controllers\JasaPrint;

use App\Http\Controllers\Controller;
use App\Http\Resources\JasaPrintResource;
use App\JasaPrint;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class JasaPrintController extends Controller
{
    /**
     * JasaPrintController constructor.
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
                'JasaPrint' => JasaPrint::orderBy('created_at', 'desc')->paginate(8)
            ];
            return view('JasaPrint.index', $data);
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
            return view('JasaPrint.create');
        } catch (Exception $exception) {
            return redirect()->route('JasaPrint.index')->with('waning', "Silakan Coba Beberapa Saat Lagi! Problem: {$exception->getMessage()}");
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
            'jenis_print' => 'required',
            'harga_print' => 'required|integer',
            'tanggal_print' => 'required',
        ]);
        try {
            JasaPrint::create($request->all());
            return redirect()->route('JasaPrint.index')->with('success', "Berhasil Ditambahkan!");
        } catch (Exception $exception) {
            return redirect()->route('JasaPrint.index')->with('danger', "Gagal Ditambahkan! Error: {$exception->getMessage()}");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param JasaPrint $JasaPrint
     * @return JasaPrintResource
     */
    public function show(JasaPrint $JasaPrint): JasaPrintResource
    {
        return new JasaPrintResource($JasaPrint);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param JasaPrint $JasaPrint
     * @return Application|Factory|RedirectResponse|Response|View
     */
    public function edit(JasaPrint $JasaPrint)
    {
        try {
            $data = [
                'JasaPrint' => $JasaPrint
            ];
            return view('JasaPrint.edit', $data);
        } catch (Exception $exception) {
            return redirect()->route('JasaPrint.index')->with('warning', "Silakan Coba Beberapa Saat Lagi! Problem: {$exception->getMessage()}");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param JasaPrint $JasaPrint
     * @return RedirectResponse
     */
    public function update(Request $request, JasaPrint $JasaPrint): ?RedirectResponse
    {
        $request->validate([
            'jenis_print' => 'required',
            'harga_print' => 'required|integer',
            'tanggal_print' => 'required',
        ]);
        try {
            JasaPrint::whereId($JasaPrint->id)->update($request->except('_method', '_token'));
            return redirect()->route('JasaPrint.index')->with('success', "Berhasil Diupdate!");
        } catch (Exception $exception) {
            return redirect()->route('JasaPrint.index')->with('danger', "Gagal Diupdate! Error: {$exception->getMessage()}");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param JasaPrint $JasaPrint
     * @return RedirectResponse
     */
    public function destroy(JasaPrint $JasaPrint): ?RedirectResponse
    {
        try {
            Gate::authorize('delete-data');
            JasaPrint::destroy($JasaPrint->id);
            return redirect()->route('JasaPrint.index')->with('success', "Berhasil Dihapus!");
        } catch (Exception $exception) {
            return redirect()->route('JasaPrint.index')->with('danger', "Gagal Dihapus! Error: {$exception->getMessage()}");
        }
    }
}
