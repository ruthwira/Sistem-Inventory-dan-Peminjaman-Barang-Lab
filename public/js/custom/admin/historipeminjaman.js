$(document).ready(function () {
    $("#tableHistoriPeminjaman").DataTable({
        dom: "<'#tableheader.row'<'col-6 pb-2'l><'col-4 ms-auto pb-2'f>><'#tableHistoriPeminjamanDT.row'<'col-12'tr>><'#tableFooter.row'<'col-4'i><'col-8'p>>",
        language: {
            sLengthMenu: "Tampilkan _MENU_ history",
            sInfo: "History ke _START_ s/d _END_ dari _TOTAL_",
            sInfoFiltered: "(disaring dari total _MAX_ history)",
        },
    });
    $("#tableHistoriPeminjaman_length").addClass("float-start");
    $("#tableHistoriPeminjaman_info").addClass("float-start");
    $("#tableHistoriPeminjaman_filter").addClass("float-end");
    $("#tableHistoriPeminjaman_paginate").addClass("float-end");
    $("#tableheader").addClass("mx-0");
    $("#tableHistoriPeminjamanDT").addClass("mx-0");
    $("#tableFooter").addClass("mx-0");
    $("#tableFooter").addClass("py-3");
});
