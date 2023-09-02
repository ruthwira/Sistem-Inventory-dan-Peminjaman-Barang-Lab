$(document).ready(function () {
    $("#tableDaftarRuang").DataTable({
        dom: "<'#tableheader.row'<'col-6 pb-2'l><'col-4 ms-auto pb-2'f>><'#tableDaftarRuangDT.row'<'col-12'tr>><'#tableFooter.row'<'col-4'i><'col-8'p>>",
        language: {
            sLengthMenu: "Tampilkan _MENU_ ruangan",
            sInfo: "Ruangan ke _START_ s/d _END_ dari _TOTAL_",
            sInfoFiltered: "(disaring dari total _MAX_ ruangan)",
        },
    });
    $("#tableDaftarRuang_length").addClass("float-start");
    $("#tableDaftarRuang_info").addClass("float-start");
    $("#tableDaftarRuang_filter").addClass("float-end");
    $("#tableDaftarRuang_paginate").addClass("float-end");
    $("#tableheader").addClass("mx-0");
    $("#tableDaftarRuangDT").addClass("mx-0");
    $("#tableFooter").addClass("mx-0");
    $("#tableFooter").addClass("py-3");
});
