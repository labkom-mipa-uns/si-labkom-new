import React, {Component, useEffect, useState} from 'react';
import ReactDOM from 'react-dom';
import Swal from "sweetalert2";

class SuratBebasLabkom extends Component {
    componentDidMount() {
        const suratbebaslabkom_success = $('.suratbebaslabkom-success').data('flashdata')
        const suratbebaslabkom_warning = $('.suratbebaslabkom-warning').data('flashdata')
        const suratbebaslabkom_danger = $('.suratbebaslabkom-danger').data('flashdata')
        if (suratbebaslabkom_success) {
            Swal.fire({
                title: `Data Pemohon`,
                text: `${suratbebaslabkom_success}`,
                icon: `success`
            })
        } else if (suratbebaslabkom_warning) {
            Swal.fire({
                title: `Mohon Maaf`,
                text: `${suratbebaslabkom_warning}`,
                icon: `warning`
            })
        } else if (suratbebaslabkom_danger) {
            Swal.fire({
                title: `Data Pemohon`,
                text: `${suratbebaslabkom_danger}`,
                icon: `error`
            })
        }

        $('.delete-suratbebaslabkom-button').click(function (event) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah Kamu Yakin?',
                text: "Data Pemohon Akan Segera Dihapus!",
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
                <div className="modal fade" id="suratbebaslabkomModal" tabIndex="-1" role="dialog"
                     aria-labelledby="suratbebaslabkomModalLabel" aria-hidden="true">
                    <div className="modal-dialog modal-lg">
                        <div className="modal-content">
                            <div className="modal-header">
                                <h5 className="modal-title" id="suratbebaslabkomModalLabel">Data Peminjam Lab</h5>
                                <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div className="modal-body d-flex flex-column justify-content-center align-items-center">
                                <DataPemohon/>
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

function DataPemohon() {
    const [pemohon, setPemohon] = useState({})

    useEffect(() => {
        $('.detail-suratbebaslabkom-button').click(async function () {
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
                setPemohon({
                    nim: response.data.mahasiswa.nim,
                    nama: response.data.mahasiswa.nama_mahasiswa,
                    kelas: response.data.mahasiswa.kelas,
                    prodi: response.data.mahasiswa.prodi.nama_prodi,
                    angkatan: response.data.mahasiswa.angkatan,
                    no_hp: response.data.mahasiswa.no_hp,
                    tanggal: response.data.tanggal,
                    keperluan: response.data.keperluan,
                })
            }).catch(error => console.error(error));
        });
    });

    return (
        <React.Fragment>
            <div className="card-title m-0"><h1 className='m-0 font-weight-bold'>{pemohon.nim}</h1></div>
            <div className="card-title m-0"><h2>{pemohon.nama}</h2></div>
            <div className="card-subtitle"><h3 className='text-muted'>{pemohon.prodi} - {pemohon.kelas} - {pemohon.angkatan}</h3></div>
            <div className="card-subtitle"><h3 className='text-muted'>{pemohon.no_hp}</h3></div>
            <div className="card-subtitle"><h3 className='text-muted'>{pemohon.tanggal}</h3></div>
            <div className="card-subtitle"><h3 className='text-muted text-center'>{pemohon.keperluan}</h3></div>
        </React.Fragment>
    )
}

export default SuratBebasLabkom;

if (document.getElementById('detail-suratbebaslabkom')) {
    ReactDOM.render(<SuratBebasLabkom/>, document.getElementById('detail-suratbebaslabkom'));
}
