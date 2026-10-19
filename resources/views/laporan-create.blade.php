<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penilaian Anak | TPA Kemenkes</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        rel="stylesheet">


    <style>
        .swal2-container {
            z-index: 9999 !important;
        }
    </style>



    <style>
        :root {
            --primary: #168653;
            --primary-dark: #106b42;
            --primary-light: #eaf7ef;
            --text-dark: #25352d;
            --text-muted: #748078;
            --border-color: #e5ebe6;
            --page-bg: #f4f7f5;
        }

        * {
            box-sizing: border-box;
        }

        html {
            width: 100%;
            min-height: 100%;
            overflow-x: clip;
        }

        body {
            width: 100%;
            min-height: 100vh;
            margin: 0;
            background: var(--page-bg);
            color: var(--text-dark);
            font-family: "Segoe UI", Arial, sans-serif;
            overflow-x: clip;
        }

        img,
        input,
        select,
        textarea,
        button {
            max-width: 100%;
        }

        /* NAVBAR */
        .navbar-custom {
            width: 100%;
            background: #fff;
            border-bottom: 1px solid #e8eee9;
            padding: 14px 0;
        }

        .brand-icon {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            background: var(--primary-light);
            color: var(--primary);
            border-radius: 13px;
            font-size: 21px;
        }

        .brand-title {
            font-size: 17px;
            font-weight: 700;
            margin: 0;
        }

        .brand-subtitle {
            color: var(--text-muted);
            font-size: 12px;
            margin-top: 3px;
        }

        /* LAYOUT UTAMA */
        .main-container {
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
            padding: 35px 24px 40px;
        }

        .page-heading {
            width: 100%;
            margin-bottom: 28px;
        }

        .page-heading h1 {
            font-size: 27px;
            font-weight: 750;
            line-height: 1.3;
            margin-bottom: 9px;
        }

        .page-heading p {
            color: var(--text-muted);
            font-size: 14px;
            margin-bottom: 0;
        }

        .heading-icon {
            width: 62px;
            height: 62px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            background: var(--primary-light);
            color: var(--primary);
            border-radius: 18px;
            font-size: 26px;
        }

        /* CARD UTAMA */
        .main-card {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            margin: 0;
            padding: 26px;
            background: #fff;
            border: 1px solid #e9eeea;
            border-radius: 18px;
            box-shadow: 0 8px 30px rgba(31, 65, 43, .045);
        }

        /* SEMUA KOLOM BOOTSTRAP */
        .main-card .row {
            min-width: 0;
        }

        .main-card [class*="col-"] {
            min-width: 0;
        }

        /* CARD INFORMASI ANAK */
        .child-info-card,
        .activity-card,
        .condition-card,
        .meal-card {
            width: 100%;
            min-width: 0;
            background: #fff;
            border: 1px solid var(--border-color);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 2px 7px rgba(31, 65, 43, .035);
        }

        .child-info-card {
            margin-bottom: 22px;
        }

        .child-info-card h2,
        .child-info-card h3 {
            font-size: 21px;
            font-weight: 700;
            line-height: 1.4;
            overflow-wrap: anywhere;
        }

        .child-info-card p {
            color: var(--text-muted);
            font-size: 14px;
            margin-bottom: 8px;
            overflow-wrap: anywhere;
        }

        /* JUDUL SECTION */
        .section-title {
            font-size: 19px;
            font-weight: 700;
            line-height: 1.4;
            margin-bottom: 6px;
            overflow-wrap: anywhere;
        }

        .section-description {
            color: var(--text-muted);
            font-size: 13px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        /* KEGIATAN HARIAN */
        .activity-section {
            width: 100%;
            min-width: 0;
        }

        .activity-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
            width: 100%;
            min-width: 0;
        }

        .activity-item {
            width: 100%;
            min-width: 0;
            padding: 17px;
            background: #fff;
            border: 1px solid #e1e8e3;
            border-radius: 15px;
            transition: border-color .2s ease;
        }

        .activity-item:focus-within {
            border-color: #a8d5b9;
        }

        .activity-item h3,
        .activity-item h4,
        .activity-name {
            font-size: 15px;
            font-weight: 650;
            line-height: 1.5;
            margin: 0 0 5px;
            overflow-wrap: anywhere;
        }

        .activity-time {
            display: block;
            color: var(--text-muted);
            font-size: 12px;
            line-height: 1.6;
            margin-bottom: 13px;
        }

        /* RADIO PENILAIAN KEGIATAN */
        .rating-options {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-start;
            gap: 10px 16px;
            width: 100%;
            min-width: 0;
        }

        .rating-options .form-check {
            display: flex;
            align-items: flex-start;
            gap: 7px;
            min-width: 0;
            margin: 0;
            padding: 0;
        }

        .rating-options .form-check-input {
            float: none;
            flex: 0 0 17px;
            width: 17px;
            height: 17px;
            margin: 3px 0 0;
            cursor: pointer;
        }

        .rating-options .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .rating-options .form-check-label {
            min-width: 0;
            font-size: 13px;
            line-height: 1.6;
            overflow-wrap: anywhere;
            cursor: pointer;
        }

        /* INPUT FORM */
        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 650;
            margin-bottom: 8px;
        }

        .form-control,
        .form-select {
            display: block;
            width: 100%;
            min-width: 0;
            min-height: 44px;
            border: 1px solid #dfe6e1;
            border-radius: 10px;
            font-size: 14px;
            padding: 10px 12px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(22, 134, 83, .11);
        }

        .input-group {
            width: 100%;
            min-width: 0;
            flex-wrap: nowrap;
        }

        .input-group .input-group-text {
            background: #f8faf8;
            border-color: #dfe6e1;
            color: #718078;
        }

        .input-group .form-control {
            min-width: 0;
        }

        /* KONDISI HARI INI */
        .condition-card,
        .meal-card {
            margin-bottom: 20px;
        }

        .condition-card .section-title,
        .meal-card .section-title {
            margin-bottom: 20px;
        }

        .condition-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
            width: 100%;
        }

        .condition-list .form-check {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            min-width: 0;
            margin: 0;
            padding: 0;
        }

        .condition-list .form-check-input {
            float: none;
            flex: 0 0 17px;
            width: 17px;
            height: 17px;
            margin: 3px 0 0;
        }

        .condition-list .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .condition-list .form-check-label {
            min-width: 0;
            font-size: 14px;
            line-height: 1.5;
            overflow-wrap: anywhere;
        }

        /* ALERT */
        .alert {
            border-radius: 11px;
            font-size: 13px;
            overflow-wrap: anywhere;
        }

        /* TOMBOL */
        .btn-check-data,
        .btn-assessment,
        .btn-submit {
            width: 100%;
            min-height: 46px;
            border: none;
            border-radius: 10px;
            background: var(--primary);
            color: #fff;
            font-size: 14px;
            font-weight: 650;
            padding: 12px 16px;
            transition: background .2s ease;
        }

        .btn-check-data:hover,
        .btn-assessment:hover,
        .btn-submit:hover {
            background: var(--primary-dark);
            color: #fff;
        }

        .btn-assessment {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        /* HASIL VERIFIKASI */
        .result-card {
            width: 100%;
            min-width: 0;
            margin-top: 25px;
            border: 1px solid #dcebe1;
            border-radius: 14px;
            overflow: hidden;
        }

        .result-header {
            padding: 17px 20px;
            background: #eff9f2;
            color: var(--primary-dark);
        }

        .result-header h2 {
            font-size: 15px;
            font-weight: 700;
            margin: 0 0 5px;
        }

        .result-header p {
            font-size: 12px;
            margin: 0;
        }

        .result-body {
            width: 100%;
            min-width: 0;
            padding: 20px;
        }

        .info-section-title {
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
            padding: 10px 0;
            border-bottom: 1px solid #f0f2f0;
            font-size: 13px;
        }

        .info-label {
            flex: 0 1 45%;
            color: var(--text-muted);
        }

        .info-value {
            flex: 1;
            min-width: 0;
            font-weight: 600;
            text-align: right;
            overflow-wrap: anywhere;
        }

        /* FOOTER */
        .footer-text {
            width: 100%;
            margin-top: 25px;
            color: #8a968e;
            text-align: center;
            font-size: 12px;
            line-height: 1.8;
        }

        /* DESKTOP DAN LAPTOP */
        @media (min-width: 992px) {
            .main-container {
                padding: 38px 30px 45px;
            }

            .activity-item {
                padding: 18px;
            }
        }

        /* TABLET */
        @media (max-width: 991.98px) {
            .main-container {
                padding: 30px 18px 35px;
            }

            .main-card {
                padding: 22px;
            }

            .child-info-card,
            .activity-card,
            .condition-card,
            .meal-card {
                padding: 17px;
            }

            .rating-options {
                gap: 10px 14px;
            }
        }

        /* MOBILE */
        @media (max-width: 767.98px) {
            .main-container {
                width: 100%;
                padding: 25px 12px 30px;
            }

            .main-card {
                padding: 16px;
                border-radius: 15px;
            }

            .page-heading {
                margin-bottom: 22px;
            }

            .page-heading h1 {
                font-size: 23px;
            }

            .page-heading p {
                font-size: 13px;
            }

            .heading-icon {
                width: 55px;
                height: 55px;
                font-size: 23px;
            }

            .child-info-card,
            .activity-card,
            .condition-card,
            .meal-card {
                padding: 16px;
                border-radius: 13px;
            }

            .child-info-card h2,
            .child-info-card h3 {
                font-size: 19px;
            }

            .section-title {
                font-size: 17px;
            }

            .activity-item {
                padding: 14px;
                border-radius: 12px;
            }

            .rating-options {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 12px 10px;
            }

            .rating-options .form-check {
                width: 100%;
            }

            .rating-options .form-check-label {
                font-size: 13px;
            }

            .condition-card,
            .meal-card {
                margin-bottom: 16px;
            }

            .result-body {
                padding: 15px;
            }

            .result-header {
                padding: 15px;
            }

            .footer-text {
                font-size: 11px;
            }
        }

        /* MOBILE KECIL */
        @media (max-width: 400px) {
            .navbar-custom {
                padding: 11px 0;
            }

            .brand-icon {
                width: 39px;
                height: 39px;
                font-size: 18px;
            }

            .brand-title {
                font-size: 14px;
            }

            .brand-subtitle {
                font-size: 10px;
            }

            .main-container {
                padding-right: 8px;
                padding-left: 8px;
            }

            .main-card {
                padding: 12px;
            }

            .child-info-card,
            .activity-card,
            .condition-card,
            .meal-card {
                padding: 13px;
            }

            .page-heading h1 {
                font-size: 21px;
            }

            .rating-options {
                grid-template-columns: minmax(0, 1fr);
                gap: 10px;
            }

            .rating-options .form-check-label {
                font-size: 14px;
            }

            .info-row {
                gap: 8px;
            }
        }
    </style>


</head>

<body>

    <nav class="navbar-custom">
        <div class="container d-flex align-items-center gap-3">
            <div class="brand-icon">
                <i class="fa-solid fa-child-reaching"></i>
            </div>

            <div>
                <p class="brand-title">TPA Kementerian Kesehatan</p>
                <div class="brand-subtitle">Sistem Informasi Penitipan Anak</div>
            </div>
        </div>
    </nav>

    <main class="container main-container">

        <div class="page-heading">
            <div class="row align-items-center">

                <div class="col-md-8">

                    <h3 class="mb-1 fw-bold">
                        Penilaian Laporan Harian Anak
                    </h3>

                    <p class="text-muted mb-0">
                        Form evaluasi dan perkembangan harian peserta daycare
                    </p>

                </div>

                <div class="col-md-4 text-md-end mt-3 mt-md-0">

                    <a href="{{ route('laporan') }}"
                        class="btn btn-light rounded-pill px-4">

                        <i class="ti ti-arrow-left me-1"></i>
                        Kembali

                    </a>

                </div>

            </div>
        </div>

        <div class="main-card">

            <form method="POST"
                action="{{ route('laporan.store', $peserta->id) }}">

                @csrf

                <input type="hidden"
                    name="jadwal_id"
                    value="{{ $peserta->jadwal_id }}">

                <input type="hidden"
                    name="anak_id"
                    value="{{ $peserta->anak_id }}">

                <div class="row">

                    {{-- LEFT --}}
                    <div class="col-lg-8">

                        {{-- DATA ANAK --}}
                        <div class="card border-0 shadow-sm rounded-4 mb-4">

                            <div class="card-body">

                                <div class="d-flex align-items-center">

                                    {{-- FOTO --}}
                                    <div class="flex-shrink-0">

                                        @if ($peserta->anak->foto)

                                        <img src="{{ asset('storage/' . $peserta->anak->foto) }}"
                                            class="rounded-circle border"
                                            width="90"
                                            height="90"
                                            style="object-fit:cover;">

                                        @else

                                        <div class="rounded-circle bg-light-success d-flex align-items-center justify-content-center"
                                            style="width:90px;height:90px;">

                                            <i class="ti ti-user text-success"
                                                style="font-size:35px;"></i>

                                        </div>

                                        @endif

                                    </div>

                                    {{-- INFO --}}
                                    <div class="ms-3">

                                        <h4 class="mb-1 fw-bold">
                                            {{ $peserta->anak->nama }}
                                        </h4>

                                        <div class="text-muted d-flex flex-column gap-1">

                                            <div>

                                                <i class="ti ti-calendar"></i>

                                                {{ \Carbon\Carbon::parse($peserta->jadwal->tanggal)->translatedFormat('l, d F Y') }}

                                            </div>

                                            <div>

                                                <i class="ti ti-user"></i>

                                                Orang Tua:
                                                {{ $peserta->anak->user->nama ?? '-' }}

                                            </div>

                                            <div>

                                                <i class="ti ti-clock"></i>
                                                Check In:
                                                {{ $peserta->waktu_masuk ? \Carbon\Carbon::parse($peserta->waktu_masuk)->format('H:i') : '-' }}
                                                &emsp;
                                                <i class="ti ti-clock"></i>
                                                Check Out:
                                                {{ $peserta->waktu_keluar ? \Carbon\Carbon::parse($peserta->waktu_keluar)->format('H:i') : '-' }}

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        {{-- SUHU ANAK --}}
                        <div class="card border-0 shadow-sm rounded-4 mb-4">

                            <div class="card-header bg-white border-0 pt-4">

                                <h5 class="fw-bold mb-1">
                                    Suhu Anak
                                </h5>

                                <p class="text-muted small mb-0">
                                    Pemantauan suhu tubuh anak
                                </p>

                            </div>

                            <div class="card-body">

                                <div class="row g-3">

                                    {{-- Suhu Saat Datang --}}
                                    <div class="col-12 col-md-6">
                                        <div class="border rounded-4 p-3 h-100">
                                            <label for="suhu_datang" class="form-label fw-semibold">
                                                <i class="fa-solid fa-temperature-half me-2 text-primary"></i>
                                                Suhu Anak Saat Datang
                                            </label>

                                            <div class="input-group">
                                                <input type="number"
                                                    class="form-control"
                                                    id="suhu_datang"
                                                    name="suhu_datang"
                                                    placeholder="Contoh: 36.5"
                                                    min="30"
                                                    max="45"
                                                    step="0.1"
                                                    required>

                                                <span class="input-group-text">°C</span>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Suhu Saat Pulang --}}
                                    <div class="col-12 col-md-6">
                                        <div class="border rounded-4 p-3 h-100">
                                            <label for="suhu_pulang" class="form-label fw-semibold">
                                                <i class="fa-solid fa-temperature-half me-2 text-danger"></i>
                                                Suhu Anak Saat Pulang
                                            </label>

                                            <div class="input-group">
                                                <input type="number"
                                                    class="form-control"
                                                    id="suhu_pulang"
                                                    name="suhu_pulang"
                                                    placeholder="Contoh: 36.7"
                                                    min="30"
                                                    max="45"
                                                    step="0.1">

                                                <span class="input-group-text">°C</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                        {{-- KEGIATAN --}}
                        <div class="card border-0 shadow-sm rounded-4 mb-4">

                            <div class="card-header bg-white border-0 pt-4">

                                <h5 class="fw-bold mb-1">
                                    Kegiatan Harian
                                </h5>

                                <p class="text-muted small mb-0">
                                    Penilaian aktivitas dan respon anak
                                </p>

                            </div>

                            <div class="card-body">

                                @foreach ($kategori->where('kategori', 'kegiatan') as $item)
                                <div class="border rounded-4 p-3 mb-3">

                                    <div class="row g-3 align-items-center">

                                        {{-- Deskripsi kegiatan --}}
                                        <div class="col-12 col-lg-4">
                                            <h6 class="mb-1 fw-semibold">
                                                {{ $item->deskripsi }}
                                            </h6>

                                            <small class="text-muted">
                                                {{ $item->keterangan }}
                                            </small>
                                        </div>

                                        {{-- Pilihan penilaian --}}
                                        <div class="col-12 col-lg-8">
                                            <div class="row g-2">

                                                @php
                                                $pilihan = [
                                                'Sangat Baik',
                                                'Baik',
                                                'Cukup',
                                                'Perlu Pendampingan',
                                                ];
                                                @endphp

                                                @foreach ($pilihan as $nilai)
                                                <div class="col-6 col-md-3">
                                                    <label class="border rounded-3 p-2 d-flex align-items-center gap-2 h-100 w-100"
                                                        style="cursor: pointer;">

                                                        <input
                                                            class="form-check-input mt-0 flex-shrink-0"
                                                            type="radio"
                                                            name="kegiatan[{{ $item->id }}]"
                                                            value="{{ $nilai }}">

                                                        <span class="small">
                                                            {{ $nilai == 'Perlu Pendampingan' ? 'Pendampingan' : $nilai }}
                                                        </span>

                                                    </label>
                                                </div>
                                                @endforeach

                                            </div>
                                        </div>

                                    </div>

                                </div>
                                @endforeach

                                {{-- Catatan kegiatan --}}
                                <div class="mt-4">
                                    <label class="form-label fw-semibold">
                                        Catatan Kegiatan Hari Ini
                                    </label>

                                    <textarea
                                        class="form-control"
                                        rows="4"
                                        name="catatan_kegiatan"
                                        placeholder="Tambahkan catatan kegiatan anak hari ini"></textarea>
                                </div>

                            </div>

                        </div>

                        {{-- PERKEMBANGAN --}}
                        <div class="card border-0 shadow-sm rounded-4 mb-4">

                            <div class="card-header bg-white border-0 pt-4">

                                <h5 class="fw-bold mb-1">
                                    Perkembangan Hari Ini
                                </h5>

                                <p class="text-muted small mb-0">
                                    Penilaian perkembangan anak
                                </p>

                            </div>

                            <div class="card-body">

                                @foreach (['Motorik Kasar', 'Motorik Halus', 'Bahasa / Komunikasi', 'Sosial & Emosi', 'Kemandirian'] as $perkembangan)

                                <div class="border rounded-4 p-3 mb-3">

                                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                                        <h6 class="mb-0">
                                            {{ $perkembangan }}
                                        </h6>

                                        <div class="d-flex gap-4">

                                            <div class="form-check">
                                                <input class="form-check-input"
                                                    type="radio"
                                                    name="perkembangan[{{ $perkembangan }}]"
                                                    value="MB">

                                                <label class="form-check-label">
                                                    MB
                                                </label>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input"
                                                    type="radio"
                                                    name="perkembangan[{{ $perkembangan }}]"
                                                    value="BSH">

                                                <label class="form-check-label">
                                                    BSH
                                                </label>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input"
                                                    type="radio"
                                                    name="perkembangan[{{ $perkembangan }}]"
                                                    value="BSB">

                                                <label class="form-check-label">
                                                    BSB
                                                </label>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                @endforeach

                            </div>

                        </div>

                    </div>

                    {{-- RIGHT --}}
                    <div class="col-lg-4">

                        {{-- KONDISI --}}
                        <div class="card border-0 shadow-sm rounded-4 mb-4">

                            <div class="card-header bg-white border-0 pt-4">

                                <h5 class="fw-bold mb-1">
                                    Kondisi Hari Ini
                                </h5>

                            </div>

                            <div class="card-body">

                                <label class="form-label fw-semibold">
                                    Mood Anak
                                </label>

                                <select class="form-select mb-4"
                                    name="mood">

                                    <option value="">Pilih Mood</option>
                                    <option value="Ceria">Ceria</option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Tenang">Tenang</option>
                                    <option value="Rewel">Rewel</option>
                                    <option value="Perlu Pendampingan">Perlu Pendampingan</option>

                                </select>

                                <label class="form-label fw-semibold">
                                    Kondisi Fisik
                                </label>

                                <div class="d-flex flex-column gap-2">

                                    @foreach (['Sehat', 'Batuk', 'Pilek', 'Demam', 'Lecet / Luka Ringan', 'Alergi'] as $fisik)

                                    <div class="form-check">

                                        <input class="form-check-input"
                                            type="checkbox"
                                            name="kondisi_fisik[]"
                                            value="{{ $fisik }}">

                                        <label class="form-check-label">
                                            {{ $fisik }}
                                        </label>

                                    </div>

                                    @endforeach

                                </div>

                            </div>

                        </div>

                        {{-- MAKAN --}}
                        <div class="card border-0 shadow-sm rounded-4 mb-4">

                            <div class="card-header bg-white border-0 pt-4">

                                <h5 class="fw-bold mb-1">
                                    Makan & Minum
                                </h5>

                            </div>

                            <div class="card-body">

                                <label class="form-label fw-semibold">
                                    Minum Air Putih
                                </label>

                                <input type="number"
                                    class="form-control mb-4"
                                    name="minum_air"
                                    placeholder="Jumlah gelas">

                                <label class="form-label fw-semibold">
                                    Selera Makan
                                </label>

                                <select class="form-select mb-4"
                                    name="selera_makan">

                                    <option value="">Pilih</option>
                                    <option value="baik">Baik</option>
                                    <option value="cukup">Cukup</option>
                                    <option value="kurang">Kurang</option>

                                </select>

                                <label class="form-label fw-semibold">
                                    Catatan Makan
                                </label>

                                <textarea class="form-control"
                                    rows="3"
                                    name="catatan_makan"></textarea>

                            </div>

                        </div>

                        {{-- TOILET --}}
                        <div class="card border-0 shadow-sm rounded-4 mb-4">

                            <div class="card-header bg-white border-0 pt-4">

                                <h5 class="fw-bold mb-1">
                                    Toilet Training
                                </h5>

                            </div>

                            <div class="card-body">

                                <label class="form-label fw-semibold">
                                    Pipis di Toilet
                                </label>

                                <select class="form-select mb-3"
                                    name="toilet_pipis">

                                    <option value="">Pilih</option>
                                    <option value="ya">Ya</option>
                                    <option value="belum">Belum</option>
                                    <option value="kadang">Kadang-kadang</option>

                                </select>

                                <label class="form-label fw-semibold">
                                    Pup di Toilet
                                </label>

                                <select class="form-select mb-3"
                                    name="toilet_pup">

                                    <option value="">Pilih</option>
                                    <option value="ya">Ya</option>
                                    <option value="belum">Belum</option>
                                    <option value="kadang">Kadang-kadang</option>

                                </select>

                                <label class="form-label fw-semibold">
                                    Kondisi Popok
                                </label>

                                <select class="form-select"
                                    name="kondisi_popok">

                                    <option value="">Pilih</option>
                                    <option value="full">Full</option>
                                    <option value="sebagian">Sebagian</option>
                                    <option value="kering">Kering</option>

                                </select>

                            </div>

                        </div>

                        {{-- INFORMASI --}}
                        <div class="card border-0 shadow-sm rounded-4">

                            <div class="card-header bg-white border-0 pt-4">

                                <h5 class="fw-bold mb-1">
                                    Informasi Orang Tua
                                </h5>

                            </div>

                            <div class="card-body">

                                <textarea class="form-control mb-4"
                                    rows="5"
                                    name="informasi_orang_tua"
                                    placeholder="Tambahkan informasi penting untuk orang tua"></textarea>

                            </div>

                        </div>

                        <div class="card border-0 shadow-sm rounded-4 mt-4">

                            <div class="card-header bg-white border-0 pt-4">

                                <h5 class="fw-bold mb-1">
                                    Tanda Tangan
                                </h5>

                                <p class="text-muted small mb-0">
                                    Validasi laporan harian daycare
                                </p>

                            </div>

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-md-6 mb-4">

                                        <input type="hidden" name="pengasuh_id" value="{{ $pengasuh->id }}">

                                        <label class="form-label fw-semibold">
                                            Tanda Tangan Pengasuh
                                        </label>

                                        <div class="border rounded-4 p-2 bg-light">

                                            <canvas id="signaturePengasuh"
                                                height="180"
                                                class="w-100 rounded-3 bg-white"></canvas>

                                        </div>

                                        <input type="hidden"
                                            name="ttd_pengasuh"
                                            id="ttd_pengasuh">

                                        <button type="button"
                                            class="btn btn-light btn-sm rounded-pill mt-2"
                                            id="clearPengasuh">

                                            Reset

                                        </button>

                                    </div>

                                    {{-- ORANG TUA --}}
                                    <div class="col-md-6 mb-4">

                                        <label class="form-label fw-semibold">
                                            Tanda Tangan Orang Tua
                                        </label>

                                        <div class="border rounded-4 p-2 bg-light">

                                            <canvas id="signatureOrangtua"
                                                height="180"
                                                class="w-100 rounded-3 bg-white"></canvas>

                                        </div>

                                        <input type="hidden"
                                            name="ttd_orangtua"
                                            id="ttd_orangtua">

                                        <button type="button"
                                            class="btn btn-light btn-sm rounded-pill mt-2"
                                            id="clearOrangtua">

                                            Reset

                                        </button>

                                    </div>

                                </div>

                                <button type="button" class="btn btn-success rounded-pill w-100 py-2" id="btnSimpanLaporan">

                                    <i class="ti ti-device-floppy me-1"></i>
                                    Simpan Laporan Harian

                                </button>

                            </div>

                        </div>

                    </div>

                </div>

            </form>

        </div>

        <div class="footer-text">
            TPA Kementerian Kesehatan Republik Indonesia
            <br>
            Sistem Informasi Penilaian Anak
        </div>

    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const canvasPengasuh = document.getElementById('signaturePengasuh');
        const padPengasuh = new SignaturePad(canvasPengasuh);

        const canvasOrangtua = document.getElementById('signatureOrangtua');
        const padOrangtua = new SignaturePad(canvasOrangtua);

        $('#clearPengasuh').click(function() {
            padPengasuh.clear();
        });

        $('#clearOrangtua').click(function() {
            padOrangtua.clear();
        });

        $('#btnSimpanLaporan').on('click', function() {

            let valid = true;

            // VALIDASI RADIO KEGIATAN
            $('[name^="kegiatan"]').each(function() {

                let name = $(this).attr('name');

                if (!$(`input[name="${name}"]:checked`).length) {

                    valid = false;

                }

            });

            // VALIDASI PERKEMBANGAN
            $('[name^="perkembangan"]').each(function() {

                let name = $(this).attr('name');

                if (!$(`input[name="${name}"]:checked`).length) {

                    valid = false;

                }

            });

            // VALIDASI SELECT & INPUT
            const requiredFields = [
                'mood',
                'minum_air',
                'selera_makan',
                'toilet_pipis',
                'toilet_pup',
                'kondisi_popok'
            ];

            requiredFields.forEach(function(field) {

                if (!$(`[name="${field}"]`).val()) {

                    valid = false;

                }

            });

            // VALIDASI KONDISI FISIK
            if (!$('input[name="kondisi_fisik[]"]:checked').length) {

                valid = false;

            }

            // VALIDASI TTD
            if (padPengasuh.isEmpty() || padOrangtua.isEmpty()) {

                valid = false;

            }

            // ERROR
            if (!valid) {

                Swal.fire({
                    icon: 'warning',
                    title: 'Form Belum Lengkap',
                    text: 'Pastikan seluruh penilaian telah diisi kecuali bagian catatan',
                    confirmButtonColor: '#16a34a'
                });

                return;

            }

            // KONFIRMASI
            Swal.fire({

                title: 'Simpan Laporan?',
                text: 'Pastikan seluruh penilaian harian sudah benar',
                icon: 'question',

                showCancelButton: true,
                confirmButtonText: 'Ya, Simpan',
                cancelButtonText: 'Batal',

                reverseButtons: true,

                customClass: {
                    popup: 'rounded-4',
                    confirmButton: 'btn btn-success rounded-pill px-4',
                    cancelButton: 'btn btn-light rounded-pill px-4 me-2'
                },

                buttonsStyling: false

            }).then((result) => {

                if (result.isConfirmed) {

                    $('#ttd_pengasuh').val(
                        padPengasuh.toDataURL()
                    );

                    $('#ttd_orangtua').val(
                        padOrangtua.toDataURL()
                    );

                    Swal.fire({

                        title: 'Menyimpan Laporan...',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,

                        didOpen: () => {
                            Swal.showLoading();
                        },

                        customClass: {
                            popup: 'rounded-4'
                        }

                    });

                    $('form').submit();

                }

            });

        });
    </script>

</body>

</html>