<?php

namespace App\Http\Controllers\User\SuratBebasLabkom;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Prodi;
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
use RuntimeException;
use Throwable;

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
            'Prodi' => Prodi::all()
        ];
        return view('User.SuratBebasLabkom.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|null
     */
    public function store(Request $request): ?RedirectResponse
    {
        $request->validate([
            // Mahasiswa
            'nim' => ['required', 'size:8'],
            'nama_mahasiswa' => ['required', 'string', 'max:60'],
            'id_prodi' => ['required'],
            'angkatan' => ['required'],
            'jenis_kelamin' => ['required', 'string'],
            //'kelas' => ['required', 'string', 'max:5'],
            'no_hp' => ['required', 'max:13'],
            'email' => [
                'required',
                'regex:/[a-zA-Z0-9_.]@(student\.uns\.ac\.id)$/'
            ],
            // Surat Bebas Labkom
//            'tanggal' => 'required|date',
            'proses' => 'required',
        ]);
        try {
            if (is_null(Mahasiswa::where('nim', $request->nim)->first())) {
                $mahasiswa = new Mahasiswa();
                $mahasiswa->nim = $request->nim;
                $mahasiswa->nama_mahasiswa = $request->nama_mahasiswa;
                $mahasiswa->jenis_kelamin = $request->jenis_kelamin;
                // $mahasiswa->kelas = $request->kelas;
                $mahasiswa->id_prodi = $request->id_prodi;
                $mahasiswa->angkatan = $request->angkatan;
                $mahasiswa->email = $request->email;
                $mahasiswa->no_hp = $request->no_hp;
                $mahasiswa->saveOrFail();
            } else if (SuratBebasLabkom::where('id_mahasiswa', Mahasiswa::where('nim', $request->nim)->first()->id)->first()) {
                throw new RuntimeException('Kamu sudah mengajukan permohonan sebelumnya, silakan tunggu balasan konfirmasi dari kami');              
            }
            $surat = new SuratBebasLabkom();
            $surat->id_mahasiswa = Mahasiswa::where('nim', $request->nim)->first()->id;
            $surat->tanggal = $request->tanggal;
            $surat->proses = $request->proses;
            $surat->saveOrFail();
            return Redirect::route('UserSuratBebasLabkom.index')
                ->with([
                    'name' => 'Surat Bebas Labkom',
                    'success' => 'Berhasil Diajukan!'
                ]);
        } catch (Exception $exception) {
            return Redirect::route('UserSuratBebasLabkom.index')
                ->with([
                    'name' => 'Gagal Diajukan!',
                    'error' => "{$exception->getMessage()}"
                ]);
        } catch (Throwable $exception) {
            return Redirect::route('UserSuratBebasLabkom.index')
                ->with([
                    'name' => 'Gagal Diajukan!',
                    'error' => "{$exception->getMessage()}"
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
            $template->setValue('tanggal', strftime("%d %B %Y", strtotime($SuratBebasLabkom->tanggal)));
            $filename = "{$SuratBebasLabkom->mahasiswa->nim}-SuratBebasLabkom-{$SuratBebasLabkom->mahasiswa->prodi->nama_prodi}.docx";
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
