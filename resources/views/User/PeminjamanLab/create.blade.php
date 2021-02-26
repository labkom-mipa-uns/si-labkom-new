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
                <span class="text-indigo-600 font-medium"> /</span> Ajukan Permohonan
            </h1>
            <div class="bg-white rounded shadow overflow-hidden max-w-full mb-8">
                <form method="post"
                      action="{{ route('UserPeminjamanLab.store') }}"
                    @csrf
                    <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                        <div class="pr-6 pb-8 w-full lg:w-1/2">
                            <label class="form-label" for="nim">NIM</label>
                            <input
                                id="nim"
                                name="nim"
                                class="form-input @error('nim') error @enderror"
                                type="text"
                                value="{{ old('nim') }}"
                                autocomplete="off"
                            />
                            @error('nim')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="pr-6 pb-8 w-full lg:w-1/2">
                            <label class="form-label" for="nama_mahasiswa">Nama Lengkap</label>
                            <input
                                id="nama_mahasiswa"
                                name="nama_mahasiswa"
                                class="form-input @error('nama_mahasiswa') error @enderror"
                                type="text"
                                value="{{ old('nama_mahasiswa') }}"
                                autocomplete="off"
                            />
                            @error('nama_mahasiswa')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="pr-6 pb-8 w-full lg:w-1/2">
                            <label class="form-label" for="id_prodi">Program Studi</label>
                            <select
                                id="id_prodi"
                                name="id_prodi"
                                class="form-select @error('id_prodi') error @enderror"
                            >
                                <option></option>
                                @foreach($Prodi as $item)
                                    @if($item->id === old('id_prodi'))
                                        <option value="{{ old('id_prodi') }}">{{ $item->nama_prodi }}</option>
                                    @endif
                                    <option value="{{ $item->id }}">{{ $item->nama_prodi }}</option>
                                @endforeach
                            </select>
                            @error('id_prodi')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="pr-6 pb-8 w-full lg:w-1/2">
                            <label class="form-label" for="angkatan">Angkatan</label>
                            <select
                                id="angkatan"
                                name="angkatan"
                                class="form-select @error('angkatan') error @enderror"
                            >
                                <option value=""></option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                            </select>
                            @error('angkatan')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="pr-6 pb-8 w-full lg:w-1/2">
                            <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                            <select
                                id="jenis_kelamin"
                                name="jenis_kelamin"
                                class="form-input @error('jenis_kelamin') error @enderror"
                            >
                                <option value=""></option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="pr-6 pb-8 w-full lg:w-1/2">
                            <label class="form-label" for="kelas">Kelas</label>
                            <input
                                id="kelas"
                                name="kelas"
                                class="form-input @error('kelas') error @enderror"
                                type="text"
                                value="{{ old('kelas') }}"
                                autocomplete="off"
                            />
                            @error('kelas')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="pr-6 pb-8 w-full lg:w-1/2">
                            <label class="form-label" for="no_hp">Nomor WhatsApp</label>
                            <input
                                id="no_hp"
                                name="no_hp"
                                class="form-input @error('no_hp') error @enderror"
                                type="tel"
                                value="{{ old('no_hp') }}"
                                autocomplete="off"
                            />
                            @error('no_hp')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="pr-6 pb-8 w-full lg:w-1/2">
                            <label class="form-label" for="email">Email</label>
                            <input
                                id="email"
                                name="email"
                                class="form-input @error('email') error @enderror"
                                type="email"
                                value="{{ old('email') }}"
                                autocomplete="off"
                            />
                            @error('email')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="pr-6 pb-8 w-full lg:w-1/2">
                            <label class="form-label" for="nama_dosen">Nama Dosen Pengampu</label>
                            <input
                                id="nama_dosen"
                                name="nama_dosen"
                                class="form-input @error('nama_dosen') error @enderror"
                                type="text"
                                value="{{ old('nama_dosen') }}"
                                autocomplete="off"
                            />
                            @error('nama_dosen')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="pr-6 pb-8 w-full lg:w-1/2">
                            <label class="form-label" for="nidn">NIDN/NIP</label>
                            <input
                                id="nidn"
                                name="nidn"
                                class="form-input @error('nidn') error @enderror"
                                type="text"
                                value="{{ old('nidn') }}"
                                autocomplete="off"
                            />
                            @error('nidn')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="pr-6 pb-8 w-full lg:w-1/2">
                            <label class="form-label" for="nama_matkul">Mata Kuliah</label>
                            <input
                                id="nama_matkul"
                                name="nama_matkul"
                                class="form-input @error('nama_matkul') error @enderror"
                                type="text"
                                value="{{ old('nama_matkul') }}"
                                autocomplete="off"
                            />
                            @error('nama_matkul')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="pr-6 pb-8 w-full lg:w-1/2">
                            <label class="form-label" for="kode_mk">Kode MK</label>
                            <input
                                id="kode_mk"
                                name="kode_mk"
                                class="form-input @error('kode_mk') error @enderror"
                                type="text"
                                value="{{ old('kode_mk') }}"
                                autocomplete="off"
                            />
                            @error('kode_mk')
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
                        <div class="pr-6 pb-8 w-full lg:w-1/3">
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
                        <div class="pr-6 pb-8 w-full lg:w-1/3">
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
                        <div class="pr-6 pb-8 w-full lg:w-1/3">
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
                            Ajukan Permohonan
                        </button>
                    </div>
                </form>
            </div>
        </div>
@endsection
