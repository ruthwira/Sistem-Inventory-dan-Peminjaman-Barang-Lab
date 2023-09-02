@extends('layouts.general')
@section('content')
    <div class="container py-4 py-xl-5 min-vh-100">
        <div class="row mb-5">
            <div class="col-md-8 col-xl-6 text-center mx-auto">
                <h2 class="fw-bold">Katalog Peralatan</h2>
                <p class="w-lg-50" style="color: var(--bs-gray-600);">Cek perlatan yang tersedia sebelum melakukan
                    peminjaman.</p>
            </div>
        </div>
        <div data-reflow-type="product-search" style="margin-bottom: 30px;"></div>
        <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3" style="margin-bottom: 60px;">
            <?php
            foreach ($alats as $alat) {
        ?>
            <div class="col-xxl-3">
                <div class="card">
                    @if (!empty($alat['path']))
                        <img class="card-img-top w-100 d-block fit-cover" style="height: 200px;" src="/img/alat/{{ $alat['path'] }}" alt="Foto alat">
                    @else
                        <img class="card-img-top w-100 d-block fit-cover" style="height: 200px;" src="/img/2.png">
                    @endif
                    <div class="card-body p-4">
                        <h4 class="card-title">{{ $alat['alat_nama'] }}</h4>
                        <p class="card-text mb-0" style="color: var(--bs-gray-600);">Qty</p>
                        <div class="d-flex">
                            <div>{{ $alat['alat_total'] }}</div>
                        </div>
                    </div>
                    <div class="card-img-overlay">
                        <span class="btn btn-sm btn-<?= $alat['b'] ? 'success' : 'danger' ?>"><?= $alat['b'] ? 'Tersedia' : 'Tidak Tersedia' ?>
                        </span>
                    </div>
                </div>
            </div>
            <?php
            }
        ?>
        </div>
    </div>
@endsection
