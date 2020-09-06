<?php

namespace App\Http\Controllers\Dosen;

use App\Dosen;
use App\Http\Controllers\Controller;
use App\Http\Requests\DosenRequest;
use App\Http\Resources\DosenResource;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DosenController extends Controller
{
    /**
     * DosenController constructor.
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
                'Dosen' => Dosen::orderBy('created_at', 'desc')->paginate(8),
            ];
            return view('Dosen.index', $data);
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
            return view('Dosen.create');
        } catch (Exception $exception) {
            return redirect()->route('Dosen.index')
                ->with('warning', "Silakan Coba Beberapa Saat Lagi!");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DosenRequest $request
     * @return RedirectResponse
     */
    public function store(DosenRequest $request): ?RedirectResponse
    {
        try {
            Dosen::create($request->validated());
            return redirect()->route('Dosen.index')
                ->with('success',"Berhasil Ditambahkan!");
        } catch (Exception $exception) {
            return redirect()->route('Dosen.index')
                ->with('danger',"Gagal Ditambahkan! {$exception->getMessage()}");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Dosen $Dosen
     * @return DosenResource
     */
    public function show(Dosen $Dosen): DosenResource
    {
        return new DosenResource($Dosen);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Dosen $Dosen
     * @return Application|Factory|RedirectResponse|View
     */
    public function edit(Dosen $Dosen)
    {
        try {
            $data = [
                'Dosen' => $Dosen
            ];
            return view('Dosen.edit', $data);
        } catch (Exception $exception) {
            return redirect()->route('Dosen.index')
                ->with('warning', "Silakan Coba Beberapa Saat Lagi! {$exception->getMessage()}");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DosenRequest $request
     * @param Dosen $Dosen
     * @return RedirectResponse
     */
    public function update(DosenRequest $request, Dosen $Dosen): ?RedirectResponse
    {
        try {
            $Dosen->update($request->validated());
            return redirect()->route('Dosen.index')
                ->with('success', "Berhasil Diupdate!");
        } catch (Exception $exception) {
            return redirect()->route('Dosen.index')
                ->with('danger', "Gagal Diupdate! {$exception->getMessage()}");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Dosen $Dosen
     * @return RedirectResponse
     */
    public function destroy(Dosen $Dosen): ?RedirectResponse
    {
        try {
            $this->authorize('delete-data');
            Dosen::destroy($Dosen->id);
            return redirect()->route('Dosen.index')
                ->with('success', "Berhasil Dihapus!");
        } catch (Exception $exception) {
            return redirect()->route('Dosen.index')
                ->with('danger', "Gagal Dihapus! {$exception->getMessage()}");
        }
    }

    /**
     * @return DosenResource
     */
    public function all(): DosenResource
    {
        return new DosenResource(Dosen::all());
    }
}
