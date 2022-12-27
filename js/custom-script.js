//window.addEventListener('DOMContentLoaded', event => {
//    // Simple-DataTables
//    // https://github.com/fiduswriter/Simple-DataTables/wiki
//
//    const datatablesSimple = document.getElementById('datatablesSimple');
//    if (datatablesSimple) {
//        new simpleDatatables.DataTable(datatablesSimple);
//    }
//});
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

function follow_up_cbm() {
    var modelunit = document.getElementById("inputModelUnit").value;
    const data = {"modelUnit": modelunit};

    fetch("<?= base_url('followup-cbm/get_code_unit') ?>", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-Requested-With": "XMLHttpRequest"
        },
        body: JSON.stringify(data)
    })
            .then((response) => response.json())
            .then((data) => {
                //console.log('Success:', data);
                drawCodeUnit(data);
            })
            .catch((error) => {
                console.error('Error:', error);
            });
}

$(document).ready(function () {
    load_data_cbm();
});

