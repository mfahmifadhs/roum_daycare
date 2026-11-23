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

                            <div>
                                <small class="text-muted d-block">
                                    Laporan
                                </small>

                                <span class="fw-semibold">
                                    <a href="javascript:void(0)"
                                        class="text-decoration-none"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalLaporanBulanan">
                                        <i class="ti ti-calendar-month me-1"></i>
                                        Laporan Bulanan
                                    </a>
                                </span>
                            </div>



                        </div>

                    </div>

                </div>

                <div class="card border-0 shadow-sm rounded-4 mb-4">

                    <div class="card-header bg-white border-0 pt-4">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <h5 class="fw-bold mb-1">
                                    Ringkasan Mood Anak
                                </h5>

                                <p class="text-muted small mb-0">
                                    Mayoritas anak menunjukkan mood
                                    <b>{{ $rekap->moodAnak->first()?->nilai }}</b>
                                </p>

                            </div>

                            <span class="badge bg-light-success text-success">

                                {{ $rekap->totalMood }} Penilaian

                            </span>

                        </div>

                    </div>

                    <div class="card-body">

                        <div class="d-flex flex-column gap-4">

                            @foreach ($rekap->moodAnak as $mood)

                            @php
                            $persentase = $rekap->totalMood > 0
                            ? round(($mood->total / $rekap->totalMood) * 100)
                            : 0;
                            @endphp

                            <div>

                                <div class="d-flex justify-content-between align-items-center mb-2">

                                    <div class="fw-semibold">

                                        {{ $mood->nilai }}

                                    </div>

                                    <div class="small text-muted">

                                        {{ $mood->total }} Anak
                                        ({{ $persentase }}%)

                                    </div>

                                </div>

                                <div class="progress rounded-pill" style="height: 10px;">
                                    <div class="progress-bar bg-success rounded-pill"
                                        data-width="{{ $persentase }}">
                                    </div>
                                </div>

                            </div>

                            @endforeach

                        </div>

                    </div>

                </div>

                <div class="card border-0 shadow-sm rounded-4 mb-4">

                    <div class="card-header bg-white border-0 pt-4">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <h5 class="fw-bold mb-1">
                                    Ringkasan Kondisi Anak
                                </h5>

                                <p class="text-muted small mb-0">
                                    Kondisi kesehatan anak selama periode berjalan
                                </p>

                            </div>

                            <span class="badge bg-light-primary text-primary">

                                {{ $rekap->totalKondisi }} Penilaian

                            </span>

                        </div>

                    </div>

                    <div class="card-body">

                        {{-- KONDISI DOMINAN --}}
                        @if ($rekap->kondisiAnak->first())

                        <div class="bg-light rounded-4 p-3 mb-4">

                            <small class="text-muted d-block mb-1">
                                Kondisi Dominan
                            </small>

                            <h4 class="fw-bold mb-0 text-primary">

                                {{ $rekap->kondisiAnak->first()->nilai }}

                            </h4>

                        </div>

                        @endif

                        {{-- LIST KONDISI --}}
                        <div class="d-flex flex-column gap-4">

                            @foreach ($rekap->kondisiAnak as $kondisi)

                            @php
                            $persentase = $rekap->totalKondisi > 0
                            ? round(($kondisi->total / $rekap->totalKondisi) * 100)
                            : 0;
                            @endphp

                            <div>

                                <div class="d-flex justify-content-between align-items-center mb-2">

                                    <div class="fw-semibold">

                                        {{ $kondisi->nilai }}

                                    </div>

                                    <div class="small text-muted">

                                        {{ $kondisi->total }} Anak
                                        ({{ $persentase }}%)

                                    </div>

                                </div>

                                <div class="progress rounded-pill" style="height: 10px;">
                                    <div class="progress-bar bg-success rounded-pill"
                                        data-width="{{ $persentase }}">
                                    </div>
                                </div>

                            </div>

                            @endforeach

                        </div>

                    </div>

                </div>

                {{-- PERKEMBANGAN ANAK --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">

                    <div class="card-header bg-white border-0 pt-4">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <h5 class="fw-bold mb-1">
                                    Ringkasan Perkembangan Anak
                                </h5>

                                <p class="text-muted small mb-0">
                                    Hasil evaluasi perkembangan harian anak
                                </p>

                            </div>

                            <span class="badge bg-light-warning text-warning">

                                {{ $rekap->perkembanganAnak->count() }} Aspek

                            </span>

                        </div>

                    </div>

                    <div class="card-body">

                        <div class="d-flex flex-column gap-4">

                            @foreach ($rekap->perkembanganAnak as $item)

                            @php

                            if ($item->rata_nilai >= 2.5) {

                            $hasil = 'BSB';
                            $persentase = 100;

                            } elseif ($item->rata_nilai >= 1.5) {

                            $hasil = 'BSH';
                            $persentase = 75;

                            } else {

                            $hasil = 'MB';
                            $persentase = 45;

                            }

                            @endphp

                            <div>

                                <div class="d-flex justify-content-between align-items-center mb-2">

                                    <div>

                                        <div class="fw-semibold">

                                            {{ $item->kategori->deskripsi }}

                                        </div>

                                        <small class="text-muted">

                                            {{ $item->total }} Penilaian

                                        </small>

                                    </div>

                                    <span class="badge
                        @if($hasil == 'BSB')
                            bg-light-success text-success
                        @elseif($hasil == 'BSH')
                            bg-light-primary text-primary
                        @else
                            bg-light-warning text-warning
                        @endif">

                                        {{ $hasil }}

                                    </span>

                                </div>

                                <div class="progress rounded-pill"
                                    style="height:10px;">

                                    <div class="progress-bar
                        @if($hasil == 'BSB')
                            bg-success
                        @elseif($hasil == 'BSH')
                            bg-primary
                        @else
                            bg-warning
                        @endif"
                                        data-width="{{ $persentase }}">

                                    </div>

                                </div>

                            </div>

                            @endforeach

                        </div>

                        {{-- KETERANGAN --}}
                        <div class="mt-4 border-top pt-3">

                            <div class="d-flex flex-wrap gap-3 small text-muted">

                                <div>
                                    <span class="badge bg-warning me-1">MB</span>
                                    Mulai Berkembang
                                </div>

                                <div>
                                    <span class="badge bg-primary me-1">BSH</span>
                                    Berkembang Sesuai Harapan
                                </div>

                                <div>
                                    <span class="badge bg-success me-1">BSB</span>
                                    Berkembang Sangat Baik
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- RIGHT --}}
            <div class="col-lg-8">

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

                                @if (!$rekapKegiatan)
                                <tbody>
                                    <tr>
                                        <td colspan="5" class="text-center py-5">

                                            <div class="text-muted">

                                                <i class="ti ti-activity fs-1 d-block mb-2"></i>

                                                Belum ada data rekap kegiatan

                                            </div>

                                        </td>
                                    </tr>
                                </tbody>
                                @endif

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

                                            {{ $item->jadwal?->tanggal ? \Carbon\Carbon::parse($item->jadwal->tanggal)->translatedFormat('l, d F Y') : '-' }}

                                        </h6>

                                        <div class="small text-muted d-flex flex-column gap-1">

                                            <div>

                                                <i class="ti ti-clock-play"></i>

                                                Check In:
                                                <span class="fw-medium">

                                                    {{ $item->waktu_masuk ? \Carbon\Carbon::parse($item->waktu_masuk)->format('H:i') : '-' }}

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

                                        <a href="{{ route('laporan.detail', $item->laporan->first()->id) }}"
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


