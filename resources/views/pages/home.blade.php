@extends('pages.app')

@section('content')
<div class="pc-container">
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Selamat Datang, Kak Users</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-md-8 col-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-success">
                            <div class="card-body p-4">

                                @if (!$anak)

                                <!-- JIKA BELUM ADA DATA ANAK -->
                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-4">
                                    <div>

                                        <h2 class="text-white fw-bold mb-4">
                                            Data Anak Belum Tersedia
                                        </h2>

                                        <p class="text-white opacity-75 mb-4"
                                            style="max-width:500px;">
                                            Silakan lengkapi data anak terlebih dahulu
                                            untuk dapat melakukan penitipan dan monitoring daycare.
                                        </p>

                                        <a href="#" class="btn btn-light rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahAnak">
                                            <i class="ti ti-plus me-1"></i>
                                            Input Data Anak
                                        </a>
                                    </div>
                                </div>

                                @else

                                <!-- JIKA ADA DATA ANAK -->
                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-4">
                                    <div class="d-flex align-items-center">
                                        <div class="me-4">
                                            @if ($anak->foto)
                                            <img src="{{ asset('storage/' . $anak->foto) }}"
                                                class="rounded-circle border border-4 border-white shadow"
                                                width="110"
                                                height="110"
                                                style="object-fit:cover;">
                                            @else

                                            <div class="bg-white bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center shadow"
                                                style="width:110px;height:110px;">
                                                <i class="ti ti-user text-white"
                                                    style="font-size:50px;"></i>
                                            </div>
                                            @endif
                                        </div>

                                        <div>
                                            <div class="mb-2">
                                                <span class="badge bg-white text-success rounded-pill px-3 py-2">
                                                    {{ $kategoriAnak }}
                                                </span>
                                            </div>

                                            <h2 class="text-white fw-bold mb-1">
                                                {{ $anak->nama }}
                                            </h2>

                                            <p class="text-white opacity-75 mb-2">
                                                {{ \Carbon\Carbon::parse($anak->tanggal_lahir)->diff(now())->y }}
                                                Tahun

                                                {{ \Carbon\Carbon::parse($anak->tanggal_lahir)->diff(now())->m }}
                                                Bulan
                                            </p>

                                            <div class="d-flex flex-wrap gap-2">
                                                <span class="badge bg-light text-success rounded-pill px-3 py-2">
                                                    <i class="ti ti-heart me-1"></i>
                                                    {{ $anak->golongan_darah ?? '-' }}
                                                </span>

                                                <span class="badge bg-light text-success rounded-pill px-3 py-2">
                                                    <i class="ti ti-scale me-1"></i>
                                                    {{ $anak->skrining->berat_badan ?? '-' }} Kg
                                                </span>

                                                <span class="badge bg-light text-success rounded-pill px-3 py-2">
                                                    <i class="ti ti-ruler me-1"></i>
                                                    {{ $anak->skrining->tinggi_badan ?? '-' }} Cm
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        @if ($anak)
                                        @if ($anak->paket_id)
                                        <a href="#" class="btn btn-light btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#modalQr">
                                            <i class="ti ti-qrcode"></i>
                                            QRCode
                                        </a>
                                        @endif
                                        <a href="{{ route('anak.detail', $anak->id) }}" class="btn btn-light btn-sm rounded-pill px-3">
                                            <i class="ti ti-eye me-1"></i>
                                            Detail
                                        </a>
                                        @if (!$anak->paketReguler)
                                        <a href="{{ route('anak.edit', $anak->id) }}" class="btn btn-light btn-sm rounded-pill px-3">
                                            <i class="ti ti-edit me-1"></i>
                                            Edit
                                        </a>
                                        @endif
                                        @endif

                                        <div class="modal fade" id="modalQr" tabindex="-1">

                                            <div class="modal-dialog modal-dialog-centered">

                                                <div class="modal-content border-0 rounded-4">

                                                    <div class="modal-header border-0">

                                                        <h5 class="modal-title fw-bold">
                                                            QR Code Anak
                                                        </h5>

                                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                        </button>

                                                    </div>

                                                    <div class="modal-body text-center pb-4">

                                                        <div class="mb-3">

                                                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data={{ Carbon\Carbon::now()->format('YmdHis') }}{{ $anak->kode }}"
                                                                class="img-fluid rounded-4">

                                                        </div>

                                                        <h6 class="fw-semibold mb-1">
                                                            {{ $anak->nama }} ({{ $anak->kode }})
                                                        </h6>

                                                        <small class="text-muted">
                                                            Scan QR untuk absensi penitipan
                                                        </small>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        @if ($anak && $anak->paket_id != 1)
                        <div class="card border-0 shadow-sm rounded-4">

                            <div class="card-body">

                                <!-- HEADER -->
                                <div class="d-flex justify-content-between align-items-center mb-4">

                                    <div>

                                        <h5 class="mb-1">
                                            Jadwal Penitipan
                                        </h5>

                                        <small class="text-muted">

                                            Jadwal untuk besok

                                        </small>

                                    </div>

                                    <span class="badge bg-light-primary text-primary px-3 py-2">

                                        Besok

                                    </span>

                                </div>

                                <!-- JIKA TIDAK ADA JADWAL -->
                                @if ($jadwal->isEmpty())

                                <div class="text-center py-5">

                                    <div class="mb-3">

                                        <i class="ti ti-calendar-off text-muted"
                                            style="font-size:60px;"></i>

                                    </div>

                                    <h6 class="fw-bold">
                                        Belum Ada Jadwal
                                    </h6>

                                    <small class="text-muted">

                                        Jadwal penitipan minggu ini
                                        belum tersedia

                                    </small>

                                </div>

                                @endif

                                <!-- LOOP JADWAL -->
                                @foreach ($jadwal as $item)

                                @php

                                $terisi = $item->peserta->count() ?? 0;

                                $persen =
                                $item->kuota > 0
                                ? ($terisi / $item->kuota) * 100
                                : 0;

                                $sisa = $item->kuota - $terisi;

                                $jadwalDateTime = \Carbon\Carbon::parse($item->tanggal)
                                ->setTime(8, 0);

                                $bisaBatal = now()->lt($jadwalDateTime);
                                $batasDaftar = \Carbon\Carbon::parse($item->tanggal)
                                ->subDay()
                                ->setTime(23, 59, 59);

                                $bisaDaftar = now()->lte($batasDaftar);

                                @endphp

                                <div class="border rounded-4 p-3 mb-3">

                                    <!-- TOP -->
                                    <div class="d-flex justify-content-between align-items-center mb-2">

                                        <div>

                                            <h6 class="mb-0 fw-semibold">

                                                {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l') }}

                                            </h6>

                                            <small class="text-muted">

                                                {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}

                                            </small>

                                        </div>

                                        <div class="text-end">

                                            <span class="fw-semibold text-success">

                                                {{ $item->peserta->count() }} / {{ $item->kuota }}

                                            </span>

                                            <br>

                                            <small class="text-muted">

                                                Kuota

                                            </small>

                                        </div>

                                    </div>

                                    <!-- BOTTOM -->
                                    <div class="d-flex align-items-center gap-3">

                                        <!-- PROGRESS -->
                                        <div class="flex-grow-1">

                                            <div class="progress"
                                                style="height:8px;">

                                                <div class="progress-bar bg-success"
                                                    style="width: '{{ $persen }}%;'">
                                                </div>

                                            </div>

                                        </div>

                                        <!-- BUTTON -->
                                        <div class="flex-shrink-0">
                                            @if (($anak && $sisa > 0 && $bisaDaftar && !$anak->paket_id) && !$item->peserta->contains('anak_id', $anak->id))

                                            <button class="btn btn-success btn-sm rounded-pill px-3"
                                                onclick="daftarJadwal('{{ $item->id }}')">

                                                <i class="ti ti-check"></i>
                                                Daftar

                                            </button>

                                            @elseif ($anak && $item->peserta->contains('anak_id', $anak->id) && $bisaBatal)
                                            <button class="btn btn-danger btn-sm rounded-pill px-3"
                                                onclick="batalJadwal('{{ $item->id }}')">

                                                <i class="ti ti-x"></i>
                                                Batal

                                            </button>
                                            @elseif ($item->peserta->count() == $item->kuota)

                                            <button class="btn btn-light btn-sm rounded-pill px-3 text-muted"
                                                disabled>

                                                Penuh

                                            </button>

                                            @endif

                                        </div>

                                    </div>

                                </div>

                                @endforeach

                            </div>

                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                            <div class="card-body p-4">

                                <div class="d-flex align-items-start justify-content-between flex-wrap gap-4">

                                    {{-- CONTENT --}}
                                    <div>

                                        <div class="bg-light-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                            style="width:70px;height:70px;">

                                            <i class="ti ti-calendar-plus text-success"
                                                style="font-size:34px;"></i>

                                        </div>

                                        <h4 class="fw-bold mb-2">
                                            Pendaftaran Penitipan Anak
                                        </h4>

                                        <p class="text-muted mb-4"
                                            style="max-width:700px; line-height:1.7;">

                                            Seluruh orang tua yang telah melakukan pendataan anak
                                            wajib mengikuti proses pendaftaran penitipan reguler
                                            sebelum dapat menggunakan layanan daycare.

                                        </p>

                                        @if ($anak)
                                        @if (!$anak->paketReguler && $total->sisa != 0)
                                        <button type="button"
                                            class="btn btn-success rounded-pill px-4 shadow-sm"
                                            onclick="pilihPaket('{{ $anak->id }}')">

                                            <i class="ti ti-arrow-right me-1"></i>
                                            Daftar Penitipan

                                        </button>

                                        @elseif (!$anak->paketReguler && $total->sisa == 0)
                                        <button type="button" class="btn btn-danger rounded-pill px-4 shadow-sm" disabled>
                                            <i class="ti ti-alert-circle me-1"></i>
                                            Kuota Penuh
                                        </button>
                                        @else

                                        <div class="mt-4">

                                            <div class="d-flex flex-column gap-4">

                                                {{-- STEP 1 --}}
                                                <div class="d-flex align-items-start">

                                                    <div class="me-3">

                                                        <div class="rounded-circle d-flex align-items-center justify-content-center
                                    {{ $anak && $anak->paketReguler->status ? 'bg-success text-white' : 'bg-light text-muted' }}"
                                                            style="width:45px;height:45px;">

                                                            <i class="ti ti-check"></i>

                                                        </div>

                                                    </div>

                                                    <div>

                                                        <h6 class="fw-bold mb-1">
                                                            Verifikasi Administrasi
                                                        </h6>

                                                        <p class="text-muted mb-0 small">

                                                            Data anak dan dokumen sedang diverifikasi oleh admin daycare

                                                        </p>

                                                    </div>

                                                </div>

                                                {{-- STEP 2 --}}
                                                <div class="d-flex align-items-start">

                                                    <div class="me-3">

                                                        <div class="rounded-circle d-flex align-items-center justify-content-center
                                    {{ $anak && $anak->paketReguler->tanggal_wawancara ? 'bg-warning text-white' : 'bg-light text-muted' }}"
                                                            style="width:45px;height:45px;">

                                                            <i class="ti ti-users"></i>

                                                        </div>

                                                    </div>

                                                    <div>

                                                        <h6 class="fw-bold mb-1">
                                                            Wawancara Orang Tua
                                                        </h6>

                                                        <p class="text-muted mb-1 small">

                                                            @if ($anak && $anak->paketReguler->tanggal_wawancara)

                                                            Jadwal wawancara:
                                                            <span class="fw-semibold text-dark">

                                                                {{ \Carbon\Carbon::parse($anak->paketReguler->tanggal_wawancara)->translatedFormat('d F Y') }}

                                                            </span>

                                                            @else

                                                            Menunggu jadwal wawancara

                                                            @endif

                                                        </p>

                                                    </div>

                                                </div>

                                                {{-- STEP 3 --}}
                                                <div class="d-flex align-items-start">

                                                    <div class="me-3">

                                                        @php

                                                        $status = $anak && $anak->paketReguler->status;

                                                        $bg = 'bg-light text-muted';
                                                        $icon = 'ti ti-clock';

                                                        if ($status == 'lolos') {
                                                        $bg = 'bg-success text-white';
                                                        $icon = 'ti ti-check';
                                                        }

                                                        if ($status == 'ditolak') {
                                                        $bg = 'bg-warning text-white';
                                                        $icon = 'ti ti-alert-circle';
                                                        }

                                                        if ($status == 'tms') {
                                                        $bg = 'bg-danger text-white';
                                                        $icon = 'ti ti-x';
                                                        }

                                                        @endphp

                                                        <div class="rounded-circle d-flex align-items-center justify-content-center {{ $bg }}"
                                                            style="width:45px;height:45px;">

                                                            <i class="{{ $icon }}"></i>

                                                        </div>

                                                    </div>

                                                    <div>

                                                        <h6 class="fw-bold mb-1">
                                                            Hasil Pendaftaran
                                                        </h6>

                                                        <p class="mb-2 small">

                                                            @if ($status == 'pending')

                                                            <span class="text-muted">

                                                                Proses seleksi sedang berlangsung

                                                            </span>

                                                            @elseif ($status == 'lolos')

                                                            <span class="text-success fw-semibold">

                                                                Selamat, anak dinyatakan lolos penitipan reguler

                                                            </span>

                                                            @elseif ($status == 'ditolak')

                                                            <span class="text-warning fw-semibold">

                                                                Pendaftaran reguler ditolak.
                                                                Masih dapat menggunakan penitipan harian.

                                                            </span>

                                                            @elseif ($status == 'tms')

                                                            <span class="text-danger fw-semibold">

                                                                Tidak memenuhi syarat penitipan daycare.

                                                            </span>

                                                            @endif

                                                        </p>

                                                        {{-- HARIAN --}}
                                                        @if ($status == 'ditolak')

                                                        <button type="button"
                                                            class="btn btn-light rounded-pill px-4 shadow-sm"
                                                            onclick="konfirmasiPenitipanHarian('{{ $anak->id }}')">

                                                            <i class="ti ti-clock-hour-4 me-1"></i>
                                                            Daftar Penitipan Harian

                                                        </button>

                                                        @endif

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        @endif
                                        @endif

                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal Konfirmasi -->
            <div class="modal fade" id="modalTambahAnak">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content border-0 rounded-4 shadow">
                        <!-- HEADER -->
                        <div class="modal-header border-0 pb-0">
                            <div>
                                <h4 class="modal-title fw-bold mb-1">
                                    Tambah Data Anak
                                </h4>

                                <p class="text-muted small mb-0">
                                    Lengkapi data anak untuk penitipan
                                </p>
                            </div>

                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- BODY -->
                        <div class="modal-body pt-4">

                            <form id="formTambahAnak"
                                method="POST"
                                action="{{ route('anak.store') }}"
                                enctype="multipart/form-data">

                                @csrf

                                <div class="row g-4">

                                    <!-- ========================= -->
                                    <!-- DATA ANAK -->
                                    <!-- ========================= -->

                                    <div class="col-12">

                                        <div class="border-bottom pb-2 mb-2">

                                            <h5 class="fw-bold mb-1">
                                                Data Anak
                                            </h5>

                                            <small class="text-muted">
                                                Informasi dasar anak
                                            </small>

                                        </div>

                                    </div>

                                    <!-- FOTO -->
                                    <div class="col-md-12 text-center">

                                        <div class="mb-2">

                                            <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center overflow-hidden shadow-sm"
                                                style="width:120px;height:120px;">

                                                <img id="previewFoto"
                                                    src="https://ui-avatars.com/api/?name=Anak&background=E9ECEF&color=6C757D"
                                                    class="w-100 h-100 object-fit-cover">

                                            </div>

                                        </div>

                                        <input type="file"
                                            class="form-control"
                                            name="foto"
                                            accept="image/*"
                                            id="fotoInput">

                                    </div>

                                    <!-- NAMA -->
                                    <div class="col-md-12">

                                        <label class="form-label fw-semibold">
                                            Nama Anak
                                        </label>

                                        <input type="text"
                                            class="form-control"
                                            name="nama"
                                            placeholder="Masukkan nama anak"
                                            required>

                                    </div>

                                    <!-- TEMPAT LAHIR -->
                                    <div class="col-md-6">

                                        <label class="form-label fw-semibold">
                                            Tempat Lahir
                                        </label>

                                        <input type="text"
                                            class="form-control"
                                            name="tempat_lahir"
                                            placeholder="Contoh: Jakarta"
                                            required>

                                    </div>

                                    <!-- TANGGAL LAHIR -->
                                    <div class="col-md-6">

                                        <label class="form-label fw-semibold">
                                            Tanggal Lahir
                                        </label>

                                        <input type="date"
                                            class="form-control"
                                            name="tanggal_lahir"
                                            required>

                                    </div>

                                    <!-- JK -->
                                    <div class="col-md-6">

                                        <label class="form-label fw-semibold">
                                            Jenis Kelamin
                                        </label>

                                        <select class="form-select"
                                            name="jenis_kelamin"
                                            required>

                                            <option value="">
                                                Pilih Jenis Kelamin
                                            </option>

                                            <option value="L">
                                                Laki-laki
                                            </option>

                                            <option value="P">
                                                Perempuan
                                            </option>

                                        </select>

                                    </div>

                                    <!-- GOLDAR -->
                                    <div class="col-md-6">

                                        <label class="form-label fw-semibold">
                                            Golongan Darah
                                        </label>

                                        <select class="form-select"
                                            name="golongan_darah">

                                            <option value="">
                                                Pilih Golongan Darah
                                            </option>

                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="AB">AB</option>
                                            <option value="O">O</option>

                                        </select>

                                    </div>

                                    <!-- ========================= -->
                                    <!-- SKRINING -->
                                    <!-- ========================= -->

                                    <div class="col-12 mt-3">

                                        <div class="border-bottom pb-2 mb-2">

                                            <h5 class="fw-bold mb-1">
                                                Skrining Kesehatan Anak
                                            </h5>

                                            <small class="text-muted">
                                                Data kesehatan dan kondisi khusus anak
                                            </small>

                                        </div>

                                    </div>

                                    <!-- BERAT BADAN -->
                                    <div class="col-md-6">

                                        <label class="form-label fw-semibold">
                                            Berat Badan (Kg)
                                        </label>

                                        <input type="number"
                                            step="0.1"
                                            class="form-control"
                                            name="berat_badan"
                                            placeholder="Contoh: 15.5">

                                    </div>

                                    <!-- TINGGI BADAN -->
                                    <div class="col-md-6">

                                        <label class="form-label fw-semibold">
                                            Tinggi Badan (Cm)
                                        </label>

                                        <input type="number"
                                            step="0.1"
                                            class="form-control"
                                            name="tinggi_badan"
                                            placeholder="Contoh: 98">

                                    </div>

                                    <!-- ALERGI -->
                                    <div class="col-md-6">

                                        <label class="form-label fw-semibold">
                                            Alergi
                                        </label>

                                        <textarea class="form-control"
                                            name="alergi"
                                            rows="3"
                                            placeholder="Contoh: susu, seafood"></textarea>

                                    </div>

                                    <!-- RIWAYAT PENYAKIT -->
                                    <div class="col-md-6">

                                        <label class="form-label fw-semibold">
                                            Riwayat Penyakit
                                        </label>

                                        <textarea class="form-control"
                                            name="riwayat_penyakit"
                                            rows="3"
                                            placeholder="Contoh: asma, kejang"></textarea>

                                    </div>

                                    <!-- KEBUTUHAN KHUSUS -->
                                    <div class="col-md-6">

                                        <label class="form-label fw-semibold">
                                            Kebutuhan Khusus
                                        </label>

                                        <textarea class="form-control"
                                            name="kebutuhan_khusus"
                                            rows="3"
                                            placeholder="Contoh: speech delay"></textarea>

                                    </div>

                                    <!-- KONSUMSI OBAT -->
                                    <div class="col-md-6">

                                        <label class="form-label fw-semibold">
                                            Konsumsi Obat
                                        </label>

                                        <textarea class="form-control"
                                            name="konsumsi_obat"
                                            rows="3"
                                            placeholder="Contoh: obat asma"></textarea>

                                    </div>

                                    <!-- RIWAYAT RAWAT INAP -->
                                    <div class="col-md-6">

                                        <label class="form-label fw-semibold">
                                            Riwayat Rawat Inap
                                        </label>

                                        <textarea class="form-control"
                                            name="riwayat_rawat_inap"
                                            rows="3"
                                            placeholder="Opsional"></textarea>

                                    </div>

                                    <!-- IMUNISASI -->
                                    <div class="col-md-6">

                                        <label class="form-label fw-semibold">
                                            Imunisasi Dasar
                                        </label>

                                        <select class="form-select"
                                            name="imunisasi_dasar">

                                            <option value="">
                                                Pilih Status
                                            </option>

                                            <option value="true">
                                                Sudah
                                            </option>

                                            <option value="false">
                                                Belum
                                            </option>

                                        </select>

                                    </div>

                                    <!-- CATATAN -->
                                    <div class="col-md-12">

                                        <label class="form-label fw-semibold">
                                            Catatan Orang Tua
                                        </label>

                                        <textarea class="form-control"
                                            name="catatan_orang_tua"
                                            rows="4"
                                            placeholder="Tambahkan catatan penting lainnya"></textarea>

                                    </div>

                                </div>

                            </form>

                        </div>

                        <!-- FOOTER -->
                        <div class="modal-footer border-0 pt-0 pb-4 justify-content-end">
                            <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">
                                Batal
                            </button>

                            <button type="submit" id="btnSimpanAnak" class="btn btn-success rounded-pill px-4">
                                <i class="bi bi-check-circle me-1"></i>
                                Simpan Data
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('js')
<script>
    document.getElementById('btnSimpanAnak')
        .addEventListener('click', function() {

            const form = document.getElementById('formTambahAnak');

            // VALIDASI
            if (!form.checkValidity()) {

                form.reportValidity();

                return;

            }

            Swal.fire({

                title: 'Simpan Data Anak?',

                text: 'Pastikan data anak sudah benar',

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

                buttonsStyling: false,

                // AGAR MUNCUL DI ATAS MODAL
                backdrop: `
            rgba(0,0,0,0.5)
        `,

                didOpen: () => {

                    document.querySelector('.swal2-container')
                        .style.zIndex = '2000';

                }

            }).then((result) => {

                if (result.isConfirmed) {

                    Swal.fire({
                        title: 'Proses...',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        background: '#ffffff',
                        didOpen: () => {
                            Swal.showLoading();
                        },
                        customClass: {
                            popup: 'rounded-4'
                        },
                    });

                    // SUBMIT FORM
                    form.requestSubmit();

                }

            });

        });
</script>

<script>
    function pilihPaket(id) {

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

                width: '700px',

                background: '#fff',

                showCloseButton: true,

                showCancelButton: true,

                confirmButtonText: `
                <i class="ti ti-check me-1"></i>
                Daftar Paket
            `,

                cancelButtonText: 'Batal',

                buttonsStyling: false,

                customClass: {

                    popup: 'rounded-4 border-0 shadow',
                    title: 'fw-bold fs-4',
                    confirmButton: 'btn btn-success rounded-pill px-4',
                    cancelButton: 'btn btn-light rounded-pill px-4 me-2'

                },

                title: 'Konfirmasi Skrining Anak',

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

                    <div class="alert alert-warning rounded-4 mt-4 mb-0">

                        <i class="ti ti-alert-circle me-1"></i>

                        Pastikan seluruh data skrining sudah benar.
                        Data ini akan digunakan admin untuk verifikasi
                        pendaftaran paket reguler.

                    </div>

                </div>

            `

            }).then((result) => {

                if (result.isConfirmed) {

                    Swal.fire({
                        title: 'Proses...',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        background: '#ffffff',
                        didOpen: () => {
                            Swal.showLoading();
                        },
                        customClass: {
                            popup: 'rounded-4'
                        },
                    });


                    window.location.href =
                        `/paket/reguler/${id}`;

                }

            });

        });

    }
</script>

<script>
    $('#fotoInput').on('change', function(e) {

        const file = e.target.files[0];

        if (file) {

            $('#previewFoto').attr(
                'src',
                URL.createObjectURL(file)
            );

        }

    });
</script>

<script>
    function daftarJadwal(id) {

        Swal.fire({

            width: '420px',

            background: '#fff',

            showCloseButton: true,

            showCancelButton: true,

            showConfirmButton: true,

            confirmButtonText: `
            <i class="ti ti-check me-1"></i>
            Ya, Daftar
        `,

            cancelButtonText: 'Batal',

            buttonsStyling: false,

            customClass: {

                popup: 'rounded-4 border-0 shadow',
                confirmButton: 'btn btn-success rounded-pill px-4',
                cancelButton: 'btn btn-light rounded-pill px-4 me-2'

            },

            title: 'Daftar Jadwal?',

            html: `

            <div class="text-center py-2">

                <div class="mb-4">

                    <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center"
                        style="width:80px;height:80px;">

                        <i class="ti ti-calendar-event text-success"
                            style="font-size:35px;">
                        </i>

                    </div>

                </div>

                <p class="text-muted mb-0">

                    Anak akan didaftarkan
                    pada jadwal penitipan ini

                </p>

            </div>

        `

        }).then((result) => {

            if (result.isConfirmed) {

                Swal.fire({

                    title: 'Mendaftarkan...',

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

                setTimeout(() => {

                    window.location.href =
                        `/jadwal/daftar/${id}`;

                }, 500);

            }

        });

    }
</script>

<script>
    function batalJadwal(id) {

        Swal.fire({

            width: '420px',

            background: '#fff',

            showCloseButton: true,

            showCancelButton: true,

            showConfirmButton: true,

            confirmButtonText: `
            <i class="ti ti-check me-1"></i>
            Ya, Batalkan
        `,

            cancelButtonText: 'Tutup',

            buttonsStyling: false,

            customClass: {

                popup: 'rounded-4 border-0 shadow',
                confirmButton: 'btn btn-danger rounded-pill px-4',
                cancelButton: 'btn btn-light rounded-pill px-4 me-2'

            },

            title: 'Batalkan Jadwal?',

            html: `

            <div class="text-center py-2">

                <div class="mb-4">

                    <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center"
                        style="width:80px;height:80px;">

                        <i class="ti ti-calendar-x text-danger"
                            style="font-size:35px;">
                        </i>

                    </div>

                </div>

                <p class="text-muted mb-0">

                    Jadwal penitipan akan dibatalkan

                </p>

            </div>

        `

        }).then((result) => {

            if (result.isConfirmed) {

                Swal.fire({

                    title: 'Membatalkan Jadwal...',

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

                setTimeout(() => {

                    window.location.href =
                        `/jadwal/batal/${id}`;

                }, 500);

            }

        });

    }
</script>
<script>
    function konfirmasiPenitipanHarian() {

        Swal.fire({

            title: 'Penitipan Harian',
            text: 'Anda akan diarahkan ke halaman jadwal penitipan harian',
            icon: 'question',

            showCancelButton: true,

            confirmButtonText: 'Lanjutkan',
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

                window.location.href =
                    "{{ route('jadwal.daftar', 'harian') }}";

            }

        });

    }
</script>

<script>
    function daftarHarian() {
        let anakId = '{{ Auth::user()->anak->id ?? 0 }}'

        Swal.fire({

            title: 'Penitipan Harian',
            text: 'Daftar penitipan harian',
            icon: 'question',

            showCancelButton: true,

            confirmButtonText: 'Lanjutkan',
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

                Swal.fire({
                    title: 'Proses...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                window.location.href =
                    "{{ url('/paket/harian') }}/" + anakId;

            }

        });

    }
</script>
@endsection
@endsection