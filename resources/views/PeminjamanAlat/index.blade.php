@extends('adminlte::page')
@section('title', 'Labkom FMIPA UNS | Peminjaman Alat')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Daftar Peminjam Alat</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Peminjaman Alat</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="peminjamalat-success" data-flashdata="{{ session('success') }}"></div>
    <div class="peminjamalat-warning" data-flashdata="{{ session('warning') }}"></div>
    <div class="peminjamalat-danger" data-flashdata="{{ session('danger') }}"></div>
@endsection

@section('content')
    <!-- Default box -->
    <div class="card shadow">
        <div class="card-header">
            <h3 class="card-title">Daftar Peminjam Alat</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool">
                    <a href="{{ route('PeminjamanAlat.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-user-plus"></i>
                        Insert
                    </a>
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped table-bordered">
                <thead class="thead-light">
                <tr>
                    <th class="text-center">
                        No
                    </th>
                    <th class="text-center">
                        Tanggal
                    </th>
                    <th class="text-center">
                        Nama
                    </th>
                    <th class="text-center">
                        Prodi
                    </th>
                    <th class="text-center">
                        Alat
                    </th>
                    <th >
                        #
                    </th>
                </tr>
                </thead>
                <tbody>

                @foreach($PeminjamanAlat as $elemen)
                    <tr>
                        <td class="text-center">
                            {{ ($PeminjamanAlat->currentPage() - 1) * $PeminjamanAlat->perPage() + $loop->index + 1 }}
                        </td>
                        <td class="text-center">
                            <a>
                                {{ $elemen->tanggal_pinjam }} - {{ $elemen->tanggal_kembali }}
                            </a>
                        </td>
                        <td class="text-center">
                            <a>
                                {{ $elemen->mahasiswa->nama_mahasiswa }}
                            </a>
                            <br>
                            <small>
                                {{ $elemen->mahasiswa->kelas }} - {{ $elemen->mahasiswa->nim }}
                            </small>
                        </td>
                        <td class="text-center">
                            <a>
                                {{ $elemen->mahasiswa->prodi->nama_prodi }}
                            </a>
                            <br>
                            <small>
                                {{ $elemen->mahasiswa->tahun_angkatan }}
                            </small>
                        </td>
                        <td class="text-center">
                            <a>
                                {{ $elemen->alat->nama_alat }}
                            </a>
                            <br>
                            <small>
                                Rp.{{ $elemen->alat->harga_alat }}
                            </small>
                        </td>
                        <td class="project-actions text-right">
                            <button class="btn btn-secondary btn-sm detail-peminjamanalat-button" type="button" data-toggle="modal" data-target="#peminjamanalatModal" data-showurl="{{ route('PeminjamanAlat.show', $elemen->id) }}">
                                <i class="fas fa-folder"></i>
                                Detail
                            </button>
                            <a class="btn btn-info btn-sm" href="{{ route('PeminjamanAlat.edit', $elemen->id) }}">
                                <i class="fas fa-pencil-alt"></i>
                                Edit
                            </a>
                            <form action="{{ route('PeminjamanAlat.destroy', $elemen->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm delete-peminjamanalat-button" type="submit">
                                    <i class="fas fa-trash"></i>
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            <section class="d-flex align-items-center justify-content-center mt-3">
                {{ $PeminjamanAlat->links() }}
            </section>
        </div>
        <!-- /.card-body -->
        <div id="detail-peminjamalat"></div>
    </div>
    <!-- /.card -->
@endsection
