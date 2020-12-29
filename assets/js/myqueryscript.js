const flashdata = $('.flash-data').data('flashdata');

if (flashdata) {
    Swal({
        title: 'Gagal Login',
        text: 'Username / Password salah..!',
        type: 'warning'
    });
}