import React, {Component, useEffect, useState} from 'react'
import ReactDOM from 'react-dom'
import $ from 'jquery'
import Swal from "sweetalert2";

class Jadwal extends Component {
    componentDidMount() {
        const jadwal_success = $('.jadwal-success').data('flashdata')
        const jadwal_warning = $('.jadwal-warning').data('flashdata')
        const jadwal_danger = $('.jadwal-danger').data('flashdata')

        if (jadwal_success) {
            Swal.fire({
                title: `Data Jadwal`,
                text: `${jadwal_success}`,
                icon: `success`
            })
        } else if (jadwal_warning) {
            Swal.fire({
                title: `Mohon Maaf`,
                text: `${jadwal_warning}`,
                icon: `warning`
            })
        } else if (jadwal_danger) {
            Swal.fire({
                title: `Data Jadwal`,
                text: `${jadwal_danger}`,
                icon: `error`
            })
        }

        $('.delete-jadwal-button').click(function (event) {
            event.preventDefault()
            Swal.fire({
                title: 'Apakah Kamu Yakin?',
                text: "Data Jadwal Akan Segera Dihapus!",
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
                <div className="modal fade" id="jadwalModal" tabIndex="-1" role="dialog"
                     aria-labelledby="jadwalModalLabel" aria-hidden="true">
                    <div className="modal-dialog modal-lg">
                        <div className="modal-content">
                            <div className="modal-header">
                                <h5 className="modal-title" id="jadwalModalLabel">Data Jadwal</h5>
                                <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div className="modal-body d-flex flex-column justify-content-center align-items-center">
                                <DataJadwal/>
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

function DataJadwal() {
    const [jadwal, setJadwal] = useState({})

    useEffect(() => {
        $('.detail-jadwal-button').click(async function () {
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
                setJadwal({
                    prodi: response.data.prodi.nama_prodi,
                    dosen: response.data.dosen.nama_dosen,
                    matkul: response.data.matakuliah.nama_matkul
                })
            }).catch(error => console.error(error))
        })
    })

    return (
        <React.Fragment>
            <div className="card-title m-0"><h1 className='m-0 font-weight-bold'>{jadwal.prodi}</h1></div>
            <div className="card-title m-0"><h2>{jadwal.dosen}</h2></div>
            <div className="card-subtitle"><h3 className='text-muted'>{jadwal.matkul}</h3></div>
        </React.Fragment>
    )
}

export default Jadwal

if (document.getElementById('detail-jadwal')) {
    ReactDOM.render(<Jadwal/>, document.getElementById('detail-jadwal'));
}
