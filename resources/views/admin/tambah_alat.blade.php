@extends('layouts.admin')

@section('content')
    <h1 class="h3 mb-3"><strong>Tambah</strong> Alat</h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form method="POST" action="{{ route('admin.add_alat') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label for="path" class="col-sm-2 col-form-label">Foto Alat</label>
                                    <div class="col-sm-6">
                                        <p class="text-muted">Belum ada foto</p>
                                        <input class="form-control" type="file" id="path" name="path"
                                            required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="alat_nama" class="col-sm-2 col-form-label">Nama Alat</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="alat_nama" name="alat_nama" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="alat_total" class="col-sm-2 col-form-label">Total</label>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="alat_total" name="alat_total"
                                            required>
                                            <span class="input-group-text" id="basic-addon2">Buah</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="alat_keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                                    <div class="col-sm-9">
                                        <textarea name="alat_keterangan" id="alat_keterangan" cols="30" rows="10" class="form-control" required></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-11">
                                        <a href="{{ route('admin.daftar_alat') }}"
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
