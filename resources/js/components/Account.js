import React, {Component} from 'react'
import ReactDOM from 'react-dom'
import $ from 'jquery'
import Swal from 'sweetalert2'

class Account extends Component {
    componentDidMount() {
        const account_success = $('.account-success').data('flashdata')
        const account_warning = $('.account-warning').data('flashdata')
        const account_danger = $('.account-danger').data('flashdata')
        if (account_success) {
            Swal.fire({
                title: `Data Account`,
                text: `${account_success}`,
                icon: `success`
            })
        } else if (account_warning) {
            Swal.fire({
                title: `Mohon Maaf`,
                text: `${account_warning}`,
                icon: `warning`
            })
        } else if (account_danger) {
            Swal.fire({
                title: `Data Account`,
                text: `${account_danger}`,
                icon: `error`
            })
        }

        $('.delete-account-button').click(function (event) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah Kamu Yakin?',
                text: "Data Account Akan Segera Dihapus!",
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

export default Account

if (document.getElementById('detail-account')) {
    ReactDOM.render(<Account/>, document.getElementById('detail-account'));
}
