@extends('pages.app')

@section('content')
<div class="pc-container">
    <div class="pc-content">

        {{-- PAGE HEADER --}}
        <div class="page-header mb-4">
            <div class="page-block">
                <div class="row align-items-center">

                    <div class="col-md-8">
                        <h3 class="mb-1 fw-bold">
                            Detail Jadwal
                        </h3>

                        <p class="text-muted mb-0">
                            Detail jadwal penitipan dan evaluasi harian anak
                        </p>
                    </div>

                    <div class="col-md-4 text-md-end mt-3 mt-md-0">

                        <a href="{{ route('jadwal') }}"
                            class="btn btn-light rounded-pill px-4">

                            <i class="ti ti-arrow-left me-1"></i>
                            Kembali

                        </a>

                    </div>

                </div>
            </div>
        </div>

        {{-- DETAIL JADWAL --}}
        <div class="row mb-4">

            <div class="col-lg-4">

                <div class="card border-0 shadow-sm rounded-4">

                    <div class="card-body">

                        <div class="d-flex align-items-center mb-4">

                            <div class="rounded-circle bg-light-success d-flex align-items-center justify-content-center"
                                style="width:70px;height:70px;">

                                <i class="ti ti-calendar-event text-success f-30"></i>

                            </div>

                            <div class="ms-3">

                                <h5 class="mb-1 fw-bold">
                                    {{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('l') }}
                                </h5>

                                <p class="text-muted mb-0">
                                    {{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('d F Y') }}
                                </p>

                            </div>

                        </div>

                        <div class="border rounded-4 p-3 mb-3">

                            <small class="text-muted d-block mb-1">
                                Pengasuh
                            </small>

                            <h6 class="mb-0 fw-semibold">
                                {{ $jadwal->pengasuh->nama ?? '-' }}
                            </h6>

                        </div>

                        <div class="border rounded-4 p-3 mb-3">

                            <small class="text-muted d-block mb-1">
                                Total Peserta
                            </small>

                            <h6 class="mb-0 fw-semibold text-success">
                                {{ $jadwal->peserta->count() }} Anak
                            </h6>

                        </div>

                        <div class="border rounded-4 p-3">

                            <small class="text-muted d-block mb-1">
                                Kuota
                            </small>

                            <h6 class="mb-0 fw-semibold">
                                {{ $jadwal->peserta->count() }} / {{ $jadwal->kuota }}
                            </h6>

                        </div>

                    </div>

                </div>

                <div class="card border-0 shadow-sm rounded-4">

                    <div class="card-header bg-white border-0 pt-4 pb-0">

                        <h5 class="fw-bold mb-1">
                            Jadwal Kegiatan Harian
                        </h5>

                        <p class="text-muted mb-0 small">
                            Aktivitas daycare harian
                        </p>

                    </div>

                    <div class="card-body">

                        @foreach ($kategori as $item)

                        <div class="border rounded-4 p-3 mb-3">

                            <div class="d-flex justify-content-between align-items-center">

                                <div>

                                    <h6 class="mb-1 fw-semibold">
                                        {{ $item->deskripsi }}
                                    </h6>

                                    <small class="text-muted">
                                        {{ $item->keterangan }}
                                    </small>

                                </div>

                                <span class="badge bg-light-success text-success">

                                    Kegiatan

                                </span>

                            </div>

                        </div>

                        @endforeach

                    </div>

                </div>

            </div>

            {{-- KEGIATAN --}}
            <div class="col-lg-8">
                {{-- PESERTA --}}
                <div class="card border-0 shadow-sm rounded-4">

                    {{-- HEADER --}}
                    <div class="card-header bg-white border-0 pt-4 pb-0">

                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                            <div>

                                <h5 class="fw-bold mb-1">
                                    Peserta Penitipan
                                </h5>

                                <p class="text-muted mb-0 small">
                                    Daftar peserta dan evaluasi harian anak
                                </p>

                            </div>

                            <span class="badge bg-success">

                                {{ $jadwal->peserta->count() }} Peserta

                            </span>

                        </div>

                    </div>

                    {{-- FILTER --}}
                    <div class="card-body border-bottom">

                        <div class="row g-3">

                            {{-- SEARCH --}}
                            <div class="col-md-8">

                                <label class="form-label">
                                    Cari Nama Anak
                                </label>

                                <input type="text"
                                    class="form-control"
                                    id="searchPeserta"
                                    placeholder="Cari nama peserta...">

                            </div>

                            {{-- FILTER PENILAIAN --}}
                            <div class="col-md-4">

                                <label class="form-label">
                                    Filter Penilaian
                                </label>

                                <select class="form-select"
                                    id="filterPenilaian">

                                    <option value="all">
                                        Semua
                                    </option>

                                    <option value="sudah">
                                        Sudah Penilaian
                                    </option>

                                    <option value="belum">
                                        Belum Penilaian
                                    </option>

                                </select>

                            </div>

                        </div>

                    </div>

                    {{-- BODY --}}
                    <div class="card-body p-0">

                        <ul class="list-group list-group-flush"
                            id="listPeserta">

                            @forelse ($jadwal->peserta as $item)

                            @php

                            $laporan = \App\Models\Laporan::where('jadwal_id', $jadwal->id)
                            ->where('anak_id', $item->anak_id)
                            ->first();

                            @endphp

                            <li class="list-group-item py-3 peserta-item"
                                data-search="{{ strtolower($item->anak->nama) }}"
                                data-penilaian="{{ $laporan ? 'sudah' : 'belum' }}">

                                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                                    {{-- LEFT --}}
                                    <div class="d-flex align-items-center">

                                        {{-- FOTO --}}
                                        <div class="flex-shrink-0">

                                            @if ($item->anak->foto)

                                            <img src="{{ asset('storage/' . $item->anak->foto) }}"
                                                class="rounded-circle border"
                                                width="65"
                                                height="65"
                                                style="object-fit:cover;">

                                            @else

                                            <div class="rounded-circle bg-light-success d-flex align-items-center justify-content-center"
                                                style="width:65px;height:65px;">

                                                <i class="ti ti-user text-success"></i>

                                            </div>

                                            @endif

                                        </div>

                                        {{-- INFO --}}
                                        <div class="ms-3">

                                            <h6 class="mb-1 fw-semibold">
                                                {{ $item->anak->nama }}
                                            </h6>

                                            <div class="small text-muted d-flex flex-column gap-1">

                                                {{-- ORANG TUA --}}
                                                <div>

                                                    <i class="ti ti-users"></i>

                                                    Orang Tua:
                                                    {{ $item->anak->user->nama ?? '-' }}

                                                </div>

                                                {{-- UNIT --}}
                                                <div>

                                                    <i class="ti ti-building"></i>

                                                    Unit Kerja:
                                                    {{ $item->anak->user->uker->nama_uker ?? '-' }}

                                                </div>

                                                {{-- CHECK IN --}}
                                                <div>

                                                    <i class="ti ti-login"></i>

                                                    Check In:

                                                    <span class="fw-medium">

                                                        {{ $item->waktu_masuk ? \Carbon\Carbon::parse($item->waktu_masuk)->format('H:i') : '-' }}

                                                    </span>

                                                </div>

                                                {{-- CHECK OUT --}}
                                                <div>

                                                    <i class="ti ti-logout"></i>

                                                    Check Out:

                                                    <span class="fw-medium">

                                                        {{ $item->waktu_keluar ? \Carbon\Carbon::parse($item->waktu_keluar)->format('H:i') : '-' }}

                                                    </span>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    {{-- RIGHT --}}
                                    <div class="d-flex flex-column align-items-end gap-2">

                                        {{-- STATUS --}}
                                        @if ($item->waktu_masuk)

                                        <span class="badge bg-light-success text-success">

                                            <i class="ti ti-check me-1"></i>
                                            Sudah Check In

                                        </span>

                                        @else

                                        <span class="badge bg-light-danger text-danger">

                                            <i class="ti ti-x me-1"></i>
                                            Belum Check In

                                        </span>

                                        @endif

                                        {{-- STATUS PENILAIAN --}}
                                        @if ($laporan)

                                        <span class="badge bg-success">

                                            <i class="ti ti-check me-1"></i>
                                            Sudah Penilaian

                                        </span>

                                        @else

                                        <span class="badge bg-warning text-dark">

                                            <i class="ti ti-clock me-1"></i>
                                            Belum Penilaian

                                        </span>

                                        @endif

                                        {{-- BUTTON --}}
                                        @if ($item->waktu_masuk && $item->waktu_keluar)
                                        @if (!$item->laporan->count())
                                        <a href="{{ route('laporan.create', $item->id) }}"
                                            class="btn btn-success btn-sm rounded-pill px-3">

                                            <i class="ti ti-notebook me-1"></i>
                                            Penilaian Evaluasi
                                        </a>
                                        @else
                                        <div class="input-group">
                                        <a href="{{ route('laporan.edit', $item->laporan->first()->id) }}"
                                            class="btn btn-warning btn-sm rounded-pill px-3 mx-2">

                                            <i class="ti ti-notebook me-1"></i>
                                            Edit
                                        </a>
                                        <a href="{{ route('laporan.detail', $item->laporan->first()->id) }}"
                                            class="btn btn-info btn-sm rounded-pill px-2 ml-2">

                                            <i class="ti ti-report me-1"></i>
                                            Detail
                                        </a>
                                        </div>
                                        @endif
                                        @endif

                                    </div>

                                </div>

                            </li>

                            @empty

                            <li class="list-group-item text-center py-5">

                                <div class="text-muted">

                                    <i class="ti ti-inbox fs-1 d-block mb-2"></i>

                                    Belum ada peserta penitipan

                                </div>

                            </li>

                            @endforelse

                            {{-- EMPTY --}}
                            <li class="list-group-item text-center py-5 d-none"
                                id="emptySearchResult">

                                <div class="text-muted">

                                    <i class="ti ti-search-off fs-1 d-block mb-2"></i>

                                    Data tidak ditemukan

                                </div>

                            </li>

                        </ul>

                    </div>

                </div>


            </div>

        </div>



    </div>
</div>
@section('js')


<script>
    $('#searchPeserta, #filterPenilaian').on('keyup change', function() {

        let search = $('#searchPeserta').val().toLowerCase();
        let filter = $('#filterPenilaian').val();

        let visible = 0;

        $('.peserta-item').each(function() {

            let nama = $(this).data('search');
            let penilaian = $(this).data('penilaian');

            let matchSearch = nama.includes(search);

            let matchFilter = (
                filter === 'all' ||
                penilaian === filter
            );

            if (matchSearch && matchFilter) {

                $(this).show();
                visible++;

            } else {

                $(this).hide();

            }

        });

        if (visible === 0) {

            $('#emptySearchResult').removeClass('d-none');

        } else {

            $('#emptySearchResult').addClass('d-none');

        }

    });
</script>
@endsection
@endsection