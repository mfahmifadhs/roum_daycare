@extends('pages.app')

@section('content')
<div class="pc-container">
    <div class="pc-content">

        {{-- PAGE HEADER --}}
        <div class="page-header mb-4">
            <div class="page-block">

                <div class="row align-items-center">

                    <div class="col-md-8">

                        <h3 class="fw-bold mb-1">
                            Detail Laporan Harian Anak
                        </h3>

                        <p class="text-muted mb-0">
                            Hasil evaluasi dan perkembangan harian peserta daycare
                        </p>

                    </div>

                    <div class="col-md-4 text-md-end mt-3 mt-md-0">

                        <a href="{{ route('jadwal.detail', $laporan->jadwal_id) }}"
                            class="btn btn-light rounded-pill px-4">

                            <i class="ti ti-arrow-left me-1"></i>
                            Kembali

                        </a>

                    </div>

                </div>

            </div>
        </div>

        <div class="row">

            {{-- LEFT --}}
            <div class="col-lg-8">

                {{-- DATA ANAK --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">

                    <div class="card-body">

                        <div class="d-flex align-items-center flex-wrap gap-3">

                            {{-- FOTO --}}
                            <div>

                                @if ($laporan->anak->foto)

                                <img src="{{ asset('storage/' . $laporan->anak->foto) }}"
                                    class="rounded-circle border border-3 border-white shadow"
                                    width="100"
                                    height="100"
                                    style="object-fit:cover;">

                                @else

                                <div class="rounded-circle bg-light-success d-flex align-items-center justify-content-center"
                                    style="width:100px;height:100px;">

                                    <i class="ti ti-user text-success"
                                        style="font-size:40px;"></i>

                                </div>

                                @endif

                            </div>

                            {{-- INFO --}}
                            <div>

                                <h4 class="fw-bold mb-1">
                                    {{ $laporan->anak->nama }}
                                </h4>

                                <div class="text-muted d-flex flex-column gap-1">

                                    <div>

                                        <i class="ti ti-calendar"></i>

                                        {{ \Carbon\Carbon::parse($laporan->tanggal)->translatedFormat('l, d F Y') }}

                                    </div>

                                    <div>

                                        <i class="ti ti-user"></i>

                                        Orang Tua:
                                        {{ $laporan->anak->user->nama ?? '-' }}

                                    </div>

                                    <div>

                                        <i class="ti ti-building"></i>

                                        Unit Kerja:
                                        {{ $laporan->anak->user->uker->nama_uker ?? '-' }}

                                    </div>

                                    <div>

                                        <i class="ti ti-heart"></i>

                                        Pengasuh:
                                        {{ $laporan->pengasuh->nama ?? '-' }}

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
                            Aktivitas dan respon anak selama penitipan
                        </p>

                    </div>

                    <div class="card-body">

                        @foreach ($laporan->detail->where('keterangan', 'Kegiatan') as $item)

                        <div class="border rounded-4 p-3 mb-3">

                            <div class="d-flex justify-content-between align-items-center">

                                <div>

                                    <h6 class="fw-semibold mb-1">
                                        {{ $item->kategori->deskripsi }}
                                    </h6>

                                    <small class="text-muted">
                                        {{ $item->kategori->keterangan }}
                                    </small>

                                </div>

                                <span class="badge bg-success">

                                    {{ $item->nilai }}

                                </span>

                            </div>

                        </div>

                        @endforeach

                        @if ($laporan->catatan_kegiatan)

                        <div class="alert alert-light-success border-0 rounded-4">

                            <h6 class="fw-bold mb-2">
                                Catatan Kegiatan
                            </h6>

                            <p class="mb-0">
                                {{ $laporan->catatan_kegiatan }}
                            </p>

                        </div>

                        @endif

                    </div>

                </div>

                {{-- PERKEMBANGAN --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">

                    <div class="card-header bg-white border-0 pt-4">

                        <h5 class="fw-bold mb-1">
                            Perkembangan Anak
                        </h5>

                    </div>

                    <div class="card-body">

                        @foreach ($laporan->detail->where('keterangan', 'Perkembangan') as $item)

                        <div class="border rounded-4 p-3 mb-3">

                            <div class="d-flex justify-content-between align-items-center">

                                <h6 class="mb-0 fw-semibold">
                                    {{ $item->kategori?->deskripsi }}
                                </h6>

                                <span class="badge bg-light-success text-success">

                                    {{ $item->nilai }}

                                </span>

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

                        {{-- MOOD --}}
                        <div class="mb-4">

                            <label class="text-muted small d-block mb-2">
                                Mood Anak
                            </label>

                            @php
                            $mood = $laporan->detail->where('keterangan', 'Mood')->first();
                            @endphp

                            <span class="badge bg-success">

                                {{ $mood->nilai ?? '-' }}

                            </span>

                        </div>

                        {{-- KONDISI --}}
                        <div>

                            <label class="text-muted small d-block mb-2">
                                Kondisi Fisik
                            </label>

                            <div class="d-flex flex-wrap gap-2">

                                @foreach ($laporan->detail->where('keterangan', 'Kondisi') as $item)

                                <span class="badge bg-light-danger text-danger">

                                    {{ $item->nilai }}

                                </span>

                                @endforeach

                            </div>

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

                    <div class="card-body d-flex flex-column gap-3">

                        <div>

                            <small class="text-muted d-block">
                                Minum Air
                            </small>

                            <span class="fw-semibold">
                                {{ $laporan->minum_air }} Gelas
                            </span>

                        </div>

                        <div>

                            <small class="text-muted d-block">
                                Selera Makan
                            </small>

                            <span class="fw-semibold">
                                {{ ucfirst($laporan->selera_makan) }}
                            </span>

                        </div>

                        @if ($laporan->catatan_makan)

                        <div>

                            <small class="text-muted d-block">
                                Catatan Makan
                            </small>

                            <p class="mb-0">
                                {{ $laporan->catatan_makan }}
                            </p>

                        </div>

                        @endif

                    </div>

                </div>

                {{-- TOILET --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">

                    <div class="card-header bg-white border-0 pt-4">

                        <h5 class="fw-bold mb-1">
                            Toilet Training
                        </h5>

                    </div>

                    <div class="card-body d-flex flex-column gap-3">

                        <div>

                            <small class="text-muted d-block">
                                Pipis di Toilet
                            </small>

                            <span class="fw-semibold">
                                {{ ucfirst($laporan->toilet_pipis) }}
                            </span>

                        </div>

                        <div>

                            <small class="text-muted d-block">
                                Pup di Toilet
                            </small>

                            <span class="fw-semibold">
                                {{ ucfirst($laporan->toilet_pup) }}
                            </span>

                        </div>

                        <div>

                            <small class="text-muted d-block">
                                Kondisi Popok
                            </small>

                            <span class="fw-semibold">
                                {{ ucfirst($laporan->kondisi_popok) }}
                            </span>

                        </div>

                    </div>

                </div>

                {{-- INFORMASI --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">

                    <div class="card-header bg-white border-0 pt-4">

                        <h5 class="fw-bold mb-1">
                            Informasi Orang Tua
                        </h5>

                    </div>

                    <div class="card-body">

                        <p class="mb-0">

                            {{ $laporan->informasi_orang_tua ?? '-' }}

                        </p>

                    </div>

                </div>

                {{-- TTD --}}
                <div class="card border-0 shadow-sm rounded-4">

                    <div class="card-header bg-white border-0 pt-4">

                        <h5 class="fw-bold mb-1">
                            Validasi Tanda Tangan
                        </h5>

                    </div>

                    <div class="card-body">

                        <div class="row text-center">

                            {{-- PENGASUH --}}
                            <div class="col-6">

                                <small class="text-muted d-block mb-2">
                                    Pengasuh
                                </small>

                                @if ($laporan->ttd_pengasuh)

                                <img src="{{ $laporan->ttd_pengasuh }}"
                                    class="img-fluid"
                                    style="max-height:100px;">

                                @else

                                <div class="text-muted small">
                                    Belum TTD
                                </div>

                                @endif

                            </div>

                            {{-- ORANG TUA --}}
                            <div class="col-6">

                                <small class="text-muted d-block mb-2">
                                    Orang Tua
                                </small>

                                @if ($laporan->ttd_orangtua)

                                <img src="{{ $laporan->ttd_orangtua }}"
                                    class="img-fluid"
                                    style="max-height:100px;">

                                @else

                                <div class="text-muted small">
                                    Belum TTD
                                </div>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</div>
@endsection