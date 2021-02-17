@extends('User.app')

@section('title', '| Peminjaman Alat | create')
@section('content')
    <div class="w-full px-12 pt-24 pb-4 container mx-auto">
        <h1 class="mb-8 font-bold text-3xl">
            <a
                href="{{route('UserPeminjamanAlat.index')}}"
                class="text-indigo-100 hover:text-indigo-200"
            >
                Peminjaman Alat
            </a>
            <span class="text-indigo-600 font-medium"> /</span> Kirim Data
        </h1>
        <div class="bg-white rounded shadow overflow-hidden max-w-full mb-8">
            <form method="post" action="{{ route('UserPeminjamanAlat.store') }}">
                <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                    <div class="pr-6 pb-8 w-full lg:w-1/2">
                        <label class="form-label" for="id_mahasiswa">Mahasiswa</label>
                        <select
                            id="id_mahasiswa"
                            name="id_mahasiswa"
                            class="form-select"
                        >
                            <option value=""></option>
                        </select>
                        {{--                    <div className="form-error">{errors[0]}</div>--}}
                    </div>
                    <div class="pr-6 pb-8 w-full lg:w-1/2">
                        <label class="form-label" for="id_alat">Alat</label>
                        <select
                            id="id_alat"
                            name="id_alat"
                            class="form-select"
                        >
                            <option value=""></option>
                        </select>
                        {{--                    <div className="form-error">{errors[0]}</div>--}}
                    </div>
                    <div class="pr-6 pb-8 w-full lg:w-1/2">
                        <label class="form-label" for="tanggal_pinjam">Tanggal Pinjam</label>
                        <input
                            id="tanggal_pinjam"
                            name="tanggal_pinjam"
                            class="form-input"
                            autocomplete="off"
                            type="date"
                        />
                        {{--                    <div class="form-error">{errors[0]}</div>}--}}
                    </div>
                    <div class="pr-6 pb-8 w-full lg:w-1/2">
                        <label class="form-label" for="tanggal_kembali">Tanggal Kembali</label>
                        <input
                            id="tanggal_kembali"
                            name="tanggal_kembali"
                            class="form-input"
                            autocomplete="off"
                            type="date"
                        />
                        {{--                    <div class="form-error">{errors[0]}</div>}--}}
                    </div>
                    <div class="pr-6 pb-8 w-full lg:w-1/2">
                        <label class="form-label" for="jam_pinjam">Jam Pinjam</label>
                        <input
                            id="jam_pinjam"
                            name="jam_pinjam"
                            class="form-input"
                            autocomplete="off"
                            type="time"
                        />
                        {{--                    <div class="form-error">{errors[0]}</div>}--}}
                    </div>
                    <div class="pr-6 pb-8 w-full lg:w-1/2">
                        <label class="form-label" for="jam_kembali">Jam Kembali</label>
                        <input
                            id="jam_kembali"
                            name="jam_kembali "
                            class="form-input"
                            autocomplete="off"
                            type="time"
                        />
                        {{--                    <div class="form-error">{errors[0]}</div>}--}}
                    </div>
                    <div class="pr-6 pb-8 w-full lg:w-1/2">
                        <label class="form-label" for="jumlah_pinjam">Jumlah Pinjam</label>
                        <input
                            id="jumlah_pinjam"
                            name="jumlah_pinjam "
                            class="form-input"
                            autocomplete="off"
                            type="number"
                            min="0"
                        />
                        {{--                    <div class="form-error">{errors[0]}</div>}--}}
                    </div>
                    <div class="pr-6 pb-8 w-full lg:w-1/2">
                        <label class="form-label" for="status">Status</label>
                        <select
                            id="status"
                            name="status"
                            class="form-select"
                        >
                            <option>
                            </option>
                            <option value="0">Masih Dipinjam</option>
                            <option value="1">Sudah Dikembalikan</option>
                        </select>
                        {{--                    <div className="form-error">{errors[0]}</div>--}}
                    </div>

                    <div class="pr-6 pb-8 w-full lg:w-full">
                        <label class="form-label" for="keperluan">
                            Keperluan
                        </label>
                        <textarea name="keperluan" id="keperluan"
                                  class="form-input"
                                  autocomplete="off"
                        >
                    </textarea>
                        {{--                    {errors && <div class="form-error">{errors[0]}</div>}--}}
                    </div>
                </div>
                <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center">
                    <a
                        href="{{route('UserPeminjamanAlat.index')}}"
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
