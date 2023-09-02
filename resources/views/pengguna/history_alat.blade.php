@extends('layouts.pengguna')

@section('content')
<h1 class="h3 mb-3"><strong>History</strong> Peminjaman Alat</h1>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-hover my-0" id="tablePeminjaman">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kegiatan</th>
                    <th class="d-none d-xl-table-cell">Tanggal Mulai</th>
                    <th class="d-none d-xl-table-cell">Pukul</th>
                    <th>Status</th>
                    <th class="d-none d-md-table-cell">Action</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < 6; $i++)   
                <?php
                ?>
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>Project Fireball {{ $i+1 }}</td>
                    <td class="d-none d-xl-table-cell">0{{ $i+1 }}/01/2021</td>
                    <td class="d-none d-xl-table-cell">1{{ $i+1 }}.00</td>
                    <td><span class="badge bg-success">Disetujui</span></td>
                    <td class="d-none d-md-table-cell">
                        <a href="#" class="btn btn-sm btn-info">Detail</a>
                    </td>
                </tr>
                @endfor
            </tbody>
        </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script src="{{ asset('/js/custom/admin/peminjaman.js') }}"></script>
@endsection
