<?php

namespace App\Http\Controllers\User\SuratBebasLabkom;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuratBebasLabkomRequest;
use App\Models\Mahasiswa;
use App\Models\SuratBebasLabkom;
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

class SuratBebasLabkomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $data = [
            'Surat' => SuratBebasLabkom::all(),
        ];
        return view('User.SuratBebasLabkom.index', $data);
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
        ];
        return view('User.SuratBebasLabkom.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SuratBebasLabkomRequest $request
     * @return RedirectResponse
     */
    public function store(SuratBebasLabkomRequest $request): ?RedirectResponse
    {
        try {
            SuratBebasLabkom::create($request->validated());
            return Redirect::route('UserSuratBebasLabkom.index')
                ->with([
                    'name' => 'Surat Bebas Labkom',
                    'success' => 'Berhasil Ditambahkan!']);
        } catch (Exception $exception) {
            return Redirect::route('UserSuratBebasLabkom.index')
                ->with([
                    'name' => 'Surat Bebas Labkom',
                    'error' => "Gagal Dihapus! {$exception->getMessage()}"
                ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SuratBebasLabkom  $suratBebasLabkom
     * @return \Illuminate\Http\Response
     */
    public function show(SuratBebasLabkom $suratBebasLabkom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuratBebasLabkom  $suratBebasLabkom
     * @return \Illuminate\Http\Response
     */
    public function edit(SuratBebasLabkom $suratBebasLabkom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SuratBebasLabkom  $suratBebasLabkom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuratBebasLabkom $suratBebasLabkom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuratBebasLabkom  $suratBebasLabkom
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratBebasLabkom $suratBebasLabkom)
    {
        //
    }

    /**
     * @param SuratBebasLabkom $SuratBebasLabkom
     * @return RedirectResponse
     */
    public function exportToWord(SuratBebasLabkom $SuratBebasLabkom): ?RedirectResponse
    {
        try {
            $template = new TemplateProcessor(public_path("/uploads/template/surat-bebas-labkom.docx"));
            setlocale(LC_ALL, 'id_ID', 'id_ID.utf8');
            $template->setValue('nama_lengkap', $SuratBebasLabkom->mahasiswa->nama_mahasiswa);
            $template->setValue('nim', $SuratBebasLabkom->mahasiswa->nim);
            $template->setValue('prodi', $SuratBebasLabkom->mahasiswa->prodi->nama_prodi);
            $template->setValue('tanggal', strftime( "%d %B %Y" , strtotime($SuratBebasLabkom->tanggal)));
            $filename = "SURAT-BEBAS-LABKOM-{$SuratBebasLabkom->mahasiswa->nim}.docx";
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
            return Redirect::route('UserSuratBebasLabkom.index');
        } catch (CopyFileException | CreateTemporaryFileException $e) {
            return Redirect::route('UserSuratBebasLabkom.index')
                ->with([
                    'name' => 'Surat Bebas Labkom',
                    'error' => "Gagal Didownload! {$e->getMessage()}"
                ]);
        }
    }
}
