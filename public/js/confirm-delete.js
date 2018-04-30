function confirmDelete() {
    event.preventDefault();
    swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        confirmButtonClass: 'btn btn-danger',
        cancelButtonClass: 'btn btn-success',
        buttonsStyling: false,
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            swal({
                type: 'success',
                title: 'Your promotion will be delete.',
                showConfirmButton: false,
                timer: 1000
            }).then(function() {
                $('#del-btn').trigger( $.Event( "click" ) );
            })
        }
    })
}