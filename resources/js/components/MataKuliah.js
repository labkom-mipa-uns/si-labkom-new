import React, {Component, useEffect, useState} from 'react'
import ReactDOM from 'react-dom'
import $ from 'jquery'
import Swal from 'sweetalert2'

class MataKuliah extends Component {
    componentDidMount() {
        const matakuliah_success = $('.matakuliah-success').data('flashdata')
        const matakuliah_warning = $('.matakuliah-warning').data('flashdata')
        const matakuliah_danger = $('.matakuliah-danger').data('flashdata')
        if (matakuliah_success) {
            Swal.fire({
                title: `Data Mata Kuliah`,
                text: `${matakuliah_success}`,
                icon: 'success'
            })
        } else if (matakuliah_warning) {
            Swal.fire({
                title: `Mohon Maaf`,
                text: `${matakuliah_warning}`,
                icon: 'warning'
            })
        } else if (matakuliah_danger) {
            Swal.fire({
                title: `Data Mata Kuliah`,
                text: `${matakuliah_danger}`,
                icon: 'error'
            })
        }

        $('.delete-matakuliah-button').click(function (event) {
            event.preventDefault()
            Swal.fire({
                title: 'Apakah Kamu Yakin?',
                text: "Data Mata Kuliah Akan Segera Dihapus!",
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
                <div className="modal fade" id="matakuliahModal" tabIndex="-1" role="dialog"
                     aria-labelledby="matakuliahModalLabel" aria-hidden="true">
                    <div className="modal-dialog modal-lg">
                        <div className="modal-content">
                            <div className="modal-header">
                                <h5 className="modal-title" id="matakuliahModalLabel">Data Mata Kuliah</h5>
                                <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div className="modal-body d-flex flex-column justify-content-center align-items-center">
                                <DataMataKuliah/>
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

function DataMataKuliah() {
    const [mataKuliah, setMataKuliah] = useState({})

    useEffect(() => {
        $('.detail-matakuliah-button').click(async function () {
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
                setMataKuliah({
                    nama: response.data.nama_matkul
                })
            }).catch(error => console.error(error))
        })
    })

    return (
        <React.Fragment>
            <div className="card-title m-0"><h2 className='m-0 font-weight-bold'>{mataKuliah.nama}</h2></div>
        </React.Fragment>
    )
}

export default MataKuliah

if (document.getElementById('detail-matakuliah')) {
    ReactDOM.render(<MataKuliah/>, document.getElementById('detail-matakuliah'))
}
