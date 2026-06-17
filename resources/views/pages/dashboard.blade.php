@extends('pages.app')

@section('content')
<div class="pc-container">
    <div class="pc-content">

        {{-- HEADER --}}
        <div class="page-header mb-4">

            <div class="page-block">

                <div class="row align-items-center">

                    <div class="col-md-8">

                        <h3 class="fw-bold mb-1">
                            Dashboard Daycare
                        </h3>

                        <p class="text-muted mb-0">
                            Monitoring aktivitas, kehadiran, dan perkembangan anak
                        </p>

                    </div>

                    <div class="col-md-4 text-md-end mt-3 mt-md-0">

                        <span class="badge bg-light-success text-success px-4 py-2 rounded-pill">

                            <i class="ti ti-calendar me-1"></i>

                            {{ now()->translatedFormat('l, d F Y') }}

                        </span>

                    </div>

                </div>

            </div>

        </div>

        {{-- SUMMARY CARD --}}
        <div class="row">

            <div class="col-xl-3 col-md-6 mb-4">

                <div class="card border-0 shadow-sm rounded-4 h-100">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <small class="text-muted d-block mb-2">
                                    Total Anak
                                </small>

                                <h2 class="fw-bold mb-0">
                                    {{ $total->anak ?? 0 }}
                                </h2>

                            </div>

                            <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                style="width:60px;height:60px;">

                                <i class="ti ti-users text-success fs-3"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-xl-3 col-md-6 mb-4">

                <div class="card border-0 shadow-sm rounded-4 h-100">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <small class="text-muted d-block mb-2">
                                    Total Peserta Reguler
                                </small>

                                <h2 class="fw-bold mb-0 text-success">
                                    {{ $total->reguler ?? 0 }}
                                </h2>

                            </div>

                            <div class="bg-light-success rounded-circle d-flex align-items-center justify-content-center"
                                style="width:60px;height:60px;">

                                <i class="ti ti-check text-success fs-3"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-xl-3 col-md-6 mb-4">

                <div class="card border-0 shadow-sm rounded-4 h-100">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <small class="text-muted d-block mb-2">
                                    Total Pengasuh
                                </small>

                                <h2 class="fw-bold mb-0 text-warning">
                                    {{ $total->pengasuh ?? 0 }}
                                </h2>

                            </div>

                            <div class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                style="width:60px;height:60px;">

                                <i class="ti ti-users text-warning fs-3"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-xl-3 col-md-6 mb-4">

                <div class="card border-0 shadow-sm rounded-4 h-100">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <small class="text-muted d-block mb-2">
                                    Total Penalti Aktif
                                </small>

                                <h2 class="fw-bold mb-0 text-danger">
                                    {{ $penaltiAktif ?? 0 }}
                                </h2>

                            </div>

                            <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                style="width:60px;height:60px;">

                                <i class="ti ti-alert-circle text-danger fs-3"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- CONTENT --}}
        <div class="row">

            {{-- LEFT --}}
            <div class="col-lg-8">

                <div id="chartKehadiran" class="card border-0 shadow-sm rounded-4 mb-4">

                    <div class="card-header bg-white border-0 pt-4">

                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                            <div>

                                <h5 class="fw-bold mb-1">
                                    Grafik Kehadiran Bulanan
                                </h5>

                                <p class="text-muted small mb-0">

                                    Statistik kehadiran peserta daycare

                                </p>

                            </div>

                            <span class="badge bg-light-success text-success px-3 py-2 rounded-pill">

                                {{ \Carbon\Carbon::create($tahun, $bulan)->translatedFormat('F Y') }}

                            </span>

                        </div>

                    </div>

                    <div class="card-body">

                        <form method="GET" action="{{ route('dashboard') }}#chartKehadiran">
                            @csrf
                            <div class="row align-items-end g-3">

                                <div class="col-md-4">

                                    <label class="form-label fw-semibold">
                                        Bulan
                                    </label>

                                    <select name="bulan"
                                        class="form-select rounded-4">

                                        @foreach(range(1,12) as $b)

                                        <option value="{{ $b }}"
                                            {{ request('bulan', now()->month) == $b ? 'selected' : '' }}>

                                            {{ \Carbon\Carbon::create()->month($b)->translatedFormat('F') }}

                                        </option>

                                        @endforeach

                                    </select>

                                </div>

                                <div class="col-md-4">

                                    <label class="form-label fw-semibold">
                                        Tahun
                                    </label>

                                    <select name="tahun"
                                        class="form-select rounded-4">

                                        @foreach(range(now()->year, now()->year - 5) as $t)

                                        <option value="{{ $t }}"
                                            {{ request('tahun', now()->year) == $t ? 'selected' : '' }}>

                                            {{ $t }}

                                        </option>

                                        @endforeach

                                    </select>

                                </div>

                                <div class="col-md-2">

                                    <button class="btn btn-success rounded-pill w-100">

                                        <i class="ti ti-filter me-1"></i>
                                        Filter

                                    </button>

                                </div>

                                <div class="col-md-2">

                                    <a href="{{ route('dashboard') }}#chartKehadiran"
                                        class="btn btn-light rounded-pill w-100 border">

                                        <i class="ti ti-refresh me-1"></i>
                                        Reset

                                    </a>

                                </div>

                            </div>

                        </form>

                    </div>

                    <div class="card-body">

                        <div id="chart-kehadiran" data-hadir='@json($grafikHadir)' data-tanggal='@json($grafikTanggal)'></div>

                    </div>

                </div>

            </div>

            {{-- RIGHT --}}
            <div class="col-lg-4">

                {{-- QUICK MENU --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">

                    <div class="card-header bg-white border-0 pt-4">

                        <h5 class="fw-bold mb-1">
                            Quick Menu
                        </h5>

                    </div>

                    <div class="card-body">

                        <div class="d-grid gap-3">

                            <a href="{{ route('jadwal') }}"
                                class="btn btn-light rounded-4 text-start p-3 border">

                                <i class="ti ti-calendar-event me-2 text-success"></i>
                                Jadwal Daycare

                            </a>

                            <a href=""
                                class="btn btn-light rounded-4 text-start p-3 border">

                                <i class="ti ti-scan me-2 text-primary"></i>
                                Absensi Kehadiran

                            </a>

                            <a href=""
                                class="btn btn-light rounded-4 text-start p-3 border">

                                <i class="ti ti-users me-2 text-warning"></i>
                                Data Anak

                            </a>

                            <a href=""
                                class="btn btn-light rounded-4 text-start p-3 border">

                                <i class="ti ti-notebook me-2 text-danger"></i>
                                Laporan Harian

                            </a>

                        </div>

                    </div>

                </div>

                {{-- MOOD ANAK --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">

                    <div class="card-header bg-white border-0 pt-4">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <h5 class="fw-bold mb-1">
                                    Ringkasan Mood Anak
                                </h5>

                                <p class="text-muted small mb-0">
                                    Mayoritas anak menunjukkan mood
                                    <b>{{ $moodAnak->first()?->nilai }}</b>
                                </p>

                            </div>

                            <span class="badge bg-light-success text-success">

                                {{ $totalMood }} Penilaian

                            </span>

                        </div>

                    </div>

                    <div class="card-body">

                        <div class="d-flex flex-column gap-4">

                            @foreach ($moodAnak as $mood)

                            @php
                            $persentase = $totalMood > 0
                            ? round(($mood->total / $totalMood) * 100)
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

                                <div class="progress rounded-pill"
                                    style="height:10px;">

                                    <div class="progress-bar bg-success rounded-pill"
                                        style="width: '{{ $persentase }}%'"></div>

                                </div>

                            </div>

                            @endforeach

                        </div>

                    </div>

                </div>

                {{-- KONDISI ANAK --}}
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

                                {{ $totalKondisi }} Penilaian

                            </span>

                        </div>

                    </div>

                    <div class="card-body">

                        {{-- KONDISI DOMINAN --}}
                        @if ($kondisiAnak->first())

                        <div class="bg-light rounded-4 p-3 mb-4">

                            <small class="text-muted d-block mb-1">
                                Kondisi Dominan
                            </small>

                            <h4 class="fw-bold mb-0 text-primary">

                                {{ $kondisiAnak->first()->nilai }}

                            </h4>

                        </div>

                        @endif

                        {{-- LIST KONDISI --}}
                        <div class="d-flex flex-column gap-4">

                            @foreach ($kondisiAnak as $kondisi)

                            @php
                            $persentase = $totalKondisi > 0
                            ? round(($kondisi->total / $totalKondisi) * 100)
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

                                <div class="progress rounded-pill"
                                    style="height:10px;">

                                    <div class="progress-bar bg-primary rounded-pill"
                                        style="width: '{{ $persentase }}%'"></div>

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

                                {{ $perkembanganAnak->count() }} Aspek

                            </span>

                        </div>

                    </div>

                    <div class="card-body">

                        <div class="d-flex flex-column gap-4">

                            @foreach ($perkembanganAnak as $item)

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
                                        style="width: '{{ $persentase }}%'">

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

        </div>

    </div>
</div>

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.49.1/apexcharts.min.js"></script>
<script>
    const chartElement = document.getElementById('chart-kehadiran');

    const grafikHadir = JSON.parse(
        chartElement.dataset.hadir
    );

    const grafikTanggal = JSON.parse(
        chartElement.dataset.tanggal
    );

    var options = {

        chart: {
            type: 'area',
            height: 350,
            toolbar: {
                show: false
            }
        },

        series: [{
            name: 'Jumlah Hadir',
            data: grafikHadir
        }],

        xaxis: {
            categories: grafikTanggal
        },

        stroke: {
            curve: 'smooth',
            width: 4
        },

        dataLabels: {
            enabled: false
        },

        colors: ['#16a34a'],

        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.35,
                opacityTo: 0.05,
                stops: [0, 90, 100]
            }
        },

        grid: {
            borderColor: '#f1f5f9'
        },

        tooltip: {
            y: {
                formatter: function(val) {
                    return val + ' Anak';
                }
            }
        },

        markers: {
            size: 5
        }

    };

    var chart = new ApexCharts(
        document.querySelector("#chart-kehadiran"),
        options
    );

    chart.render();
</script>
@endsection
@endsection