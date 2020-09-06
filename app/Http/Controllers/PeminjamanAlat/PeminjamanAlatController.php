<?php

namespace App\Http\Controllers\PeminjamanAlat;

use App\Alat;
use App\Http\Controllers\Controller;
use App\Http\Resources\PeminjamanAlatResource;
use App\Mahasiswa;
use App\PeminjamanAlat;
use App\Transaksi;
use Exception;
use Illuminate\View\Factory;
use Illuminate\View\View;
use PDF;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use RuntimeException;
use Throwable;

class PeminjamanAlatController extends Controller
{
    /**
     * PeminjamanAlatController constructor.
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
                'PeminjamanAlat' => PeminjamanAlat::with(['alat','mahasiswa'])
                    ->orderBy('created_at', 'desc')
                    ->paginate(8)
            ];
            return view('PeminjamanAlat.index', $data);
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
            $data = [
                'Mahasiswa' => Mahasiswa::orderBy('nama_mahasiswa', 'asc')->get(),
                'Alat' => Alat::orderBy('nama_alat', 'asc')->get()
            ];
            return view('PeminjamanAlat.create', $data);
        } catch (Exception $exception) {
            return redirect()->route('PeminjamanAlat.index')
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
            'id_alat' => 'required',
            'tanggal_pinjam' => 'required|date',
            'jam_pinjam' => 'required',
            'jam_kembali' => 'required',
            'tanggal_kembali' => 'required|date',
            'jumlah_pinjam' => 'required|numeric',
            'keperluan' => 'required|string',
            'status' => 'required'
        ]);
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
            $peminjamanAlat->saveOrFail();
            return redirect()->route('PeminjamanAlat.index')->with('success', "Berhasil Ditambahkan!");
        } catch (Exception $exception) {
            return redirect()->route('PeminjamanAlat.index')
                ->with('danger', "Gagal Ditambahkan! {$exception->getMessage()}");
        } catch (Throwable $exception) {
            return redirect()->route('PeminjamanAlat.index')
                ->with('danger', "Gagal Ditambahkan! {$exception->getMessage()}");
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
     * @return Application|Factory|RedirectResponse|Response|View
     */
    public function edit(PeminjamanAlat $PeminjamanAlat)
    {
        try {
            $data = [
                'PeminjamanAlat' => $PeminjamanAlat::with(['alat','mahasiswa'])
                    ->firstWhere('id',$PeminjamanAlat->id),
                'Mahasiswa' => Mahasiswa::orderBy('nama_mahasiswa', 'asc')->get(),
                'Alat' => Alat::orderBy('nama_alat', 'asc')->get()
            ];
            return view('PeminjamanAlat.edit', $data);
        } catch (Exception $exception) {
            return redirect()->route('PeminjamanAlat.index')
                ->with('warning', "Silakan Coba Beberapa Saat Lagi! {$exception->getMessage()}");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param PeminjamanAlat $PeminjamanAlat
     * @return RedirectResponse
     */
    public function update(Request $request, PeminjamanAlat $PeminjamanAlat): ?RedirectResponse
    {
        $request->validate([
            'id_mahasiswa' => 'required',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date',
            'jam_pinjam' => 'required',
            'jam_kembali' => 'required',
            'id_alat' => 'required',
            'keperluan' => 'required|string',
            'status' => 'required'
        ]);
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
            $peminjamanAlat->saveOrFail();
            return redirect()->route('PeminjamanAlat.index')->with('success', "Berhasil Diupdate!");
        } catch (Exception $exception) {
            return redirect()->route('PeminjamanAlat.index')->with('danger', "Gagal Diupdate! {$exception->getMessage()}");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PeminjamanAlat $PeminjamanAlat
     * @return RedirectResponse
     */
    public function destroy(PeminjamanAlat $PeminjamanAlat): ?RedirectResponse
    {
        try {
            $this->authorize('delete-data');
            PeminjamanAlat::destroy($PeminjamanAlat->id);
            return redirect()->route('PeminjamanAlat.index')->with('success', "Berhasil Dihapus!");
        } catch (Exception $exception) {
            return redirect()->route('PeminjamanAlat.index')->with('danger', "Gagal Dihapus! {$exception->getMessage()}");
        }
    }

    /**
     * @return PeminjamanAlatResource
     */
    public function all(): PeminjamanAlatResource
    {
        return new PeminjamanAlatResource(PeminjamanAlat::with(['alat','mahasiswa'])->get());
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
            $pdf = PDF::loadView('Invoice.Daily.PeminjamanAlat', $data)->setPaper('a4', 'landscape');
            return $pdf->stream("Peminjaman_Alat_Daily_Report_{$request->tanggal}.pdf");
        } catch (Exception $exception) {
            return redirect()->route('PeminjamanAlat.index')
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
            $pdf = PDF::loadView('Invoice.Monthly.PeminjamanAlat', $data)->setPaper('a4', 'landscape');
            return $pdf->stream("Peminjaman_Alat_Monthly_Report_{$request->tanggal}.pdf");
        } catch (Exception $exception) {
            return redirect()->route('PeminjamanAlat.index')
                ->with('warning', "Silakan Coba Beberapa Saat Lagi! {$exception->getMessage()}");
        }
    }
}
