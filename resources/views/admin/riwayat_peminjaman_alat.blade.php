@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-12 col-md-8">
                            <h3>Daftar Riwayat Peminjaman Alat</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <strong>Hore!</strong> {{ $message }}.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <strong>Woaa!</strong> {{ $message }}.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-hover my-0" id="tablePeminjamanAlat">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Nama Peminjam</th>
                                            <th class="text-center">Tanggal</th>
                                            <th class="d-none d-xl-table-cell text-center">Waktu Mulai</th>
                                            <th class="text-center">Alat</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($peminjamanAlats as $i => $peminjaman)
                                            <tr>
                                                <td class="text-center">{{ $i + 1 }}</td>
                                                <td>{{ $peminjaman->user['name'] }}</td>
                                                <td class="text-center">{{ $peminjaman['tanggal_mulai'] }}</td>
                                                <td class="d-none d-xl-table-cell text-center">{{ $peminjaman['waktu_mulai'] }}</td>
                                                <td class="text-center">{{ $peminjaman->alat['alat_nama'] }}</td>
                                                <td class="text-center">
                                                    @if ($peminjaman['status_peminjaman'] == 'proses')
                                                        <span class="badge bg-warning">Proses</span>
                                                </td>
                                            @elseif($peminjaman['status_peminjaman'] == 'tolak')
                                                <span class="badge bg-danger">Ditolak</span></td>
                                            @elseif($peminjaman['status_peminjaman'] == 'acc')
                                                <span class="badge bg-success">Diterima</span></td>
                                        @endif
                                                <td class="d-none d-md-table-cell text-center">
                                                    <a href="/admin/alat/riwayat/{{ $peminjaman['peminjaman_alat_id'] }}"
                                                        class="btn btn-sm btn-info">Detail</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    $(document).ready(function () {
    $("#tablePeminjamanAlat").DataTable({
        dom: "<'#tableheader.row'<'col-6 pb-2'l><'col-4 ms-auto pb-2'f>><'#tablePeminjamanAlatDT.row'<'col-12'tr>><'#tableFooter.row'<'col-4'i><'col-8'p>>",
        language: {
            sLengthMenu: "Tampilkan _MENU_ peminjaman",
            sInfo: "Peminjaman ke _START_ s/d _END_ dari _TOTAL_",
            sInfoFiltered: "(disaring dari total _MAX_ peminjaman)",
        },
    });
    $("#tablePeminjamanAlat_length").addClass("float-start");
    $("#tablePeminjamanAlat_info").addClass("float-start");
    $("#tablePeminjamanAlat_filter").addClass("float-end");
    $("#tablePeminjamanAlat_paginate").addClass("float-end");
    $("#tableheader").addClass("mx-0");
    $("#tablePeminjamanAlatDT").addClass("mx-0");
    $("#tableFooter").addClass("mx-0");
    $("#tableFooter").addClass("py-3");
});

</script>
@endsection
