// Peminjaman Lab
const flashData_success = $('flashdata-success').data('flashdata')
const flashData_warning = $('flashdata-warning').data('flashdata')
const flashData_danger = $('flashdata-danger').data('flashdata')
if (flashData_success) {
    Swal({
        title: `Data Peminjam Lab`,
        text: `Berhasil ${flashData_success}`,
        type: `success`
    })
} else if (flashData_warning) {
    Swal({
        title: `Mohon Maaf`,
        text: `${flashData_warning}`,
        type: `warning`
    })
} else {
    Swal({
        title: `Data Peminjam Lab`,
        text: `Gagal ${flashData_danger}`,
        type: `danger`
    })
}
