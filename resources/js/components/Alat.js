import React, {Component, useEffect, useState} from 'react'
import ReactDOM from 'react-dom'
import $ from 'jquery'
import Swal from 'sweetalert2'

class Alat extends Component {
    componentDidMount() {
        const alat_success = $('.alat-success').data('flashdata')
        const alat_warning = $('.alat-warning').data('flashdata')
        const alat_danger = $('.alat-danger').data('flashdata')
        if (alat_success) {
            Swal.fire({
                title: `Data Alat`,
                text: `${alat_success}`,
                icon: `success`
            })
        } else if (alat_warning) {
            Swal.fire({
                title: `Mohon Maat`,
                text: `${alat_warning}`,
                icon: `warning`
            })
        } else if (alat_danger) {
            Swal.fire({
                title: `Data Alat`,
                text: `${alat_danger}`,
                icon: `error`
            })
        }

        $('.delete-alat-button').click(function (event) {
            event.preventDefault()
            Swal.fire({
                title: 'Apakah Kamu Yakin?',
                text: "Data Alat Akan Segera Dihapus!",
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
                <div className="modal fade" id="alatModal" tabIndex="-1" role="dialog"
                     aria-labelledby="alatModalLabel" aria-hidden="true">
                    <div className="modal-dialog modal-lg">
                        <div className="modal-content">
                            <div className="modal-header">
                                <h5 className="modal-title" id="alatModalLabel">Data Alat</h5>
                                <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div className="modal-body d-flex flex-column justify-content-center align-items-center">
                                <DataAlat/>
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

function DataAlat() {
    const [alat, setAlat] = useState({})

    useEffect(() => {
        $('.detail-alat-button').click(async function() {
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
                    return response.json()
                }
                throw new Error(response.statusText)
            }).then(response => {
                setAlat({
                    nama: response.data.nama_alat,
                    harga: response.data.harga_alat
                })
            }).catch(error => console.error(error))
        })
    })

    return (
        <React.Fragment>
            <div className="card-title m-0"><h1 className='m-0 font-weight-bold'>{alat.nama}</h1></div>
            <div className="card-title m-0"><h2>Rp.{alat.harga}</h2></div>
        </React.Fragment>
    )
}

export default Alat

if (document.getElementById('detail-alat')) {
    ReactDOM.render(<Alat/>, document.getElementById('detail-alat'))
}
