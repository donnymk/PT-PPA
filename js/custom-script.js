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

// load data populasi
function load_data_populasi() {
    $('#dataPopulasi').DataTable();
}

// tamppilkan grafik jumlah follow up yang berstatus "Open"
function chart_bar_followup_open() {
// Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';


    var ctx = document.getElementById("myBarChart");
//    $.ajax({
//        url: "jumlah_followup_open",
//        method: "GET",
//        success: function (data) {
//            console.log(data);
//            var label = [];
//            var value = [];
//            for (var i in data) {
//                label.push(data[i].cbm);
//                value.push(data[i].jumlahdata);
//            }
//            console.log(label);
//            var chart = new Chart(ctx, {
//                type: 'bar',
//                data: {
//                    labels: label,
//                    datasets: [{
//                            label: 'Jumlah Follow Up',
//                            backgroundColor: 'rgb(252, 116, 101)',
//                            borderColor: 'rgb(255, 255, 255)',
//                            data: value
//                        }]
//                },
//                options: {}
//            });
//        }
//    });

    fetch("jumlah_followup_open", {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
            "X-Requested-With": "XMLHttpRequest"
        }
    })
            .then((response) => response.json())
            .then((data) => {
                var label = [];
                var value = [];
                for (var i in data) {
                    label.push(data[i].cbm);
                    value.push(data[i].jumlahdata);
                }
                var chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: label,
                        datasets: [{
                                label: 'Jumlah Follow Up',
                                backgroundColor: 'rgb(252, 116, 101)',
                                borderColor: 'rgb(255, 255, 255)',
                                data: value
                            }]
                    },
                    options: {scales: {
                            xAxes: [{
                                    time: {
                                        unit: 'month'
                                    },
                                    gridLines: {
                                        display: false
                                    },
                                    ticks: {
                                        maxTicksLimit: 6
                                    }
                                }],
                            yAxes: [{
                                    ticks: {
                                        maxTicksLimit: 1
                                    },
                                    gridLines: {
                                        display: true
                                    }
                                }],
                        },
                        legend: {
                            display: false
                        }}
                });
            })
            .catch((error) => {
                console.error('Error:', error);
            });
}

$(document).ready(function () {
    load_data_cbm();
    load_data_populasi();
    chart_bar_followup_open();
});

