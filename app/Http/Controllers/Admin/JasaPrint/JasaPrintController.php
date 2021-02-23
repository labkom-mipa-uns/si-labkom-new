<?php

namespace App\Http\Controllers\Admin\JasaPrint;

use App\Http\Controllers\Controller;
use App\Http\Requests\JasaPrintRequest;
use App\Http\Resources\JasaPrintResource;
use App\Models\JasaPrint;
use App\Models\Transaksi;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as HttpRequest;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use PDF;
use Throwable;

class JasaPrintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return InertiaResponse
     */
    public function index(): InertiaResponse
    {
        return Inertia::render('Admin/JasaPrint/Index', [
            'filters' => Request::all(['search', 'trashed']),
            'jasaprint' => JasaPrint::orderBy('created_at', 'desc')
                ->filter(Request::only(['search', 'trashed']))
                ->paginate()
                ->transform(function ($jasaprint) {
                    return [
                        'id' => $jasaprint->id,
                        'jenis_print' => $jasaprint->jenis_print,
                        'harga_print' => number_format($jasaprint->harga_print),
                        'jumlah_print' => $jasaprint->jumlah_print,
                        'tanggal_print' => date('d M Y', strtotime($jasaprint->tanggal_print)),
                        'deleted_at' => $jasaprint->deleted_at
                    ];
                })
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return InertiaResponse
     */
    public function create(): InertiaResponse
    {
        return Inertia::render('Admin/JasaPrint/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param JasaPrintRequest $request
     * @return RedirectResponse
     */
    public function store(JasaPrintRequest $request): ?RedirectResponse
    {
        try {
            $jasaPrint = new JasaPrint();
            $jasaPrint->jenis_print = $request->jenis_print;
            $jasaPrint->harga_print = $request->harga_print;
            $jasaPrint->jumlah_print = $request->jumlah_print;
            $jasaPrint->tanggal_print = $request->tanggal_print;
            $jasaPrint->saveOrFail();
            return Redirect::route('JasaPrint.index')
                ->with([
                    'name' => 'Data Print',
                    'success' => 'Berhasil Ditambahkan!'
                ]);
        } catch (Exception $exception) {
            return Redirect::route('JasaPrint.index')
                ->with([
                    'name' => 'Data Print',
                    'error' => "Gagal Ditambahkan! {$exception->getMessage()}"]);
        } catch (Throwable $exception) {
            return Redirect::route('JasaPrint.index')
                ->with([
                    'name' => 'Data Print',
                    'error' => "Gagal Ditambahkan! {$exception->getMessage()}"]);
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
     * @return InertiaResponse
     */
    public function edit(JasaPrint $JasaPrint): InertiaResponse
    {
        return Inertia::render('Admin/JasaPrint/Edit', [
            'jasaprint' => [
                'id' => $JasaPrint->id,
                'jenis_print' => $JasaPrint->jenis_print,
                'harga_print' => $JasaPrint->harga_print,
                'jumlah_print' => $JasaPrint->jumlah_print,
                'tanggal_print' => $JasaPrint->tanggal_print,
                'deleted_at' => $JasaPrint->deleted_at
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param JasaPrintRequest $request
     * @param JasaPrint $JasaPrint
     * @return RedirectResponse
     */
    public function update(JasaPrintRequest $request, JasaPrint $JasaPrint): ?RedirectResponse
    {
        try {
            $jasaPrint = JasaPrint::findOrFail($JasaPrint->id);
            $jasaPrint->jenis_print = $request->jenis_print;
            $jasaPrint->harga_print = $request->harga_print;
            $jasaPrint->jumlah_print = $request->jumlah_print;
            $jasaPrint->tanggal_print = $request->tanggal_print;
            $jasaPrint->saveOrFail();
            return Redirect::route('JasaPrint.index')
                ->with([
                    'name' => 'Data Print',
                    'success' => "Berhasil Diubah!"]);
        } catch (Exception $exception) {
            return Redirect::route('JasaPrint.index')
                ->with([
                    'name' => 'Data Print',
                    'error' => "Gagal Diubah! {$exception->getMessage()}"
                ]);
        } catch (Throwable $exception) {
            return Redirect::route('JasaPrint.index')
                ->with([
                    'name' => 'Data Print',
                    'error' => "Gagal Diubah! {$exception->getMessage()}"
                ]);
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
            $this->authorize('delete-data');
            $JasaPrint->delete();
            return Redirect::route('JasaPrint.index')
                ->with([
                    'name' => 'Data Print',
                    'success' => "Berhasil Dihapus!"
                ]);
        } catch (Exception $exception) {
            return Redirect::route('JasaPrint.index')
                ->with([
                    'name' => 'Data Print',
                    'error' => "Gagal Dihapus! {$exception->getMessage()}"
                ]);
        }
    }

    /**
     * @param JasaPrint $JasaPrint
     * @return RedirectResponse
     */
    public function restore(JasaPrint $JasaPrint): RedirectResponse
    {
        $JasaPrint->restore();
        return Redirect::route('JasaPrint.index')
            ->with([
                'name' => 'Data Print',
                'success' => 'Berhasil Dipulihkan!'
            ]);
    }

    /**
     * @param HttpRequest $request
     * @return RedirectResponse|HttpResponse
     */
    public function daily_report(HttpRequest $request)
    {
        $request->validate([
            'tanggal' => 'required|date'
        ]);
        try {
            $data = [
                'Transaksi' => Transaksi::with(['peminjamanalat', 'jasainstallasi', 'jasaprint'])
                    ->whereDate('tanggal', $request->tanggal)
                    ->where('kategori', '=', 'jasa_print')->get(),
                'tanggal' => $request->tanggal
            ];
            $pdf = PDF::loadView('Invoice.Daily.JasaPrint', $data)->setPaper('a4', 'landscape');
            return Inertia::location($pdf->stream("Jasa_Installasi_Daily_Report_{$request->tanggal}.pdf"))->h;
        } catch (Exception $exception) {
            return Redirect::route('JasaPrint.index')
                ->with('warning', "Silakan Coba Beberapa Saat Lagi! {$exception->getMessage()}");
        }
    }

    /**
     * @param HttpRequest $request
     * @return RedirectResponse|HttpResponse
     */
    public function monthly_report(HttpRequest $request)
    {
        $request->validate([
            'bulan' => 'required'
        ]);
        try {
            $data = [
                'Transaksi' => Transaksi::with(['peminjamanalat', 'jasainstallasi', 'jasaprint'])
                    ->whereMonth('tanggal', $request->bulan)
                    ->where('kategori', $request->kategori)->get(),
                'bulan' => $request->bulan
            ];
            $pdf = PDF::loadView('Invoice.Monthly.JasaPrint', $data)->setPaper('a4', 'landscape');
            return Inertia::location($pdf->stream("Jasa_Installasi_Monthly_Report_{$request->tanggal}.pdf"));
        } catch (Exception $exception) {
            return Redirect::route('JasaPrint.index')
                ->with('warning', "Silakan Coba Beberapa Saat Lagi! {$exception->getMessage()}");
        }
    }
}
