<?php

namespace App\Http\Controllers\Software;

use App\Http\Controllers\Controller;
use App\Http\Requests\SoftwareRequest;
use App\Http\Resources\SoftwareResource;
use App\Software;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
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
            return view('Software.create');
        } catch (Exception $exception) {
            return redirect()->route('Software.index')
                ->with('warning', "Silakan Coba Beberapa Saat Lagi! {$exception->getMessage()}");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SoftwareRequest $request
     * @return RedirectResponse
     */
    public function store(SoftwareRequest $request): ?RedirectResponse
    {
        try {
            Software::create($request->validated());
            return redirect()->route('Software.index')
                ->with('success', "Berhasil Ditambahkan!");
        } catch (Exception $exception) {
            return redirect()->route('Software.index')
                ->with('danger', "Gagal Ditambahkan! {$exception->getMessage()}");
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
            return redirect()->route('Software.index')
                ->with('warning', "Silakan Coba Beberapa Saat Lagi! {$exception->getMessage()}");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SoftwareRequest $request
     * @param Software $Software
     * @return RedirectResponse
     */
    public function update(SoftwareRequest $request, Software $Software): ?RedirectResponse
    {
        try {
            $Software->update($request->validated());
            return redirect()->route('Software.index')
                ->with('success', "Berhasil Diupdate!");
        } catch (Exception $exception) {
            return redirect()->route('Software.index')
                ->with('danger', "Gagal Diupdate! {$exception->getMessage()}");
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
            $this->authorize('delete-data');
            Software::destroy($Software->id);
            return redirect()->route('Software.index')
                ->with('success', "Berhasil Dihapus!");
        } catch (Exception $exception) {
            return redirect()->route('Software.index')
                ->with('danger', "Gagal Dihapus! {$exception->getMessage()}");
        }
    }

    /**
     * @return SoftwareResource
     */
    public function all(): SoftwareResource
    {
        return new SoftwareResource(Software::all());
    }
}
