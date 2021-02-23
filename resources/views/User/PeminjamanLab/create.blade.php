@extends('User.app')

@section('title', '| Peminjaman Ruang | create')
@section('content')
        <div class="w-full px-12 pt-24 pb-4 container mx-auto">
            <h1 class="mb-8 font-bold text-3xl">
                <a
                    href="{{route('UserPeminjamanLab.index')}}"
                    class="text-indigo-100 hover:text-indigo-400"
                >
                    Peminjaman Ruang
                </a>
                <span class="text-indigo-600 font-medium"> /</span> Kirim Data
            </h1>
            <div class="bg-white rounded shadow overflow-hidden max-w-full mb-8">
                <form method="post" action="{{ route('UserPeminjamanLab.store') }}">
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
                            <label class="form-label" for="id_lab">Laboratorium</label>
                            <select
                                id="id_lab"
                                name="id_lab"
                                class="form-select @error('id_lab') error @enderror"
                            >
                                <option></option>
                                @foreach($Lab as $item)
                                    @if($item->id === old('id_lab'))
                                        <option value="{{ old('id_lab') }}">{{ $item->nama_lab }}</option>
                                    @endif
                                    <option value="{{ $item->id }}">{{ $item->nama_lab }}</option>
                                @endforeach
                            </select>
                            @error('id_lab')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="pr-6 pb-8 w-full lg:w-1/2">
                            <label class="form-label" for="id_jadwal">Jadwal</label>
                            <select
                                id="id_jadwal"
                                name="id_jadwal"
                                class="form-select @error('id_jadwal') error @enderror"
                            >
                                <option></option>
                                @foreach($Jadwal as $item)
                                    @if($item->id === old('id_jadwal'))
                                        <option value="{{ old('id_jadwal') }}">{{ $item->nama_jadwal }}</option>
                                    @endif
                                    <option value="{{ $item->id }}">{{ $item->dosen->nama_dosen }} - {{ $item->matakuliah->nama_matkul }} - {{ $item->prodi->nama_prodi }}</option>
                                @endforeach
                            </select>
                            @error('id_jadwal')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="pr-6 pb-8 w-full lg:w-1/2">
                            <label class="form-label" for="tanggal">Tanggal</label>
                            <input
                                id="tanggal"
                                name="tanggal"
                                class="form-input @error('tanggal') error @enderror"
                                type="date"
                                value="{{ old('tanggal') }}"
                            />
                            @error('tanggal')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="pr-6 pb-8 w-full lg:w-1/2">
                            <label class="form-label" for="jam_pinjam">Jam Pinjam</label>
                            <input
                                id="jam_pinjam"
                                name="jam_pinjam"
                                class="form-input @error('jam_pinjam') error @enderror"
                                type="time"
                                value="{{ old('jam_pinjam') }}"
                            />
                            @error('jam_pinjam')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="pr-6 pb-8 w-full lg:w-1/2">
                            <label class="form-label" for="jam_kembali">Jam Kembali</label>
                            <input
                                id="jam_kembali"
                                name="jam_kembali"
                                class="form-input @error('jam_kembali') error @enderror"
                                type="time"
                                value="{{ old('jam_kembali') }}"
                            />
                            @error('jam_kembali')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="pr-6 pb-8 w-full">
                            <label class="form-label" for="kategori">Kategori</label>
                            <select
                                id="kategori"
                                name="kategori"
                                class="form-select @error('kategori') error @enderror"
                            >
                                <option value=""></option>
                                <option value="didalam_jam">Didalam Jam Kuliah</option>
                                <option value="diluar_jam">Diluar Jam Kuliah</option>
                            </select>
                            @error('kategori')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <input type="hidden" name="proses" value="1">
                        <input type="hidden" name="status" value="0">
                        <div class="pr-6 pb-8 w-full lg:w-full">
                            <label class="form-label" for="keperluan">
                                Keperluan
                            </label>
                            <textarea name="keperluan" id="keperluan"
                                      class="form-input @error('keperluan') error @enderror"
                                      autocomplete="off"
                            >{{ old('keperluan') }}</textarea>
                            @error('keperluan')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                            {{--                    {errors && <div class="form-error">{errors[0]}</div>}--}}
                        </div>
                    </div>
                    <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center">
                        <a
                            href="{{route('UserPeminjamanLab.index')}}"
                            class="text-indigo-600 hover:text-indigo-700 ml-auto mr-6"
                        >
                            Kembali
                        </a>
                        <button
                            type="submit"
                            class="btn-indigo"
                        >
                            Kirim Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
@endsection
