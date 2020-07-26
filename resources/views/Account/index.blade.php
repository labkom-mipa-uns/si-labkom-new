@extends('adminlte::page')
@section('title', 'Labkom FMIPA UNS | Account')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Profile</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Account</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="account-success" data-flashdata="{{ session('success') }}"></div>
    <div class="account-warning" data-flashdata="{{ session('warning') }}"></div>
    <div class="account-danger" data-flashdata="{{ session('danger') }}"></div>
@endsection

@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Account Information</h3>
        </div>
        <div class="card-body p-3">
            <h3 class="m-0"><strong>{{ __('Name : ') }}</strong>{{ $User->name }}</h3>
            <h3 class="m-0"><strong>{{ __('Email : ') }}</strong>{{ $User->email }}</h3>
            <h3 class="m-0"><strong>{{ __('Role : ') }}</strong>{{ ($User->role === 'super admin' ? 'Super Admin' : 'Admin') }}</h3>
            <section class="mt-3">
                <a class="btn btn-info btn-sm" href="{{ route('Account.edit', $User->id) }}">
                    <i class="fas fa-pencil-alt"></i>
                    Edit Account
                </a>
                <form action="{{ route('Account.destroy', $User->id) }}" method="post" class="d-inline">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger btn-sm delete-account-button" type="submit">
                        <i class="fas fa-trash"></i>
                        Delete Account
                    </button>
                </form>
            </section>

        </div>
        <!-- /.card-body -->
        <div id="detail-account"></div>
    </div>
    <!-- /.card -->
@endsection
