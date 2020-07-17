import React, {Component, useEffect, useState} from 'react';
import ReactDOM from 'react-dom';
import Swal from 'sweetalert2';

class PeminjamanLab extends Component {
    componentDidMount() {
        const peminjamLab_success = $('.peminjamlab-success').data('flashdata')
        const peminjamLab_warning = $('.peminjamlab-warning').data('flashdata')
        const peminjamLab_danger = $('.peminjamlab-danger').data('flashdata')
        if (peminjamLab_success) {
            Swal.fire({
                title: `Data Peminjam Lab`,
                text: `${peminjamLab_success}`,
                icon: `success`
            })
        } else if (peminjamLab_warning) {
            Swal.fire({
                title: `Mohon Maaf`,
                text: `${peminjamLab_warning}`,
                icon: `warning`
            })
        } else if (peminjamLab_danger) {
            Swal.fire({
                title: `Data Peminjam Lab`,
                text: `${peminjamLab_danger}`,
                icon: `error`
            })
        }

        $('.delete-peminjamanlab-button').click(function (event) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah Kamu Yakin?',
                text: "Data Peminjam Lab Akan Segera Dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.value) {
                    $(this).parent().submit();
                }
            })
        })
    }

    render() {
        return (
            <React.Fragment>
                <div className="modal fade" id="peminjamanLabModal" tabIndex="-1" role="dialog"
                     aria-labelledby="peminjamanLabModalLabel" aria-hidden="true">
                    <div className="modal-dialog modal-lg">
                        <div className="modal-content">
                            <div className="modal-header">
                                <h5 className="modal-title" id="peminjamanLabModalLabel">Data Peminjam Lab</h5>
                                <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div className="modal-body d-flex flex-column justify-content-center align-items-center">
                                <DataPeminjam/>
                            </div>
                            <div className="modal-footer">
                                <button type="button" className="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </React.Fragment>
        )
    }
}

function DataPeminjam() {
    const [peminjam, setPeminjam] = useState({})

    useEffect(() => {
        $('.detail-peminjamlab-button').click(async function () {
            await fetch(`${$(this).data('showurl')}`, {
                method: 'GET',
                mode: "same-origin",
                credentials: "same-origin",
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            }).then(response => {
                if (response.ok) {
                    return response.json();
                }
                throw new Error(response.statusText)
            }).then(response => {
                setPeminjam({
                    nim: response.data.mahasiswa.nim,
                    nama: response.data.mahasiswa.nama_mahasiswa,
                    kelas: response.data.mahasiswa.kelas,
                    prodi: response.data.mahasiswa.prodi.nama_prodi,
                    angkatan: response.data.mahasiswa.angkatan,
                    no_hp: response.data.mahasiswa.no_hp,
                    lab: response.data.lab.nama_lab,
                    dosen: response.data.jadwal.dosen.nama_dosen,
                    matakuliah: response.data.jadwal.matakuliah.nama_matkul,
                    tanggal: response.data.tanggal,
                    jam_pinjam: response.data.jam_pinjam,
                    jam_kembali: response.data.jam_kembali,
                    keperluan: response.data.keperluan,
                    kategori: response.data.kategori,
                    status: response.data.status
                })
            }).catch(error => console.error(error));
        });
    });

    return (
        <React.Fragment>
            <div className="card-title m-0"><h1 className='m-0 font-weight-bold'>{peminjam.nim}</h1></div>
            <div className="card-title m-0"><h2>{peminjam.nama}</h2></div>
            <div className="card-subtitle"><h3 className='text-muted'>{peminjam.prodi} - {peminjam.kelas} - {peminjam.angkatan}</h3></div>
            <div className="card-subtitle"><h3 className='text-muted'>{peminjam.no_hp}</h3></div>
            <div className="card-subtitle"><h3 className='text-muted'>{peminjam.lab}</h3></div>
            <div className="card-subtitle"><h3 className='text-muted'>{peminjam.dosen} - {peminjam.matakuliah}</h3></div>
            <div className="card-subtitle"><h3 className='text-muted'>{peminjam.tanggal}</h3></div>
            <div className="card-subtitle"><h3 className='text-muted'>{peminjam.jam_pinjam} - {peminjam.jam_kembali}</h3></div>
            <div className="card-subtitle"><h3 className='text-muted text-center'>{peminjam.keperluan}</h3></div>
            <div className="card-subtitle"><h3 className='text-muted'>{(peminjam.kategori === 'didalam_jam') ? "Didalam Jam Kuliah" : "Diluar Jam Kuliah"} - {(peminjam.status === "0" ? "Masih Dipinjam" : "Sudah Dikembalikan")}</h3></div>
        </React.Fragment>
    )
}

export default PeminjamanLab

if (document.getElementById('detail-peminjamlab')) {
    ReactDOM.render(<PeminjamanLab/>, document.getElementById('detail-peminjamlab'))
}
