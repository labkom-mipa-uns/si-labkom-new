import React from 'react';
import MainMenuItem from '@/Shared/MainMenuItem';

export default ({ className }) => {
    return (
        <div className={className}>
            <MainMenuItem text="Dashboard" link="dashboard" icon="dashboard" />
            <MainMenuItem text="Peminjaman Lab" link="peminjamanlab" icon="office" />
            <MainMenuItem text="Peminjaman Alat" link="peminjamanalat" icon="office" />
            <MainMenuItem text="Surat Bebas Labkom" link="suratbebaslabkom" icon="printer" />
            <MainMenuItem text="Jasa Print" link="jasaprint" icon="printer" />
            <MainMenuItem text="Jasa Installasi" link="jasainstallasi" icon="printer" />

            <MainMenuItem text="Laboratorium" link="lab" icon="users" />
            <MainMenuItem text="Alat" link="alat" icon="users" />
            <MainMenuItem text="Mahasiswa" link="mahasiswa" icon="users" />
            <MainMenuItem text="Prodi" link="prodi" icon="users" />
            <MainMenuItem text="Dosen" link="dosen" icon="users" />
            <MainMenuItem text="Mata Kuliah" link="matakuliah" icon="users" />
            <MainMenuItem text="Jadwal" link="jadwal" icon="users" />
            <MainMenuItem text="Software" link="software" icon="users" />
            <MainMenuItem text="User" link="user" icon="users" />
        </div>
    );
};
