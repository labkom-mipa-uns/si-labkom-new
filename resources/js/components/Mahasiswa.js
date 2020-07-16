import React, {Component, useEffect, useState} from 'react'
import ReactDOM from 'react-dom'
import $ from 'jquery'
import Swal from 'sweetalert2'

class Mahasiswa extends Component {
    componentDidMount() {
        const mahasiswa_success = $('.mahasiswa-success').data('flashdata')
        const mahasiswa_warning = $('.mahasiswa-warning').data('flashdata')
        const mahasiswa_danger = $('.mahasiswa-danger').data('flashdata')
        if (mahasiswa_success) {
            Swal.fire({
                title: 'Data Mahasiswa',
                text: `${mahasiswa_success}`,
                icon: "success"
            })
        } else if (mahasiswa_warning) {
            Swal.fire({
                title: 'Mohon Maaf',
                text: `${mahasiswa_warning}`,
                icon: "warning"
            })
        } else if (mahasiswa_danger) {
            Swal.fire({
                title: 'Data Mahasiswa',
                text: `${mahasiswa_danger}`,
                icon: "error"
            })
        }

        $('.delete-mahasiswa-button').click(function (event) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah Kamu Yakin?',
                text: "Data Mahasiswa Akan Segera Dihapus!",
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
                <div className="modal fade" id="mahasiswaModal" tabIndex="-1" role="dialog"
                     aria-labelledby="mahasiswaModalLabel" aria-hidden="true">
                    <div className="modal-dialog modal-lg">
                        <div className="modal-content">
                            <div className="modal-header">
                                <h5 className="modal-title" id="mahasiswaModalLabel">Data Mahasiswa</h5>
                                <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div className="modal-body d-flex flex-column justify-content-center align-items-center">
                                <DataMahasiswa/>
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

function DataMahasiswa() {
    const [mahasiswa, setMahasiswa] = useState({})

    useEffect(() => {
        $('.detail-mahasiswa-button').click(async function () {
            await fetch(`${$(this).data('showurl')}`,{
                method: 'GET',
                mode: "same-origin",
                credentials: "same-origin",
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            }).then(response => {
                if (response.ok) {
                    return response.json()
                }
                throw new Error(response.statusText)
            }).then(response => {
                setMahasiswa({
                    nim: response.data.nim,
                    nama: response.data.nama_mahasiswa,
                    jenis_kelamin: response.data.jenis_kelamin,
                    kelas: response.data.kelas,
                    prodi: response.data.prodi.nama_prodi,
                    angkatan: response.data.angkatan,
                    no_hp: response.data.no_hp
                })
            })
        })
    })

    return (
        <React.Fragment>
            <div className="card-title m-0"><h1 className='m-0 font-weight-bold'>{mahasiswa.nim}</h1></div>
            <div className="card-title m-0"><h2>{mahasiswa.nama}</h2></div>
            <div className="card-subtitle"><h3 className='text-muted'>{mahasiswa.prodi} - {mahasiswa.kelas} - {mahasiswa.angkatan}</h3></div>
            <div className="card-subtitle"><h3 className='text-muted'>{(mahasiswa.jenis_kelamin === 'L') ? 'Laki-laki' : 'Perempuan'}</h3></div>
            <div className="card-subtitle"><h3 className='text-muted'>{mahasiswa.no_hp}</h3></div>
        </React.Fragment>
    )
}

export default Mahasiswa

if (document.getElementById('detail-mahasiswa')) {
    ReactDOM.render(<Mahasiswa/>, document.getElementById('detail-mahasiswa'));
}
