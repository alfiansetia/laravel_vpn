
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

var btn_element = `<div class="btn-group" role="group" id="btn_group_action_table">
                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Action
                        <i data-feather="chevron-down"></i> 
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <li><button id="btn_add" type="button" class="dropdown-item bs-tooltip" title="Add Data">Add</button></li>
                        <li><button id="btn_delete" type="button" class="dropdown-item bs-tooltip" title="Delete Selected Data">Delete</button></li>
                    </ul>
                </div>`

var btn_element_refresh = `<div class="btn-group" role="group" id="btn_group_action_table">
    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        Action
        <i data-feather="chevron-down"></i> 
    </button>
    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
        <li><button id="btn_add" type="button" class="dropdown-item bs-tooltip" title="Add Data">Add</button></li>
        <li><button id="btn_delete" type="button" class="dropdown-item bs-tooltip" title="Delete Selected Data">Delete</button></li>
    </ul>
</div>
<button type="button" id="btn_refresh" class="btn btn-info ms-2">
<i class="fas fa-sync me-1 bs-tooltip" title="Refresh Data"></i>
</button>`

var btn_detail = `<button type="button" class="btn btn-secondary show-detail ms-1"><i
class="fas fa-info me-1 bs-tooltip" title="Detail"></i>Detail</button>`