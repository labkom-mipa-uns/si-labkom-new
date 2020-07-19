import React, {Component, useEffect, useState} from 'react'
import ReactDOM from 'react-dom'
import $ from 'jquery'
import Swal from 'sweetalert2'

class JasaInstallasi extends Component {
    componentDidMount() {
        const jasainstallasi_success = $('.jasainstallasi-success').data('flashdata')
        const jasainstallasi_warning = $('.jasainstallasi-warning').data('flashdata')
        const jasainstallasi_danger = $('.jasainstallasi-danger').data('flashdata')
        if (jasainstallasi_success) {
            Swal.fire({
                title: `Data Customer`,
                text: `${jasainstallasi_success}`,
                icon: `success`
            })
        } else if (jasainstallasi_warning) {
            Swal.fire({
                title: `Mohon Maaf`,
                text: `${jasainstallasi_warning}`,
                icon: `warning`
            })
        } else if (jasainstallasi_danger) {
            Swal.fire({
                title: `Data Customer`,
                text: `${jasainstallasi_danger}`,
                icon: `error`
            })
        }

        $('.delete-peminjamanlab-button').click(function (event) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah Kamu Yakin?',
                text: "Data Customer Akan Segera Dihapus!",
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
                <div className="modal fade" id="jasainstallasiModal" tabIndex="-1" role="dialog"
                     aria-labelledby="jasainstallasiModalLabel" aria-hidden="true">
                    <div className="modal-dialog modal-lg">
                        <div className="modal-content">
                            <div className="modal-header">
                                <h5 className="modal-title" id="jasainstallasiModalLabel">Data Customer</h5>
                                <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div className="modal-body d-flex flex-column justify-content-center align-items-center">
                                <DataCustomer/>
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

function DataCustomer() {
    const [customer, setCustomer] = useState({})

    useEffect(() => {
        $('.detail-jasainstallasi-button').click(async function () {
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
                setCustomer({
                    nim: response.data.mahasiswa.nim,
                    nama: response.data.mahasiswa.nama_mahasiswa,
                    kelas: response.data.mahasiswa.kelas,
                    prodi: response.data.mahasiswa.prodi.nama_prodi,
                    angkatan: response.data.mahasiswa.angkatan,
                    no_hp: response.data.mahasiswa.no_hp,
                    tanggal: response.data.tanggal,
                    jam_ambil: response.data.jam_ambil,
                    kelengkapan: response.data.kelengkapan,
                    software: response.data.software.nama_software,
                    keterangan: response.data.keterangan,
                    jenis: response.data.jenis,
                })
            }).catch(error => console.error(error));
        });
    });

    return (
        <React.Fragment>
            <div className="card-title m-0"><h1 className='m-0 font-weight-bold'>{customer.nim}</h1></div>
            <div className="card-title m-0"><h2>{customer.nama}</h2></div>
            <div className="card-subtitle"><h3 className='text-muted'>{customer.prodi} - {customer.kelas} - {customer.angkatan}</h3></div>
            <div className="card-subtitle"><h3 className='text-muted'>{customer.no_hp}</h3></div>
            <div className="card-subtitle"><h3 className='text-muted'>{customer.software}</h3></div>
            <div className="card-subtitle"><h3 className='text-muted'>{customer.tanggal}</h3></div>
            <div className="card-subtitle"><h3 className='text-muted'>{customer.jam_ambil}</h3></div>
            <div className="card-subtitle"><h3 className='text-muted text-center'>{customer.laptop}</h3></div>
            <div className="card-subtitle"><h3 className='text-muted text-center'>{customer.kelengkapan}</h3></div>
            <div className="card-subtitle"><h3 className='text-muted text-center'>{customer.keterangan}</h3></div>
            <div className="card-subtitle"><h3 className='text-muted'>{(customer.jenis === 'service') ? "Service" : "Install"}</h3></div>
        </React.Fragment>
    )
}

export default JasaInstallasi

if (document.getElementById('detail-jasainstallasi')) {
    ReactDOM.render(<JasaInstallasi/>, document.getElementById('detail-jasainstallasi'));
}
