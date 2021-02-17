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
                        <label class="form-label" for="tanggal">Tanggal</label>
                        <input
                            id="tanggal"
                            name="tanggal"
                            class="form-input"
                            autocomplete="off"
                            type="date"
                        />
                        {{--                    <div class="form-error">{errors[0]}</div>}--}}
                    </div>
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
                        Kirim Data
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
