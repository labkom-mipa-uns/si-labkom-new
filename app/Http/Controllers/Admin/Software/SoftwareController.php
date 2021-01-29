<?php

namespace App\Http\Controllers\Admin\Software;

use App\Http\Controllers\Controller;
use App\Http\Requests\SoftwareRequest;
use App\Http\Resources\SoftwareResource;
use App\Models\Software;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Inertia\Response;

class SoftwareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('Software/Index', [
            'filters' => Request::all(['search', 'trashed']),
            'software' => Software::orderBy('created_at', 'desc')
                ->filter(Request::only(['search', 'trashed']))
                ->paginate()
                ->transform(function ($software) {
                    return [
                        'id' => $software->id,
                        'nama_software' => $software->nama_software,
                        'harga_software' => number_format($software->harga_software),
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
        return Inertia::render('Software/Create');
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
            return Redirect::route('Software.index')
                ->with([
                    'name' => 'Data Software',
                    'success' => 'Berhasil Ditambahkan!'
                ]);
        } catch (Exception $exception) {
            return Redirect::route('Software.index')
                ->with([
                    'name' => 'Data Software',
                    'error' => "Gagal Ditambahkan! {$exception->getMessage()}"]);
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
     * @return Response
     */
    public function edit(Software $Software): Response
    {
        return Inertia::render('Software/Edit', [
            'software' => [
                'id' => $Software->id,
                'nama_software' => $Software->nama_software,
                'harga_software' => $Software->harga_software,
            ]
        ]);
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
            return Redirect::route('Software.index')
                ->with([
                    'name' => 'Data Software',
                    'success' => "Berhasil Diubah!"]);
        } catch (Exception $exception) {
            return Redirect::route('Software.index')
                ->with([
                    'name' => 'Data Software',
                    'error' => "Gagal Diubah! {$exception->getMessage()}"
                ]);
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
            $Software->delete();
            return Redirect::route('Software.index')
                ->with([
                    'name' => 'Data Software',
                    'success' => "Berhasil Dihapus!"]);
        } catch (Exception $exception) {
            return Redirect::route('Software.index')
                ->with([
                    'name' => 'Data Software',
                    'error' => "Gagal Dihapus! {$exception->getMessage()}"
                ]);
        }
    }

    /**
     * @param Software $Software
     * @return RedirectResponse
     */
    public function restore(Software $Software): RedirectResponse
    {
        $Software->restore();
        return Redirect::route('Software.index')
            ->with([
                'name' => 'Data Software',
                'success' => 'Berhasil Dipulihkan!'
            ]);
    }
}
