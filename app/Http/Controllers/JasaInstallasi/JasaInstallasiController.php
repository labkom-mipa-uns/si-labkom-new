<?php

namespace App\Http\Controllers\JasaInstallasi;

use App\Http\Controllers\Controller;
use App\Http\Resources\JasaInstallasiResource;
use App\JasaInstallasi;
use App\Mahasiswa;
use App\Software;
use App\Transaksi;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use PDF;
use Throwable;

class JasaInstallasiController extends Controller
{
    /**
     * JasaInstallasiController constructor.
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
                'JasaInstallasi' => JasaInstallasi::with(['mahasiswa', 'software'])
                    ->orderBy('created_at', 'desc')
                    ->paginate(8)
            ];
            return view('JasaInstallasi.index', $data);
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
            $data = [
                'Mahasiswa' => Mahasiswa::orderBy('nama_mahasiswa', 'asc')->get(),
                'Software' => Software::orderBy('nama_software', 'asc')->get()
            ];
            return view('JasaInstallasi.create', $data);
        } catch (Exception $exception) {
            return redirect()->route('JasaInstallasi.index')
                ->with('warning', "Silakan Coba Beberapa Saat Lagi! {$exception->getMessage()}");
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
            'id_mahasiswa' => 'required',
            'laptop' => 'required|string|max:50',
            'kelengkapan' => 'required|string',
            'tanggal' => 'required|date',
            'id_software' => 'required',
            'jenis' => 'required',
            'keterangan' => 'required',
            'jam_ambil' => 'required'
        ]);
        try {
            $jasaInstallasi = new JasaInstallasi();
            $jasaInstallasi->id_mahasiswa = $request->id_mahasiswa;
            $jasaInstallasi->laptop = $request->laptop;
            $jasaInstallasi->kelengkapan = $request->kelengkapan;
            $jasaInstallasi->tanggal = $request->tanggal;
            $jasaInstallasi->id_software = $request->id_software;
            $jasaInstallasi->jenis = $request->jenis;
            $jasaInstallasi->keterangan = $request->keterangan;
            $jasaInstallasi->jam_ambil = $request->jam_ambil;
            $jasaInstallasi->saveOrFail();
            return redirect()->route('JasaInstallasi.index')->with('success', "Berhasil Ditambahkan!");
        } catch (Exception $exception) {
            return redirect()->route('JasaInstallasi.index')
                ->with('danger', "Gagal Ditambahkan! {$exception->getMessage()}");
        } catch (Throwable $exception) {
            return redirect()->route('JasaInstallasi.index')
                ->with('danger', "Gagal Ditambahkan! {$exception->getMessage()}");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param JasaInstallasi $JasaInstallasi
     * @return JasaInstallasiResource
     */
    public function show(JasaInstallasi $JasaInstallasi): JasaInstallasiResource
    {
        return new JasaInstallasiResource($JasaInstallasi::with(['mahasiswa', 'software'])
            ->firstWhere('id',$JasaInstallasi->id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param JasaInstallasi $JasaInstallasi
     * @return Application|Factory|RedirectResponse|Response|View
     */
    public function edit(JasaInstallasi $JasaInstallasi)
    {
        try {
            $data = [
                'JasaInstallasi' => $JasaInstallasi::with(['mahasiswa', 'software'])
                    ->firstWhere('id',$JasaInstallasi->id),
                'Mahasiswa' => Mahasiswa::orderBy('nama_mahasiswa', 'asc')->get(),
                'Software' => Software::orderBy('nama_software', 'asc')->get()
            ];
            return view('JasaInstallasi.edit', $data);
        } catch (Exception $exception) {
            return redirect()->route('JasaInstallasi.index')
                ->with('warning', "Silakan Coba Beberapa Saat Lagi! {$exception->getMessage()}");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param JasaInstallasi $JasaInstallasi
     * @return RedirectResponse
     */
    public function update(Request $request, JasaInstallasi $JasaInstallasi): ?RedirectResponse
    {
        $request->validate([
            'id_mahasiswa' => 'required',
            'laptop' => 'required|string|max:50',
            'kelengkapan' => 'required|string',
            'tanggal' => 'required|date',
            'id_software' => 'required',
            'jenis' => 'required',
            'keterangan' => 'required',
            'jam_ambil' => 'required'
        ]);
        try {
            $jasaInstallasi = JasaInstallasi::findOrFail($JasaInstallasi->id);
            $jasaInstallasi->id_mahasiswa = $request->id_mahasiswa;
            $jasaInstallasi->laptop = $request->laptop;
            $jasaInstallasi->kelengkapan = $request->kelengkapan;
            $jasaInstallasi->tanggal = $request->tanggal;
            $jasaInstallasi->id_software = $request->id_software;
            $jasaInstallasi->jenis = $request->jenis;
            $jasaInstallasi->keterangan = $request->keterangan;
            $jasaInstallasi->jam_ambil = $request->jam_ambil;
            $jasaInstallasi->saveOrFail();
            return redirect()->route('JasaInstallasi.index')->with('success', "Berhasil Diupdate!");
        } catch (Exception $exception) {
            return redirect()->route('JasaInstallasi.index')
                ->with('danger', "Gagal Diupdate! {$exception->getMessage()}");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param JasaInstallasi $JasaInstallasi
     * @return RedirectResponse
     */
    public function destroy(JasaInstallasi $JasaInstallasi): ?RedirectResponse
    {
        try {
            $this->authorize('delete-data');
            JasaInstallasi::destroy($JasaInstallasi->id);
            return redirect()->route('JasaInstallasi.index')->with('success', "Berhasil Dihapus!");
        } catch (Exception $exception) {
            return redirect()->route('JasaInstallasi.index')
                ->with('danger', "Gagal Dihapus! {$exception->getMessage()}");
        }
    }

    /**
     * @return JasaInstallasiResource
     */
    public function all(): JasaInstallasiResource
    {
        return new JasaInstallasiResource(JasaInstallasi::with(['mahasiswa', 'software'])->get());
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
            $pdf = PDF::loadView('Invoice.Daily.JasaInstallasi', $data)->setPaper('a4', 'landscape');
            return $pdf->stream("Jasa_Installasi_Daily_Report_{$request->tanggal}.pdf");
        } catch (Exception $exception) {
            return redirect()->route('JasaInstallasi.index')
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
            $pdf = PDF::loadView('Invoice.Monthly.JasaInstallasi', $data)->setPaper('a4', 'landscape');
            return $pdf->stream("Jasa_Installasi_Monthly_Report_{$request->tanggal}.pdf");
        } catch (Exception $exception) {
            return redirect()->route('JasaInstallasi.index')
                ->with('warning', "Silakan Coba Beberapa Saat Lagi! {$exception->getMessage()}");
        }
    }
}
