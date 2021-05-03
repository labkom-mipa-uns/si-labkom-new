const Swal = require('sweetalert2');
const $ = require('jquery');

$(document).ready(function () {
    // ===== Front-End =====
    // -- Home --
    let scrollpos = window.scrollY;
    let header = document.getElementById("header");
    let toToggle = document.querySelectorAll(".toggleColour");
    let svgText = document.querySelectorAll('.svgText');

    if (document.getElementById('navRegister')) {
        let navRegister = document.getElementById('navRegister');
        document.addEventListener("scroll", function () {
            let i;
            /*Apply classes for slide in bar*/
            scrollpos = window.scrollY;

            if (scrollpos > 10) {
                navRegister.classList.remove('bg-white');
                navRegister.classList.add('gradient');
                navRegister.classList.remove('text-gray-800');
                navRegister.classList.add('text-white');
            } else {
                navRegister.classList.remove('gradient');
                navRegister.classList.add('bg-white');
                navRegister.classList.remove('text-white');
                navRegister.classList.add('text-gray-800');
            }
        });
    }
    if (document.getElementById('navLogin')) {
        let navLogin = document.getElementById('navLogin');
        document.addEventListener("scroll", function () {
            let i;
            /*Apply classes for slide in bar*/
            scrollpos = window.scrollY;

            if (scrollpos > 10) {
                header.classList.add("bg-white");
                navLogin.classList.remove('bg-white');
                navLogin.classList.add('gradient');
                navLogin.classList.remove('text-gray-800');
                navLogin.classList.add('text-white');
                //Use to switch toggleColour colours
                for (i = 0; i < toToggle.length; i++) {
                    toToggle[i].classList.add("text-gray-800");
                    toToggle[i].classList.remove("text-white");
                }
                for (i = 0; i < svgText.length; i++) {
                    svgText[i].classList.add("fil2");
                    svgText[i].classList.remove("fil1");
                }
                header.classList.add("shadow");
            } else {
                header.classList.remove("bg-white");
                navLogin.classList.remove('gradient');
                navLogin.classList.add('bg-white');
                navLogin.classList.remove('text-white');
                navLogin.classList.add('text-gray-800');
                //Use to switch toggleColour colours
                for (i = 0; i < toToggle.length; i++) {
                    toToggle[i].classList.add("text-white");
                    toToggle[i].classList.remove("text-gray-800");
                }
                for (i = 0; i < svgText.length; i++) {
                    svgText[i].classList.remove("fil2");
                    svgText[i].classList.add("fil1");
                }
                header.classList.remove("shadow");
            }
        });
    }
    if (document.getElementById('navDashboard')) {
        let navDashboard = document.getElementById('navDashboard');
        document.addEventListener("scroll", function () {
            let i;
            /*Apply classes for slide in bar*/
            scrollpos = window.scrollY;
            if (scrollpos > 10) {
                header.classList.add("bg-white");
                navDashboard.classList.remove('bg-white');
                navDashboard.classList.add('gradient');
                navDashboard.classList.remove('text-gray-800');
                navDashboard.classList.add('text-white');
                //Use to switch toggleColour colours
                for (i = 0; i < toToggle.length; i++) {
                    toToggle[i].classList.add("text-gray-800");
                    toToggle[i].classList.remove("text-white");
                }
                for (i = 0; i < svgText.length; i++) {
                    svgText[i].classList.add("fil2");
                    svgText[i].classList.remove("fil1");
                }
                header.classList.add("shadow");
            } else {
                header.classList.remove("bg-white");
                navDashboard.classList.remove('gradient');
                navDashboard.classList.add('bg-white');
                navDashboard.classList.remove('text-white');
                navDashboard.classList.add('text-gray-800');
                //Use to switch toggleColour colours
                for (i = 0; i < toToggle.length; i++) {
                    toToggle[i].classList.add("text-white");
                    toToggle[i].classList.remove("text-gray-800");
                }
                for (i = 0; i < svgText.length; i++) {
                    svgText[i].classList.remove("fil2");
                    svgText[i].classList.add("fil1");
                }
                header.classList.remove("shadow");
            }
        });
    }

    // --- Smooth Scrolling ---
    $('#ayomulai').click(function (event) {
        let tujuan = $(this).attr('href')
        let elemenTujuan = $(tujuan)
        $('html, body').animate({
            scrollTop: elemenTujuan.offset().top - 60
        }, 1250, 'swing');
        event.preventDefault();
    });

    // --- Peminjaman Lab ---
    let peminjamanlab = document.getElementById('peminjamanlab')
    if (peminjamanlab) {
        let name = peminjamanlab.dataset.name;
        let success = peminjamanlab.dataset.success;
        let error = peminjamanlab.dataset.error;
        if (success) {
            Swal.fire({
                title: `${name}`,
                text: `${success}`,
                icon: `success`
            })
        }
        if (error) {
            Swal.fire({
                title: `${name}`,
                text: `${error}`,
                icon: `error`
            })
        }
    }

    let tombolpinjamlab = document.getElementById('user-pinjam-lab-create')
    if (tombolpinjamlab) {
        tombolpinjamlab.addEventListener('click', function (event) {
            event.preventDefault();
            Swal.fire({
                width: '48rem',
                title: `Konfirmasi Data`,
                html: `
                <table style="width: 100%" class="border-2 border-blue-300">
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>NIM</h1>
                        </td>
                        <td>
                            <h1><b>${$('#nim').val()}</b></h1>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>Nama Lengkap</h1>
                        </td>
                        <td>
                            <h1><b>${$('#nama_mahasiswa').val()}</b></h1>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>Program Studi</h1>
                        </td>
                        <td>
                            <h1><b>${$('#id_prodi').val()}</b></h1>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>Angkatan</h1>
                        </td>
                        <td>
                            <h1><b>${$('#angkatan').val()}</b></h1>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>Jenis Kelamin</h1>
                        </td>
                        <td>
                            <h1><b>${$('#jenis_kelamin').val()}</b></h1>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>Kelas</h1>
                        </td>
                        <td>
                            <h1><b>${$('#kelas').val()}</b></h1>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>Nomor WhatsApp</h1>
                        </td>
                        <td>
                            <h1><b>${$('#no_hp').val()}</b></h1>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>Email</h1>
                        </td>
                        <td>
                            <h1><b>${$('#email').val()}</b></h1>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>Nama Dosen</h1>
                        </td>
                        <td>
                            <h1><b>${$('#nama_dosen').val()}</b></h1>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>NIDN</h1>
                        </td>
                        <td>
                            <h1><b>${$('#nidn').val()}</b></h1>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>Mata Kuliah</h1>
                        </td>
                        <td>
                            <h1><b>${$('#nama_matkul').val()}</b></h1>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>Kode MK</h1>
                        </td>
                        <td>
                            <h1><b>${$('#kode_mk').val()}</b></h1>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>Laboratorium</h1>
                        </td>
                        <td>
                            <h1><b>${$('#id_lab').val()}</b></h1>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>Kategori</h1>
                        </td>
                        <td>
                            <h1><b>${$('#kategori').val()}</b></h1>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>Tanggal</h1>
                        </td>
                        <td>
                            <h1><b>${$('#tanggal').val()}</b></h1>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>Jam Pinjam</h1>
                        </td>
                        <td>
                            <h1><b>${$('#jam_pinjam').val()}</b></h1>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>Jam Kembali</h1>
                        </td>
                        <td>
                            <h1><b>${$('#jam_kembali').val()}</b></h1>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>Keperluan</h1>
                        </td>
                        <td>
                            <h1><b>${$('#keperluan').val()}</b></h1>
                        </td>
                    </tr>
                </table>
                `,
                icon: `info`,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Konfirmasi'
            }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).parent().parent().submit()
                    }
                })
        })
    }

    // --- Peminjaman Alat ---
    let peminjamanalat = document.getElementById('peminjamanalat')
    if (peminjamanalat) {
        let name = peminjamanalat.dataset.name;
        let success = peminjamanalat.dataset.success;
        let error = peminjamanalat.dataset.error;
        if (success) {
            Swal.fire({
                title: `${name}`,
                text: `${success}`,
                icon: `success`
            })
        }
        if (error) {
            Swal.fire({
                title: `${name}`,
                text: `${error}`,
                icon: `error`
            })
        }
    }

    let tombolpinjamalat = document.getElementById('user-pinjam-alat-create')
    if (tombolpinjamalat) {
        tombolpinjamalat.addEventListener('click', function (event) {
            event.preventDefault();
            Swal.fire({
                width: '48rem',
                title: `Konfirmasi Data`,
                html: `
                <table style="width: 100%" class="border-2 border-blue-300">
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>NIM</h1>
                        </td>
                        <td>
                            <h1><b>${$('#nim').val()}</b></h1>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>Nama Lengkap</h1>
                        </td>
                        <td>
                            <h1><b>${$('#nama_mahasiswa').val()}</b></h1>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>Program Studi</h1>
                        </td>
                        <td>
                            <h1><b>${$('#id_prodi').val()}</b></h1>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>Angkatan</h1>
                        </td>
                        <td>
                            <h1><b>${$('#angkatan').val()}</b></h1>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>Jenis Kelamin</h1>
                        </td>
                        <td>
                            <h1><b>${$('#jenis_kelamin').val()}</b></h1>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>Kelas</h1>
                        </td>
                        <td>
                            <h1><b>${$('#kelas').val()}</b></h1>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>Nomor WhatsApp</h1>
                        </td>
                        <td>
                            <h1><b>${$('#no_hp').val()}</b></h1>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>Email</h1>
                        </td>
                        <td>
                            <h1><b>${$('#email').val()}</b></h1>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>Alat</h1>
                        </td>
                        <td>
                            <h1><b>${$('#id_alat').val()}</b></h1>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>Jumlah Pinjam</h1>
                        </td>
                        <td>
                            <h1><b>${$('#jumlah_pinjam').val()}</b></h1>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>Tanggal Pinjam</h1>
                        </td>
                        <td>
                            <h1><b>${$('#tanggal_pinjam').val()}</b></h1>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>Tanggal Kembali</h1>
                        </td>
                        <td>
                            <h1><b>${$('#tanggal_kembali').val()}</b></h1>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>Jam Pinjam</h1>
                        </td>
                        <td>
                            <h1><b>${$('#jam_pinjam').val()}</b></h1>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>Jam Kembali</h1>
                        </td>
                        <td>
                            <h1><b>${$('#jam_kembali').val()}</b></h1>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>Keperluan</h1>
                        </td>
                        <td>
                            <h1><b>${$('#keperluan').val()}</b></h1>
                        </td>
                    </tr>
                </table>
                `,
                icon: `info`,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Konfirmasi'
            }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).parent().parent().submit()
                    }
                })
        })
    }


    // --- Surat Bebas Labkom ---
    let suratbebaslabkom = document.getElementById('suratbebaslabkom')
    if (suratbebaslabkom) {
        let name = suratbebaslabkom.dataset.name;
        let success = suratbebaslabkom.dataset.success;
        let error = suratbebaslabkom.dataset.error;
        if (success) {
            Swal.fire({
                title: `${name}`,
                text: `${success}`,
                icon: `success`
            })
        }
        if (error) {
            Swal.fire({
                title: `${name}`,
                text: `${error}`,
                icon: `error`
            })
        }
    }
    let tombolsuratbebas = document.getElementById('user-surat-bebas-create')
    if (tombolsuratbebas) {
        tombolsuratbebas.addEventListener('click', function (event) {
            event.preventDefault();
            Swal.fire({
                width: '48rem',
                title: `Konfirmasi Data`,
                html: `
                <table style="width: 100%" class="border-2 border-blue-300">
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>NIM</h1>
                        </td>
                        <td>
                            <h1><b>${$('#nim').val()}</b></h1>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>Nama Lengkap</h1>
                        </td>
                        <td>
                            <h1><b>${$('#nama_mahasiswa').val()}</b></h1>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>Program Studi</h1>
                        </td>
                        <td>
                            <h1><b>${$('#id_prodi').val()}</b></h1>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>Angkatan</h1>
                        </td>
                        <td>
                            <h1><b>${$('#angkatan').val()}</b></h1>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>Jenis Kelamin</h1>
                        </td>
                        <td>
                            <h1><b>${$('#jenis_kelamin').val()}</b></h1>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>Kelas</h1>
                        </td>
                        <td>
                            <h1><b>${$('#kelas').val()}</b></h1>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>Nomor WhatsApp</h1>
                        </td>
                        <td>
                            <h1><b>${$('#no_hp').val()}</b></h1>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>Email</h1>
                        </td>
                        <td>
                            <h1><b>${$('#email').val()}</b></h1>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-blue-300">
                        <td class="border-r-2 border-blue-300">
                            <h1>Tanggal</h1>
                        </td>
                        <td>
                            <h1><b>${$('#tanggal').val()}</b></h1>
                        </td>
                    </tr>
                </table>
                `,
                icon: `info`,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Konfirmasi'
            }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).parent().parent().submit()
                    }
                })
        })
    }


    // --- Contact Mail ---
    let contact = document.getElementById('contact')
    if (contact) {
        let name = contact.dataset.name;
        let success = contact.dataset.success;
        let error = contact.dataset.error;
        if (success) {
            Swal.fire({
                title: `${name}`,
                text: `${success}`,
                icon: `success`
            })
        }
        if (error) {
            Swal.fire({
                title: `${name}`,
                text: `${error}`,
                icon: `error`
            })
        }
    }
});
