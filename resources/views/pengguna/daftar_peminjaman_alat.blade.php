@extends('layouts.pengguna')

@section('content')
    <h1 class="h3 mb-3"><strong>Data</strong> Peminjaman Alat</h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 float-end">
                            <a href="{{ route('pengguna.tambah_peminjaman_alat') }}"
                                class="btn btn-sm btn-success float-md-end">Tambah
                                Peminjaman</a>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-hover my-0" id="tablePeminjaman">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Nama Kegiatan</th>
                                            <th class="text-center">Alat</th>
                                            <th class="d-none d-xl-table-cell text-center">Tanggal Mulai</th>
                                            <th class="d-none d-xl-table-cell text-center">Waktu Mulai</th>
                                            <th class="d-none d-xl-table-cell text-center">Waktu Selesai</th>
                                            <th class="d-none d-xl-table-cell text-center">Qty</th>
                                            <th class="text-center">Status</th>
                                            <th class="d-none d-md-table-cell text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($peminjamanAlats as $i => $peminjaman)
                                            <tr>
                                                <td class="text-center">{{ $i + 1 }}</td>
                                                <td>{{ $peminjaman['nama_kegiatan'] }}</td>
                                                <td class="text-center">{{ $peminjaman->alat['alat_nama'] }}</td>
                                                <td class="d-none d-xl-table-cell text-center">
                                                    {{ $peminjaman['tanggal_mulai'] }}</td>
                                                <td class="d-none d-xl-table-cell text-center">{{ $peminjaman['waktu_mulai'] }}</td>
                                                <td class="d-none d-xl-table-cell text-center">{{ $peminjaman['waktu_selesai'] }}</td>
                                                <td class="d-none d-xl-table-cell text-center">{{ $peminjaman['alat_total'] }}</td>
                                                <td>
                                                    @if ($peminjaman['status_peminjaman'] == 'proses')
                                                        <span class="badge bg-warning">Proses</span>
                                                </td>
                                            @elseif($peminjaman['status_peminjaman'] == 'tolak')
                                                <span class="badge bg-danger">Ditolak</span></td>
                                            @elseif($peminjaman['status_peminjaman'] == 'acc')
                                                <span class="badge bg-success">Diterima</span></td>
                                        @endif
                                        <td class="d-none d-md-table-cell text-center">
                                            <a href="/pengguna/alat/peminjaman/detail/{{ $peminjaman['peminjaman_alat_id'] }}"
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
    <script src="{{ asset('/js/custom/admin/peminjaman.js') }}"></script>
@endsection
