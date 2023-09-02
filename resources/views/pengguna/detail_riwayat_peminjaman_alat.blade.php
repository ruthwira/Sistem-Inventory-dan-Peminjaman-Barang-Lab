@extends('layouts.pengguna')

@section('content')
    <h1 class="h3 mb-3"><strong>Detail</strong> Riwayat Peminjaman Alat</h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-12">
                            <h3>Identitas Peminjam</h3>
                            <small class="text-muted float-start">Identitas peminjam sesuai dengan profile pengguna</small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <form>
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ $user['name'] }}" disabled required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-6">
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ $user['email'] }}" disabled required>
                                    </div>
                                </div>
                                @if ($isMahasiswa)
                                    <div class="row mb-3">
                                        <label for="mahasiswa_nim" class="col-sm-2 col-form-label">NIM</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="mahasiswa_nim"
                                                name="mahasiswa_nim" value="{{ $mahasiswa['mahasiswa_nim'] }}" disabled
                                                required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="mahasiswa_prodi" class="col-sm-2 col-form-label">Prodi</label>
                                        <div class="col-sm-6">
                                            <select class="form-select" id="mahasiswa_prodi" name="mahasiswa_prodi" disabled
                                                required>
                                                <option value="{{ $mahasiswa->prodi['prodi_id'] }}" selected>
                                                    {{ $mahasiswa->prodi['prodi_nama'] }}</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="mahasiswa_angkatan" class="col-sm-2 col-form-label">Angkatan</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="mahasiswa_angkatan"
                                                name="mahasiswa_angkatan" value="{{ $mahasiswa['mahasiswa_angkatan'] }}"
                                                disabled required>
                                        </div>
                                    </div>
                                @else
                                    <div class="row mb-3">
                                        <label for="dosen_nik" class="col-sm-2 col-form-label">NIK</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="dosen_nik" name="dosen_nik"
                                                value="{{ $dosen['dosen_nik'] }}" disabled required>
                                        </div>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <h3>Informasi Kegiatan</h3>
                            <small class="text-muted float-start">Silakan isi data akun dengan benar</small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <form>
                            <div class="row mb-3">
                                <label for="nama_kegiatan" class="col-sm-2 col-form-label">Nama Kegiatan</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan"
                                        <?= !$isEditable ? 'disabled' : '' ?> value="{{ $peminjaman['nama_kegiatan'] }}"
                                        required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="pj_kegiatan" class="col-sm-2 col-form-label">Penanggung Jawab</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="pj_kegiatan" name="pj_kegiatan"
                                        <?= !$isEditable ? 'disabled' : '' ?> value="{{ $peminjaman['pj_kegiatan'] }}"
                                        required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="alat_id" class="col-sm-2 col-form-label">Alat</label>
                                <div class="col-sm-6">
                                    <select class="form-select" id="alat_id" name="alat_id"
                                        <?= !$isEditable ? 'disabled' : '' ?> required>
                                        @foreach ($alats as $alat)
                                            @if ($alat['alat_id'] == $peminjaman['alat_id'])
                                                <option value="{{ $alat['alat_id'] }}" selected>{{ $alat['alat_nama'] }}</option>
                                            @else
                                                <option value="{{ $alat['alat_id'] }}">{{ $alat['alat_nama'] }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <label for="qty" class="col-sm-1 col-form-label">Qty</label>
                                <div class="col-sm-2">
                                    <input type="number" class="form-control" id="qty" name="qty"
                                        min="0" value="{{ $peminjaman['alat_total'] }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="tanggal_mulai" class="col-sm-2 col-form-label">Tanggal Kegiatan</label>
                                <div class="col-sm-3">
                                    <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai"
                                        <?= !$isEditable ? 'disabled' : '' ?> value="{{ $peminjaman['tanggal_mulai'] }}"
                                        required>
                                </div>
                                <label for="waktu_mulai" class="col-sm-1 col-form-label">Mulai</label>
                                <div class="col-sm-2">
                                    <input type="time" class="form-control" id="waktu_mulai" name="waktu_mulai"
                                        <?= !$isEditable ? 'disabled' : '' ?> value="{{ $peminjaman['waktu_mulai'] }}"
                                        required>
                                </div>
                                <label for="waktu_selesai" class="col-sm-1 col-form-label">Selesai</label>
                                <div class="col-sm-2">
                                    <input type="time" class="form-control" id="waktu_selesai" name="waktu_selesai"
                                        <?= !$isEditable ? 'disabled' : '' ?> value="{{ $peminjaman['waktu_selesai'] }}"
                                        required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="path_dokumen" class="col-sm-2 col-form-label">Surat Peminjaman</label>
                                <div class="col-sm-6">
                                    <input class="form-control" type="file" id="path_dokumen" name="path_dokumen"
                                        <?= !$isEditable ? 'disabled' : '' ?>>
                                </div>
                                <div class="col-sm-2">
                                    <a href="{{ url('surat/alat/' . $peminjaman['path_dokumen']) }}"
                                        class="btn btn-info">Download</a>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="status_peminjaman" class="col-sm-2 col-form-label">Status Pengajuan</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control {{ $class_status_peminjaman }} text-white"
                                        id="status_peminjaman" name="status_peminjaman" value="{{ $status_peminjaman }}"
                                        required <?= !$isEditable ? 'disabled' : '' ?>>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="deskripsi_kegiatan" class="col-sm-2 col-form-label">Deskripsi</label>
                                <div class="col-sm-9">
                                    <textarea name="deskripsi_kegiatan" id="deskripsi_kegiatan" cols="30" rows="10" class="form-control"
                                        <?= !$isEditable ? 'disabled' : '' ?> required>{{ $peminjaman['deskripsi_kegiatan'] }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-11">
                                    <a href="{{ route('pengguna.riwayat_peminjaman_alat') }}"
                                        class="btn btn-secondary float-start">Kembali</a>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function update(){
            let alat_qty = $('#alat_id option:selected').attr('data-qty');
            $('#qty').attr('max', alat_qty);
            $('#qty').attr('value', alat_qty);
        }

        let alat_qty = $('#alat_id option:selected').attr('data-qty');
        $('#qty').attr('max', alat_qty);

    </script>
@endsection
