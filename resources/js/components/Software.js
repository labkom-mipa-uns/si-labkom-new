import React, {Component, useEffect, useState} from 'react'
import ReactDOM from 'react-dom'
import $ from 'jquery'
import Swal from 'sweetalert2'

class Software extends Component {
    componentDidMount() {
        const software_success = $('.software-success').data('flashdata')
        const software_warning = $('.software-warning').data('flashdata')
        const software_danger = $('.software-danger').data('flashdata')
        if (software_success) {
            Swal.fire({
                title: `Data Software`,
                text: `${software_success}`,
                icon: `success`
            })
        } else if (software_warning) {
            Swal.fire({
                title: `Mohon Maaf`,
                text: `${software_warning}`,
                icon: `warning`
            })
        } else if (software_danger) {
            Swal.fire({
                title: `Data Software`,
                text: `${software_danger}`,
                icon: `error`
            })
        }

        $('.delete-software-button').click(function (event) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah Kamu Yakin?',
                text: "Data Software Akan Segera Dihapus!",
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
                <div className="modal fade" id="softwareModal" tabIndex="-1" role="dialog"
                     aria-labelledby="softwareModalLabel" aria-hidden="true">
                    <div className="modal-dialog modal-lg">
                        <div className="modal-content">
                            <div className="modal-header">
                                <h5 className="modal-title" id="softwareModalLabel">Data Software</h5>
                                <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div className="modal-body d-flex flex-column justify-content-center align-items-center">
                                <DataSoftware/>
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

function DataSoftware() {
    const [software, setSoftware] = useState({})

    useEffect(() => {
        $('.detail-software-button').click(async function () {
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
                setSoftware({
                    nama: response.data.nama_software,
                    harga: response.data.harga_software,
                })
            }).catch(error => console.error(error));
        });
    });

    return (
        <React.Fragment>
            <div className="card-title m-0"><h1 className='m-0 font-weight-bold'>{software.nama}</h1></div>
            <div className="card-title m-0"><h2>Rp.{software.harga}</h2></div>
        </React.Fragment>
    )
}

export default Software

if (document.getElementById('detail-software')) {
    ReactDOM.render(<Software/>, document.getElementById('detail-software'));
}
