import React, {Component, useEffect, useState} from 'react'
import ReactDOM from 'react-dom'
import Swal from 'sweetalert2'

class Lab extends Component {
    componentDidMount() {
        const lab_success = $('.lab-success').data('flashdata')
        const lab_warning = $('.lab-warning').data('flashdata')
        const lab_danger = $('.lab-danger').data('flashdata')
        if (lab_success) {
            Swal.fire({
                title: `Data Laboratorium`,
                text: `${lab_success}`,
                icon: `success`
            })
        } else if (lab_warning) {
            Swal.fire({
                title: `Mohon Maaf`,
                text: `${lab_warning}`,
                icon: `warning`
            })
        } else if (lab_danger) {
            Swal.fire({
                title: `Data Laboratorium`,
                text: `${lab_danger}`,
                icon: `error`
            })
        }

        $('.delete-lab-button').click(function (event) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah Kamu Yakin?',
                text: "Data Laboratorium Akan Segera Dihapus!",
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
                <div className="modal fade" id="labModal" tabIndex="-1" role="dialog"
                     aria-labelledby="labModalLabel" aria-hidden="true">
                    <div className="modal-dialog modal-lg">
                        <div className="modal-content">
                            <div className="modal-header">
                                <h5 className="modal-title" id="labModalLabel">Data Laboratorium</h5>
                                <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div className="modal-body d-flex flex-column justify-content-center align-items-center">
                                <DataLab/>
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

function DataLab() {
    const [lab, setLab] = useState({})

    useEffect(() => {
        $('.detail-lab-button').click(async function () {
            await fetch(`${$(this).data('showurl')}`,{
                method: 'GET',
                mode: "same-origin",
                credentials: "same-origin",
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                }
            }).then(response => {
                if (response.ok) {
                    return response.json()
                }
                throw new Error(response.statusText)
            }).then(response => {
                setLab({
                    nama_lab: response.data.nama_lab
                })
            }).catch(error => console.error(error))
        });
    })

    return (
        <React.Fragment>
            <div className="card-title m-0"><h1 className='m-0 font-weight-bold'>{lab.nama_lab}</h1></div>
        </React.Fragment>
    )
}

export default Lab

if (document.getElementById('detail-lab')) {
    ReactDOM.render(<Lab/>, document.getElementById('detail-lab'));
}
