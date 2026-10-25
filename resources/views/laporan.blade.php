@extends('app')

@section('content')
<div class="main-card">

    <div class="section-title">
        <i class="fa-solid fa-magnifying-glass me-2"
            style="color: var(--primary)"></i>
        Verifikasi Data
    </div>

    <p class="section-description">
        Masukkan kode pengasuh, kode anak, dan tanggal penilaian.
    </p>

    {{-- Pesan validasi --}}
    @if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <div class="fw-bold mb-1">
            <i class="fa-solid fa-circle-exclamation me-1"></i>
            Data belum dapat diverifikasi
        </div>

        <ul class="mb-0 ps-3">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Form pencarian --}}
    <form id="formCheck" action="{{ route('laporan.check') }}"
        method="POST">
        @csrf

        <div class="mb-3">
            <label for="kode_pengasuh" class="form-label">
                Kode Pengasuh
            </label>

            <div class="input-group">
                <span class="input-group-text">
                    <i class="fa-solid fa-user-nurse"></i>
                </span>

                <input type="number"
                    class="form-control"
                    id="kode_pengasuh"
                    name="kode_pengasuh"
                    value="{{ old('kode_pengasuh') }}"
                    placeholder="Masukkan kode pengasuh"
                    autocomplete="off"
                    min="1"
                    required>
            </div>
        </div>

        <div class="mb-3">
            <label for="kode_anak" class="form-label">
                Kode Anak
            </label>

            <div class="input-group">
                <span class="input-group-text">
                    <i class="fa-solid fa-child"></i>
                </span>

                <input type="number"
                    class="form-control"
                    id="kode_anak"
                    name="kode_anak"
                    value="{{ old('kode_anak') }}"
                    placeholder="Masukkan kode anak"
                    autocomplete="off"
                    min="1"
                    required>
            </div>
        </div>

        <div class="mb-4">
            <label for="tanggal" class="form-label">
                Tanggal Penilaian
            </label>

            <div class="input-group">
                <span class="input-group-text">
                    <i class="fa-solid fa-calendar-days"></i>
                </span>

                <input type="date"
                    class="form-control"
                    id="tanggal"
                    name="tanggal"
                    value="{{ old('tanggal', now()->format('Y-m-d')) }}"
                    required>
            </div>
        </div>

        <button type="submit" id="btnCheck()" class="btn btn-check-data w-100">
            <i class="fa-solid fa-magnifying-glass me-2"></i>
            Check Data
        </button>
    </form>

    {{-- Hasil verifikasi --}}
    @if (isset($pengasuh) && isset($anak))

    <div class="result-card">

        <div class="result-header">
            <h2>
                <i class="fa-solid fa-circle-check me-2"></i>
                Data Berhasil Diverifikasi
            </h2>
            <p>Pastikan informasi pengasuh dan anak sudah benar.</p>
        </div>

        <div class="result-body">

            <div class="info-section-title">
                <i class="fa-solid fa-user-nurse me-2"
                    style="color: var(--primary)"></i>
                Informasi Pengasuh
            </div>

            <div class="info-row">
                <span class="info-label">Kode Pengasuh</span>
                <span class="info-value">
                    {{ $pengasuh->kode }}
                </span>
            </div>

            <div class="info-row">
                <span class="info-label">Nama Pengasuh</span>
                <span class="info-value">
                    {{ $pengasuh->nama }}
                </span>
            </div>

            <hr class="my-4">

            <div class="info-section-title">
                <i class="fa-solid fa-child me-2"
                    style="color: var(--primary)"></i>
                Informasi Anak
            </div>

            <div class="info-row">
                <span class="info-label">Kode Anak</span>
                <span class="info-value">
                    {{ $anak->kode }}
                </span>
            </div>

            <div class="info-row">
                <span class="info-label">Nama Anak</span>
                <span class="info-value">
                    {{ $anak->nama }}
                </span>
            </div>

            <div class="info-row">
                <span class="info-label">Tanggal Penilaian</span>
                <span class="info-value">
                    {{ \Carbon\Carbon::parse(
                                request('tanggal', old('tanggal', now()))
                            )->format('d/m/Y') }}
                </span>
            </div>

            <form action="{{ route('laporan.create', $peserta->id) }}"
                method="GET"
                class="mt-4">
                @csrf

                <input type="hidden"
                    name="kode_pengasuh"
                    value="{{ $pengasuh->kode }}">

                <input type="hidden"
                    name="kode_anak"
                    value="{{ $anak->kode }}">

                <input type="hidden"
                    name="tanggal"
                    value="{{ request('tanggal', old('tanggal', now()->format('Y-m-d'))) }}">

                @if (!$laporan)
                <button type="submit" class="btn btn-assessment">
                    <i class="fa-solid fa-clipboard-list"></i>
                    Lakukan Penilaian
                    <i class="fa-solid fa-arrow-right ms-auto"></i>
                </button>
                @endif
            </form>

            @if ($laporan)
            <a href="{{ route('home.laporan.detail', $laporan->id) }}" class="btn btn-primary">
                <i class="fa-solid fa-clipboard-list"></i>
                Detail Penilaian
            </a>
            @endif

        </div>
    </div>
    @endif

</div>
@endsection