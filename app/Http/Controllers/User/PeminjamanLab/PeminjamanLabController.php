<?php

namespace App\Http\Controllers\User\PeminjamanLab;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Lab;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\PeminjamanLab;
use App\Models\Prodi;
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

class PeminjamanLabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): Factory|View|Application
    {
        $data = [
            'PeminjamanLab' => PeminjamanLab::with(['mahasiswa', 'lab'])->get()
        ];
        return view('User.PeminjamanLab.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): Factory|View|Application
    {
        $data = [
            'Mahasiswa' => Mahasiswa::all(),
            'Prodi' => Prodi::all(),
            'Lab' => Lab::all(),
        ];
        return view('User.PeminjamanLab.create', $data);
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
            'nim' => ['required','size:8'],
            'nama_mahasiswa' => ['required','string','max:60'],
            'id_prodi' => ['required'],
            'angkatan' => ['required'],
            'jenis_kelamin' => ['required','string'],
            'kelas' => ['required','string','max:5'],
            'no_hp' => ['required','max:13'],
            'email' => ['required','regex:/^[A-Za-z0-9\.]*@(student)[.](uns.ac.id)$/'],
            // Dosen
            'nidn' => 'required|string',
            'nama_dosen' => 'required|string|max:60',
            // Mata Kuliah
            'kode_mk' => 'required',
            'nama_matkul' => 'required|string|max:55',
            // Peminjaman Lab
            'id_lab' => 'required',
            'tanggal' => 'required|date',
            'jam_pinjam' => 'required',
            'jam_kembali' => 'required',
            'kategori' => 'required|string',
            'keperluan' => 'required|string',
            'proses' => 'required|string',
            'status' => 'required|string',
        ]);
        try {
//            if (now() === date($request->tanggal) || time() + (time() + 7) >= 4) {
//                throw new RuntimeException('Booking lab paling lambat 3 hari sebelum hari peminjaman!');
//            }
//            if (PeminjamanLab::with(['mahasiswa', 'dosen', 'matakuliah'])
//                ->whereDate('tanggal', $request->tanggal)
//                ->whereTime('jam_kembali','>=', $request->jam_pinjam)
//                ->whereTime('jam_pinjam', '<=', $request->jam_kembali)
//                ->where('status', '=', '0')
//            ) {
//                throw new RuntimeException('Lab Sedang Dipinjam!');
//            }
            if (is_null(Mahasiswa::where('nim', $request->nim)->first())) {
                $mahasiswa = new Mahasiswa();
                $mahasiswa->nim = $request->nim;
                $mahasiswa->nama_mahasiswa = $request->nama_mahasiswa;
                $mahasiswa->jenis_kelamin = $request->jenis_kelamin;
                $mahasiswa->kelas = $request->kelas;
                $mahasiswa->id_prodi = $request->id_prodi;
                $mahasiswa->angkatan = $request->angkatan;
                $mahasiswa->email = $request->email;
                $mahasiswa->no_hp = $request->no_hp;
                $mahasiswa->saveOrFail();
            }
            if (is_null(Dosen::where('nidn', $request->nidn)->first())) {
                $dosen = new Dosen();
                $dosen->nidn = $request->nidn;
                $dosen->nama_dosen = $request->nama_dosen;
                $dosen->saveOrFail();
            }
            if (is_null(MataKuliah::where('kode_mk', $request->kode_mk)->first())) {
                $mata_kuliah = new MataKuliah();
                $mata_kuliah->kode_mk = $request->kode_mk;
                $mata_kuliah->nama_matkul = $request->nama_matkul;
                $mata_kuliah->saveOrFail();
            }
            $peminjaman_lab = new PeminjamanLab();
            $peminjaman_lab->id_mahasiswa = Mahasiswa::where('nim', $request->nim)->first()->id;
            $peminjaman_lab->id_dosen = Dosen::where('nidn', $request->nidn)->first()->id;
            $peminjaman_lab->id_matkul = MataKuliah::where('kode_mk', $request->kode_mk)->first()->id;
            $peminjaman_lab->id_lab = $request->id_lab;
            $peminjaman_lab->tanggal = $request->tanggal;
            $peminjaman_lab->jam_pinjam = $request->jam_pinjam;
            $peminjaman_lab->jam_kembali = $request->jam_kembali;
            $peminjaman_lab->kategori = $request->kategori;
            $peminjaman_lab->keperluan = $request->keperluan;
            $peminjaman_lab->proses = $request->proses;
            $peminjaman_lab->status = $request->status;
            $peminjaman_lab->saveOrFail();
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
        } catch (Throwable $exception) {
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
            $filename = "{$PeminjamanLab->mahasiswa->nim}-SuratPeminjamanLab-{$PeminjamanLab->mahasiswa->prodi->nama_prodi}.docx";
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
