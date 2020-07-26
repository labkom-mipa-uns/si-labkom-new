import React, {Component} from 'react'
import ReactDOM from 'react-dom'
import $ from 'jquery'
import Swal from 'sweetalert2'

class User extends Component {
    componentDidMount() {
        const user_success = $('.user-success').data('flashdata')
        const user_warning = $('.user-warning').data('flashdata')
        const user_danger = $('.user-danger').data('flashdata')
        if (user_success) {
            Swal.fire({
                title: `Data User`,
                text: `${user_success}`,
                icon: `success`
            })
        } else if (user_warning) {
            Swal.fire({
                title: `Mohon Maaf`,
                text: `${user_warning}`,
                icon: `warning`
            })
        } else if (user_danger) {
            Swal.fire({
                title: `Data User`,
                text: `${user_danger}`,
                icon: `error`
            })
        }

        $('.delete-user-button').click(function (event) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah Kamu Yakin?',
                text: "Data User Akan Segera Dihapus!",
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
            </React.Fragment>
        );
    }
}

export default User

if (document.getElementById('detail-user')) {
    ReactDOM.render(<User/>, document.getElementById('detail-user'))
}
