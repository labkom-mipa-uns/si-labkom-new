@extends('adminlte::page')
@section('title', 'Labkom FMIPA UNS | User | Edit Data')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Data User</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('User.index') }}">User</a></li>
                <li class="breadcrumb-item active">Edit Data</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('content')
    <form action="{{ route('User.update', $User->id) }}" method="post">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">User</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="User">{{ __('Name') }} :</label>
                            <input type="text" name="name" id="User" class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan Nama" value="{{ $User->name }}" autocomplete="off">
                            @error('name')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">{{ __('E-Mail Address') }} :</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $User->email }}" placeholder="Masukkan Email" autocomplete="off">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="newPassword">{{ __('New Password') }} :</label>
                            <input id="newPassword" type="password" class="form-control @error('newPassword') is-invalid @enderror" name="newPassword" placeholder="Masukkan Password" autocomplete="off">
                            @error('newPassword')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="newPassword-confirm">{{ __('Confirm Password') }} :</label>
                            <input id="newPassword-confirm" type="password" class="form-control" name="newPassword_confirmation" placeholder="Masukkan Password Konfirmasi" autocomplete="off">
                        </div>
                        @can('isSuperAdmin')
                            <div class="form-group">
                                <label for="role">{{ __('Role') }} :</label>
                                <select name="role" id="role" class="custom-select @error('role') is-invalid @enderror">
                                    @if($User->role === 'super admin')
                                        <option selected value="super admin">Super Admin</option>
                                        <option value="admin">Admin</option>
                                    @else
                                        <option value="super admin">Super Admin</option>
                                        <option selected value="admin">Admin</option>
                                    @endif
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        @endcan
                        <input type="hidden" name="password" value="{{ $User->password }}">
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card-body">
                    <div class="card-tools" >
                        <a href="{{ route('User.index') }}" class="btn btn-secondary btn-lg">Cancel</a>
                        <button type="submit" class="btn btn-info btn-lg float-right">
                            <i class="fas fa-plus"></i>
                            Update Data
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
