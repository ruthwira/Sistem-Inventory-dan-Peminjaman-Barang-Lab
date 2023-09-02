$(document).ready(function () {
    $("#tablePeminjaman").DataTable({
        dom: "<'#tableheader.row'<'col-6 pb-2'l><'col-4 ms-auto pb-2'f>><'#tablePeminjamanDT.row'<'col-12'tr>><'#tableFooter.row'<'col-4'i><'col-8'p>>",
        language: {
            sLengthMenu: "Tampilkan _MENU_ peminjaman",
            sInfo: "Peminjaman ke _START_ s/d _END_ dari _TOTAL_",
            sInfoFiltered: "(disaring dari total _MAX_ peminjaman)",
        },
    });
    $("#tablePeminjaman_length").addClass("float-start");
    $("#tablePeminjaman_info").addClass("float-start");
    $("#tablePeminjaman_filter").addClass("float-end");
    $("#tablePeminjaman_paginate").addClass("float-end");
    $("#tableheader").addClass("mx-0");
    $("#tablePeminjamanDT").addClass("mx-0");
    $("#tableFooter").addClass("mx-0");
    $("#tableFooter").addClass("py-3");
});
