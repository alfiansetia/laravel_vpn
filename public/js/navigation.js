function show_card_detail() {
    $('#card_detail').show()
    $('#card_table').hide()
    $('#card_filter').hide()
    $('#card_add').hide()
}

function hide_card_detail() {
    $('#card_detail').hide()
    $('#card_table').show()
    $('#card_filter').show()
    $('#card_add').hide()
}

function hide_card_add() {
    $('#card_add').hide()
    $('#card_table').show()
    $('#card_filter').show()
    $('#card_detail').hide()
}

function show_card_add() {
    $('#card_add').show()
    $('#card_table').hide()
    $('#card_filter').hide()
    $('#card_detail').hide()
}
