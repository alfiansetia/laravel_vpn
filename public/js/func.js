function convertUnixTimestampToTime(timestamp) {
    var date = new Date(timestamp * 1000);
    var year = date.getFullYear();
    var month = date.getMonth() + 1;
    var day = date.getDate();
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var seconds = date.getSeconds();

    var formattedTime = year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;

    return formattedTime;
}


function formatBytes(size) {
    var unit = [
        'Byte',
        'KiB',
        'MiB',
        'GiB',
        'TiB',
        'PiB',
        'EiB',
        'ZiB',
        'YiB'
    ];
    for (i = 0; size >= 1024 && i <= unit.length; i++) {
        size = size / 1024;
    }
    return parseFloat(size).toFixed(2) + ' ' + unit[i];
}


$('.show-index').click(function() {
    show_index()
})

function selected() {
    let id = $('input[name="id[]"]:checked').length;

    if (id <= 0) {
        Swal.fire({
            title: 'Failed!',
            text: "No Selected Data!",
            icon: 'error',
        })
        return false
    }
    return true
}

function show_alert(message, type){
    Swal.fire({
        title: type == 'success' ? 'Success!' : 'Failed!',
        text: message,
        icon: type,
    })
}

function handleResponseCode(code) {
    if (code === 404) {
        Swal.fire({
            title: 'Failed!',
            text: "Not Found!",
            icon: 'error',
        })
    } else if (code === 500) {
        Swal.fire({
            title: 'Failed!',
            text: "Server Error!",
            icon: 'error',
        })
    } else if (code === 403) {
        Swal.fire({
            title: 'Failed!',
            text: "Unauthorize!",
            icon: 'error',
        })
    } else if (code === 401) {
        Swal.fire({
            title: 'Failed!',
            text: "Unauthenticate!",
            icon: 'error',
        })
        window.location.reload();
    } else {
        Swal.fire({
            title: 'Failed!',
            text: "Error! Code : " + code,
            icon: 'error',
        })
    }
}

function handleResponse(jqXHR) {
    let message = jqXHR.responseJSON.message
    Swal.fire({
        title: 'Failed!',
        text: message,
        icon: 'error',
    })
    // if (jqXHR.status === 401) {
    //     window.location.reload();
    // }
}

function handleResponseForm(jqXHR, form = 'add') {
    let message = jqXHR.responseJSON.message

    if (jqXHR.status != 422) {
        Swal.fire({
            title: 'Failed!',
            text: message,
            icon: 'error',
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

function input_focus(input_name){
    $(`input[name="${input_name}"]`).focus();
}

function delete_batch(url) {
    if (selected()) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Data Will be Lost!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '<i class="fa fa-thumbs-up"></i> Yes!',
            confirmButtonAriaLabel: 'Thumbs up, Yes!',
            cancelButtonText: '<i class="fa fa-thumbs-down"></i> No',
            cancelButtonAriaLabel: 'Thumbs down',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            padding: '2em',
            customClass: 'animated tada',
            showClass: {
                popup: `animated tada`
            },
        }).then((result) => {
            if (result.isConfirmed) {
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
                        Swal.fire(
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
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Accept': 'application/json'
        }
    });
}

$('#reset').click(function () {
    action_reset()
})

if($('#form').length > 0){
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
                url: url_post,
                data: $(form).serialize(),
                beforeSend: function () {
                    block();
                    clear_validate($(form))
                },
                success: function (res) {
                    unblock();
                    table.ajax.reload();
                    reset();
                    Swal.fire(
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
}

if($('#formEdit').length > 0){
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
                    Swal.fire(
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
}

$('#edit_delete').click(function () {
    Swal.fire({
        title: 'Are you sure?',
        text: "Data Will be Lost!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '<i class="fa fa-thumbs-up"></i> Yes!',
        confirmButtonAriaLabel: 'Thumbs up, Yes!',
        cancelButtonText: '<i class="fa fa-thumbs-down"></i> No',
        cancelButtonAriaLabel: 'Thumbs down',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        padding: '2em',
        customClass: 'animated tada',
        showClass: {
            popup: `animated tada`
        },
    }).then((result) => {
        if (result.isConfirmed) {
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
                    Swal.fire(
                        'Success!',
                        res.message,
                        'success'
                    )
                    $('#modalEdit').modal('hide')
                    show_index()
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
    oPaginate: {
        sPrevious: '<i data-feather="arrow-left"></i>',
        sNext: '<i data-feather="arrow-right"></i>'
    },
    // "sInfo": "Showing page _PAGE_ of _PAGES_",
    sSearch: '<i data-feather="search"></i>',
    sSearchPlaceholder: "Search...",
    sLengthMenu: "Results :  _MENU_",
}

var dom = "<'inv-list-top-section'<'row'<'col-sm-12 col-md-6 d-flex justify-content-md-start justify-content-center'l<'dt-action-buttons align-self-center'B>><'col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center mt-md-0 mt-3'f<'toolbar align-self-center'>>>>" +
"<'table-responsive'tr>" +
"<'inv-list-bottom-section d-sm-flex justify-content-sm-between text-center'<'inv-list-pages-count  mb-sm-0 mb-3'i><'inv-list-pagination'p>>"

var btn_element = `<div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Action
                        <i data-feather="chevron-down"></i> 
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <li><button id="btn_add" type="button" class="dropdown-item bs-tooltip" title="Add Data">Add</button></li>
                        <li><button id="btn_delete" type="button" class="dropdown-item bs-tooltip" title="Delete Selected Data">Delete</button></li>
                    </ul>
                </div>`
