<?php

namespace App\Http\Controllers\Admin\JasaInstallasi;

use App\Http\Controllers\Controller;
use App\Http\Requests\JasaInstallasiRequest;
use App\Http\Resources\JasaInstallasiResource;
use App\Models\JasaInstallasi;
use App\Models\Mahasiswa;
use App\Models\Software;
use App\Models\Transaksi;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use PDF;
use Throwable;

class JasaInstallasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return InertiaResponse
     */
    public function index(): InertiaResponse
    {
        return Inertia::render('JasaInstallasi/Index', [
            'filters' => Request::all(['search', 'trashed']),
            'jasainstallasi' => JasaInstallasi::orderBy('created_at', 'desc')
                ->filter(Request::only(['search', 'trashed']))
                ->paginate()
                ->transform(function ($jasainstallasi) {
                    return [
                        'id' => $jasainstallasi->id,
                        'laptop' => $jasainstallasi->laptop,
                        'kelengkapan' => $jasainstallasi->kelengkapan,
                        'tanggal' => $jasainstallasi->tanggal,
                        'mahasiswa' => $jasainstallasi->mahasiswa,
                        'id_software' => $jasainstallasi->id_software,
                        'software' => $jasainstallasi->software,
                        'jenis' => $jasainstallasi->jenis,
                        'keterangan' => $jasainstallasi->keterangan,
                        'jam_ambil' => $jasainstallasi->jam_ambil,
                        'deleted_at' => $jasainstallasi->deleted_at
                    ];
                })
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return Inertia::render('JasaInstallasi/Create', [
            'mahasiswa' => Mahasiswa::orderBy('nama_mahasiswa', 'asc')
                ->get()
                ->map
                ->only('id', 'nama_mahasiswa'),
            'software' => Software::orderBy('nama_software', 'asc')
                ->get()
                ->map
                ->only('id', 'nama_software')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param JasaInstallasiRequest $request
     * @return RedirectResponse
     */
    public function store(JasaInstallasiRequest $request): ?RedirectResponse
    {
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
            return Redirect::route('JasaInstallasi.index')
                ->with([
                    'name' => 'Data Installasi',
                    'success' => 'Berhasil Ditambahkan!'
                ]);
        } catch (Exception $exception) {
            return Redirect::route('JasaInstallasi.index')
                ->with([
                    'name' => 'Data Installasi',
                    'error' => "Gagal Ditambahkan! {$exception->getMessage()}"]);
        } catch (Throwable $exception) {
            return Redirect::route('JasaInstallasi.index')
                ->with([
                    'name' => 'Data Installasi',
                    'error' => "Gagal Ditambahkan! {$exception->getMessage()}"]);
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
     * @return InertiaResponse
     */
    public function edit(JasaInstallasi $JasaInstallasi): InertiaResponse
    {
        return Inertia::render('JasaInstallasi/Edit', [
            'jasainstallasi' => [
                'id' => $JasaInstallasi->id,
                'laptop' => $JasaInstallasi->laptop,
                'kelengkapan' => $JasaInstallasi->kelengkapan,
                'tanggal' => $JasaInstallasi->tanggal,
                'id_software' => $JasaInstallasi->id_software,
                'id_mahasiswa' => $JasaInstallasi->id_mahasiswa,
                'mahasiswa' => $JasaInstallasi->mahasiswa,
                'software' => $JasaInstallasi->software,
                'jenis' => $JasaInstallasi->jenis,
                'keterangan' => $JasaInstallasi->keterangan,
                'jam_ambil' => $JasaInstallasi->jam_ambil,
                'deleted_at' => $JasaInstallasi->deleted_at
            ],
            'mahasiswa' => Mahasiswa::orderBy('nama_mahasiswa', 'asc')
                ->get()
                ->map
                ->only('id', 'nama_mahasiswa'),
            'software' => Software::orderBy('nama_software', 'asc')
                ->get()
                ->map
                ->only('id', 'nama_software')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param JasaInstallasiRequest $request
     * @param JasaInstallasi $JasaInstallasi
     * @return RedirectResponse
     */
    public function update(JasaInstallasiRequest $request, JasaInstallasi $JasaInstallasi): ?RedirectResponse
    {
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
            return Redirect::route('JasaInstallasi.index')
                ->with([
                    'name' => 'Data Installasi',
                    'success' => "Berhasil Diubah!"]);
        } catch (Exception $exception) {
            return Redirect::route('JasaInstallasi.index')
                ->with([
                    'name' => 'Data Installasi',
                    'error' => "Gagal Diubah! {$exception->getMessage()}"
                ]);
        } catch (Throwable $exception) {
            return Redirect::route('JasaInstallasi.index')
                ->with([
                    'name' => 'Data Installasi',
                    'error' => "Gagal Diubah! {$exception->getMessage()}"
                ]);
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
            $JasaInstallasi->delete();
            return Redirect::route('JasaInstallasi.index')
                ->with([
                    'name' => 'Data Installasi',
                    'success' => "Berhasil Dihapus!"
                ]);
        } catch (Exception $exception) {
            return Redirect::route('JasaInstallasi.index')
                ->with([
                    'name' => 'Data Installasi',
                    'error' => "Gagal Dihapus! {$exception->getMessage()}"
                ]);
        }
    }

    /**
     * @param JasaInstallasi $JasaInstallasi
     * @return RedirectResponse
     */
    public function restore(JasaInstallasi $JasaInstallasi): RedirectResponse
    {
        $JasaInstallasi->restore();
        return Redirect::route('JasaInstallasi.index')
            ->with([
                'name' => 'Data Installasi',
                'success' => 'Berhasil Dipulihkan!'
            ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|HttpResponse
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
            return Inertia::location($pdf->stream("Jasa_Installasi_Daily_Report_{$request->tanggal}.pdf"));
        } catch (Exception $exception) {
            return Redirect::route('JasaInstallasi.index')
                ->with('warning', "Silakan Coba Beberapa Saat Lagi! {$exception->getMessage()}");
        }
    }

    /**
     * @param Request $request
     * @return RedirectResponse|HttpResponse
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
            return Inertia::location($pdf->stream("Jasa_Installasi_Monthly_Report_{$request->tanggal}.pdf"));
        } catch (Exception $exception) {
            return Redirect::route('JasaInstallasi.index')
                ->with('warning', "Silakan Coba Beberapa Saat Lagi! {$exception->getMessage()}");
        }
    }
}
