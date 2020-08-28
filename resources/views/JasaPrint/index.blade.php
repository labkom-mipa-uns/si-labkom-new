@extends('adminlte::page')
@section('title', 'Labkom FMIPA UNS | Jasa Print')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Daftar Print</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Jasa Print</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="jasaprint-success" data-flashdata="{{ session('success') }}"></div>
    <div class="jasaprint-warning" data-flashdata="{{ session('warning') }}"></div>
    <div class="jasaprint-danger" data-flashdata="{{ session('danger') }}"></div>
@endsection

@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Print</h3>
            <div class="card-tools">
                <div class="card-tools">
                    <form class="form-inline d-inline" method="post" action="{{ route('JasaPrint.daily_report') }}">
                        @csrf
                        @method('post')
                        <input type="hidden" name="kategori" value="jasa_print">
                        <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old("tanggal") }}" autocomplete="off">
                        @error('tanggal')
                        <div class="invalid-feedback d-inline">
                            {{ $message }}
                        </div>
                        @enderror
                        <button type="submit" class="btn btn-outline-dark btn-sm ml-2 mr-2">
                            <i class="fas fa-file-pdf"></i>
                            Cetak per hari
                        </button>
                    </form>
                    <form action="{{ route('JasaPrint.monthly_report') }}" method="post" class="form-inline d-inline">
                        @csrf
                        @method('post')
                        <input type="hidden" name="kategori" value="jasa_print">
                        <select class="form-control custom-select @error('bulan') is-invalid @enderror" name="bulan">
                            <option disabled selected>-</option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                        @error('bulan')
                        <div class="invalid-feedback d-inline">
                            {{ $message }}
                        </div>
                        @enderror
                        <button type="submit" class="btn btn-outline-dark btn-sm ml-2 mr-2">
                            <i class="fas fa-file-pdf"></i>
                            Cetak per bulan
                        </button>
                    </form>
                    <a href="{{ route('JasaPrint.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-user-plus"></i>
                    Insert
                </a>
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
                        Jenis Print
                    </th>
                    <th class="text-center">
                        Harga Print
                    </th>
                    <th>
                        #
                    </th>
                </tr>
                </thead>
                <tbody>

                @foreach($JasaPrint as $elemen)
                    <tr>
                        <td class="text-center">
                            {{ ($JasaPrint->currentPage() - 1) * $JasaPrint->perPage() + $loop->index + 1 }}
                        </td>
                        <td class="text-center">
                            <a>
                                {{ $elemen->tanggal_print }}
                            </a>
                        </td>
                        <td class="text-center">
                            <a>
                                {{ $elemen->jenis_print }}
                            </a>
                        </td>
                        <td class="text-center">
                            <a>
                                Rp.{{ $elemen->harga_print }}
                            </a>
                        </td>
                        <td class="project-actions text-right">
                            <button class="btn btn-secondary btn-sm detail-jasaprint-button" type="button" data-toggle="modal" data-target="#jasaprintModal" data-showurl="{{ route('JasaPrint.show', $elemen->id) }}">
                                <i class="fas fa-folder"></i>
                                Detail
                            </button>
                            <a class="btn btn-info btn-sm" href="{{ route('JasaPrint.edit', $elemen->id) }}">
                                <i class="fas fa-pencil-alt"></i>
                                Edit
                            </a>
                            <form action="{{ route('JasaPrint.destroy', $elemen->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm delete-jasaprint-button d" type="submit">
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
                {{ $JasaPrint->links() }}
            </section>
        </div>
        <!-- /.card-body -->
        <div id="detail-jasaprint"></div>
    </div>
    <!-- /.card -->
@endsection
