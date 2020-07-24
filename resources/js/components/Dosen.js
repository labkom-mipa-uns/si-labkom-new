import React, {Component, useEffect, useState} from 'react'
import ReactDOM from 'react-dom'
import $ from 'jquery'
import Swal from 'sweetalert2'

class Dosen extends Component {
    componentDidMount() {
        const dosen_success = $('.dosen-success').data('flashdata')
        const dosen_warning = $('.dosen-warning').data('flashdata')
        const dosen_danger = $('.dosen-danger').data('flashdata')
        if (dosen_success) {
            Swal.fire({
                title: `Data Dosen`,
                text: `${dosen_success}`,
                icon: 'success'
            })
        } else if (dosen_warning) {
            Swal.fire({
                title: `Mohon Maaf`,
                text: `${dosen_warning}`,
                icon: 'warning'
            })
        } else if (dosen_danger) {
            Swal.fire({
                title: `Data Dosen`,
                text: `${dosen_danger}`,
                icon: 'error'
            })
        }

        $('.delete-dosen-button').click(function (event) {
            event.preventDefault()
            Swal.fire({
                title: 'Apakah Kamu Yakin?',
                text: "Data Dosen Akan Segera Dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.value) {
                    $(this).parent().submit()
                }
            })
        })
    }

    render() {
        return (
            <React.Fragment>
                <div className="modal fade" id="dosenModal" tabIndex="-1" role="dialog"
                     aria-labelledby="dosenModalLabel" aria-hidden="true">
                    <div className="modal-dialog modal-lg">
                        <div className="modal-content">
                            <div className="modal-header">
                                <h5 className="modal-title" id="dosenModalLabel">Data Dosen</h5>
                                <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div className="modal-body d-flex flex-column justify-content-center align-items-center">
                                <DataDosen/>
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

function DataDosen() {
    const [dosen, setDosen] = useState({})

    useEffect(() => {
        $('.detail-dosen-button').click(async function () {
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
                setDosen({
                    nama: response.data.nama_dosen
                })
            }).catch(error => console.error(error))
        })
    })

    return (
        <React.Fragment>
            <div className="card-title m-0"><h2>{dosen.nama}</h2></div>
        </React.Fragment>
    )
}

export default Dosen

if (document.getElementById('detail-dosen')) {
    ReactDOM.render(<Dosen/>, document.getElementById('detail-dosen'));
}
