@extends('User.app')

@section('title', '| Surat Bebas Labkom | create')
@section('content')
    <div class="w-full px-12 pt-24 pb-4 container mx-auto">
        <h1 class="mb-8 font-bold text-3xl">
            <a href="{{ route('UserSuratBebasLabkom.index') }}">
                Surat Bebas Labkom
            </a>
            <span class="font-medium"> /</span> Ajukan Permohonan
        </h1>
        <div class="bg-white rounded shadow overflow-hidden max-w-full md:mb-8">
            <form method="post" action="{{ route('UserSuratBebasLabkom.store') }}">
                @csrf
                <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                    <div class="pr-6 pb-8 w-full lg:w-1/2">
                        <label class="form-label" for="nim">NIM</label>
                        <input id="nim" name="nim" class="form-input @error('nim') error @enderror" type="text"
                            value="{{ old('nim') }}" autocomplete="off" placeholder="Masukkan NIM" />
                        @error('nim')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="pr-6 pb-8 w-full lg:w-1/2">
                        <label class="form-label" for="nama_mahasiswa">Nama Lengkap</label>
                        <input id="nama_mahasiswa" name="nama_mahasiswa"
                            class="form-input @error('nama_mahasiswa') error @enderror" type="text"
                            value="{{ old('nama_mahasiswa') }}" autocomplete="off" placeholder="Masukkan nama lengkap" />
                        @error('nama_mahasiswa')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="pr-6 pb-8 w-full lg:w-1/3">
                        <label class="form-label" for="id_prodi">Program Studi</label>
                        <select id="id_prodi" name="id_prodi" class="form-select @error('id_prodi') error @enderror">
                            <option></option>
                            @foreach ($Prodi as $item)
                                @if ($item->id === old('id_prodi'))
                                    <option value="{{ old('id_prodi') }}">{{ $item->nama_prodi }}</option>
                                @endif
                                <option value="{{ $item->id }}">{{ $item->nama_prodi }}</option>
                            @endforeach
                        </select>
                        @error('id_prodi')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="pr-6 pb-8 w-full lg:w-1/3">
                        <label class="form-label" for="angkatan">Angkatan</label>
                        <select id="angkatan" name="angkatan" class="form-select @error('angkatan') error @enderror">
                            <option value=""></option>
                            <option value="2014">2014</option>
                            <option value="2015">2015</option>
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                        </select>
                        @error('angkatan')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="pr-6 pb-8 w-full lg:w-1/3">
                        <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin"
                            class="form-input @error('jenis_kelamin') error @enderror">
                            <option value=""></option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>
{{--                    <div class="pr-6 pb-8 w-full lg:w-1/3">
                        <label class="form-label" for="kelas">Kelas</label>
                        <input id="kelas" name="kelas" class="form-input @error('kelas') error @enderror" type="text"
                            value="{{ old('kelas') }}" autocomplete="off" placeholder="Masukkan kelas" />
                        @error('kelas')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div> --}}
                    <div class="pr-6 pb-8 w-full lg:w-1/2">
                        <label class="form-label" for="no_hp">Nomor WhatsApp</label>
                        <input id="no_hp" name="no_hp" class="form-input @error('no_hp') error @enderror" type="tel"
                            value="{{ old('no_hp') }}" autocomplete="off" placeholder="Masukkan nomor WhatsApp aktif" />
                        @error('no_hp')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="pr-6 pb-8 w-full lg:w-1/2">
                        <label class="form-label" for="email">Email</label>
                        <input id="email" name="email" class="form-input @error('email') error @enderror" type="email"
                            value="{{ old('email') }}" autocomplete="off" placeholder="Masukkan email SSO" />
                        @error('email')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>
{{--                    <div class="pr-6 pb-8 w-full lg:w-1/2">
                        <label class="form-label" for="tanggal_pinjam">Tanggal</label>
                        <input id="tanggal" name="tanggal" class="form-input @error('tanggal') error @enderror"
                            autocomplete="off" type="date" value="{{ old('tanggal') }}" />
                        @error('tanggal')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div> --}}
                  <?php
					setlocale (LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID');
					$date = strftime("%Y-%m-%d" , time());
                  ?>
                  <input type="hidden" id="kelas" name="kelas" value="-">
                  <input type="hidden" id="tanggal" name="tanggal" class="form-control" value="<?php echo $date ?>">
                  <input type="hidden" name="proses" value="1">
                </div>
                <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center">
                    <a href="{{ route('UserSuratBebasLabkom.index') }}"
                        class="text-indigo-600 hover:text-indigo-700 ml-auto mr-6">
                        Kembali
                    </a>
                    <button type="submit" id="user-surat-bebas-create" class="btn-indigo">
                        Ajukan Permohonan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
