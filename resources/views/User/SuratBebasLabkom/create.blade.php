@extends('User.app')

@section('title', '| Surat Bebas Labkom | create')
@section('content')
    <div class="w-full px-12 pt-24 pb-4 container mx-auto">
        <h1 class="mb-8 font-bold text-3xl">
            <a
                href="{{route('UserSuratBebasLabkom.index')}}"
                class="text-indigo-100 hover:text-indigo-200"
            >
                Surat Bebas Labkom
            </a>
            <span class="text-indigo-600 font-medium"> /</span> Kirim Data
        </h1>
        <div class="bg-white rounded shadow overflow-hidden max-w-full md:mb-8">
            <form method="post" action="{{ route('UserSuratBebasLabkom.store') }}">
                @csrf
                <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                    <div class="pr-6 pb-8 w-full lg:w-1/2">
                        <label class="form-label" for="id_mahasiswa">Mahasiswa</label>
                        <select
                            id="id_mahasiswa"
                            name="id_mahasiswa"
                            class="form-select @error('id_mahasiswa') error @enderror"
                        >
                            <option></option>
                            @foreach($Mahasiswa as $item)
                                @if($item->id === old('id_mahasiswa'))
                                    <option value="{{ old('id_mahasiswa') }}">{{ $item->nama_mahasiswa }}</option>
                                @endif
                                <option value="{{ $item->id }}">{{ $item->nama_mahasiswa }}</option>
                            @endforeach
                        </select>
                        @error('id_mahasiswa')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="pr-6 pb-8 w-full lg:w-1/2">
                        <label class="form-label" for="tanggal_pinjam">Tanggal</label>
                        <input
                            id="tanggal"
                            name="tanggal"
                            class="form-input @error('tanggal') error @enderror"
                            autocomplete="off"
                            type="date"
                            value="{{ old('tanggal') }}"
                        />
                        @error('tanggal')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <input type="hidden" name="proses" value="1">
                </div>
                <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center">
                    <a
                        href="{{route('UserSuratBebasLabkom.index')}}"
                        class="text-indigo-600 hover:text-indigo-700 ml-auto mr-6"
                    >
                        Kembali
                    </a>
                    <button
                        type="submit"
                        class="btn-indigo"
                    >
                        Konfirmasi
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