<div class="modal fade" id="modalLaporanBulanan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">

            <div class="modal-header border-0 pb-0">
                <div>
                    <h5 class="modal-title fw-bold">
                        <i class="ti ti-file-description text-success me-2"></i>
                        Laporan Bulanan
                    </h5>
                    <small class="text-muted">
                        Pilih periode laporan anak yang ingin dicetak.
                    </small>
                </div>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>
            </div>

            <div class="modal-body p-4">

                <form action="{{ route('laporan.bulanan', $anak->id) }}"
                    method="GET"
                    target="_blank">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Pilih Bulan
                        </label>

                        <select name="bulan" class="form-select rounded-3" required>
                            @foreach (range(1, 12) as $bulan)
                            <option value="{{ $bulan }}"
                                {{ $bulan == now()->month ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            Pilih Tahun
                        </label>

                        <select name="tahun" class="form-select rounded-3" required>
                            @for ($tahun = now()->year; $tahun >= now()->year - 5; $tahun--)
                            <option value="{{ $tahun }}"
                                {{ $tahun == now()->year ? 'selected' : '' }}>
                                {{ $tahun }}
                            </option>
                            @endfor
                        </select>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <button type="button"
                            class="btn btn-light rounded-pill px-4"
                            data-bs-dismiss="modal">
                            Batal
                        </button>

                        <button type="submit"
                            class="btn btn-success rounded-pill px-4">
                            <i class="ti ti-printer me-1"></i>
                            Cetak Laporan
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>



@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.49.1/apexcharts.min.js"></script>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.progress-bar[data-width]').forEach(function(bar) {
            let width = parseInt(bar.dataset.width, 10) || 0;

            width = Math.min(100, Math.max(0, width));

            bar.style.width = width + '%';
        });
    });
</script>
@endsection
@endsection