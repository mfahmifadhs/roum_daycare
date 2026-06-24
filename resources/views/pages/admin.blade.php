@extends ('pages.app')

@section('content')
<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Admin Page</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">

            {{-- INFANT --}}
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                    <div class="card-body p-4">

                        {{-- HEADER --}}
                        <div class="d-flex align-items-center justify-content-between mb-4">

                            <div>

                                <h5 class="fw-bold mb-1">
                                    Infant
                                </h5>

                                <small class="text-muted">
                                    3 Bulan - 2 Tahun
                                </small>

                            </div>

                            <div class="bg-light-success rounded-circle d-flex align-items-center justify-content-center"
                                style="width:60px;height:60px;">

                                <i class="ti ti-baby-carriage text-success fs-3"></i>

                            </div>

                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-2">

                            <div>

                                <label class="fw-semibold mb-0">
                                    Reguler
                                </label>

                                <div class="small text-muted">
                                    Paket reguler aktif
                                </div>

                            </div>

                            <div class="text-end">

                                <h5 class="fw-bold text-success mb-0">

                                    {{ $total->infant }}/{{ $kuota->infantReg }}

                                </h5>

                            </div>

                        </div>

                        <div class="progress rounded-pill"
                            style="height:10px;">

                            <div class="progress-bar bg-success"
                                style="width: <?= round(($total->infant / max($kuota->infantReg, 1)) * 100) ?>%">
                            </div>

                        </div>

                        <div class="mt-2 text-end">

                            @if ($kuota->infantReg - $total->infant > 0)

                            <span class="badge bg-light-success text-success rounded-pill">

                                Slot Tersedia

                            </span>

                            @else

                            <span class="badge bg-light-danger text-danger rounded-pill">

                                Kuota Penuh

                            </span>

                            @endif

                        </div>

                    </div>

                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                    <div class="card-body p-4">

                        <div class="d-flex align-items-center justify-content-between mb-4">

                            <div>

                                <h5 class="fw-bold mb-1">
                                    Toddler
                                </h5>

                                <small class="text-muted">
                                    2 Tahun - 4 Tahun
                                </small>

                            </div>

                            <div class="bg-light-primary rounded-circle d-flex align-items-center justify-content-center"
                                style="width:60px;height:60px;">

                                <i class="ti ti-baby-carriage text-primary fs-3"></i>

                            </div>

                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-2">

                            <div>

                                <label class="fw-semibold mb-0">
                                    Laki-laki Reguler
                                </label>

                                <div class="small text-muted">
                                    Paket reguler laki-laki
                                </div>

                            </div>

                            <div class="text-end">

                                <h5 class="fw-bold text-success mb-0">

                                    {{ $total->toddlerLaki }}/{{ $kuota->toddlerLakiReg }}

                                </h5>

                            </div>

                        </div>

                        <div class="progress rounded-pill"
                            style="height:10px;">

                            <div class="progress-bar bg-success"
                                style="width: <?= round(($total->toddlerLaki / max($kuota->toddlerLakiReg, 1)) * 100) ?>% ">
                            </div>

                        </div>

                        <div class="mt-2 text-end">

                            @if ($kuota->toddlerLakiReg - $total->toddlerLaki > 0)

                            <span class="badge bg-light-success text-success rounded-pill">

                                Slot Tersedia

                            </span>

                            @else

                            <span class="badge bg-light-danger text-danger rounded-pill">

                                Kuota Penuh

                            </span>

                            @endif

                        </div>

                    </div>

                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                    <div class="card-body p-4">

                        <div class="d-flex align-items-center justify-content-between mb-4">

                            <div>

                                <h5 class="fw-bold mb-1">
                                    Toddler
                                </h5>

                                <small class="text-muted">
                                    2 Tahun - 4 Tahun
                                </small>

                            </div>

                            <div class="bg-light-primary rounded-circle d-flex align-items-center justify-content-center"
                                style="width:60px;height:60px;">

                                <i class="ti ti-baby-carriage text-primary fs-3"></i>

                            </div>

                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-2">

                            <div>

                                <label class="fw-semibold mb-0">
                                    Reguler Perempuan
                                </label>

                                <div class="small text-muted">
                                    Paket reguler perempuan
                                </div>

                            </div>

                            <div class="text-end">

                                <h5 class="fw-bold text-success mb-0">

                                    {{ $total->toddlerPerempuan }}/{{ $kuota->toddlerPerempuanReg }}

                                </h5>

                            </div>

                        </div>

                        <div class="progress rounded-pill"
                            style="height:10px;">

                            <div class="progress-bar bg-success"
                                style="width: <?= round(($total->toddlerPerempuan / max($kuota->toddlerPerempuanReg, 1)) * 100) ?>% ">
                            </div>

                        </div>

                        <div class="mt-2 text-end">

                            @if ($kuota->toddlerPerempuanReg - $total->toddlerPerempuan > 0)

                            <span class="badge bg-light-success text-success rounded-pill">

                                Slot Tersedia

                            </span>

                            @else

                            <span class="badge bg-light-danger text-danger rounded-pill">

                                Kuota Penuh

                            </span>

                            @endif

                        </div>

                    </div>

                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                    <div class="card-body p-3">

                        <div class="d-flex align-items-center justify-content-between mb-2">

                            <div>

                                <h5 class="fw-bold mb-1">
                                    Kuota Harian
                                </h5>

                                <small class="text-muted">
                                    {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
                                </small>

                            </div>

                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-2">

                            <div>

                                <label class="fw-semibold mb-0">
                                    Infant
                                </label>

                            </div>

                            <div class="text-end">

                                <h5 class="fw-bold text-success mb-0">

                                    {{ $total->pesertaInfant }}/{{ $kuota->infant }}

                                </h5>

                            </div>

                        </div>

                        <div class="progress rounded-pill mb-2"
                            style="height:10px;">

                            <div class="progress-bar bg-success"
                                style="width: <?= round(($total->pesertaInfant / max($kuota->infant, 1)) * 100) ?>% ">
                            </div>

                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-2">

                            <div>

                                <label class="fw-semibold mb-0">
                                    Toddler Laki-laki
                                </label>

                            </div>

                            <div class="text-end">

                                <h5 class="fw-bold text-success mb-0">

                                    {{ $total->pesertaToddlerLaki }}/{{ $kuota->toddlerLaki }}

                                </h5>

                            </div>

                        </div>

                        <div class="progress rounded-pill mb-2"
                            style="height:10px;">

                            <div class="progress-bar bg-success"
                                style="width: '{{ ($total->pesertaToddlerLaki / max($kuota->toddlerLaki,1)) * 100 }}%' ">
                            </div>

                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-2">

                            <div>

                                <label class="fw-semibold mb-0">
                                    Toddler Perempuan
                                </label>

                            </div>

                            <div class="text-end">

                                <h5 class="fw-bold text-success mb-0">

                                    {{ $total->pesertaToddlerPerempuan }}/{{ $kuota->toddlerPerempuan }}

                                </h5>

                            </div>

                        </div>

                        <div class="progress rounded-pill"
                            style="height:10px;">

                            <div class="progress-bar bg-success"
                                style="width: '{{ ($total->pesertaToddlerPerempuan / max($kuota->toddlerPerempuan,1)) * 100 }}%' ">
                            </div>

                        </div>

                    </div>

                </div>
            </div>

        </div>

        <div class="row g-4 mb-4">

            {{-- VERIFIKASI --}}
            <div class="col-lg-6">

                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">

                    <div class="card-header bg-white border-0 p-4 pb-0">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <h5 class="fw-bold mb-1">
                                    Verifikasi Administrasi
                                </h5>

                                <p class="text-muted mb-0 small">
                                    Menunggu proses verifikasi data
                                </p>

                            </div>

                            <span class="badge bg-light-warning text-warning rounded-pill px-3 py-2">

                                {{ $data->reguler->whereNull('tanggal_wawancara')->whereNull('status')->count() }} Pending

                            </span>

                        </div>

                    </div>

                    <div class="card-body p-4">

                        @forelse ($data->reguler->whereNull('tanggal_wawancara')->whereNull('status') as $reguler)

                        @php
                        $anak = $reguler->anak;
                        $user = $anak?->user;
                        $skrining = $anak?->skrining;
                        $umur = $anak ? \Carbon\Carbon::parse($anak->tanggal_lahir)->diff(now()) : null;
                        @endphp

                        <div class="border rounded-4 p-3 mb-3">

                            <div class="d-flex justify-content-between align-items-start">

                                {{-- LEFT --}}
                                <div class="d-flex gap-3">

                                    <div class="bg-light-success rounded-circle d-flex align-items-center justify-content-center"
                                        style="width:55px;height:55px;min-width:55px;">

                                        <i class="ti ti-user text-success fs-4"></i>

                                    </div>

                                    <div>

                                        <h6 class="fw-bold mb-1">

                                            {{ $anak?->nama }}

                                        </h6>

                                        <div class="small text-muted mb-2">

                                            {{ $user?->nama }}

                                        </div>

                                        <div class="d-flex flex-wrap gap-2">

                                            <span class="badge bg-light-primary text-primary rounded-pill">

                                                {{ $anak?->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}

                                            </span>

                                            @if ($umur)

                                            <span class="badge bg-light-success text-success rounded-pill">

                                                {{ $umur->y }} Tahun

                                            </span>

                                            @endif

                                        </div>

                                    </div>

                                </div>

                                {{-- RIGHT --}}
                                <div class="text-end">

                                    <small class="text-muted d-block mb-2">

                                        {{ \Carbon\Carbon::parse($reguler->created_at)->diffForHumans() }}

                                    </small>

                                    <a href="{{ route('reguler.detail', $reguler->id) }}"
                                        class="btn btn-light btn-sm rounded-pill px-3">

                                        Detail

                                    </a>

                                </div>

                            </div>

                            {{-- ACTION --}}
                            <div class="d-flex gap-2 mt-4">

                                {{-- Approve --}}
                                <button type="button"
                                    class="btn btn-success rounded-pill w-100"
                                    onclick="approveReguler('{{ $reguler->id }}')">

                                    <i class="ti ti-check me-1"></i>
                                    Setujui

                                </button>

                                {{-- Reject --}}
                                <button type="button"
                                    class="btn btn-outline-danger rounded-pill w-100"
                                    onclick="rejectReguler('{{ $reguler->id }}')">

                                    <i class="ti ti-x me-1"></i>
                                    Tolak

                                </button>

                            </div>

                        </div>

                        @empty

                        <div class="text-center py-5">

                            <img src="{{ asset('assets/images/empty.svg') }}"
                                width="140"
                                class="mb-3">

                            <h6 class="fw-bold">
                                Tidak Ada Verifikasi
                            </h6>

                            <p class="text-muted small mb-0">
                                Belum ada data verifikasi administrasi
                            </p>

                        </div>

                        @endforelse

                    </div>

                </div>

            </div>

            {{-- WAWANCARA --}}
            <div class="col-lg-6">

                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">

                    <div class="card-header bg-white border-0 p-4 pb-0">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <h5 class="fw-bold mb-1">
                                    Jadwal Wawancara
                                </h5>

                                <p class="text-muted mb-0 small">
                                    Peserta yang telah lolos administrasi
                                </p>

                            </div>

                            <span class="badge bg-light-primary text-primary rounded-pill px-3 py-2">

                                {{ $data->reguler->whereNotNull('tanggal_wawancara')->whereNull('status')->count() }} Jadwal

                            </span>

                        </div>

                    </div>

                    <div class="card-body p-4">

                        @forelse ($data->reguler->whereNotNull('tanggal_wawancara')->whereNull('status') as $reguler)

                        @php
                        $anak = $reguler->anak;
                        $user = $anak?->user;
                        $skrining = $anak?->skrining;
                        $umur = $anak ? \Carbon\Carbon::parse($anak->tanggal_lahir)->diff(now()) : null;
                        @endphp

                        <div class="border rounded-4 p-3 mb-3">

                            <div class="d-flex justify-content-between align-items-start">

                                {{-- LEFT --}}
                                <div class="d-flex gap-3">

                                    <div class="bg-light-primary rounded-circle d-flex align-items-center justify-content-center"
                                        style="width:55px;height:55px;min-width:55px;">

                                        <i class="ti ti-calendar-event text-primary fs-4"></i>

                                    </div>

                                    <div>

                                        <h6 class="fw-bold mb-1">

                                            {{ $anak?->nama }}

                                        </h6>

                                        <div class="small text-muted mb-2">

                                            {{ $user?->nama }}

                                        </div>

                                        <div class="small fw-semibold text-primary">

                                            <i class="ti ti-calendar me-1"></i>

                                            {{ \Carbon\Carbon::parse($reguler->tanggal_wawancara)->translatedFormat('d F Y') }}

                                        </div>

                                    </div>

                                </div>

                                {{-- RIGHT --}}
                                <div class="text-end">

                                    <span class="badge bg-light-success text-success rounded-pill mb-2">

                                        Lolos Administrasi

                                    </span>

                                    <div>

                                        <a href="{{ route('reguler.detail', $reguler->id) }}"
                                            class="btn btn-light btn-sm rounded-pill px-3">

                                            Detail

                                        </a>

                                    </div>

                                </div>

                            </div>

                            {{-- ACTION --}}
                            <div class="d-flex gap-2 mt-4">

                                <button type="button"
                                    class="btn btn-success rounded-pill w-100"
                                    onclick="approveWawancara('{{ $reguler->id }}')">

                                    <i class="ti ti-check me-1"></i>
                                    Lolos

                                </button>

                                <button type="button"
                                    class="btn btn-outline-danger rounded-pill w-100"
                                    onclick="rejectWawancara('{{ $reguler->id }}')">

                                    <i class="ti ti-x me-1"></i>
                                    Tidak Lolos

                                </button>

                            </div>

                        </div>

                        @empty

                        <div class="text-center py-5">

                            <img src="{{ asset('assets/images/empty.svg') }}"
                                width="140"
                                class="mb-3">

                            <h6 class="fw-bold">
                                Tidak Ada Jadwal
                            </h6>

                            <p class="text-muted small mb-0">
                                Belum ada jadwal wawancara
                            </p>

                        </div>

                        @endforelse

                    </div>

                </div>

            </div>

        </div>

        <div class="row g-4 mb-4">
            {{-- Kuota --}}
            <div class="col-lg-6">

                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">

                    <div class="card-header bg-white border-0 p-4 pb-0">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <h5 class="fw-bold mb-1">
                                    Setting Kuota
                                </h5>

                                <p class="text-muted mb-0 small">
                                    Mengatur kuota pendaftaran penitipan
                                </p>

                            </div>

                            <div class="bg-light-primary rounded-circle d-flex align-items-center justify-content-center"
                                style="width:48px;height:48px;">

                                <i class="ti ti-users-group text-primary fs-5"></i>

                            </div>

                        </div>

                    </div>

                    <div class="card-body p-4">

                        <div class="table-responsive">

                            <table class="table table-hover align-middle mb-0">

                                <thead class="table-light">

                                    <tr>

                                        <th width="60">No</th>
                                        <th>Kategori</th>
                                        <th width="120">Kuota</th>
                                        <th width="120" class="text-center">Aksi</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @forelse ($data->kuota as $index => $kuota)

                                    <tr>

                                        <td>

                                            <span class="fw-semibold text-muted">
                                                {{ $index + 1 }}
                                            </span>

                                        </td>

                                        <td>

                                            <div class="d-flex align-items-center">

                                                <div class="bg-light-primary rounded-circle d-flex align-items-center justify-content-center me-3"
                                                    style="width:40px;height:40px;">

                                                    <i class="ti ti-baby-carriage text-primary"></i>

                                                </div>

                                                <div>

                                                    <div class="fw-semibold">
                                                        {{ ucwords($kuota->kategori.' '.$kuota->tipe) }}
                                                    </div>

                                                    <small class="text-muted">
                                                        {{ ucfirst($kuota->jenis_kelamin == 'L' ? 'laki-laki' : ($kuota->jenis_kelamin == 'P' ? 'perempuan' : '-')) }}
                                                    </small>

                                                </div>

                                            </div>

                                        </td>

                                        <td>

                                            <span class="badge bg-light-success text-success px-3 py-2 rounded-pill">

                                                {{ $kuota->kuota }} Slot

                                            </span>

                                        </td>

                                        <td class="text-center">

                                            <button
                                                class="btn btn-sm btn-primary rounded-pill px-3"
                                                onclick="editKuota(
                                                    '{{ $kuota->id }}',
                                                    '{{ ucfirst($kuota->kategori) }}',
                                                    '{{ $kuota->kuota }}'
                                                )">

                                                <i class="ti ti-edit me-1"></i>
                                                Edit

                                            </button>

                                        </td>

                                    </tr>

                                    <form id="form-kuota-{{ $kuota->id }}" action="{{ route('kuota.update', $kuota->id) }}" method="POST">
                                        @csrf

                                        <input type="hidden" name="kuota" id="kuota-{{ $kuota->id }}">
                                    </form>

                                    @empty

                                    <tr>

                                        <td colspan="4" class="text-center py-5">

                                            <i class="ti ti-inbox fs-1 text-muted d-block mb-2"></i>

                                            <span class="text-muted">

                                                Belum ada data kuota

                                            </span>

                                        </td>

                                    </tr>

                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>
        </div>

        <div class="row g-4 mb-4">

            <div class="col-12">

                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                    {{-- HEADER --}}
                    <div class="card-header bg-white border-0 p-4 pb-0">

                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">

                            <div>

                                <h5 class="fw-bold mb-1">
                                    Absensi Kehadiran Harian
                                </h5>

                                <p class="text-muted mb-0 small">

                                    Scan QR Code / input kode member peserta

                                </p>

                            </div>

                            <div class="d-flex align-items-center gap-2">

                                <span class="badge bg-light-success text-success rounded-pill px-3 py-2">

                                    {{ $data->absen->count() }} Kehadiran

                                </span>

                            </div>

                        </div>

                    </div>

                    {{-- FORM --}}
                    <div class="card-body p-4 pb-0">

                        <form id="formAbsensi"
                            action="{{ route('absen.store') }}"
                            method="POST">

                            @csrf

                            <div class="input-group input-group-lg shadow-sm rounded-pill overflow-hidden">

                                <span class="input-group-text bg-success text-white border-0 px-4">

                                    <i class="ti ti-qrcode"></i>

                                </span>

                                <input type="text"
                                    class="form-control border-0"
                                    id="kode_member"
                                    name="kode"
                                    placeholder="Scan QR Code / Input Kode Member"
                                    required>

                                <button class="btn btn-success px-4">

                                    Check In

                                </button>

                            </div>

                            <small class="text-muted d-block mt-2">

                                Scan QR peserta untuk check-in / check-out otomatis

                            </small>

                        </form>

                    </div>

                    {{-- TABLE --}}
                    <div class="table-responsive mt-4">

                        <table class="table align-middle mb-0">

                            <thead class="bg-light">

                                <tr>

                                    <th class="ps-4 py-3 border-0">
                                        Peserta
                                    </th>

                                    <th class="py-3 border-0">
                                        Check In
                                    </th>

                                    <th class="py-3 border-0">
                                        Check Out
                                    </th>

                                    <th class="py-3 border-0">
                                        Status
                                    </th>

                                    <th class="pe-4 py-3 border-0">
                                        Penalti
                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse ($data->absen as $item)

                                <tr>

                                    {{-- PESERTA --}}
                                    <td class="ps-4 py-3">

                                        <div class="d-flex align-items-center">

                                            <div class="rounded-circle bg-light-success d-flex align-items-center justify-content-center me-3"
                                                style="width:48px;height:48px;min-width:48px;">

                                                <span class="text-success fw-bold">

                                                    {{ strtoupper(substr($item->anak->nama, 0, 1)) }}

                                                </span>

                                            </div>

                                            <div>

                                                <h6 class="mb-1 fw-semibold">

                                                    {{ $item->anak->nama }}

                                                </h6>

                                                <small class="text-muted">

                                                    {{ $item->anak->kode }}

                                                </small>

                                            </div>

                                        </div>

                                    </td>

                                    {{-- CHECK IN --}}
                                    <td class="py-3">

                                        @if ($item->check_in)

                                        <div class="d-flex flex-column gap-1">

                                            <span class="badge bg-light-success text-success rounded-pill px-3 py-2">

                                                {{ \Carbon\Carbon::parse($item->check_in)->format('H:i') }}

                                            </span>

                                            @if ($item->status_checkin == 'terlambat')

                                            <span class="badge bg-light-warning text-warning rounded-pill">

                                                Terlambat

                                            </span>

                                            @endif

                                        </div>

                                        @else

                                        <span class="text-muted">
                                            -
                                        </span>

                                        @endif

                                    </td>

                                    {{-- CHECK OUT --}}
                                    <td class="py-3">

                                        @if ($item->check_out)

                                        <div class="d-flex flex-column gap-1">

                                            <span class="badge bg-light-primary text-primary rounded-pill px-3 py-2">

                                                {{ \Carbon\Carbon::parse($item->check_out)->format('H:i') }}

                                            </span>

                                            @if ($item->status_checkout == 'terlambat')

                                            <span class="badge bg-light-warning text-warning rounded-pill">

                                                Terlambat

                                            </span>

                                            @endif

                                        </div>

                                        @else

                                        <span class="text-muted">
                                            -
                                        </span>

                                        @endif

                                    </td>

                                    {{-- STATUS --}}
                                    <td class="py-3">

                                        @if ($item->status == 'true')

                                        <span class="badge bg-light-success text-success rounded-pill px-3 py-2">

                                            Hadir

                                        </span>

                                        @elseif ($item->status == 'false')

                                        <span class="badge bg-light-warning text-warning rounded-pill px-3 py-2">

                                            Tidak Hadir

                                        </span>

                                        @else

                                        <span class="badge bg-light-danger text-danger rounded-pill px-3 py-2">

                                            Penalti

                                        </span>

                                        @endif

                                    </td>

                                    {{-- PENALTI --}}
                                    <td class="pe-4 py-3">

                                        @if ($item->penalti)

                                        <span class="badge bg-danger rounded-pill px-3 py-2">

                                            {{ $item->penaltiHari() }} Hari

                                        </span>

                                        @else

                                        <span class="text-muted">
                                            -
                                        </span>

                                        @endif

                                    </td>

                                </tr>

                                @empty

                                <tr>

                                    <td colspan="5"
                                        class="text-center py-5">

                                        <div class="d-flex flex-column align-items-center">

                                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mb-3"
                                                style="width:80px;height:80px;">

                                                <i class="ti ti-inbox text-muted fs-1"></i>

                                            </div>

                                            <h6 class="fw-bold mb-1">

                                                Belum Ada Kehadiran

                                            </h6>

                                            <p class="text-muted small mb-0">

                                                Belum ada absensi peserta hari ini

                                            </p>

                                        </div>

                                    </td>

                                </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>
    </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="modalDetailJadwal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Detail Jadwal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row mb-4">

                    <div class="col-md-3 mb-3">

                        <div class="border rounded-4 p-3 h-100">

                            <div class="text-muted small mb-1">Tanggal</div>
                            <div class="fw-semibold" id="detail_tanggal">-</div>
                        </div>

                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="border rounded-4 p-3 h-100">
                            <div class="text-muted small mb-1">Kuota</div>
                            <div class="fw-semibold" id="detail_kuota"> - </div>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="border rounded-4 p-3 h-100">
                            <div class="text-muted small mb-1"> Pengasuh </div>
                            <div class="fw-semibold" id="detail_pengasuh"> - </div>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="border rounded-4 p-3 h-100">
                            <div class="text-muted small mb-1"> Status </div>
                            <div class="fw-semibold" id="detail_status"> - </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <h5 class="fw-bold mb-0">
                                Peserta Penitipan
                            </h5>

                            <span
                                class="badge bg-success-subtle text-success rounded-pill px-3"
                                id="detail_total_peserta">
                                0 Peserta
                            </span>

                        </div>

                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Anak</th>
                                        <th>Orang Tua</th>
                                        <th>Paket</th>
                                        <th>Masuk</th>
                                        <th>Keluar</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

                                <tbody id="tablePeserta">
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">
                                            Tidak ada data
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('js')
<script>
    const searchInput = document.getElementById('searchReguler');

    searchInput.addEventListener('keyup', function() {

        let keyword = this.value.toLowerCase();

        let items = document.querySelectorAll('.reguler-item');

        let visible = 0;

        items.forEach(item => {

            let searchText = item.getAttribute('data-search');

            if (searchText.includes(keyword)) {
                item.style.display = '';
                visible++;
            } else {
                item.style.display = 'none';
            }

        });

        const emptySearch = document.getElementById('emptySearchResult');

        if (visible === 0) {
            emptySearch.classList.remove('d-none');
        } else {
            emptySearch.classList.add('d-none');
        }

    });

    // =========================
    // APPROVE
    // =========================

    function approveReguler(id) {

        Swal.fire({

            title: 'Setujui Pendaftaran',

            html: `

                <div class="text-start mt-3">

                    <label class="form-label fw-semibold mb-2">
                        Tanggal Wawancara
                    </label>

                    <input type="date"
                        id="tanggalWawancara"
                        class="form-control">

                </div>

            `,

            icon: 'question',

            showCancelButton: true,

            confirmButtonText: 'Setujui',
            cancelButtonText: 'Batal',

            confirmButtonColor: '#198754',

            reverseButtons: true,

            customClass: {
                popup: 'border-0 rounded-4 shadow-sm'
            },

            preConfirm: () => {

                const tanggal =
                    document.getElementById('tanggalWawancara').value;

                if (!tanggal) {

                    Swal.showValidationMessage(
                        'Tanggal wawancara wajib diisi'
                    );

                    return false;

                }

                return {
                    tanggal: tanggal
                };

            }

        }).then((result) => {

            if (result.isConfirmed) {

                const form = document.createElement('form');

                form.method = 'POST';
                form.action = '/reguler/approve/' + id;

                form.innerHTML = `
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="tanggal_wawancara" value="${result.value.tanggal}">
                `;

                Swal.fire({

                    html: `

                        <div class="py-3">

                            <div class="spinner-border text-success mb-3"
                                style="width: 3rem; height: 3rem;"
                                role="status">
                            </div>

                            <h5 class="mb-1 fw-semibold">
                                Memproses...
                            </h5>

                        </div>

                    `,

                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,

                    background: '#fff',

                    customClass: {
                        popup: 'border-0 rounded-4 shadow-sm'
                    }

                });

                document.body.appendChild(form);
                form.submit();
            }

        });

    }

    // REJECT
    function rejectReguler(id) {

        Swal.fire({

            title: 'Tolak Pendaftaran',

            html: `

                <div class="text-start mt-3">

                    <label class="form-label fw-semibold mb-2">
                        Alasan Penolakan
                    </label>

                    <select id="statusPenolakan"
                        class="form-select mb-3">

                        <option value="">
                            Pilih Alasan
                        </option>

                        <option value="false">
                            Kuota Penuh
                        </option>

                        <option value="tms">
                            Tidak Memenuhi Syarat
                        </option>

                    </select>

                    <textarea id="keteranganPenolakan"
                        class="form-control"
                        rows="4"
                        placeholder="Tambahkan keterangan penolakan..."></textarea>

                </div>

            `,

            icon: 'warning',

            showCancelButton: true,

            confirmButtonText: 'Tolak',
            cancelButtonText: 'Batal',

            confirmButtonColor: '#dc3545',

            reverseButtons: true,

            customClass: {
                popup: 'border-0 rounded-4 shadow-sm'
            },

            preConfirm: () => {

                const status =
                    document.getElementById('statusPenolakan').value;

                const keterangan =
                    document.getElementById('keteranganPenolakan').value;

                if (!status) {

                    Swal.showValidationMessage(
                        'Pilih alasan penolakan'
                    );

                    return false;

                }

                if (!keterangan) {

                    Swal.showValidationMessage(
                        'Keterangan wajib diisi'
                    );

                    return false;

                }

                return {
                    status: status,
                    keterangan: keterangan
                };

            }

        }).then((result) => {

            if (result.isConfirmed) {

                Swal.fire({

                    html: `

                        <div class="py-3">

                            <div class="spinner-border text-success mb-3"
                                style="width: 3rem; height: 3rem;"
                                role="status">
                            </div>

                            <h5 class="mb-1 fw-semibold">
                                Memproses...
                            </h5>

                        </div>

                    `,

                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,

                    background: '#fff',

                    customClass: {
                        popup: 'border-0 rounded-4 shadow-sm'
                    }

                });

                const form = document.createElement('form');

                form.method = 'POST';

                form.action =
                    `/reguler/reject/${id}`;

                form.innerHTML = `
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="status" value="${result.value.status}">
                    <input type="hidden" name="keterangan" value="${result.value.keterangan}">
                `;

                document.body.appendChild(form);

                form.submit();

            }

        });

    }
</script>

<script>
    function detailSkrining(id) {

        Swal.fire({

            title: 'Memuat Data Skrining...',

            allowOutsideClick: false,

            didOpen: () => {

                Swal.showLoading();

            }

        });

        $.get(`/anak/skrining/${id}`, function(data) {

            Swal.close();

            Swal.fire({

                width: '750px',

                background: '#fff',

                showCloseButton: true,

                showConfirmButton: false,

                customClass: {

                    popup: 'rounded-4 border-0 shadow',
                    title: 'fw-bold fs-4'

                },

                title: 'Detail Skrining Anak',

                html: `

                <div class="text-start mt-4">

                    <!-- HEADER -->
                    <div class="d-flex align-items-center mb-4">

                        <div class="me-3">

                            ${
                                data.foto
                                ?
                                `<img src="/storage/${data.foto}"
                                    class="rounded-circle border shadow"
                                    width="80"
                                    height="80"
                                    style="object-fit:cover;">`
                                :
                                `<div class="bg-light rounded-circle d-flex align-items-center justify-content-center"
                                    style="width:80px;height:80px;">

                                    <i class="ti ti-user text-success"
                                        style="font-size:35px;"></i>

                                </div>`
                            }

                        </div>

                        <div>

                            <h5 class="fw-bold mb-1">
                                ${data.nama}
                            </h5>

                            <div class="text-muted">

                                ${data.umur}

                            </div>

                        </div>

                    </div>

                    <!-- SKRINING -->
                    <div class="row g-3">

                        <div class="col-md-6">

                            <div class="border rounded-4 p-3 h-100">

                                <small class="text-muted d-block">
                                    Berat Badan
                                </small>

                                <div class="fw-semibold">
                                    ${data.skrining.berat_badan ?? '-'} Kg
                                </div>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="border rounded-4 p-3 h-100">

                                <small class="text-muted d-block">
                                    Tinggi Badan
                                </small>

                                <div class="fw-semibold">
                                    ${data.skrining.tinggi_badan ?? '-'} Cm
                                </div>

                            </div>

                        </div>

                        <div class="col-md-12">

                            <div class="border rounded-4 p-3">

                                <small class="text-muted d-block mb-1">
                                    Alergi
                                </small>

                                <div class="fw-semibold">
                                    ${data.skrining.alergi ?? '-'}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-12">

                            <div class="border rounded-4 p-3">

                                <small class="text-muted d-block mb-1">
                                    Riwayat Penyakit
                                </small>

                                <div class="fw-semibold">
                                    ${data.skrining.riwayat_penyakit ?? '-'}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-12">

                            <div class="border rounded-4 p-3">

                                <small class="text-muted d-block mb-1">
                                    Kebutuhan Khusus
                                </small>

                                <div class="fw-semibold">
                                    ${data.skrining.kebutuhan_khusus ?? '-'}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-12">

                            <div class="border rounded-4 p-3">

                                <small class="text-muted d-block mb-1">
                                    Konsumsi Obat
                                </small>

                                <div class="fw-semibold">
                                    ${data.skrining.konsumsi_obat ?? '-'}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-12">
                            <div class="border rounded-4 p-3">

                                <small class="text-muted d-block mb-1">
                                    Catatan Orang Tua
                                </small>

                                <div class="fw-semibold">
                                    ${data.skrining.catatan_orang_tua ?? '-'}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            `

            });

        });

    }
</script>

<script>
    $(document).ready(function() {

        // $('#kode_member').focus();

        // AUTO FOCUS TERUS
        // setInterval(() => {

        //     $('#kode_member').focus();

        // }, 1000);

        // AUTO SUBMIT SETELAH SCAN
        $('#kode_member').on('change', function() {

            Swal.fire({

                title: 'Memproses Absensi...',

                html: `

                <div class="py-3">

                    <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                        style="width:90px;height:90px;">

                        <div class="spinner-border text-success"
                            style="width:3rem;height:3rem;">
                        </div>

                    </div>

                    <p class="text-muted mb-0">

                        Mohon tunggu sebentar

                    </p>

                </div>

            `,

                allowOutsideClick: false,
                allowEscapeKey: false,

                showConfirmButton: false,

                background: '#fff',

                customClass: {

                    popup: 'rounded-4 border-0 shadow'

                }

            });

            // SUBMIT
            setTimeout(() => {

                $('#formAbsensi').submit();

            }, 500);

        });

    });
</script>

<!-- Modal Detail Jadwal -->
<script>
    $('.btn-detail').on('click', function() {
        let id = $(this).data('id');

        // Tampilkan loading sebentar saat ambil data
        Swal.fire({
            title: 'Mengambil Data...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $.get(`/jadwal/detailModal/${id}`, function(data) {
            console.log(data.tanggal, data.kuota, data.total_peserta, data.pengasuh, data.status, data.total_peserta)
            Swal.close();

            $('#detail_tanggal').text(data.tanggal);
            $('#detail_kuota').text(
                `${data.total_peserta} / ${data.kuota}`
            );

            $('#detail_pengasuh').text(
                data.pengasuh ?? '-'
            );

            $('#detail_status').html(`
                ${data.status}
            `);

            $('#detail_total_peserta').text(
                `${data.total_peserta} Peserta`
            );

            let html = '';

            if (data.peserta.length > 0) {

                data.peserta.forEach((item, index) => {

                    html += `

                    <tr>
                        <td>${index + 1}</td>
                        <td>
                            <div class="fw-semibold">
                                ${item.nama_anak}
                            </div>
                        </td>
                        <td>
                            ${item.nama_ortu}
                        </td>
                        <td>
                            <span class="badge bg-primary-subtle text-primary rounded-pill px-3">
                                ${item.paket}
                            </span>
                        </td>
                        <td>${item.masuk}</td>
                        <td>${item.keluar}</td>
                        <td>
                            ${item.status}
                        </td>
                    </tr>
                `;
                });
            } else {

                html = `
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                        Belum ada peserta penitipan
                    </td>
                </tr>
            `;

            }

            $('#tablePeserta').html(html);

            $('#modalDetailJadwal').modal('show');
        }).fail(function() {
            Swal.fire('Error', 'Jadwal tidak ditemukan', 'error');
        });
    });
</script>

<script>
    function approveWawancara(id) {

        Swal.fire({

            title: 'Loloskan Pendaftaran?',
            text: 'Anak akan dinyatakan lolos penitipan reguler',

            icon: 'question',

            showCancelButton: true,

            confirmButtonText: 'Ya, Loloskan',
            cancelButtonText: 'Batal',

            confirmButtonColor: '#198754',

            reverseButtons: true,

            customClass: {
                popup: 'border-0 rounded-4 shadow-sm'
            }

        }).then((result) => {

            if (result.isConfirmed) {

                const form = document.createElement('form');

                form.method = 'POST';
                form.action = '/reguler/approve/' + id;

                form.innerHTML = `
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="status" value="lolos">
                `;

                Swal.fire({

                    html: `

                        <div class="py-3">

                            <div class="spinner-border text-success mb-3"
                                style="width: 3rem; height: 3rem;"
                                role="status">
                            </div>

                            <h5 class="mb-1 fw-semibold">
                                Memproses...
                            </h5>

                        </div>

                    `,

                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,

                    background: '#fff',

                    customClass: {
                        popup: 'border-0 rounded-4 shadow-sm'
                    }

                });

                document.body.appendChild(form);
                form.submit();
            }

        });

    }
</script>

<script>
    function rejectWawancara(id) {

        Swal.fire({

            title: 'Hasil Wawancara',

            html: `

            <div class="text-start">

                <label class="form-label fw-semibold mb-2">
                    Alasan Tidak Lolos
                </label>

                <select id="statusWawancara"
                    class="form-select">

                    <option value="">
                        -- Pilih Alasan --
                    </option>

                    <option value="false">
                        Kuota Penuh
                    </option>

                    <option value="tms">
                        Tidak Memenuhi Syarat
                    </option>

                </select>

                <div class="mt-3">

                    <label class="form-label fw-semibold mb-2">
                        Keterangan
                    </label>

                    <textarea
                        id="keteranganWawancara"
                        class="form-control"
                        rows="3"
                        placeholder="Masukkan keterangan..."></textarea>

                </div>

            </div>

        `,

            icon: 'warning',

            showCancelButton: true,

            confirmButtonText: 'Simpan',
            cancelButtonText: 'Batal',

            confirmButtonColor: '#dc3545',

            reverseButtons: true,

            customClass: {
                popup: 'border-0 rounded-4 shadow-sm'
            },

            preConfirm: () => {

                const status = document.getElementById(
                    'statusWawancara'
                ).value;

                const keterangan = document.getElementById(
                    'keteranganWawancara'
                ).value;

                if (!status) {

                    Swal.showValidationMessage(
                        'Pilih alasan tidak lolos'
                    );

                    return false;
                }

                return {
                    status: status,
                    keterangan: keterangan
                };
            }

        }).then((result) => {

            if (result.isConfirmed) {

                Swal.fire({

                    html: `

                        <div class="py-3">

                            <div class="spinner-border text-success mb-3"
                                style="width: 3rem; height: 3rem;"
                                role="status">
                            </div>

                            <h5 class="mb-1 fw-semibold">
                                Memproses...
                            </h5>

                        </div>

                    `,

                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,

                    background: '#fff',

                    customClass: {
                        popup: 'border-0 rounded-4 shadow-sm'
                    }

                });

                const form = document.createElement('form');

                form.method = 'POST';

                form.action =
                    `/reguler/reject/${id}`;

                form.innerHTML = `
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="status" value="${result.value.status}">
                <input type="hidden" name="keterangan" value="${result.value.keterangan}">
            `;

                document.body.appendChild(form);

                form.submit();
            }

        });

    }
</script>

<script>
    function editKuota(id, kategori, kuota) {

        Swal.fire({

            title: 'Edit Kuota',

            html: `
                <div class="text-start">

                    <label class="form-label fw-semibold">
                        Kategori
                    </label>

                    <input type="text"
                        class="form-control mb-3"
                        value="${kategori}"
                        readonly>

                    <label class="form-label fw-semibold">
                        Kuota
                    </label>

                    <input type="number"
                        id="inputKuota"
                        class="form-control"
                        value="${kuota}"
                        min="0">

                </div>
            `,

            showCancelButton: true,

            confirmButtonText: 'Simpan',
            cancelButtonText: 'Batal',

            confirmButtonColor: '#0d6efd',

            customClass: {
                popup: 'border-0 rounded-4 shadow-sm'
            },

            preConfirm: () => {

                const value = document.getElementById(
                    'inputKuota'
                ).value;

                if (!value || value < 0) {

                    Swal.showValidationMessage(
                        'Kuota harus diisi'
                    );

                    return false;
                }

                return value;
            }

        }).then((result) => {

            if (result.isConfirmed) {

                document.getElementById(
                    'kuota-' + id
                ).value = result.value;

                Swal.fire({

                    title: 'Memproses...',

                    allowOutsideClick: false,
                    allowEscapeKey: false,

                    showConfirmButton: false,

                    didOpen: () => {
                        Swal.showLoading();
                    }

                });

                document.getElementById(
                    'form-kuota-' + id
                ).submit();
            }

        });

    }
</script>
@endsection
@endsection