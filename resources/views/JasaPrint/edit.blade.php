@extends('adminlte::page')
@section('title', 'Labkom FMIPA UNS | Jasa Print | Edit Data')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Data Print</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('JasaPrint.index') }}">Jasa Print</a></li>
                <li class="breadcrumb-item active">Edit Data</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('content')
    <form action="{{ route('JasaPrint.update', $JasaPrint->id) }}" method="post">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-md">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Print</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="Tanggal">Tanggal Print :</label>
                            <input type="text" name="tanggal_print" id="Tanggal" class="form-control @error('tanggal_print') is-invalid @enderror" placeholder="Masukkan Tanggal Print" onfocus="this.type = 'date'" value="{{ $JasaPrint->tanggal_print }}">
                            @error('tanggal_print')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Jenis_Print">Jenis Print :</label>
                            <select name="jenis_print" id="Jenis_Print" class="custom-select @error('jenis_print') is-invalid @enderror">
                                <?php $arrayJenis = ['Hitam Putih', 'Warna', 'Warna-full'] ?>
                                @foreach($arrayJenis as $elemen)
                                    @if($JasaPrint->jenis_print == $elemen)
                                        <option selected value="{{ $JasaPrint->jenis_print }}">{{ $elemen }}</option>
                                    @else
                                        <option value="{{ $elemen }}">{{ $elemen }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('jenis_print')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga Print :</label>
                            <input type="number" name="harga_print" id="harga" class="form-control @error('harga_print') is-invalid @enderror" value="{{ $JasaPrint->harga_print }}" autocomplete="off">
                            @error('harga_print')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.card -->
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card-body">
                    <div class="card-tools" >
                        <a href="{{ route('JasaPrint.index') }}" class="btn btn-secondary btn-lg">Cancel</a>
                        <button type="submit" class="btn btn-primary btn-lg float-right">
                            <i class="fas fa-plus"></i>
                            Update Data
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
