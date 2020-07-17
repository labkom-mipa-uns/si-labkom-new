import React, {Component, useEffect, useState} from 'react'
import ReactDOM from 'react-dom'
import $ from 'jquery'
import Swal from 'sweetalert2'

class Prodi extends Component {
    componentDidMount() {
        const prodi_success = $('.prodi-success').data('flashdata')
        const prodi_warning = $('.prodi-warning').data('flashdata')
        const prodi_danger = $('.prodi-danger').data('flashdata')
        if (prodi_success) {
            Swal.fire({
                title: `Data Prodi`,
                text: `${prodi_success}`,
                icon: `success`
            })
        } else if (prodi_warning) {
            Swal.fire({
                title: `Mohon Maaf`,
                text: `${prodi_warning}`,
                icon: `warning`
            })
        } else if (prodi_danger) {
            Swal.fire({
                title: `Data Prodi`,
                text: `${prodi_danger}`,
                icon: `error`
            })
        }

        $('.delete-prodi-button').click(function (event) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah Kamu Yakin?',
                text: "Data Prodi Akan Segera Dihapus!",
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
                <div className="modal fade" id="prodiModal" tabIndex="-1" role="dialog"
                     aria-labelledby="prodiModalLabel" aria-hidden="true">
                    <div className="modal-dialog modal-lg">
                        <div className="modal-content">
                            <div className="modal-header">
                                <h5 className="modal-title" id="prodiModalLabel">Data Prodi</h5>
                                <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div className="modal-body d-flex flex-column justify-content-center align-items-center">
                                <DataProdi/>
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

function DataProdi() {
    const [prodi, setProdi] = useState({})

    useEffect(() => {
        $('.detail-prodi-button').click(async function () {
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
                setProdi({
                    nama: response.data.nama_prodi,
                })
            }).catch(error => console.error(error));
        });
    });

    return (
        <React.Fragment>
            <div className="card-title m-0"><h1 className='m-0 font-weight-bold'>{prodi.nama}</h1></div>
        </React.Fragment>
    )
}

export default Prodi

if (document.getElementById('detail-prodi')) {
    ReactDOM.render(<Prodi/>, document.getElementById('detail-prodi'))
}
