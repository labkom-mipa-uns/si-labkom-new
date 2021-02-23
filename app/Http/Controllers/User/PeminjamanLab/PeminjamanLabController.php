<?php

namespace App\Http\Controllers\User\PeminjamanLab;

use App\Http\Controllers\Controller;
use App\Http\Requests\PeminjamanLabRequest;
use App\Models\Jadwal;
use App\Models\Lab;
use App\Models\Mahasiswa;
use App\Models\PeminjamanLab;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use PhpOffice\PhpWord\Exception\CopyFileException;
use PhpOffice\PhpWord\Exception\CreateTemporaryFileException;
use PhpOffice\PhpWord\TemplateProcessor;

class PeminjamanLabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $data = [
            'PeminjamanLab' => PeminjamanLab::with(['mahasiswa', 'jadwal', 'lab'])->get()
        ];
        return view('User.PeminjamanLab.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $data = [
            'Mahasiswa' => Mahasiswa::all(),
            'Lab' => Lab::all(),
            'Jadwal' => Jadwal::with(['prodi', 'dosen', 'matakuliah'])->get()
        ];
        return view('User.PeminjamanLab.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PeminjamanLabRequest $request
     * @return RedirectResponse
     */
    public function store(PeminjamanLabRequest $request): ?RedirectResponse
    {
        try {
            PeminjamanLab::create($request->validated());
            return Redirect::route('UserPeminjamanLab.index')
                ->with([
                    'name' => 'Data Peminjam Lab',
                    'success' => 'Berhasil Ditambahkan!']);
        } catch (Exception $exception) {
            return Redirect::route('UserPeminjamanLab.index')
                ->with([
                    'name' => 'Data Peminjam Lab',
                    'error' => "Gagal Ditambahkan! {$exception->getMessage()}"
                ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param PeminjamanLab $PeminjamanLab
     * @return RedirectResponse
     */
    public function exportToWord(PeminjamanLab $PeminjamanLab): RedirectResponse
    {
        try {
            $template = new TemplateProcessor(public_path("/uploads/template/surat-peminjaman-lab.docx"));
            setlocale(LC_ALL, 'id_ID', 'id_ID.utf8');
            $today = strftime( "%d %B %Y" , time());
            $template->setValue('nama_lengkap', $PeminjamanLab->mahasiswa->nama_mahasiswa);
            $template->setValue('nim', $PeminjamanLab->mahasiswa->nim);
            $template->setValue('no_wa', $PeminjamanLab->mahasiswa->no_hp);
            $template->setValue('keperluan', $PeminjamanLab->keperluan);
            $template->setValue('nama_lab', $PeminjamanLab->lab->nama_lab);
            $template->setValue('tanggal', strftime( "%d %B %Y" , strtotime($PeminjamanLab->tanggal)));
            $template->setValue('jam_pinjam', date("H.i", strtotime($PeminjamanLab->jam_pinjam)));
            $template->setValue('jam_kembali', date("H.i", strtotime($PeminjamanLab->jam_kembali)));
            $template->setValue('today', $today);
            $filename = "SURAT-PEMINJAMAN-LAB-{$PeminjamanLab->mahasiswa->nim}.docx";
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
            return Redirect::route('UserPeminjamanLab.index');
        } catch (CopyFileException | CreateTemporaryFileException $e) {
            return Redirect::route('UserPeminjamanLab.index')
                ->with([
                    'name' => 'Surat Peminjaman Lab',
                    'error' => "Gagal Didownload! {$e->getMessage()}"
                ]);
        }
    }
}
