<?php

namespace App\Http\Controllers\User\PeminjamanAlat;

use App\Http\Controllers\Controller;
use App\Http\Requests\PeminjamanAlatRequest;
use App\Models\Alat;
use App\Models\Mahasiswa;
use App\Models\PeminjamanAlat;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use PhpOffice\PhpWord\Exception\CopyFileException;
use PhpOffice\PhpWord\Exception\CreateTemporaryFileException;
use PhpOffice\PhpWord\TemplateProcessor;
use Throwable;

class PeminjamanAlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $data = [
            'PeminjamanAlat' => PeminjamanAlat::with(['mahasiswa', 'alat'])->get()
        ];
        return view('User.PeminjamanAlat.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        $data = [
            'Mahasiswa' => Mahasiswa::all(),
            'Alat' => Alat::all(),
        ];
        return view('User.PeminjamanAlat.create', $data);
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
            return Redirect::route('UserPeminjamanAlat.index')
                ->with([
                    'name' => 'Data Peminjam Alat',
                    'success' => 'Berhasil Ditambahkan!']);
        } catch (Exception | Throwable $exception) {
            return Redirect::route('UserPeminjamanAlat.index')
                ->with([
                    'name' => 'Data Peminjam Alat',
                    'error' => "Gagal Ditambahkan! {$exception->getMessage()}"
                ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param PeminjamanAlat $PeminjamanAlat
     * @return RedirectResponse
     */
    public function exportToWord(PeminjamanAlat $PeminjamanAlat): ?RedirectResponse
    {
        try {
            $template = new TemplateProcessor(public_path("/uploads/template/surat-peminjaman-alat.docx"));
            setlocale(LC_ALL, 'id_ID', 'id_ID.utf8');
            $today = strftime( "%d %B %Y" , time());
            $template->setValue('nama_lengkap', $PeminjamanAlat->mahasiswa->nama_mahasiswa);
            $template->setValue('nim', $PeminjamanAlat->mahasiswa->nim);
            $template->setValue('prodi', $PeminjamanAlat->mahasiswa->prodi->nama_prodi);
            $template->setValue('no_wa', $PeminjamanAlat->mahasiswa->no_hp);
            $template->setValue('keperluan', $PeminjamanAlat->keperluan);
            $template->setValue('nama_alat', $PeminjamanAlat->alat->nama_alat);
            $template->setValue('jumlah_alat', $PeminjamanAlat->alat->jumlah_alat);
            $template->setValue('tanggal_pinjam', strftime( "%d %B %Y" , strtotime($PeminjamanAlat->tanggal_pinjam)));
            $template->setValue('tanggal_kembali', strftime( "%d %B %Y" , strtotime($PeminjamanAlat->tanggal_kembali)));
            $template->setValue('jam_pinjam', date("H.i", strtotime($PeminjamanAlat->jam_pinjam)));
            $template->setValue('jam_kembali', date("H.i", strtotime($PeminjamanAlat->jam_kembali)));
            $template->setValue('today', $today);
            $filename = "SURAT-PEMINJAMAN-ALAT-{$PeminjamanAlat->mahasiswa->nim}.docx";
            header("Content-Description: File Transfer");
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
            header('Content-Transfer-Encoding: binary');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Expires: 0');
            $template->saveAs($filename);
            flush();
            readfile($filename);
            unlink($filename);
            return Redirect::route('UserPeminjamanAlat.index');
        } catch (CopyFileException | CreateTemporaryFileException $e) {
            return Redirect::route('UserPeminjamanAlat.index')
                ->with([
                    'name' => 'Surat Peminjaman Alat',
                    'error' => "Gagal Didownload! {$e->getMessage()}"
                ]);
        }
    }
}
