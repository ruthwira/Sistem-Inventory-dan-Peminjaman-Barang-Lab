@extends('layouts.pengguna')

@section('content')
    <h1 class="h3 mb-3"><strong>Profile</strong> </h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-12">
                            <h3>Profile</h3>
                            <small class="text-muted float-start">Silakan isi data akun dengan benar</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            @if ($message = Session::get('successInfo'))
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <strong>Hore!</strong> {{ $message }}.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if ($message = Session::get('errorInfo'))
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <strong>Woaa!</strong> {{ $message }}.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <form action="{{ route('pengguna.update_profile') }}" method="post">
                                @csrf
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ $user['name'] }}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-6">
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ $user['email'] }}" required>
                                    </div>
                                </div>
                                @if ($isMahasiswa)
                                    <div class="row mb-3">
                                        <label for="mahasiswa_nim" class="col-sm-2 col-form-label">NIM</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="mahasiswa_nim"
                                                name="mahasiswa_nim" value="{{ $mahasiswa['mahasiswa_nim'] }}" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="mahasiswa_prodi" class="col-sm-2 col-form-label">Prodi</label>
                                        <div class="col-sm-6">
                                            <select class="form-select" id="mahasiswa_prodi" name="mahasiswa_prodi"
                                                required>
                                                @foreach ($prodis as $prodi)
                                                    @if ($mahasiswa['mahasiswa_prodi'] == $prodi['prodi_id'])
                                                        <option value="{{ $prodi['prodi_id'] }}" selected>
                                                            {{ $prodi['prodi_nama'] }}</option>
                                                    @else
                                                        <option value="{{ $prodi['prodi_id'] }}">{{ $prodi['prodi_nama'] }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="mahasiswa_angkatan" class="col-sm-2 col-form-label">Angkatan</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="mahasiswa_angkatan"
                                                name="mahasiswa_angkatan" value="{{ $mahasiswa['mahasiswa_angkatan'] }}"
                                                required>
                                        </div>
                                    </div>
                                @else
                                    <div class="row mb-3">
                                        <label for="dosen_nik" class="col-sm-2 col-form-label">NIK</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="dosen_nik"
                                                name="dosen_nik" value="{{ $dosen['dosen_nik'] }}" required>
                                        </div>
                                    </div>
                                @endif
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary float-end">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h3>Password</h3>
                            <div class="alert alert-dark">
                                <h6 class="alert-heading fw-bold mb-1">Apakah Anda yakin ingin mengganti password?</h6>
                                <p class="mb-0">Jika Anda lupa password baru setelah ini, silakan hubungi Admin.</p>
                            </div>
                            @if ($message = Session::get('successPW'))
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <strong>Hore!</strong> {{ $message }}.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if ($message = Session::get('errorPW'))
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
                            <form action="{{ route('pengguna.update_password') }}" method="post">
                                @csrf
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="password_lama">Password Lama</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control @error('pwLama') is-invalid @enderror"
                                            id="password_lama" name="password_lama" required>
                                        @error('pwLama')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="password_baru">Password Baru</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="password_baru"
                                            name="password_baru" required>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-12">
                                        <a href="{{ route('pengguna.index') }}"
                                            class="btn btn-secondary float-start">Kembali</a>
                                        <button type="submit" class="btn btn-primary float-end">Ganti
                                            Password</button>
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
@endsection
