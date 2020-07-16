import React, {Component} from 'react'
import ReactDOM from 'react-dom'
import $ from 'jquery'
import Swal from 'sweetalert2'

class Home extends Component {
    componentDidMount() {
        const home_success = $('.home-success').data('flashdata')
        const home_warning = $('.home-warning').data('flashdata')
        const home_danger = $('.home-danger').data('flashdata')
        if (home_success) {
            Swal.fire({
                title: `Pemberitahuan`,
                text: `${home_success}`,
                icon: `success`
            })
        } else if (home_warning) {
            Swal.fire({
                title: `Mohon Maaf`,
                text: `${home_warning}`,
                icon: `warning`
            })
        } else if (home_danger) {
            Swal.fire({
                title: `Pemberitahuan`,
                text: `${home_danger}`,
                icon: `error`
            })
        }
    }

    render() {
        return (
            <React.Fragment>
            </React.Fragment>
        );
    }
}

export default Home

if (document.getElementById('home')) {
    ReactDOM.render(<Home/>, document.getElementById('home'));
}
