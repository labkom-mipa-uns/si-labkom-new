@extends('User.app')

@section('title', '| Surat Bebas Labkom | Alur')
@section('content')
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
                        Konfirmasi dilakukan setelah pengisian formulir selesai, akan muncul halaman dengan pilihan tombol "Konfirmasi"
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
