//window.addEventListener('DOMContentLoaded', event => {
//    // Simple-DataTables
//    // https://github.com/fiduswriter/Simple-DataTables/wiki
//
//    const datatablesSimple = document.getElementById('datatablesSimple');
//    if (datatablesSimple) {
//        new simpleDatatables.DataTable(datatablesSimple);
//    }
//});
$('#datatablesSimple').dataTable({
    processing: true,
    ajax: "resume_data",
    order: [[0, 'asc']],
    // ordering: false,
//    lengthMenu: [[5, 10], [5, 10]],
//    pageLength: 5
});
