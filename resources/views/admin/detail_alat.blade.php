@extends('layouts.admin')

@section('content')
    <h1 class="h3 mb-3"><strong>Detail</strong> Alat</h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
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
                            <form method="POST" action="{{ route('admin.update_alat') }}" enctype="multipart/form-data">
                        <input type="hidden" name="id_alat" id="id_alat" value="{{ $alat['alat_id'] }}">
                                @csrf
                                <div class="row mb-3">
                                    <label for="path" class="col-sm-2 col-form-label">Foto Alat</label>
                                    <div class="col-sm-6">
                                        @if (!empty($alat['path']))
                                            <img class="w-100" style="height: 200px;"src="/img/alat/{{ $alat['path'] }}" alt="Foto alat">
                                        @else
                                            <p class="text-muted">Belum ada foto</p>
                                        @endif
                                        <input class="form-control mt-3" type="file" id="path" name="path">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="alat_nama" class="col-sm-2 col-form-label">Nama Alat</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="alat_nama" name="alat_nama" value="{{ $alat['alat_nama'] }}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="alat_total" class="col-sm-2 col-form-label">Total</label>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="alat_total" name="alat_total" value="{{ $alat['alat_total'] }}"
                                                required>
                                            <span class="input-group-text" id="basic-addon2">Buah</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="alat_keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                                    <div class="col-sm-9">
                                        <textarea name="alat_keterangan" id="alat_keterangan" cols="30" rows="10" class="form-control" required>{{ $alat['alat_keterangan'] }}</textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-11">
                                        <a href="{{ route('admin.daftar_alat') }}"
                                            class="btn btn-secondary float-start">Kembali</a>
                                        <button type="submit" class="btn btn-primary float-end">Simpan</button>
                                        <button type="button" class="btn btn-danger float-end mx-2" data-bs-toggle="modal"
                                            data-bs-target="#modalHapus">
                                            Hapus
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHapusLabel">Hapus Alat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.delete_alat') }}" method="post">
                        @csrf
                        <input type="hidden" name="id_alat" id="id_alat" value="{{ $alat['alat_id'] }}">
                        <div class="alert alert-danger" role="alert">
                            <h4 class="alert-heading fw-bolder">Anda akan menghapus data alat!</h4>
                            <p class="mb-0">Alat akan berhasil dihapus dari <i>database</i> jika alat tersebut tidak
                                pernah dipinjamkan.</p>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
