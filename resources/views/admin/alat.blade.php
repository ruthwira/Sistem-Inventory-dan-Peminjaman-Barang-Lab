@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-12 col-md-8">
                            <h3>Daftar Alat</h3>
                        </div>
                        <div class="col-12 col-md-4">
                            <a href="{{ route('admin.tambah_alat') }}" class="btn btn-sm btn-success float-md-end">Tambah Alat</a>
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
                                <table class="table table-hover my-0" id="tableAlat">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Nama Alat</th>
                                            <th class="d-none d-xl-table-cell text-center">Qty</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($alats as $i => $alat)
                                            <tr>
                                                <td class="text-center">{{ $i + 1 }}</td>
                                                <td>{{ $alat['alat_nama'] }}</td>
                                                <td class="d-none d-xl-table-cell text-center">{{ $alat['alat_total'] }}</td>
                                                <td class="text-center">
                                                    <a href="/admin/alat/detail/{{ $alat['alat_id'] }}"
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
    $("#tableAlat").DataTable({
        dom: "<'#tableheader.row'<'col-6 pb-2'l><'col-4 ms-auto pb-2'f>><'#tableAlatDT.row'<'col-12'tr>><'#tableFooter.row'<'col-4'i><'col-8'p>>",
        language: {
            sLengthMenu: "Tampilkan _MENU_ ruang",
            sInfo: "Ruang ke _START_ s/d _END_ dari _TOTAL_",
            sInfoFiltered: "(disaring dari total _MAX_ ruang)",
        },
    });
    $("#tableAlat_length").addClass("float-start");
    $("#tableAlat_info").addClass("float-start");
    $("#tableAlat_filter").addClass("float-end");
    $("#tableAlat_paginate").addClass("float-end");
    $("#tableheader").addClass("mx-0");
    $("#tableAlatDT").addClass("mx-0");
    $("#tableFooter").addClass("mx-0");
    $("#tableFooter").addClass("py-3");
});

</script>
@endsection
