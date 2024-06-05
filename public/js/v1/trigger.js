// $(document).ready(function(){

    $('.show-detail').click(function() {
        show_card_detail()
    })

    $('.show-index').click(function() {
        show_index()
    })

    $('.close-detail').click(function() {
        hide_card_detail()
    })

    $('.show-edit').click(function() {
        show_card_edit()
    })

    $('#reset').click(function () {
        action_reset()
    })

    $('#edit_reset').click(function () {
        edit(false)
    })

    $('.btn_edit_refresh').click(function () {
        edit(false)
    })

    $('#edit_delete').click(function () {
        delete_data()
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
                send_ajax('form', 'POST')
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
                send_ajax('formEdit', 'PUT')
            }
        });
    }

    $('#btn_add').click(function() {
        show_card_add()
        input_focus('name')
    })

    $('.show-detail').click(function() {
        show_card_detail()
    })

    $('#btn_delete').click(function() {
        delete_batch()
    })

// })
