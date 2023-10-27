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

function handleResponseCode(code) {
    if (code === 404) {
        swal({
            title: 'Failed!',
            text: "Not Found!",
            type: 'error',
        })
    } else if (code === 500) {
        swal({
            title: 'Failed!',
            text: "Server Error!",
            type: 'error',
        })
    } else if (code === 403) {
        swal({
            title: 'Failed!',
            text: "Unauthorize!",
            type: 'error',
        })
    } else if (code === 401) {
        swal({
            title: 'Failed!',
            text: "Unauthenticate!",
            type: 'error',
        })
        window.location.reload();
    } else {
        swal({
            title: 'Failed!',
            text: "Error! Code : " + code,
            type: 'error',
        })
    }
}

function handleResponse(jqXHR) {
    let message = jqXHR.responseJSON.message
    swal({
        title: 'Failed!',
        text: message,
        type: 'error',
    })
    // if (jqXHR.status === 401) {
    //     window.location.reload();
    // }
}

function handleResponseForm(jqXHR, form = 'add') {
    let message = jqXHR.responseJSON.message

    if (jqXHR.status != 422) {
        swal({
            title: 'Failed!',
            text: message,
            type: 'error',
        })
        // window.location.reload();
    } else {
        er = jqXHR.responseJSON.errors
        erlen = Object.keys(er).length
        for (i = 0; i < erlen; i++) {
            obname = Object.keys(er)[i];
            $('#' + obname).addClass('is-invalid');
            if (form === 'add') {
                $('#err_' + obname).text(er[obname][0]);
                $('#err_' + obname).show();
            } else if (form === 'edit') {
                $('#err_edit_' + obname).text(er[obname][0]);
                $('#err_edit_' + obname).show();
            }
        }
    }

}

function delete_batch(url) {
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
                ajax_setup()
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
                        swal(
                            'Success!',
                            res.message,
                            'success'
                        )
                    },
                    error: function (xhr, status, error) {
                        unblock();
                        handleResponse(xhr)
                    }
                });
            }
        })
    }
}

function action_reset() {
    clear_validate($('#form'))
    $('#form select').val('').trigger('change');
    // $('#form select').empty().trigger('change');
}

function clear_validate(form) {
    form.find('.error.invalid-feedback').each(function (i) {
        $(this).hide();
    });
    form.find('input.is-invalid, textarea.is-invalid').each(function (i) {
        $(this).removeClass('is-invalid');
    });
}

function reset() {
    $('#reset').click();
}

function ajax_setup() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
}

$('#reset').click(function () {
    action_reset()
})

$('#form').submit(function (event) {
    event.preventDefault();
}).validate({
    errorElement: 'span',
    errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
        $(element).addClass('is-valid');
    },
    submitHandler: function (form) {
        ajax_setup()
        $.ajax({
            type: 'POST',
            url: url,
            data: $(form).serialize(),
            beforeSend: function () {
                block();
                clear_validate(form)
            },
            success: function (res) {
                unblock();
                table.ajax.reload();
                reset();
                swal(
                    'Success!',
                    res.message,
                    'success'
                )
            },
            error: function (xhr, status, error) {
                unblock();
                handleResponseForm(xhr, 'add')
            }
        });
    }
});

$('#formEdit').submit(function (event) {
    event.preventDefault();
}).validate({
    errorElement: 'span',
    errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
        $(element).addClass('is-valid');
    },
    submitHandler: function (form) {
        ajax_setup()
        $.ajax({
            type: 'POST',
            url: url_put,
            data: $(form).serialize(),
            beforeSend: function () {
                block();
                $('#formEdit .error.invalid-feedback').each(function (i) {
                    $(this).hide();
                });
                $('#formEdit input.is-invalid').each(function (i) {
                    $(this).removeClass('is-invalid');
                });
            },
            success: function (res) {
                unblock();
                table.ajax.reload();
                reset();
                // action_reset()
                swal(
                    'Success!',
                    res.message,
                    'success'
                )
            },
            error: function (xhr, status, error) {
                unblock();
                handleResponseForm(xhr, 'edit')
            }
        });
    }
});

$('#edit_delete').click(function () {
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
            ajax_setup();
            $.ajax({
                type: 'DELETE',
                url: url_delete,
                beforeSend: function () {
                    block();
                },
                success: function (res) {
                    unblock();
                    table.ajax.reload();
                    swal(
                        'Success!',
                        res.message,
                        'success'
                    )
                    $('#modalEdit').modal('hide')
                },
                error: function (xhr, status, error) {
                    unblock();
                    handleResponse(xhr)
                }
            });
        }
    })
})

$('#edit_reset').click(function () {
    edit(false)
})

var length_menu = [
    [10, 50, 100, 500, 1000],
    ['10 rows', '50 rows', '100 rows', '500 rows', '1000 rows']
];

var o_lang = {
    "oPaginate": {
        "sPrevious": '<i data-feather="arrow-left"></i>',
        "sNext": '<i data-feather="arrow-right"></i>'
    },
    // "sInfo": "Showing page _PAGE_ of _PAGES_",
    "sSearch": '<i data-feather="search"></i>',
    "sSearchPlaceholder": "Search...",
    "sLengthMenu": "Results :  _MENU_",
};

var dom = "<'dt--top-section'<'row'<'col-sm-12 col-md-6 d-flex justify-content-md-start justify-content-center'B><'col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center mt-md-0 mt-3'f>>>" +
    "<'table-responsive'tr>" +
    "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>";

