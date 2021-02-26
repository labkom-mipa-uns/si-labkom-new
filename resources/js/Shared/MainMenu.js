import React from 'react';
import MainMenuItem from '@/Shared/MainMenuItem';

export default ({ className }) => {
    return (
        <div className={className}>
            <MainMenuItem text="Dashboard" link="Dashboard" icon="tachometer" />
            <MainMenuItem text="Peminjaman Lab" link="PeminjamanLab.index" icon="desktop" />
            <MainMenuItem text="Peminjaman Alat" link="PeminjamanAlat.index" icon="tools" />
            <MainMenuItem text="Surat Bebas Labkom" link="SuratBebasLabkom.index" icon="file" />
            <MainMenuItem text="Jasa Print" link="JasaPrint.index" icon="printer" />
            <MainMenuItem text="Jasa Installasi" link="JasaInstallasi.index" icon="laptop-code" />
            <div className="my-4 w-3/4"/>
            <MainMenuItem text="Laboratorium" link="Laboratorium.index" icon="laptop" />
            <MainMenuItem text="Alat" link="Alat.index" icon="cube" />
            <MainMenuItem text="Mahasiswa" link="Mahasiswa.index" icon="users" />
            <MainMenuItem text="Prodi" link="Prodi.index" icon="book-reader" />
            <MainMenuItem text="Dosen" link="Dosen.index" icon="users" />
            <MainMenuItem text="Mata Kuliah" link="MataKuliah.index" icon="book-open" />
            <MainMenuItem text="Software" link="Software.index" icon="calendar-check" />
            <MainMenuItem text="User" link="User.index" icon="users" />
        </div>
    );
};
