
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