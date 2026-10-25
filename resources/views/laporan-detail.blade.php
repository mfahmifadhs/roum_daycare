
@extends('app')

@section('content')

<div class="container-fluid px-0">

    {{-- HEADER --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <div class="section-title mb-2">
                <i class="fa-solid fa-clipboard-check me-2"
                   style="color: var(--primary)"></i>
                Detail Penilaian
            </div>
            <p class="section-description mb-0">
                Informasi lengkap kegiatan dan kondisi anak selama penitipan.
            </p>
        </div>

        <a href="{{ route('laporan') }}"
           class="btn btn-outline-secondary rounded-3">
            <i class="fa-solid fa-arrow-left me-2"></i>
            Kembali
        </a>
    </div>

    <div class="row g-4">

        {{-- KOLOM KIRI --}}
        <div class="col-12 col-lg-8">

            {{-- DATA ANAK --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-3 p-md-4">

                    <div class="d-flex align-items-center flex-wrap gap-3">

                        {{-- FOTO ANAK --}}
                        <div class="flex-shrink-0">
                            @if ($laporan->anak?->foto)
                                <img
                                    src="{{ asset('storage/' . $laporan->anak->foto) }}"
                                    alt="Foto anak"
                                    class="rounded-circle border border-3 border-white shadow"
                                    width="100"
                                    height="100"
                                    style="object-fit: cover;">
                            @else
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                                     style="width:100px;height:100px;">
                                    <i class="fa-solid fa-child text-secondary"
                                       style="font-size:40px;"></i>
                                </div>
                            @endif
                        </div>

                        {{-- IDENTITAS --}}
                        <div class="flex-grow-1">
                            <h4 class="fw-bold mb-2">
                                {{ $laporan->anak?->nama ?? '-' }}
                            </h4>

                            <div class="text-muted d-flex flex-column gap-2 small">

                                <div>
                                    <i class="fa-solid fa-calendar-days me-2"></i>
                                    {{ \Carbon\Carbon::parse($laporan->tanggal)->translatedFormat('l, d F Y') }}
                                </div>

                                <div>
                                    <i class="fa-solid fa-user me-2"></i>
                                    Orang Tua:
                                    {{ $laporan->anak?->user?->nama ?? '-' }}
                                </div>

                                <div>
                                    <i class="fa-solid fa-building me-2"></i>
                                    Unit Kerja:
                                    {{ $laporan->anak?->user?->uker?->nama_uker ?? '-' }}
                                </div>

                                <div>
                                    <i class="fa-solid fa-user-nurse me-2"></i>
                                    Pengasuh:
                                    {{ $laporan->pengasuh?->nama ?? '-' }}
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- KEGIATAN HARIAN --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-0 pt-4 px-3 px-md-4">
                    <h5 class="fw-bold mb-1">Kegiatan Harian</h5>
                    <p class="text-muted small mb-0">
                        Aktivitas dan respons anak selama penitipan.
                    </p>
                </div>

                <div class="card-body p-3 p-md-4">

                    @forelse ($laporan->detail->where('keterangan', 'Kegiatan') as $item)
                        <div class="border rounded-4 p-3 mb-3">
                            <div class="d-flex flex-wrap justify-content-between align-items-start gap-3">

                                <div class="flex-grow-1">
                                    <h6 class="fw-semibold mb-1">
                                        {{ $item->kategori?->deskripsi ?? '-' }}
                                    </h6>

                                    <small class="text-muted">
                                        {{ $item->kategori?->keterangan ?? '' }}
                                    </small>
                                </div>

                                <span class="badge bg-success rounded-pill px-3 py-2">
                                    {{ $item->nilai ?? '-' }}
                                </span>

                            </div>
                        </div>
                    @empty
                        <p class="text-muted small mb-0">
                            Belum ada data kegiatan harian.
                        </p>
                    @endforelse

                    @if ($laporan->catatan_kegiatan)
                        <div class="alert alert-light border rounded-4 mb-0">
                            <h6 class="fw-bold mb-2">
                                <i class="fa-solid fa-note-sticky me-2"></i>
                                Catatan Kegiatan
                            </h6>

                            <p class="mb-0" style="white-space:pre-line;">{{ $laporan->catatan_kegiatan }}</p>
                        </div>
                    @endif

                </div>
            </div>

            {{-- PERKEMBANGAN ANAK --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-0 pt-4 px-3 px-md-4">
                    <h5 class="fw-bold mb-1">Perkembangan Anak</h5>
                    <p class="text-muted small mb-0">
                        Hasil pemantauan perkembangan anak.
                    </p>
                </div>

                <div class="card-body p-3 p-md-4">

                    @forelse ($laporan->detail->where('keterangan', 'Perkembangan') as $item)
                        <div class="border rounded-4 p-3 mb-3">
                            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">

                                <h6 class="mb-0 fw-semibold">
                                    {{ $item->kategori?->deskripsi ?? '-' }}
                                </h6>

                                <span class="badge bg-light-success text-success rounded-pill px-3 py-2">
                                    {{ $item->nilai ?? '-' }}
                                </span>

                            </div>
                        </div>
                    @empty
                        <p class="text-muted small mb-0">
                            Belum ada data perkembangan anak.
                        </p>
                    @endforelse

                </div>
            </div>

        </div>

        {{-- KOLOM KANAN --}}
        <div class="col-12 col-lg-4">

            {{-- KONDISI HARI INI --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-0 pt-4 px-3 px-md-4">
                    <h5 class="fw-bold mb-1">Kondisi Hari Ini</h5>
                </div>

                <div class="card-body p-3 p-md-4">

                    {{-- MOOD --}}
                    @php
                        $mood = $laporan->detail
                            ->where('keterangan', 'Mood')
                            ->first();
                    @endphp

                    <div class="mb-4">
                        <label class="text-muted small d-block mb-2">
                            Mood Anak
                        </label>

                        @if ($mood)
                            <span class="badge bg-success rounded-pill px-3 py-2">
                                {{ $mood->nilai }}
                            </span>
                        @else
                            <span class="text-muted">Belum diisi</span>
                        @endif
                    </div>

                    <hr>

                    {{-- KONDISI FISIK --}}
                    <div>
                        <label class="text-muted small d-block mb-2">
                            Kondisi Fisik
                        </label>

                        <div class="d-flex flex-wrap gap-2">
                            @forelse ($laporan->detail->where('keterangan', 'Kondisi') as $item)
                                <span class="badge bg-light-danger text-danger rounded-pill px-3 py-2">
                                    {{ $item->nilai }}
                                </span>
                            @empty
                                <span class="text-muted small">
                                    Tidak ada data kondisi fisik.
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
                                <i class="fa-solid fa-house text-primary"></i>
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

            {{-- MAKAN DAN MINUM --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-0 pt-4 px-3 px-md-4">
                    <h5 class="fw-bold mb-1">Makan & Minum</h5>
                </div>

                <div class="card-body p-3 p-md-4 d-flex flex-column gap-3">

                    <div>
                        <small class="text-muted d-block mb-1">Minum Air</small>
                        <span class="fw-semibold">
                            {{ $laporan->minum_air !== null ? $laporan->minum_air . ' Gelas' : '-' }}
                        </span>
                    </div>

                    <hr class="my-0">

                    <div>
                        <small class="text-muted d-block mb-1">Selera Makan</small>
                        <span class="fw-semibold">
                            {{ $laporan->selera_makan ? ucfirst($laporan->selera_makan) : '-' }}
                        </span>
                    </div>

                    @if ($laporan->catatan_makan)
                        <hr class="my-0">
                        <div>
                            <small class="text-muted d-block mb-1">Catatan Makan</small>
                            <p class="mb-0" style="white-space:pre-line;">{{ $laporan->catatan_makan }}</p>
                        </div>
                    @endif

                </div>
            </div>

            {{-- TOILET TRAINING --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-0 pt-4 px-3 px-md-4">
                    <h5 class="fw-bold mb-1">Toilet Training</h5>
                </div>

                <div class="card-body p-3 p-md-4 d-flex flex-column gap-3">

                    <div>
                        <small class="text-muted d-block mb-1">Pipis di Toilet</small>
                        <span class="fw-semibold">
                            {{ $laporan->toilet_pipis ? ucfirst($laporan->toilet_pipis) : '-' }}
                        </span>
                    </div>

                    <hr class="my-0">

                    <div>
                        <small class="text-muted d-block mb-1">Pup di Toilet</small>
                        <span class="fw-semibold">
                            {{ $laporan->toilet_pup ? ucfirst($laporan->toilet_pup) : '-' }}
                        </span>
                    </div>

                    <hr class="my-0">

                    <div>
                        <small class="text-muted d-block mb-1">Kondisi Popok</small>
                        <span class="fw-semibold">
                            {{ $laporan->kondisi_popok ? ucfirst($laporan->kondisi_popok) : '-' }}
                        </span>
                    </div>

                </div>
            </div>

            {{-- INFORMASI ORANG TUA --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-0 pt-4 px-3 px-md-4">
                    <h5 class="fw-bold mb-1">Informasi Orang Tua</h5>
                </div>

                <div class="card-body p-3 p-md-4">
                    <p class="mb-0" style="white-space:pre-line;">
                        {{ $laporan->informasi_orang_tua ?: 'Tidak ada informasi tambahan.' }}
                    </p>
                </div>
            </div>

            {{-- TANDA TANGAN --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-0 pt-4 px-3 px-md-4">
                    <h5 class="fw-bold mb-1">Validasi Tanda Tangan</h5>
                </div>

                <div class="card-body p-3 p-md-4">
                    <div class="row g-3 text-center">

                        {{-- TTD PENGASUH --}}
                        <div class="col-6">
                            <div class="border rounded-4 p-2 h-100">
                                <small class="text-muted d-block mb-3">
                                    Pengasuh
                                </small>

                                @if ($laporan->ttd_pengasuh)
                                    <img
                                        src="{{ $laporan->ttd_pengasuh }}"
                                        alt="Tanda tangan pengasuh"
                                        class="img-fluid"
                                        style="max-height:100px;max-width:100%;">
                                @else
                                    <div class="text-muted small py-3">
                                        <i class="fa-solid fa-file-signature d-block mb-2 fs-4"></i>
                                        Belum TTD
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- TTD ORANG TUA --}}
                        <div class="col-6">
                            <div class="border rounded-4 p-2 h-100">
                                <small class="text-muted d-block mb-3">
                                    Orang Tua
                                </small>

                                @if ($laporan->ttd_orangtua)
                                    <img
                                        src="{{ $laporan->ttd_orangtua }}"
                                        alt="Tanda tangan orang tua"
                                        class="img-fluid"
                                        style="max-height:100px;max-width:100%;">
                                @else
                                    <div class="text-muted small py-3">
                                        <i class="fa-solid fa-file-signature d-block mb-2 fs-4"></i>
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
