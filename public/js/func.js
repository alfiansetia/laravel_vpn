
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

function handleResponseStatus(jqXHR) {
    if (jqXHR.status === 404) {
        swal({
            title: 'Failed!',
            text: "Not Found!",
            type: 'error',
        })
    } else if (jqXHR.status === 500) {
        swal({
            title: 'Failed!',
            text: "Server Error!",
            type: 'error',
        })
    } else if (jqXHR.status === 403) {
        swal({
            title: 'Failed!',
            text: "Unauthorize!",
            type: 'error',
        })
    } else if (jqXHR.status === 401) {
        swal({
            title: 'Failed!',
            text: "Unauthenticate!",
            type: 'error',
        })
        window.location.reload();
    } else {
        swal({
            title: 'Failed!',
            text: "Error! Code : " + jqXHR.status,
            type: 'error',
        })
    }
}