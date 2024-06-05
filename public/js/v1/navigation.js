function hide_element(element = []){
    element.forEach(e => {
        $('#card_'+e).hide();
    });
}

function show_element(element = []){
    element.forEach(e => {
        $('#card_'+e).show();
    });
}

function show_index(){
    hide_element(['detail', 'add', 'edit'])
    show_element(['table', 'filter'])
}

function show_card_detail() {
    show_element(['detail'])
    hide_element(['table', 'filter', 'add', 'edit'])
}

function hide_card_detail() {
   show_index()
}

function show_card_add() {
    show_element(['add'])
    hide_element(['table', 'filter', 'detail', 'edit'])
}

function hide_card_add() {
    show_index()
}

function show_card_edit() {
    show_element(['edit'])
    hide_element(['table', 'filter', 'detail', 'add'])
}

function hide_card_edit() {
    show_index()
}
