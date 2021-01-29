import React from 'react';
import MainMenuItem from '@/Shared/MainMenuItem';

export default ({ className }) => {
    return (
        <div className={className}>
            <MainMenuItem text="Dashboard" link="home" icon="tachometer" />
            <MainMenuItem text="Peminjaman Lab" link="PeminjamanLab.index" icon="office" />
            <MainMenuItem text="Peminjaman Alat" link="PeminjamanAlat.index" icon="office" />
            <MainMenuItem text="Surat Bebas Labkom" link="SuratBebasLabkom.index" icon="printer" />
            <MainMenuItem text="Jasa Print" link="JasaPrint.index" icon="printer" />
            <MainMenuItem text="Jasa Installasi" link="JasaInstallasi.index" icon="printer" />

            <MainMenuItem text="Laboratorium" link="Laboratorium.index" icon="users" />
            <MainMenuItem text="Alat" link="Alat.index" icon="users" />
            <MainMenuItem text="Mahasiswa" link="Mahasiswa.index" icon="users" />
            <MainMenuItem text="Prodi" link="Prodi.index" icon="users" />
            <MainMenuItem text="Dosen" link="Dosen.index" icon="users" />
            <MainMenuItem text="Mata Kuliah" link="MataKuliah.index" icon="users" />
            <MainMenuItem text="Jadwal" link="Jadwal.index" icon="users" />
            <MainMenuItem text="Software" link="Software.index" icon="users" />
            <MainMenuItem text="User" link="User.index" icon="users" />
        </div>
    );
};
