//window.addEventListener('DOMContentLoaded', event => {
//    // Simple-DataTables
//    // https://github.com/fiduswriter/Simple-DataTables/wiki
//
//    const datatablesSimple = document.getElementById('datatablesSimple');
//    if (datatablesSimple) {
//        new simpleDatatables.DataTable(datatablesSimple);
//    }
//});
// load data
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


//function follow_up_cbm() {
//    var modelunit = document.getElementById("inputModelUnit").value;
//    const data = {"modelUnit": modelunit};
//
//    fetch("<?= base_url('followup-cbm/get_code_unit') ?>", {
//        method: "POST",
//        headers: {
//            "Content-Type": "application/json",
//            "X-Requested-With": "XMLHttpRequest"
//        },
//        body: JSON.stringify(data)
//    })
//            .then((response) => response.json())
//            .then((data) => {
//                //console.log('Success:', data);
//                drawCodeUnit(data);
//            })
//            .catch((error) => {
//                console.error('Error:', error);
//            });
//}

// update data follow up
function updateFollowUp(noFollowup) {
    var hasExecuted = document.getElementById("has-executed").value;
    var dateExecuted = document.getElementById("date-executed").value;
    var pic = document.getElementById("pic").value;
    var followupStatus = document.getElementById("followup-status").value;
    var reasonCancelled = document.getElementById("reason-cancelled").value;

    const data = {"noFollowup": noFollowup, "hasExecuted": hasExecuted, "dateExecuted": dateExecuted, "pic": pic, "followupStatus": followupStatus, "reasonCancelled": reasonCancelled};

    fetch("update_followup", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-Requested-With": "XMLHttpRequest"
        },
        body: JSON.stringify(data)
    })
            .then((response) => response.json())
            .then((data) => {
                console.log('Success:', data);
                if (data.statusUpdate === 'ok') {
                    // refresh datatable
                    $('#datatablesSimple').DataTable().ajax.reload();
                    alert('Update data berhasil');
                }
            })
            .catch((error) => {
                console.error('Error:', error);
            });
}

$(document).ready(function () {
    load_data_cbm();
});

