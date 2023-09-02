@extends('layouts.general')
@section('content')
        <div class="carousel slide" data-bs-ride="carousel" id="carouselMenu" style="height: 600px;">
        <div class="carousel-inner h-100">
            <div class="carousel-item active h-100"><img class="w-100 d-block position-absolute h-100 fit-cover"
                    alt="Slide Image" style="z-index: -1;" src="/img/sampul1.jpg">
                <div class="container d-flex flex-column justify-content-center h-100">
                    <div class="row">
                        <div class="col-md-6 col-xl-4 offset-md-2">
                            <div style="max-width: 350px;">
                                <h1 class="fw-bold" style="color: var(--bs-white);">Selamat datang di Web Laboratorium
                                    FTI</h1>
                                <p class="my-3" style="color: var(--bs-white);">Website ini memuat segala informasi
                                    mengenai peminjaman alat dan ruang yang berada di Laboratorium FTI.</p><a
                                    class="btn btn-secondary btn-lg me-2" href="#pilih_pinjaman">Mulai Peminjaman</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item h-100"><img class="w-100 d-block position-absolute h-100 fit-cover"
                    alt="Slide Image" style="z-index: -1;" src="/img/sampul2.jpg">
                <div class="container d-flex flex-column justify-content-center h-100">
                    <div class="row">
                        <div class="col-md-6 col-xl-4 offset-md-2">
                            <div style="max-width: 350px;">
                                <h1 class="fw-bold" style="color: var(--bs-white);">Peralatan apa saja yang tersedia di
                                    Laboratorium FTI?</h1>
                                <p class="my-3" style="color: var(--bs-white);">Lihat daftar peralatan dan
                                    ketersediannya</p><a class="btn btn-secondary btn-lg me-2"
                                    href="/daftar/alat">Daftar Alat</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item h-100"><img class="w-100 d-block position-absolute h-100 fit-cover"
                    alt="Slide Image" style="z-index: -1;" src="/img/sampul3.jpg">
                <div class="container d-flex flex-column justify-content-center h-100">
                    <div class="row">
                        <div class="col-md-6 col-xl-4 offset-md-2">
                            <div style="max-width: 350px;">
                                <h1 class="fw-bold" style="color: var(--bs-white);">Ruangan apa saja yang tersedia di
                                    Laboratorium FTI?</h1>
                                <p class="my-3" style="color: var(--bs-white);">Lihat daftar ruangan dan fasilitas
                                    yang ada di dalamnya</p><a class="btn btn-secondary btn-lg me-2"
                                    href="/daftar/ruang">Daftar Ruangan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div><a class="carousel-control-prev" href="#carouselMenu" role="button" data-bs-slide="prev"><span
                    class="carousel-control-prev-icon"></span><span class="visually-hidden">Previous</span></a><a
                class="carousel-control-next" href="#carouselMenu" role="button" data-bs-slide="next"><span
                    class="carousel-control-next-icon"></span><span class="visually-hidden">Next</span></a></div>
        <ol class="carousel-indicators" style="padding-bottom: 60px;">
            <li data-bs-target="#carouselMenu" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#carouselMenu" data-bs-slide-to="1"></li>
            <li data-bs-target="#carouselMenu" data-bs-slide-to="2"></li>
        </ol>
    </div>
    <div class="container h-100 position-relative" style="top: -50px;">
        <div class="col">
            <div class="card">
                <div class="card-body p-4">
                    <h4 class="card-title">Laboratorium FTI</h4>
                    <h6 class="text-muted card-subtitle mb-2">Agape Lt 2, 3, dan 4</h6>
                    <p class="card-text">Lab FTI 2 berada di Gedung Agape berfungsi sebagai ruang penyimpanan peralatan komputer FTI. Di lab FTI 2 juga ada server dan ruang bebas khusus untuk mahasiswa FTI.</p>
                    <p class="card-text">Lab FTI 3 berada di Gedung Agape berfungsi untuk pertemuan dan ruang diskusi.  Lab FTI 3 juga membantu mahasiswa mengumpulkan berkas Kerja Praktek dan Yudisium mahasiswa FTI.</p>
                    <p class="card-text">Lab FTI 4 berada di Gedung Agape digunakan untuk perkuliahan FTI.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container" id="pilih_pinjaman">
        <div class="row mb-5">
            <div class="col-md-8 col-xl-6 text-center mx-auto">
                <h2 class="fw-bolder">Ayo lakukan peminjaman di Laboratorium FTI<br></h2>
                <p class="w-lg-50" style="color: var(--bs-gray-600);">Kami menyediakan dua pilhan yang dapat
                    dilakukan!<br>
                </p>
            </div>
        </div>
        <div class="row gy-4 row-cols-1 row-cols-md-2">
            <div class="col">
                <div class="card" style="min-height: 100%;"><img class="card-img-top w-100 d-block fit-cover"
                        style="height: 200px;" src="/img/alat.jpg">
                    <div class="card-body p-4">
                        <h4 class="fw-bolder card-title">Peminjaman Alat</h4>
                        <p class="card-text">Peminjaman peralatan yang terdapat pada Laboratorium FTI
                        </p>
                        <div class="d-flex">
                            <div></div>
                        </div><a class="btn btn-primary btn-lg" role="button" style="min-width: 100%;"
                            href="/daftar/alat">Pilih</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="min-height: 100%;"><img class="card-img-top w-100 d-block fit-cover"
                        style="height: 200px;" src="/img/sampul1.jpg">
                    <div class="card-body p-4">
                        <h4 class="fw-bolder card-title">Peminjaman Ruangan</h4>
                        <p class="card-text">Peminjaman ruangan yang tersedia pada Laboratorium FTI</p>
                        <div class="d-flex"></div><a class="btn btn-primary btn-lg" role="button"
                            style="min-width: 100%;" href="/daftar/ruang">Pilih</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row my-5">

        </div>
    </div>
@endsection