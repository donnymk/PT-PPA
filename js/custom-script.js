//window.addEventListener('DOMContentLoaded', event => {
//    // Simple-DataTables
//    // https://github.com/fiduswriter/Simple-DataTables/wiki
//
//    const datatablesSimple = document.getElementById('datatablesSimple');
//    if (datatablesSimple) {
//        new simpleDatatables.DataTable(datatablesSimple);
//    }
//});
// load data cbm
function load_data_cbm() {
    $('#datatablesSimple').dataTable({
        processing: true,
        ajax: "resume_data",
        order: [[0, 'asc']],
        // ordering: false,
        //    lengthMenu: [[5, 10], [5, 10]],
        //    pageLength: 5
    });
}

// load data master
function load_data_master() {
    $('#dataMaster').DataTable();
}

$(document).ready(function () {
    load_data_cbm();
    load_data_master();
});

