@extends('layouts.admin')

@section('content')
    <h1 class="h3 mb-3"><strong>Beranda</strong> Admin</h1>
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Ruangan</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="align-middle" data-feather="truck"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">{{ count($ruangs) }}</h1>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Alat</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="align-middle" data-feather="users"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">{{ count($alats) }}</h1>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Pengajuan Bulan Ini</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="align-middle" data-feather="truck"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">{{ count($pengajuan_bulan_ini) }}</h1>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Peminjaman Bulan Ini</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="align-middle" data-feather="users"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">{{ count($peminjaman_bulan_ini) }}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-hover my-0" id="tablePeminjaman">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th>Nama Kegiatan</th>
                    <th class="text-center">Ruangan</th>
                    <th class="d-none d-xl-table-cell text-center">Tanggal Mulai</th>
                    <th class="d-none d-xl-table-cell text-center">Pukul</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
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
                    <td class="text-center">{{ $i+1 }}</td>
                    <td>{{ $peminjamans[$i]['nama_kegiatan'] }}</td>
                    <td class="text-center">{{ $peminjamans[$i]->ruang['ruang_nama'] }}</td>
                    <td class="d-none d-xl-table-cell text-center">{{ $peminjamans[$i]['tanggal_mulai'] }}</td>
                    <td class="d-none d-xl-table-cell text-center">{{ $peminjamans[$i]['waktu_mulai'] }}</td>
                    <td class="text-center"><span class="badge {{ $bg }}">{{ $txt }}</span></td>
                    <td class="text-center">
                        <a href="/admin/ruang/peminjaman/{{ $peminjamans[$i]['peminjaman_ruang_id'] }}" class="btn btn-sm btn-info">Detail</a>
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