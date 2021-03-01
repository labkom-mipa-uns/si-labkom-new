@extends('User.app')

@section('title', '| Surat Bebas Labkom | Alur')
@section('content')
    @if(session()->exists('success'))
        <script>window.open(`https://api.whatsapp.com/send?phone=6281234535633&text=Saya%20meminta%20izin%20untuk%20dibuatkan%20surat%20bebas%20labkom`); </script>
        <div id="suratbebaslabkom" data-name="{{ session('name') }}" data-success="{{ session('success') }}"></div>
    @endif
    @if(session()->exists('error'))
        <div id="suratbebaslabkom" data-name="{{ session('name') }}" data-error="{{ session('error') }}"></div>
    @endif
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="pt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-white sm:text-4xl">
                    Alur Pembuatan Surat Bebas Labkom
                </p>
                <p class="mt-2 max-w-2xl text-xl text-white lg:mx-auto">
                    Laboratorium Komputasi FMIPA UNS
                </p>
            </div>
        </div>
    </div>
    <div class="relative -mt-12 lg:-mt-24">
        <svg viewBox="0 0 1428 174" version="1.1" xmlns="http://www.w3.org/2000/svg">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g transform="translate(-2.000000, 44.000000)" fill="#FFFFFF" fill-rule="nonzero">
                    <path d="M0,0 C90.7283404,0.927527913 147.912752,27.187927 291.910178,59.9119003 C387.908462,81.7278826 543.605069,89.334785 759,82.7326078 C469.336065,156.254352 216.336065,153.6679 0,74.9732496" opacity="0.100000001"></path>
                    <path
                        d="M100,104.708498 C277.413333,72.2345949 426.147877,52.5246657 546.203633,45.5787101 C666.259389,38.6327546 810.524845,41.7979068 979,55.0741668 C931.069965,56.122511 810.303266,74.8455141 616.699903,111.243176 C423.096539,147.640838 250.863238,145.462612 100,104.708498 Z"
                        opacity="0.100000001"
                    ></path>
                    <path d="M1046,51.6521276 C1130.83045,29.328812 1279.08318,17.607883 1439,40.1656806 L1439,120 C1271.17211,77.9435312 1140.17211,55.1609071 1046,51.6521276 Z" id="Path-4" opacity="0.200000003"></path>
                </g>
                <g transform="translate(-4.000000, 76.000000)" fill="#FFFFFF" fill-rule="nonzero">
                    <path
                        d="M0.457,34.035 C57.086,53.198 98.208,65.809 123.822,71.865 C181.454,85.495 234.295,90.29 272.033,93.459 C311.355,96.759 396.635,95.801 461.025,91.663 C486.76,90.01 518.727,86.372 556.926,80.752 C595.747,74.596 622.372,70.008 636.799,66.991 C663.913,61.324 712.501,49.503 727.605,46.128 C780.47,34.317 818.839,22.532 856.324,15.904 C922.689,4.169 955.676,2.522 1011.185,0.432 C1060.705,1.477 1097.39,3.129 1121.236,5.387 C1161.703,9.219 1208.621,17.821 1235.4,22.304 C1285.855,30.748 1354.351,47.432 1440.886,72.354 L1441.191,104.352 L1.121,104.031 L0.457,34.035 Z"
                    ></path>
                </g>
            </g>
        </svg>
    </div>
    <div class="bg-white min-h-full md:py-16 lg:py-24">
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="flex flex-col container mx-auto pb-10">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Prodi
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($Surat as $item)
                                @if($item->proses !== '0')
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $item->mahasiswa->nama_mahasiswa }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ $item->mahasiswa->nim }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $item->mahasiswa->prodi->nama_prodi }}</div>
                                            <div class="text-sm text-gray-500">{{ $item->mahasiswa->angkatan }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap flex flex-col items-start">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full @if($item->proses === '2') bg-green-100 text-green-800 @endif @if($item->proses === '1') bg-yellow-100 text-yellow-800 @endif @if($item->proses === '0') bg-red-100 text-red-800 @endif">
                                              @if($item->proses === '2') {{ __('Sudah Disetujui')}} @elseif($item->proses === '1') {{ __('Sedang Diproses')}} @elseif($item->proses === '0') {{ __('Ditolak') }} @endif
                                            </span>
                                            @if($item->proses === '2')
                                                <a class="px-2 py-1 mt-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-200 text-blue-800" href="{{ route('UserSuratBebasLabkom.exportToWord', $item->id) }}">
                                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="file-word" class="svg-inline--fa fa-file-word w-4 h-4 mr-2" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="currentColor" d="M224 136V0H24C10.7 0 0 10.7 0 24v464c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V160H248c-13.2 0-24-10.8-24-24zm57.1 120H305c7.7 0 13.4 7.1 11.7 14.7l-38 168c-1.2 5.5-6.1 9.3-11.7 9.3h-38c-5.5 0-10.3-3.8-11.6-9.1-25.8-103.5-20.8-81.2-25.6-110.5h-.5c-1.1 14.3-2.4 17.4-25.6 110.5-1.3 5.3-6.1 9.1-11.6 9.1H117c-5.6 0-10.5-3.9-11.7-9.4l-37.8-168c-1.7-7.5 4-14.6 11.7-14.6h24.5c5.7 0 10.7 4 11.8 9.7 15.6 78 20.1 109.5 21 122.2 1.6-10.2 7.3-32.7 29.4-122.7 1.3-5.4 6.1-9.1 11.7-9.1h29.1c5.6 0 10.4 3.8 11.7 9.2 24 100.4 28.8 124 29.6 129.4-.2-11.2-2.6-17.8 21.6-129.2 1-5.6 5.9-9.5 11.5-9.5zM384 121.9v6.1H256V0h6.1c6.4 0 12.5 2.5 17 7l97.9 98c4.5 4.5 7 10.6 7 16.9z"></path></svg>
                                                    {{ __(' Cetak Dokumen') }}</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            <!-- More items... -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <dl class="space-y-10 md:space-y-0 grid md:gap-4 grid-rows-3 grid-flow-col container mx-auto">
            <div class="flex">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 font-bold text-white">
                        1
                    </div>
                </div>
                <div class="ml-4">
                    <dt class="text-lg leading-6 font-medium text-gray-900">
                        Mengisi Data Diri
                    </dt>
                    <dd class="mt-2 text-base text-gray-800">Mengisi data diri untuk pembuatan <i>Surat Bebas Labkom</i> di halaman berikut: <a href="{{ route('UserSuratBebasLabkom.create') }}" class="font-bold text-indigo-800 hover:underline">Formulir Surat Bebas Labkom</a></dd>
                </div>
            </div>
            <div class="flex">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 font-bold text-white">
                        2
                    </div>
                </div>
                <div class="ml-4">
                    <dt class="text-lg leading-6 font-medium text-gray-900">
                        Konfirmasi Pengajuan Surat Bebas Labkom
                    </dt>
                    <dd class="mt-2 text-base text-gray-800">
                        Konfirmasi dilakukan setelah mengisi formulir, dengan cara melampirkan dokumen yang sudah ditandatangi dan di-<i>scan</i>, lalu kirim ke bagian <i>Public Relation</i> kami dengan format:
                        <b>NIM-SuratPeminjamanAlat-Prodi</b>
                    </dd>
                </div>
            </div>
            <div class="flex">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 font-bold text-white">
                        3
                    </div>
                </div>
                <div class="ml-4">
                    <dt class="text-lg leading-6 font-medium text-gray-900">
                        Menunggu Pemrosesan Dokumen
                    </dt>
                    <dd class="mt-2 text-base text-gray-800">
                        Tunggu hingga kami mengirimkan dokumen surat bebas labkom yang sudah diproses
                    </dd>
                </div>
            </div>
            <div class="flex">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 font-bold text-white">
                        4
                    </div>
                </div>
                <div class="ml-4">
                    <dt class="text-lg leading-6 font-medium text-gray-900">
                        Cetak & Simpan Dokumen
                    </dt>
                    <dd class="mt-2 text-base text-gray-800">
                        Cetak dokumen dengan kertas ukuran A4 lalu simpan dokumen yang sudah dicetak tersebut
                    </dd>
                </div>
            </div>
            <div class="flex">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 font-bold text-white">
                        5
                    </div>
                </div>
                <div class="ml-4">
                    <dt class="text-lg leading-6 font-medium text-gray-900">
                        Cetak Dokumen
                    </dt>
                    <dd class="mt-2 text-base text-gray-800">
                        Cetak dokumen dengan kertas ukuran A4
                    </dd>
                </div>
            </div>
            <div class="flex">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 font-bold text-white">
                        6
                    </div>
                </div>
                <div class="ml-4">
                    <dt class="text-lg leading-6 font-medium text-gray-900">
                        Selesai :)
                    </dt>
                </div>
            </div>
        </dl>
    </div>
@endsection
