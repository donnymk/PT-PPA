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
    load_data_cbm();
    load_data_master();

});

