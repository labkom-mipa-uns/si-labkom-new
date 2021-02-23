<?php

namespace App\Http\Controllers\Admin\PeminjamanAlat;

use App\Http\Requests\PeminjamanAlatRequest;
use App\Models\Alat;
use App\Http\Controllers\Controller;
use App\Http\Resources\PeminjamanAlatResource;
use App\Models\Mahasiswa;
use App\Models\PeminjamanAlat;
use App\Models\Transaksi;
use Exception;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use PDF;
use Illuminate\Http\RedirectResponse;
use RuntimeException;
use Throwable;

class PeminjamanAlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return InertiaResponse
     */
    public function index(): InertiaResponse
    {
        return Inertia::render('Admin/PeminjamanAlat/Index', [
            'filters' => Request::all(['search', 'trashed']),
            'peminjamanalat' => PeminjamanAlat::with(['mahasiswa', 'alat'])
                ->orderBy('created_at', 'desc')
                ->filter(Request::only(['search', 'trashed']))
                ->paginate()
                ->transform(function ($peminjamanalat) {
                    return [
                        'id' => $peminjamanalat->id,
                        'mahasiswa' => $peminjamanalat->mahasiswa,
                        'alat' => $peminjamanalat->alat,
                        'harga' => number_format( $peminjamanalat->alat->harga_alat),
                        'tanggal_pinjam' => date("d M Y", strtotime($peminjamanalat->tanggal_pinjam)),
                        'tanggal_kembali' => date("d M Y", strtotime($peminjamanalat->tanggal_kembali)),
                        'jam_pinjam' => date("H:i", strtotime($peminjamanalat->jam_pinjam)),
                        'jam_kembali' => date("H:i", strtotime($peminjamanalat->jam_kembali)),
                        'jumlah_pinjam' => $peminjamanalat->jumlah_pinjam,
                        'keperluan' => $peminjamanalat->keperluan,
                        'status' => $peminjamanalat->status,
                        'proses' => $peminjamanalat->proses,
                        'deleted_at' => $peminjamanalat->deleted_at
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
        return Inertia::render('Admin/PeminjamanAlat/Create', [
            'mahasiswa' => Mahasiswa::orderBy('nama_mahasiswa', 'asc')
                ->get()
                ->map
                ->only('id', 'nama_mahasiswa'),
            'alat' => Alat::orderBy('nama_alat', 'asc')
                ->get()
                ->map
                ->only('id', 'nama_alat'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PeminjamanAlatRequest $request
     * @return RedirectResponse
     */
    public function store(PeminjamanAlatRequest $request): ?RedirectResponse
    {
        $alat = Alat::firstWhere('id', $request->id_alat);
        try {
            if ($alat->stok_alat < $request->jumlah_pinjam):
                throw new RuntimeException('Stok alat tidak mencukupi!');
            endif;
            $peminjamanAlat = new PeminjamanAlat();
            $peminjamanAlat->id_mahasiswa = $request->id_mahasiswa;
            $peminjamanAlat->tanggal_pinjam = $request->tanggal_pinjam;
            $peminjamanAlat->jam_pinjam = $request->jam_pinjam;
            $peminjamanAlat->tanggal_kembali = $request->tanggal_kembali;
            $peminjamanAlat->jam_kembali = $request->jam_kembali;
            $peminjamanAlat->jumlah_pinjam = $request->jumlah_pinjam;
            $peminjamanAlat->id_alat = $request->id_alat;
            $peminjamanAlat->keperluan = $request->keperluan;
            $peminjamanAlat->status = $request->status;
            $peminjamanAlat->proses = $request->proses;
            $peminjamanAlat->saveOrFail();
            return Redirect::route('PeminjamanAlat.index')
                ->with([
                    'name' => 'Data Peminjam Alat',
                    'success' => 'Berhasil Ditambahkan!']);
        } catch (Exception $exception) {
            return Redirect::route('PeminjamanAlat.index')
                ->with([
                    'name' => 'Data Peminjam Alat',
                    'error' => "Gagal Ditambahkan! {$exception->getMessage()}"
                ]);
        } catch (Throwable $exception) {
            return Redirect::route('PeminjamanAlat.index')
                ->with([
                    'name' => 'Data Peminjam Alat',
                    'error' => "Gagal Ditambahkan! {$exception->getMessage()}"
                ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param PeminjamanAlat $PeminjamanAlat
     * @return PeminjamanAlatResource
     */
    public function show(PeminjamanAlat $PeminjamanAlat): PeminjamanAlatResource
    {
        return new PeminjamanAlatResource($PeminjamanAlat::with(['mahasiswa','alat'])
            ->firstWhere('id',$PeminjamanAlat->id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param PeminjamanAlat $PeminjamanAlat
     * @return InertiaResponse
     */
    public function edit(PeminjamanAlat $PeminjamanAlat): InertiaResponse
    {
        return Inertia::render('Admin/PeminjamanAlat/Edit', [
            'peminjamanalat' => [
                'id' => $PeminjamanAlat->id,
                'id_mahasiswa' => $PeminjamanAlat->id_mahasiswa,
                'mahasiswa' => $PeminjamanAlat->mahasiswa,
                'id_alat' => $PeminjamanAlat->id_alat,
                'alat' => $PeminjamanAlat->alat,
                'tanggal_pinjam' => $PeminjamanAlat->tanggal_pinjam,
                'tanggal_kembali' => $PeminjamanAlat->tanggal_kembali,
                'jam_pinjam' => $PeminjamanAlat->jam_pinjam,
                'jam_kembali' => $PeminjamanAlat->jam_kembali,
                'jumlah_pinjam' => $PeminjamanAlat->jumlah_pinjam,
                'keperluan' => $PeminjamanAlat->keperluan,
                'status' => $PeminjamanAlat->status,
                'proses' => $PeminjamanAlat->proses,
                'deleted_at' => $PeminjamanAlat->deleted_at
            ],
            'mahasiswa' => Mahasiswa::orderBy('nama_mahasiswa', 'asc')
                ->get()
                ->map
                ->only('id', 'nama_mahasiswa'),
            'alat' => Alat::orderBy('nama_alat', 'asc')
                ->get()
                ->map
                ->only('id', 'nama_alat'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PeminjamanAlatRequest $request
     * @param PeminjamanAlat $PeminjamanAlat
     * @return RedirectResponse
     */
    public function update(PeminjamanAlatRequest $request, PeminjamanAlat $PeminjamanAlat): ?RedirectResponse
    {
        try {
            $peminjamanAlat = PeminjamanAlat::findOrFail($PeminjamanAlat->id);
            $peminjamanAlat->id_mahasiswa = $request->id_mahasiswa;
            $peminjamanAlat->tanggal_pinjam = $request->tanggal_pinjam;
            $peminjamanAlat->jam_pinjam = $request->jam_pinjam;
            $peminjamanAlat->tanggal_kembali = $request->tanggal_kembali;
            $peminjamanAlat->jam_kembali = $request->jam_kembali;
            $peminjamanAlat->jumlah_pinjam = $request->jumlah_pinjam;
            $peminjamanAlat->id_alat = $request->id_alat;
            $peminjamanAlat->keperluan = $request->keperluan;
            $peminjamanAlat->status = $request->status;
            $peminjamanAlat->proses = $request->proses;
            $peminjamanAlat->saveOrFail();
            return Redirect::route('PeminjamanAlat.index')
                ->with([
                    'name' => 'Data Peminjam Alat',
                    'success' => 'Berhasil Diubah!'
                ]);
        } catch (Exception $exception) {
            return Redirect::route('PeminjamanAlat.index')
                ->with([
                    'name' => 'Data Peminjam Alat',
                    'error' => "Gagal Diubah! {$exception->getMessage()}"
                ]);
        } catch (Throwable $exception) {
            return Redirect::route('PeminjamanAlat.index')
                ->with([
                    'name' => 'Data Peminjam Alat',
                    'error' => "Gagal Diubah! {$exception->getMessage()}"
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PeminjamanAlat $PeminjamanAlat
     * @return RedirectResponse|null
     */
    public function destroy(PeminjamanAlat $PeminjamanAlat): ?RedirectResponse
    {
        try {
            $this->authorize('delete-data');
            $PeminjamanAlat->delete();
            return Redirect::route('PeminjamanAlat.index')
                ->with([
                    'name' => 'Data Peminjam Alat',
                    'success' => 'Berhasil Dihapus!']);
        } catch (Exception $exception) {
            return Redirect::route('PeminjamanAlat.index')
                ->with([
                    'name' => 'Data Peminjam Alat',
                    'error' => "Gagal Dihapus! {$exception->getMessage()}"
                ]);
        }
    }

    /**
     * @param PeminjamanAlat $PeminjamanAlat
     * @return RedirectResponse
     */
    public function restore(PeminjamanAlat $PeminjamanAlat): RedirectResponse
    {
        $PeminjamanAlat->restore();
        return Redirect::route('PeminjamanAlat.index')
            ->with([
                'name' => 'Data Peminjam Alat',
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
                    ->where('kategori', $request->kategori)->get(),
                'tanggal' => $request->tanggal
            ];
            $pdf = PDF::loadView('Invoice.Daily.PeminjamanAlat', $data)->setPaper('a4', 'landscape');
            return Inertia::location($pdf->stream("Peminjaman_Alat_Daily_Report_{$request->tanggal}.pdf"));
        } catch (Exception $exception) {
            return Redirect::route('PeminjamanAlat.index')
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
            $pdf = PDF::loadView('Invoice.Monthly.PeminjamanAlat', $data)->setPaper('a4', 'landscape');
            return $pdf->stream("Peminjaman_Alat_Monthly_Report_{$request->tanggal}.pdf");
        } catch (Exception $exception) {
            return Redirect::route('PeminjamanAlat.index')
                ->with('warning', "Silakan Coba Beberapa Saat Lagi! {$exception->getMessage()}");
        }
    }
}
