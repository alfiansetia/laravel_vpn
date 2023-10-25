
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

function handleResponseForm(jqXHR) {
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
            $('#err_' + obname).text(er[obname][0]);
            $('#err_' + obname).show();
        }
    }

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