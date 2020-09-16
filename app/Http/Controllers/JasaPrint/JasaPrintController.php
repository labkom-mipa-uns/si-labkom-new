<?php

namespace App\Http\Controllers\JasaPrint;

use App\Http\Controllers\Controller;
use App\Http\Resources\JasaPrintResource;
use App\JasaPrint;
use App\Transaksi;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use PDF;

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
            return view('JasaPrint.create');
        } catch (Exception $exception) {
            return redirect()->route('JasaPrint.index')
                ->with('waning', "Silakan Coba Beberapa Saat Lagi! {$exception->getMessage()}");
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
            return redirect()->route('JasaPrint.index')
                ->with('danger', "Gagal Ditambahkan! {$exception->getMessage()}");
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
            return redirect()->route('JasaPrint.index')
                ->with('warning', "Silakan Coba Beberapa Saat Lagi! {$exception->getMessage()}");
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
            return redirect()->route('JasaPrint.index')
                ->with('danger', "Gagal Diupdate! {$exception->getMessage()}");
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
            JasaPrint::destroy($JasaPrint->id);
            return redirect()->route('JasaPrint.index')->with('success', "Berhasil Dihapus!");
        } catch (Exception $exception) {
            return redirect()->route('JasaPrint.index')
                ->with('danger', "Gagal Dihapus! {$exception->getMessage()}");
        }
    }

    /**
     * @return JasaPrintResource
     */
    public function all(): JasaPrintResource
    {
        return new JasaPrintResource(JasaPrint::all());
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function daily_report(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date'
        ]);
        try {
            $data = [
                'Transaksi' => Transaksi::with(['peminjamanalat', 'jasainstallasi', 'jasaprint'])
                    ->whereDate('tanggal', $request->tanggal)
                    ->where('kategori', $request->kategori)->get(),
                'tanggal' => $request->tanggal
            ];
            $pdf = PDF::loadView('Invoice.Daily.JasaPrint', $data)->setPaper('a4', 'landscape');
            return $pdf->stream("Jasa_Installasi_Daily_Report_{$request->tanggal}.pdf");
        } catch (Exception $exception) {
            return redirect()->route('JasaPrint.index')
                ->with('warning', "Silakan Coba Beberapa Saat Lagi! {$exception->getMessage()}");
        }
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function monthly_report(Request $request)
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
            return $pdf->stream("Jasa_Installasi_Monthly_Report_{$request->tanggal}.pdf");
        } catch (Exception $exception) {
            return redirect()->route('JasaPrint.index')
                ->with('warning', "Silakan Coba Beberapa Saat Lagi! {$exception->getMessage()}");
        }
    }
}
