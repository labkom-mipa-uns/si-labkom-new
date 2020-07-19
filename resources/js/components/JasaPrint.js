import React, {Component, useEffect, useState} from 'react'
import ReactDOM from 'react-dom'
import $ from 'jquery'
import Swal from 'sweetalert2'

class JasaPrint extends Component {
    componentDidMount() {
        const jasaprint_success = $('.jasaprint-success').data('flashdata')
        const jasaprint_warning = $('.jasaprint-warning').data('flashdata')
        const jasaprint_danger = $('.jasaprint-danger').data('flashdata')
        if (jasaprint_success) {
            Swal.fire({
                title: `Data Print`,
                text: `${jasaprint_success}`,
                icon: `success`
            })
        } else if (jasaprint_warning) {
            Swal.fire({
                title: `Mohon Maaf`,
                text: `${jasaprint_warning}`,
                icon: `warning`
            })
        } else if (jasaprint_danger) {
            Swal.fire({
                title: `Data Print`,
                text: `${jasaprint_danger}`,
                icon: `error`
            })
        }

        $('.delete-jasaprint-button').click(function (event) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah Kamu Yakin?',
                text: "Data Print Akan Segera Dihapus!",
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
                <div className="modal fade" id="jasaprintModal" tabIndex="-1" role="dialog"
                     aria-labelledby="jasaprintModalLabel" aria-hidden="true">
                    <div className="modal-dialog modal-lg">
                        <div className="modal-content">
                            <div className="modal-header">
                                <h5 className="modal-title" id="jasaprintModalLabel">Data Print</h5>
                                <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div className="modal-body d-flex flex-column justify-content-center align-items-center">
                                <DataPrint/>
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

function DataPrint() {
    const [print, setPrint] = useState({})

    useEffect(() => {
        $('.detail-jasaprint-button').click(async function () {
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
                setPrint({
                    jenis: response.data.jenis_print,
                    harga: response.data.harga_print,
                    tanggal: response.data.tanggal_print,
                })
            }).catch(error => console.error(error));
        });
    });

    return (
        <React.Fragment>
            <div className="card-title m-0"><h1 className='m-0 font-weight-bold'>{print.jenis}</h1></div>
            <div className="card-title m-0"><h2>{print.harga}</h2></div>
            <div className="card-subtitle"><h3 className='text-muted'>{print.tanggal}</h3></div>
        </React.Fragment>
    )
}

export default JasaPrint

if (document.getElementById('detail-jasaprint')) {
    ReactDOM.render(<JasaPrint/>, document.getElementById('detail-jasaprint'));
}
