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

                        <a href="{{ url()->previous() }}"
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

                {{-- KONDISI ANAK DATANG DAN PULANG --}}
                @php
                // Mendukung data lama yang belum memiliki tahap
                $detailDatang = $laporan->detail->filter(function ($item) {
                return is_null($item->tahap) || $item->tahap == 'Datang';
                });

                $detailPulang = $laporan->detail->where('tahap', 'Pulang');

                $moodDatang = $detailDatang
                ->where('keterangan', 'Mood')
                ->first();

                $moodPulang = $detailPulang
                ->where('keterangan', 'Mood')
                ->first();

                $kondisiDatang = $detailDatang
                ->where('keterangan', 'Kondisi');

                $kondisiPulang = $detailPulang
                ->where('keterangan', 'Kondisi');
                @endphp

                <div class="card border-0 shadow-sm rounded-4 mb-4">

                    <div class="card-header bg-white border-0 pt-4 px-3 px-md-4">
                        <h5 class="fw-bold mb-1">
                            Kondisi Anak
                        </h5>
                        <p class="text-muted small mb-0">
                            Perbandingan kondisi anak saat datang dan pulang.
                        </p>
                    </div>

                    <div class="card-body p-3 p-md-4">

                        {{-- KONDISI DATANG --}}
                        <div class="border rounded-4 p-3 mb-4">

                            <div class="d-flex align-items-center gap-2 mb-3">
                                <span class="badge bg-success rounded-pill">
                                    <i class="ti ti-login"></i>
                                </span>

                                <h6 class="fw-bold text-success mb-0">
                                    Kondisi Anak Saat Datang
                                </h6>
                            </div>

                            {{-- MOOD DATANG --}}
                            <label class="text-muted small d-block mb-2">
                                Mood Anak
                            </label>

                            @if ($moodDatang)
                            <span class="badge bg-success rounded-pill px-3 py-2">
                                {{ $moodDatang->nilai }}
                            </span>
                            @else
                            <span class="text-muted small">
                                Belum diisi
                            </span>
                            @endif

                            <hr>

                            {{-- KONDISI FISIK DATANG --}}
                            <label class="text-muted small d-block mb-2">
                                Kondisi Fisik
                            </label>

                            <div class="d-flex flex-wrap gap-2">

                                @forelse ($kondisiDatang as $item)
                                <span class="badge bg-light-success text-success rounded-pill px-3 py-2">
                                    {{ $item->nilai }}
                                </span>
                                @empty
                                <span class="text-muted small">
                                    Belum ada data kondisi fisik.
                                </span>
                                @endforelse

                            </div>

                        </div>


                        {{-- KONDISI PULANG --}}
                        <div class="border rounded-4 p-3">

                            <div class="d-flex align-items-center gap-2 mb-3">
                                <span class="badge bg-primary rounded-pill">
                                    <i class="ti ti-logout"></i>
                                </span>

                                <h6 class="fw-bold text-primary mb-0">
                                    Kondisi Anak Saat Pulang
                                </h6>
                            </div>

                            {{-- MOOD PULANG --}}
                            <label class="text-muted small d-block mb-2">
                                Mood Anak
                            </label>

                            @if ($moodPulang)
                            <span class="badge bg-primary rounded-pill px-3 py-2">
                                {{ $moodPulang->nilai }}
                            </span>
                            @else
                            <span class="text-muted small">
                                Belum diisi
                            </span>
                            @endif

                            <hr>

                            {{-- KONDISI FISIK PULANG --}}
                            <label class="text-muted small d-block mb-2">
                                Kondisi Fisik
                            </label>

                            <div class="d-flex flex-wrap gap-2">

                                @forelse ($kondisiPulang as $item)
                                <span class="badge bg-light-primary text-primary rounded-pill px-3 py-2">
                                    {{ $item->nilai }}
                                </span>
                                @empty
                                <span class="text-muted small">
                                    Belum ada data kondisi fisik.
                                </span>
                                @endforelse

                            </div>

                        </div>

                    </div>
                </div>

                {{-- SUHU ANAK --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-0 pt-4 px-3 px-md-4">
                        <h5 class="fw-bold mb-1">
                            <i class="fa-solid fa-temperature-half me-2"
                                style="color:var(--primary)"></i>
                            Suhu Anak
                        </h5>
                        <p class="text-muted small mb-0">
                            Pemantauan suhu saat datang dan pulang.
                        </p>
                    </div>

                    <div class="card-body p-3 p-md-4">

                        {{-- SUHU DATANG --}}
                        <div class="border rounded-4 p-3 mb-3">
                            <div class="d-flex align-items-center gap-3">

                                <div class="rounded-3 bg-light d-flex align-items-center justify-content-center flex-shrink-0"
                                    style="width:44px;height:44px;">
                                    <i class="fa-solid fa-sun text-warning"></i>
                                </div>

                                <div class="flex-grow-1">
                                    <div class="text-muted small mb-1">
                                        Suhu Saat Datang
                                    </div>

                                    <div class="fs-4 fw-bold">
                                        @if ($laporan->suhu_datang !== null)
                                        {{ number_format((float) $laporan->suhu_datang, 1, ',', '.') }} °C
                                        @else
                                        <span class="text-muted">-</span>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>

                        {{-- SUHU PULANG --}}
                        <div class="border rounded-4 p-3">
                            <div class="d-flex align-items-center gap-3">

                                <div class="rounded-3 bg-light d-flex align-items-center justify-content-center flex-shrink-0"
                                    style="width:44px;height:44px;">
                                    <i class="fa-solid fa-sun text-warning"></i>
                                </div>

                                <div class="flex-grow-1">
                                    <div class="text-muted small mb-1">
                                        Suhu Saat Pulang
                                    </div>

                                    <div class="fs-4 fw-bold">
                                        @if ($laporan->suhu_pulang !== null)
                                        {{ number_format((float) $laporan->suhu_pulang, 1, ',', '.') }} °C
                                        @else
                                        <span class="text-muted">-</span>
                                        @endif
                                    </div>
                                </div>

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

            </div>

        </div>

    </div>
</div>
@endsection