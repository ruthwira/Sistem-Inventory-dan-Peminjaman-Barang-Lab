@extends('layouts.admin')

@section('content')
    <h1 class="h3 mb-3"><strong>Tambah</strong> Ruang</h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form method="POST" action="{{ route('admin.add_ruang') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label for="path" class="col-sm-2 col-form-label">Foto Ruang</label>
                                    <div class="col-sm-6">
                                        <p class="text-muted">Belum ada foto</p>
                                        <input class="form-control" type="file" id="path" name="path"
                                            required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="ruang_nama" class="col-sm-2 col-form-label">Nama Ruangan</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="ruang_nama" name="ruang_nama" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="ruang_kapasitas" class="col-sm-2 col-form-label">Kapasitas</label>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="ruang_kapasitas" name="ruang_kapasitas"
                                            required>
                                            <span class="input-group-text" id="basic-addon2">Orang</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="ruang_lab" class="col-sm-2 col-form-label">Letak Ruangan</label>
                                    <div class="col-sm-6">
                                        <select class="form-select" id="ruang_lab" name="ruang_lab" required>
                                            <option value="Lab 2" selected>Lab 2 [Gedung Agape Lt. 2]</option>
                                            <option value="Lab 3" selected>Lab 3 [Gedung Agape Lt. 3]</option>
                                            <option value="Lab 4" selected>Lab 4 [Gedung Agape Lt. 4]</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="ruang_keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                                    <div class="col-sm-9">
                                        <textarea name="ruang_keterangan" id="ruang_keterangan" cols="30" rows="10" class="form-control" required></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-11">
                                        <a href="{{ route('admin.daftar_ruang') }}"
                                            class="btn btn-secondary float-start">Kembali</a>
                                        <button type="submit" class="btn btn-primary float-end">Simpan</button>
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
