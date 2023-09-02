$(document).ready(function () {
    $("#tableDaftarAlat").DataTable({
        dom: "<'#tableheader.row'<'col-6 pb-2'l><'col-4 ms-auto pb-2'f>><'#tableDaftarAlatDT.row'<'col-12'tr>><'#tableFooter.row'<'col-4'i><'col-8'p>>",
        language: {
            sLengthMenu: "Tampilkan _MENU_ alat",
            sInfo: "Alat ke _START_ s/d _END_ dari _TOTAL_",
            sInfoFiltered: "(disaring dari total _MAX_ alat)",
        },
    });
    $("#tableDaftarAlat_length").addClass("float-start");
    $("#tableDaftarAlat_info").addClass("float-start");
    $("#tableDaftarAlat_filter").addClass("float-end");
    $("#tableDaftarAlat_paginate").addClass("float-end");
    $("#tableheader").addClass("mx-0");
    $("#tableDaftarAlatDT").addClass("mx-0");
    $("#tableFooter").addClass("mx-0");
    $("#tableFooter").addClass("py-3");
});
