<?php

namespace App\Http\Controllers\Software;

use App\Http\Controllers\Controller;
use App\Http\Resources\SoftwareResource;
use App\Software;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class SoftwareController extends Controller
{
    /**
     * SoftwareController constructor.
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
                'Software' => Software::orderBy('created_at','desc')->paginate(8)
            ];
            return view('Software.index', $data);
        } catch (Exception $exception) {
            return redirect()->home()->with('warning', "Silakan Coba Beberapa Saat Lagi! Problem: {$exception->getMessage()}");
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
            return view('Software.create');
        } catch (Exception $exception) {
            return redirect()->route('Software.index')->with('warning', "Silakan Coba Beberapa Saat Lagi! Problem: {$exception->getMessage()}");
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
            'nama_software' => 'required|string|max:60',
            'harga_software' => 'required|integer'
        ]);
        try {
            Software::create($request->all());
            return redirect()->route('Software.index')->with('success', "Berhasil Ditambahkan!");
        } catch (Exception $exception) {
            return redirect()->route('Software.index')->with('danger', "Gagal Ditambahkan! Error: {$exception->getMessage()}");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Software $Software
     * @return SoftwareResource
     */
    public function show(Software $Software): SoftwareResource
    {
        return new SoftwareResource($Software);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Software $Software
     * @return Application|Factory|RedirectResponse|Response|View
     */
    public function edit(Software $Software)
    {
        try {
            $data = [
                'Software' => $Software
            ];
            return view('Software.edit', $data);
        } catch (Exception $exception) {
            return redirect()->route('Software.index')->with('warning', "Silakan Coba Beberapa Saat Lagi! Problem: {$exception->getMessage()}");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Software $Software
     * @return RedirectResponse
     */
    public function update(Request $request, Software $Software): ?RedirectResponse
    {
        $request->validate([
            'nama_software' => 'required|string|max:60',
            'harga_software' => 'required|integer'
        ]);
        try {
            Software::whereId($Software->id)->update($request->except(['_method', '_token']));
            return redirect()->route('Software.index')->with('success', "Berhasil Diupdate!");
        } catch (Exception $exception) {
            return redirect()->route('Software.index')->with('danger', "Gagal Diupdate! Error: {$exception->getMessage()}");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Software $Software
     * @return RedirectResponse
     */
    public function destroy(Software $Software): ?RedirectResponse
    {
        try {
            Gate::authorize('delete-data');
            Software::destroy($Software->id);
            return redirect()->route('Software.index')->with('success', "Berhasil Dihapus!");
        } catch (Exception $exception) {
            return redirect()->route('Software.index')->with('danger', "Gagal Dihapus! Error: {$exception->getMessage()}");
        }
    }
}
