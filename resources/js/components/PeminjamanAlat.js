import React, {Component} from 'react';
import ReactDOM from 'react-dom';

class PeminjamanAlat extends Component {
    render() {
        return (
            <React.Fragment>

            </React.Fragment>
        );
    }
}

export default PeminjamanAlat;

if (document.getElementById('detail-peminjam-alat')) {
    ReactDOM.render(<PeminjamanAlat />, document.getElementById('detail-peminjam-alat'));
}
