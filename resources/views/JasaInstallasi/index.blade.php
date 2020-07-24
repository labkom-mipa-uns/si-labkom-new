@extends('adminlte::page')
@section('title', 'Labkom FMIPA UNS | Jasa Installasi')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Daftar Customer Jasa Installasi</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Jasa Installasi</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="jasainstallasi-success" data-flashdata="{{ session('success') }}"></div>
    <div class="jasainstallasi-warning" data-flashdata="{{ session('warning') }}"></div>
    <div class="jasainstallasi-danger" data-flashdata="{{ session('danger') }}"></div>
@endsection

@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Customer Jasa Installasi</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool">
                    <a href="{{ route('JasaInstallasi.create') }}" class="btn btn-primary btn-sm">
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
                        Laptop
                    </th>
                    <th class="text-center">
                        Software
                    </th>
                    <th>
                        #
                    </th>
                </tr>
                </thead>
                <tbody>

                @foreach($JasaInstallasi as $elemen)
                    <tr>
                        <td class="text-center">
                            {{ ($JasaInstallasi->currentPage() - 1) * $JasaInstallasi->perPage() + $loop->index + 1 }}
                        </td>
                        <td class="text-center">
                            <a>
                                {{ $elemen->tanggal }}
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
                            <br>
                        </td>
                        <td class="text-center">
                            <a>
                                {{ $elemen->laptop }}
                            </a>
                        </td>
                        <td class="text-center">
                            <a>
                                {{ $elemen->software->nama_software }}
                            </a>
                            <br>
                            <small>
                                {{ $elemen->jam_ambil }}
                            </small>
                        </td>
                        <td class="project-actions text-right">
                            <button class="btn btn-secondary btn-sm detail-jasainstallasi-button" type="button" data-toggle="modal" data-target="#jasainstallasiModal" data-showurl="{{ route('JasaInstallasi.show', $elemen->id) }}">
                                <i class="fas fa-folder"></i>
                                Detail
                            </button>
                            <a class="btn btn-info btn-sm" href="{{ route('JasaInstallasi.edit', $elemen->id) }}">
                                <i class="fas fa-pencil-alt"></i>
                                Edit
                            </a>
                            <form action="{{ route('JasaInstallasi.destroy', $elemen->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm delete-peminjamanlab-button" type="submit">
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
                {{ $JasaInstallasi->links() }}
            </section>
        </div>
        <!-- /.card-body -->
        <div id="detail-jasainstallasi"></div>
    </div>
    <!-- /.card -->
@endsection
