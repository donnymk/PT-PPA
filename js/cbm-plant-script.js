//window.addEventListener('DOMContentLoaded', event => {
//    // Simple-DataTables
//    // https://github.com/fiduswriter/Simple-DataTables/wiki
//
//    const datatablesSimple = document.getElementById('datatablesSimple');
//    if (datatablesSimple) {
//        new simpleDatatables.DataTable(datatablesSimple);
//    }
//});
function get_timestamp() {
    var today = new Date();
    var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    var dateTime = date + ' ' + time;

    return dateTime;
}

// load data
//function load_data_cwp() {
//    $('#datatablesSimple').dataTable({
//        processing: true,
//        ajax: "resume_data",
//        order: [[0, 'asc']],
//        // ordering: false,
//        //    lengthMenu: [[5, 10], [5, 10]],
//        //    pageLength: 5
//        dom: 'Bfrtip',
//        buttons: [
//            {
//                extend: 'excelHtml5',
//                text: '<span class="fas fa-2x fa-file-excel"></span> Export Excel',
//                exportOptions: {
//                    columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23]
//                },
//                title: 'Resume Claim Warranty Proposal',
//                messageBottom: 'Data ' + get_timestamp() + ' melalui App online PT. PPA'
//            }
//        ]
//    });
//}

// load data CBM
function load_data_cbm() {
    $('#dataCbm').DataTable({
	lengthMenu: [[5, 10, 25], [5, 10, 25]],
        pageLength: 10,
        columnDefs: [
            {
                targets: '_all',
                className: 'dt-head-center'
            }
        ],
        initComplete: function () {
            var urutan = 0;
            this.api().columns([1, 3]).every(function () {
                urutan++;
                var column = this;
                var select = $('<select class="form-select"><option value="">--All--</option></select>')
                        //.appendTo($(column.footer()).empty())
                        .appendTo($('#filter'+urutan).empty())
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                    );
                            column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                        });
                column.data().unique().sort().each(function (d, j) {
                    select.append('<option value="' + d + '">' + d + '</option>');
                });
            });
        }
    });
}

function password1_show_hide() {
    var x = document.getElementById("inputOldPassword");
    var show_eye = document.getElementById("show_eye");
    var hide_eye = document.getElementById("hide_eye");
    hide_eye.classList.remove("d-none");
    if (x.type === "password") {
        x.type = "text";
        show_eye.style.display = "none";
        hide_eye.style.display = "block";
    } else {
        x.type = "password";
        show_eye.style.display = "block";
        hide_eye.style.display = "none";
    }
}

function password2_show_hide() {
    var x = document.getElementById("inputNewPassword");
    var show_eye = document.getElementById("show_eye2");
    var hide_eye = document.getElementById("hide_eye2");
    hide_eye.classList.remove("d-none");
    if (x.type === "password") {
        x.type = "text";
        show_eye.style.display = "none";
        hide_eye.style.display = "block";
    } else {
        x.type = "password";
        show_eye.style.display = "block";
        hide_eye.style.display = "none";
    }
}

function password3_show_hide() {
    var x = document.getElementById("inputNewPassword2");
    var show_eye = document.getElementById("show_eye3");
    var hide_eye = document.getElementById("hide_eye3");
    hide_eye.classList.remove("d-none");
    if (x.type === "password") {
        x.type = "text";
        show_eye.style.display = "none";
        hide_eye.style.display = "block";
    } else {
        x.type = "password";
        show_eye.style.display = "block";
        hide_eye.style.display = "none";
    }
}

$(document).ready(function () {
    //load_data_cwp();
    load_data_cbm();

});

