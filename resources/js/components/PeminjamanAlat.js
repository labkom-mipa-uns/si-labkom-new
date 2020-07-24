import React, {Component, useEffect, useState} from 'react';
import ReactDOM from 'react-dom';
import Swal from "sweetalert2";

class PeminjamanAlat extends Component {
    componentDidMount() {
        const peminjamalat_success = $('.peminjamalat-success').data('flashdata')
        const peminjamalat_warning = $('.peminjamalat-warning').data('flashdata')
        const peminjamalat_danger = $('.peminjamalat-danger').data('flashdata')
        if (peminjamalat_success) {
            Swal.fire({
                title: `Data Peminjam Alat`,
                text: `${peminjamalat_success}`,
                icon: `success`
            })
        } else if (peminjamalat_warning) {
            Swal.fire({
                title: `Mohon Maaf`,
                text: `${peminjamalat_warning}`,
                icon: `warning`
            })
        } else if (peminjamalat_danger) {
            Swal.fire({
                title: `Data Peminjaman Alat`,
                text: `${peminjamalat_danger}`,
                icon: `error`
            })
        }

        $('.delete-peminjamanalat-button').click(function (event) {
            event.preventDefault()
            Swal.fire({
                title: 'Apakah Kamu Yakin?',
                text: "Data Peminjam Alat Akan Segera Dihapus!",
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
                <div className="modal fade" id="peminjamanalatModal" tabIndex="-1" role="dialog"
                     aria-labelledby="peminjamanalatModalLabel" aria-hidden="true">
                    <div className="modal-dialog modal-lg">
                        <div className="modal-content">
                            <div className="modal-header">
                                <h5 className="modal-title" id="peminjamanalatModalLabel">Data Peminjam Alat</h5>
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
        );
    }
}

function DataPeminjam() {
    const [peminjam, setPeminjam] = useState({})

    useEffect(() => {
        $('.detail-peminjamanalat-button').click(async function () {
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
                    alat: response.data.alat.nama_alat,
                    tanggal_pinjam: response.data.tanggal_pinjam,
                    tanggal_kembali: response.data.tanggal_kembali,
                    keperluan: response.data.keperluan,
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
            <div className="card-subtitle"><h3 className='text-muted'>{peminjam.alat}</h3></div>
            <div className="card-subtitle"><h3 className='text-muted'>{peminjam.tanggal_pinjam} - {peminjam.tanggal_kembali}</h3></div>
            <div className="card-subtitle"><h3 className='text-muted text-center'>{peminjam.keperluan}</h3></div>
            <div className="card-subtitle"><h3 className='text-muted'>{(peminjam.status === "0" ? "Masih Dipinjam" : "Sudah Dikembalikan")}</h3></div>
        </React.Fragment>
    )
}

export default PeminjamanAlat;

if (document.getElementById('detail-peminjamalat')) {
    ReactDOM.render(<PeminjamanAlat />, document.getElementById('detail-peminjamalat'));
}
