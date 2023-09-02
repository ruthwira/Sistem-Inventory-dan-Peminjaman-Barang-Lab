@extends('layouts.admin')

@section('content')
<h1 class="h3 mb-3"><strong>Dashboard</strong> History Peminjaman</h1>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-hover my-0" id="tableHistoriPeminjaman">
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
                @for ($i = 0; $i < count($peminjamans); $i++)   
                <?php
                    if($peminjamans[$i]['status_peminjaman'] == 'proses'){
                        $bg = 'bg-warning';
                        $txt = 'Proses';
                    }else if($peminjamans[$i]['status_peminjaman'] == 'tolak'){
                        $bg = 'bg-danger';
                        $txt = 'Ditolak';
                    }else if($peminjamans[$i]['status_peminjaman'] == 'acc'){
                        $bg = 'bg-success';
                        $txt = 'Diterima';
                    }
                ?>
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $peminjamans[$i]['nama_kegiatan'] }}</td>
                    <td class="d-none d-xl-table-cell">{{ $peminjamans[$i]['tanggal_mulai'] }}</td>
                    <td class="d-none d-xl-table-cell">{{ $peminjamans[$i]['waktu_mulai'] }}</td>
                    <td><span class="badge {{ $bg }}">{{ $txt }}</span></td>
                    <td class="d-none d-md-table-cell">
                        <a href="/admin/detail_history_pengajuan/{{ $peminjamans[$i]['id_peminjaman_ruang'] }}" class="btn btn-sm btn-info">Detail</a>
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
    <script src="{{ asset('/js/custom/admin/historipeminjaman.js') }}"></script>
@endsection
