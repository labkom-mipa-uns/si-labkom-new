import React, {Component} from 'react';
import ReactDOM from 'react-dom';

class PeminjamanLab extends Component {
    render() {
        return (
            <React.Fragment>

            </React.Fragment>
        )
    }
}

export default PeminjamanLab

if (document.getElementById('detail-peminjam-lab')) {
    ReactDOM.render(<PeminjamanLab/>, document.getElementById('detail-peminjam-lab'))
}
