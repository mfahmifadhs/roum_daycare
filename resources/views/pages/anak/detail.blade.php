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
                            Detail Data Anak
                        </h3>

                        <p class="text-muted mb-0">
                            Informasi anak, skrining dan riwayat penitipan
                        </p>

                    </div>

                </div>
            </div>
        </div>

        <div class="row">

            {{-- LEFT --}}
            <div class="col-lg-4">

                {{-- DATA ANAK --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">

                    <div class="card-body text-center">

                        @if ($anak->foto)

                        <img src="{{ asset('storage/' . $anak->foto) }}"
                            class="rounded-circle border mb-3"
                            width="120"
                            height="120"
                            style="object-fit:cover;">

                        @else

                        <div class="rounded-circle bg-light-success d-flex align-items-center justify-content-center mx-auto mb-3"
                            style="width:120px;height:120px;">

                            <i class="ti ti-user text-success"
                                style="font-size:50px;"></i>

                        </div>

                        @endif

                        <h4 class="fw-bold mb-1">
                            {{ $anak->nama }}
                        </h4>

                        <p class="text-muted mb-4">
                            {{ $anak->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                        </p>

                        <div class="text-start d-flex flex-column gap-3">

                            <div>

                                <small class="text-muted d-block">
                                    Tempat, Tanggal Lahir
                                </small>

                                <span class="fw-semibold">
                                    {{ $anak->tempat_lahir }},
                                    {{ \Carbon\Carbon::parse($anak->tanggal_lahir)->translatedFormat('d F Y') }}
                                </span>

                            </div>

                            <div>

                                <small class="text-muted d-block">
                                    Golongan Darah
                                </small>

                                <span class="fw-semibold">
                                    {{ $anak->golongan_darah ?? '-' }}
                                </span>

                            </div>

                            <div>

                                <small class="text-muted d-block">
                                    Orang Tua
                                </small>

                                <span class="fw-semibold">
                                    {{ $anak->user->nama ?? '-' }}
                                </span>

                            </div>

                            <div>

                                <small class="text-muted d-block">
                                    Unit Kerja
                                </small>

                                <span class="fw-semibold">
                                    {{ $anak->user->uker->nama_uker ?? '-' }}
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- MENU NAVIGASI --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">

                    <div class="card-header bg-white border-0 pt-4">

                        <h5 class="fw-bold mb-1">
                            Menu Penilaian Anak
                        </h5>

                        <p class="text-muted small mb-0">
                            Navigasi cepat rekap dan riwayat anak
                        </p>

                    </div>

                    <div class="card-body">

                        <div class="d-grid gap-3">

                            {{-- REKAP KEGIATAN --}}
                            <a href="#rekapKegiatan"
                                class="btn btn-light rounded-4 text-start p-3 border">

                                <div class="d-flex align-items-center">

                                    <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                        style="width:45px;height:45px;">

                                        <i class="ti ti-activity text-success fs-5"></i>

                                    </div>

                                    <div class="ms-3">

                                        <div class="fw-semibold text-dark">
                                            Rekap Kegiatan Harian
                                        </div>

                                        <small class="text-muted">
                                            Ringkasan aktivitas harian anak
                                        </small>

                                    </div>

                                </div>

                            </a>

                            {{-- REKAP PERKEMBANGAN --}}
                            <a href="#rekapPerkembangan"
                                class="btn btn-light rounded-4 text-start p-3 border">

                                <div class="d-flex align-items-center">

                                    <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                        style="width:45px;height:45px;">

                                        <i class="ti ti-chart-line text-primary fs-5"></i>

                                    </div>

                                    <div class="ms-3">

                                        <div class="fw-semibold text-dark">
                                            Rekap Perkembangan Anak
                                        </div>

                                        <small class="text-muted">
                                            Monitoring perkembangan anak
                                        </small>

                                    </div>

                                </div>

                            </a>

                            {{-- REKAP PENILAIAN --}}
                            <a href="#riwayatPenilaian"
                                class="btn btn-light rounded-4 text-start p-3 border">

                                <div class="d-flex align-items-center">

                                    <div class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                        style="width:45px;height:45px;">

                                        <i class="ti ti-notebook text-warning fs-5"></i>

                                    </div>

                                    <div class="ms-3">

                                        <div class="fw-semibold text-dark">
                                            Rekap Riwayat Penilaian
                                        </div>

                                        <small class="text-muted">
                                            Daftar seluruh evaluasi harian
                                        </small>

                                    </div>

                                </div>

                            </a>

                            {{-- RIWAYAT PENITIPAN --}}
                            <a href="#riwayatPenitipan"
                                class="btn btn-light rounded-4 text-start p-3 border">

                                <div class="d-flex align-items-center">

                                    <div class="bg-info bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                        style="width:45px;height:45px;">

                                        <i class="ti ti-calendar-check text-info fs-5"></i>

                                    </div>

                                    <div class="ms-3">

                                        <div class="fw-semibold text-dark">
                                            Riwayat Penitipan Anak
                                        </div>

                                        <small class="text-muted">
                                            Kehadiran dan jadwal penitipan
                                        </small>

                                    </div>

                                </div>

                            </a>

                        </div>

                    </div>

                </div>

                {{-- SKRINING --}}
                <div class="card border-0 shadow-sm rounded-4">

                    <div class="card-header bg-white border-0 pt-4">

                        <h5 class="fw-bold mb-1">
                            Skrining Anak
                        </h5>

                        <p class="text-muted small mb-0">
                            Data kesehatan dan kebutuhan khusus
                        </p>

                    </div>

                    <div class="card-body">

                        @if ($anak->skrining)

                        <div class="d-flex flex-column gap-3">

                            <div>

                                <small class="text-muted d-block">
                                    Berat Badan
                                </small>

                                <span class="fw-semibold">
                                    {{ $anak->skrining->berat_badan }} Kg
                                </span>

                            </div>

                            <div>

                                <small class="text-muted d-block">
                                    Tinggi Badan
                                </small>

                                <span class="fw-semibold">
                                    {{ $anak->skrining->tinggi_badan }} Cm
                                </span>

                            </div>

                            <div>

                                <small class="text-muted d-block">
                                    Alergi
                                </small>

                                <span class="fw-semibold">
                                    {{ $anak->skrining->alergi ?? '-' }}
                                </span>

                            </div>

                            <div>

                                <small class="text-muted d-block">
                                    Riwayat Penyakit
                                </small>

                                <span class="fw-semibold">
                                    {{ $anak->skrining->riwayat_penyakit ?? '-' }}
                                </span>

                            </div>

                            <div>

                                <small class="text-muted d-block">
                                    Kebutuhan Khusus
                                </small>

                                <span class="fw-semibold">
                                    {{ $anak->skrining->kebutuhan_khusus ?? '-' }}
                                </span>

                            </div>

                            <div>

                                <small class="text-muted d-block">
                                    Konsumsi Obat
                                </small>

                                <span class="fw-semibold">
                                    {{ $anak->skrining->konsumsi_obat ?? '-' }}
                                </span>

                            </div>

                            <div>

                                <small class="text-muted d-block">
                                    Riwayat Rawat Inap
                                </small>

                                <span class="fw-semibold">
                                    {{ $anak->skrining->riwayat_rawat_inap ?? '-' }}
                                </span>

                            </div>

                            <div>

                                <small class="text-muted d-block">
                                    Imunisasi Dasar
                                </small>

                                <span class="badge bg-{{ $anak->skrining->imunisasi_dasar == 'true' ? 'success' : 'danger' }}">
                                    {{ $anak->skrining->imunisasi_dasar == 'true' ? 'Sudah' : 'Belum' }}
                                </span>

                            </div>

                            <div>

                                <small class="text-muted d-block">
                                    Catatan Orang Tua
                                </small>

                                <span class="fw-semibold">
                                    {{ $anak->skrining->catatan_orang_tua ?? '-' }}
                                </span>

                            </div>

                        </div>

                        @else

                        <div class="text-center py-4 text-muted">

                            <i class="ti ti-stethoscope fs-1 d-block mb-2"></i>

                            Belum ada data skrining

                        </div>

                        @endif

                    </div>

                </div>

            </div>

            {{-- RIGHT --}}
            <div class="col-lg-8" style="max-height:calc(200vh - 120px); overflow-y:auto;">
                <div class="card border-0 shadow-sm rounded-4 mb-4" id="rekapKegiatan">
                    <div class="card-header bg-white border-0 pt-4">

                        <h5 class="fw-bold mb-1">
                            Rekap Kegiatan Harian
                        </h5>

                    </div>

                    <div class="card-body p-0">

                        <div class="table-responsive">

                            <table class="table align-middle mb-0">

                                <thead class="table-light">
                                    <tr>
                                        <th>Kegiatan</th>
                                        <th>Sangat Baik</th>
                                        <th>Baik</th>
                                        <th>Cukup</th>
                                        <th>Pendampingan</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($rekapKegiatan as $nama => $nilai)

                                    <tr>

                                        <td class="fw-semibold">
                                            {{ $nama }}
                                        </td>

                                        <td>
                                            {{ $nilai['Sangat Baik'] }}
                                        </td>

                                        <td>
                                            {{ $nilai['Baik'] }}
                                        </td>

                                        <td>
                                            {{ $nilai['Cukup'] }}
                                        </td>

                                        <td>
                                            {{ $nilai['Perlu Pendampingan'] }}
                                        </td>

                                    </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

                {{-- RIWAYAT --}}
                <div class="card border-0 shadow-sm rounded-4" id="riwayatPenitipan">

                    <div class="card-header bg-white border-0 pt-4">

                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                            <div>

                                <h5 class="fw-bold mb-1">
                                    Riwayat Penitipan Anak
                                </h5>

                                <p class="text-muted small mb-0">
                                    Riwayat kehadiran dan evaluasi harian anak
                                </p>

                            </div>

                            <span class="badge bg-success">

                                {{ $anak->peserta->count() }} Riwayat

                            </span>

                        </div>

                        {{-- FILTER --}}
                        <div class="row mt-4 g-3">

                            <div class="col-md-6">

                                <select class="form-select rounded-3"
                                    id="filterKehadiran">

                                    <option value="">
                                        Semua Status Kehadiran
                                    </option>

                                    <option value="hadir">
                                        Hadir
                                    </option>

                                    <option value="tidak hadir">
                                        Tidak Hadir
                                    </option>

                                </select>

                            </div>

                            <div class="col-md-6">

                                <select class="form-select rounded-3"
                                    id="filterPenilaian">

                                    <option value="">
                                        Semua Penilaian
                                    </option>

                                    <option value="sudah dinilai">
                                        Sudah Dinilai
                                    </option>

                                    <option value="belum dinilai">
                                        Belum Dinilai
                                    </option>

                                </select>

                            </div>

                        </div>

                    </div>

                    <div class="card-body p-0">

                        <ul class="list-group list-group-flush"
                            id="riwayatList">

                            @forelse ($anak->peserta->sortByDesc('created_at') as $item)

                            @php
                            $statusKehadiran = $item->waktu_masuk ? 'hadir' : 'tidak hadir';
                            $statusPenilaian = $item->laporan ? 'sudah dinilai' : 'belum dinilai';
                            @endphp

                            <li class="list-group-item py-3 riwayat-item"
                                data-kehadiran="{{ $statusKehadiran }}"
                                data-penilaian="{{ $statusPenilaian }}">

                                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                                    {{-- INFO --}}
                                    <div>

                                        <h6 class="fw-semibold mb-1">

                                            {{ \Carbon\Carbon::parse($item->jadwal->tanggal)->translatedFormat('l, d F Y') }}

                                        </h6>

                                        <div class="small text-muted d-flex flex-column gap-1">

                                            <div>

                                                <i class="ti ti-clock-play"></i>

                                                Check In:
                                                <span class="fw-medium">

                                                    {{ $item->waktu_masuk
                                        ? \Carbon\Carbon::parse($item->waktu_masuk)->format('H:i')
                                        : '-' }}

                                                </span>

                                            </div>

                                            <div>

                                                <i class="ti ti-clock-stop"></i>

                                                Check Out:
                                                <span class="fw-medium">

                                                    {{ $item->waktu_keluar
                                        ? \Carbon\Carbon::parse($item->waktu_keluar)->format('H:i')
                                        : '-' }}

                                                </span>

                                            </div>

                                            <div>

                                                <i class="ti ti-calendar-check"></i>

                                                Status:
                                                <span class="badge bg-{{ $item->waktu_masuk ? 'success' : 'light text-dark' }}">

                                                    {{ $item->status == true ? 'Hadir' : 'Tidak Hadir' }}

                                                </span>

                                            </div>

                                        </div>

                                    </div>

                                    {{-- ACTION --}}
                                    <div class="d-flex gap-2">

                                        @if ($item->laporan->count())

                                        <a href=""
                                            class="btn btn-success btn-sm rounded-pill px-3">

                                            <i class="ti ti-file-description me-1"></i>
                                            Hasil Evaluasi

                                        </a>

                                        @else

                                        <button class="btn btn-light btn-sm rounded-pill px-3 text-muted"
                                            disabled>

                                            <i class="ti ti-file-off me-1"></i>
                                            Belum Ada Penilaian

                                        </button>

                                        @endif

                                    </div>

                                </div>

                            </li>

                            @empty

                            <li class="list-group-item text-center py-5">

                                <div class="text-muted">

                                    <i class="ti ti-calendar-off fs-1 d-block mb-2"></i>

                                    Belum ada riwayat penitipan

                                </div>

                            </li>

                            @endforelse

                            {{-- EMPTY FILTER --}}
                            <li class="list-group-item text-center py-5 d-none"
                                id="emptyRiwayat">

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
    $('#filterKehadiran, #filterPenilaian').on('change', function() {

        let kehadiran = $('#filterKehadiran').val();
        let penilaian = $('#filterPenilaian').val();

        let visible = 0;

        $('.riwayat-item').each(function() {

            let dataKehadiran = $(this).data('kehadiran');
            let dataPenilaian = $(this).data('penilaian');

            let matchKehadiran = !kehadiran || dataKehadiran == kehadiran;

            let matchPenilaian = !penilaian || dataPenilaian == penilaian;

            if (matchKehadiran && matchPenilaian) {

                $(this).show();
                visible++;

            } else {

                $(this).hide();

            }

        });

        if (visible == 0) {

            $('#emptyRiwayat').removeClass('d-none');

        } else {

            $('#emptyRiwayat').addClass('d-none');

        }

    });
</script>
@endsection
@endsection