
function deleteData(url) {
    if (selected()) {
        swal({
            title: 'Delete Selected Data?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: '<i class="fa fa-thumbs-up"></i> Yes!',
            confirmButtonAriaLabel: 'Thumbs up, Yes!',
            cancelButtonText: '<i class="fa fa-thumbs-down"></i> No',
            cancelButtonAriaLabel: 'Thumbs down',
            padding: '2em',
            animation: false,
            customClass: 'animated tada',
        }).then(function (result) {
            if (result.value) {
                let form = $("#formSelected");
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'DELETE',
                    url: url,
                    data: $(form).serialize(),
                    beforeSend: function () {
                        block();
                    },
                    success: function (res) {
                        unblock();
                        table.ajax.reload();
                        if (res.status == true) {
                            swal(
                                'Success!',
                                res.message,
                                'success'
                            )
                        } else {
                            swal(
                                'Failed!',
                                res.message,
                                'error'
                            )
                        }
                    },
                    error: function (xhr, status, error) {
                        unblock();
                        er = xhr.responseJSON.errors
                        if (xhr.status == 403) {
                            swal(
                                'Failed!',
                                xhr.responseJSON.message,
                                'error'
                            )
                        } else if (xhr.status == 422) {
                            swal(
                                'Failed!',
                                xhr.responseJSON.message,
                                'error'
                            )
                        } else if (xhr.status == 401) {
                            window.location.reload()
                        } else {
                            swal(
                                'Failed!',
                                'Server Error',
                                'error'
                            )
                        }
                    }
                });
            }
        })
    }
}

function selected() {
    let id = $('input[name="id[]"]:checked').length;
    if (id <= 0) {
        swal({
            title: 'Failed!',
            text: "No Selected Data!",
            type: 'error',
        })
        return false
    }
    return true
}