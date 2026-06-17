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
                            Penilaian Laporan Harian Anak
                        </h3>

                        <p class="text-muted mb-0">
                            Form evaluasi dan perkembangan harian peserta daycare
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

        <form method="POST"
            action="{{ route('laporan.store', $peserta->id) }}">

            @csrf

            <input type="hidden"
                name="jadwal_id"
                value="{{ $peserta->jadwal_id }}">

            <input type="hidden"
                name="anak_id"
                value="{{ $peserta->anak_id }}">

            <input type="hidden"
                name="pengasuh_id"
                value="{{ $peserta->jadwal->pengasuh_id }}">

            <div class="row">

                {{-- LEFT --}}
                <div class="col-lg-8">

                    {{-- DATA ANAK --}}
                    <div class="card border-0 shadow-sm rounded-4 mb-4">

                        <div class="card-body">

                            <div class="d-flex align-items-center">

                                {{-- FOTO --}}
                                <div class="flex-shrink-0">

                                    @if ($peserta->anak->foto)

                                    <img src="{{ asset('storage/' . $peserta->anak->foto) }}"
                                        class="rounded-circle border"
                                        width="90"
                                        height="90"
                                        style="object-fit:cover;">

                                    @else

                                    <div class="rounded-circle bg-light-success d-flex align-items-center justify-content-center"
                                        style="width:90px;height:90px;">

                                        <i class="ti ti-user text-success"
                                            style="font-size:35px;"></i>

                                    </div>

                                    @endif

                                </div>

                                {{-- INFO --}}
                                <div class="ms-3">

                                    <h4 class="mb-1 fw-bold">
                                        {{ $peserta->anak->nama }}
                                    </h4>

                                    <div class="text-muted d-flex flex-column gap-1">

                                        <div>

                                            <i class="ti ti-calendar"></i>

                                            {{ \Carbon\Carbon::parse($peserta->jadwal->tanggal)->translatedFormat('l, d F Y') }}

                                        </div>

                                        <div>

                                            <i class="ti ti-user"></i>

                                            Orang Tua:
                                            {{ $peserta->anak->user->nama ?? '-' }}

                                        </div>

                                        <div>

                                            <i class="ti ti-clock"></i>
                                            Check In:
                                            {{ $peserta->waktu_masuk ? \Carbon\Carbon::parse($peserta->waktu_masuk)->format('H:i') : '-' }}
                                            &emsp; 
                                            <i class="ti ti-clock"></i>
                                            Check Out:
                                            {{ $peserta->waktu_keluar ? \Carbon\Carbon::parse($peserta->waktu_keluar)->format('H:i') : '-' }}

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
                                Penilaian aktivitas dan respon anak
                            </p>

                        </div>

                        <div class="card-body">

                            @foreach ($kategori->where('kategori', 'kegiatan') as $item)

                            <div class="border rounded-4 p-3 mb-3">

                                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                                    <div>

                                        <h6 class="mb-1 fw-semibold">
                                            {{ $item->deskripsi }}
                                        </h6>

                                        <small class="text-muted">
                                            {{ $item->keterangan }}
                                        </small>

                                    </div>

                                    <div class="d-flex gap-4">

                                        <div class="form-check">
                                            <input class="form-check-input"
                                                type="radio"
                                                name="kegiatan[{{ $item->id }}]"
                                                value="Sangat Baik">

                                            <label class="form-check-label">
                                                Sangat Baik
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input"
                                                type="radio"
                                                name="kegiatan[{{ $item->id }}]"
                                                value="Baik">

                                            <label class="form-check-label">
                                                Baik
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input"
                                                type="radio"
                                                name="kegiatan[{{ $item->id }}]"
                                                value="Cukup">

                                            <label class="form-check-label">
                                                Cukup
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input"
                                                type="radio"
                                                name="kegiatan[{{ $item->id }}]"
                                                value="Perlu Pendampingan">

                                            <label class="form-check-label">
                                                Pendampingan
                                            </label>
                                        </div>

                                    </div>

                                </div>

                            </div>

                            @endforeach

                            <div>

                                <label class="form-label fw-semibold">
                                    Catatan Kegiatan Hari Ini
                                </label>

                                <textarea class="form-control"
                                    rows="4"
                                    name="catatan_kegiatan"
                                    placeholder="Tambahkan catatan kegiatan anak hari ini"></textarea>

                            </div>

                        </div>

                    </div>

                    {{-- PERKEMBANGAN --}}
                    <div class="card border-0 shadow-sm rounded-4 mb-4">

                        <div class="card-header bg-white border-0 pt-4">

                            <h5 class="fw-bold mb-1">
                                Perkembangan Hari Ini
                            </h5>

                            <p class="text-muted small mb-0">
                                Penilaian perkembangan anak
                            </p>

                        </div>

                        <div class="card-body">

                            @foreach (['Motorik Kasar', 'Motorik Halus', 'Bahasa / Komunikasi', 'Sosial & Emosi', 'Kemandirian'] as $perkembangan)

                            <div class="border rounded-4 p-3 mb-3">

                                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                                    <h6 class="mb-0">
                                        {{ $perkembangan }}
                                    </h6>

                                    <div class="d-flex gap-4">

                                        <div class="form-check">
                                            <input class="form-check-input"
                                                type="radio"
                                                name="perkembangan[{{ $perkembangan }}]"
                                                value="MB">

                                            <label class="form-check-label">
                                                MB
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input"
                                                type="radio"
                                                name="perkembangan[{{ $perkembangan }}]"
                                                value="BSH">

                                            <label class="form-check-label">
                                                BSH
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input"
                                                type="radio"
                                                name="perkembangan[{{ $perkembangan }}]"
                                                value="BSB">

                                            <label class="form-check-label">
                                                BSB
                                            </label>
                                        </div>

                                    </div>

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

                            <label class="form-label fw-semibold">
                                Mood Anak
                            </label>

                            <select class="form-select mb-4"
                                name="mood">

                                <option value="">Pilih Mood</option>
                                <option value="Ceria">Ceria</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Tenang">Tenang</option>
                                <option value="Rewel">Rewel</option>
                                <option value="Perlu Pendampingan">Perlu Pendampingan</option>

                            </select>

                            <label class="form-label fw-semibold">
                                Kondisi Fisik
                            </label>

                            <div class="d-flex flex-column gap-2">

                                @foreach (['Sehat', 'Batuk', 'Pilek', 'Demam', 'Lecet / Luka Ringan', 'Alergi'] as $fisik)

                                <div class="form-check">

                                    <input class="form-check-input"
                                        type="checkbox"
                                        name="kondisi_fisik[]"
                                        value="{{ $fisik }}">

                                    <label class="form-check-label">
                                        {{ $fisik }}
                                    </label>

                                </div>

                                @endforeach

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

                        <div class="card-body">

                            <label class="form-label fw-semibold">
                                Minum Air Putih
                            </label>

                            <input type="number"
                                class="form-control mb-4"
                                name="minum_air"
                                placeholder="Jumlah gelas">

                            <label class="form-label fw-semibold">
                                Selera Makan
                            </label>

                            <select class="form-select mb-4"
                                name="selera_makan">

                                <option value="">Pilih</option>
                                <option value="baik">Baik</option>
                                <option value="cukup">Cukup</option>
                                <option value="kurang">Kurang</option>

                            </select>

                            <label class="form-label fw-semibold">
                                Catatan Makan
                            </label>

                            <textarea class="form-control"
                                rows="3"
                                name="catatan_makan"></textarea>

                        </div>

                    </div>

                    {{-- TOILET --}}
                    <div class="card border-0 shadow-sm rounded-4 mb-4">

                        <div class="card-header bg-white border-0 pt-4">

                            <h5 class="fw-bold mb-1">
                                Toilet Training
                            </h5>

                        </div>

                        <div class="card-body">

                            <label class="form-label fw-semibold">
                                Pipis di Toilet
                            </label>

                            <select class="form-select mb-3"
                                name="toilet_pipis">

                                <option value="">Pilih</option>
                                <option value="ya">Ya</option>
                                <option value="belum">Belum</option>
                                <option value="kadang">Kadang-kadang</option>

                            </select>

                            <label class="form-label fw-semibold">
                                Pup di Toilet
                            </label>

                            <select class="form-select mb-3"
                                name="toilet_pup">

                                <option value="">Pilih</option>
                                <option value="ya">Ya</option>
                                <option value="belum">Belum</option>
                                <option value="kadang">Kadang-kadang</option>

                            </select>

                            <label class="form-label fw-semibold">
                                Kondisi Popok
                            </label>

                            <select class="form-select"
                                name="kondisi_popok">

                                <option value="">Pilih</option>
                                <option value="full">Full</option>
                                <option value="sebagian">Sebagian</option>
                                <option value="kering">Kering</option>

                            </select>

                        </div>

                    </div>

                    {{-- INFORMASI --}}
                    <div class="card border-0 shadow-sm rounded-4">

                        <div class="card-header bg-white border-0 pt-4">

                            <h5 class="fw-bold mb-1">
                                Informasi Orang Tua
                            </h5>

                        </div>

                        <div class="card-body">

                            <textarea class="form-control mb-4"
                                rows="5"
                                name="informasi_orang_tua"
                                placeholder="Tambahkan informasi penting untuk orang tua"></textarea>

                        </div>

                    </div>

                    <div class="card border-0 shadow-sm rounded-4 mt-4">

                        <div class="card-header bg-white border-0 pt-4">

                            <h5 class="fw-bold mb-1">
                                Tanda Tangan
                            </h5>

                            <p class="text-muted small mb-0">
                                Validasi laporan harian daycare
                            </p>

                        </div>

                        <div class="card-body">

                            <div class="row">

                                {{-- PENGASUH --}}
                                <div class="col-md-6 mb-4">

                                    <label class="form-label fw-semibold">
                                        Tanda Tangan Pengasuh
                                    </label>

                                    <div class="border rounded-4 p-2 bg-light">

                                        <canvas id="signaturePengasuh"
                                            height="180"
                                            class="w-100 rounded-3 bg-white"></canvas>

                                    </div>

                                    <input type="hidden"
                                        name="ttd_pengasuh"
                                        id="ttd_pengasuh">

                                    <button type="button"
                                        class="btn btn-light btn-sm rounded-pill mt-2"
                                        id="clearPengasuh">

                                        Reset

                                    </button>

                                </div>

                                {{-- ORANG TUA --}}
                                <div class="col-md-6 mb-4">

                                    <label class="form-label fw-semibold">
                                        Tanda Tangan Orang Tua
                                    </label>

                                    <div class="border rounded-4 p-2 bg-light">

                                        <canvas id="signatureOrangtua"
                                            height="180"
                                            class="w-100 rounded-3 bg-white"></canvas>

                                    </div>

                                    <input type="hidden"
                                        name="ttd_orangtua"
                                        id="ttd_orangtua">

                                    <button type="button"
                                        class="btn btn-light btn-sm rounded-pill mt-2"
                                        id="clearOrangtua">

                                        Reset

                                    </button>

                                </div>

                            </div>

                            <button type="button" class="btn btn-success rounded-pill w-100 py-2" id="btnSimpanLaporan">

                                <i class="ti ti-device-floppy me-1"></i>
                                Simpan Laporan Harian

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </form>

    </div>
</div>
@section('js')
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

<script>
    const canvasPengasuh = document.getElementById('signaturePengasuh');
    const padPengasuh = new SignaturePad(canvasPengasuh);

    const canvasOrangtua = document.getElementById('signatureOrangtua');
    const padOrangtua = new SignaturePad(canvasOrangtua);

    $('#clearPengasuh').click(function() {
        padPengasuh.clear();
    });

    $('#clearOrangtua').click(function() {
        padOrangtua.clear();
    });

    $('#btnSimpanLaporan').on('click', function() {

        let valid = true;

        // VALIDASI RADIO KEGIATAN
        $('[name^="kegiatan"]').each(function() {

            let name = $(this).attr('name');

            if (!$(`input[name="${name}"]:checked`).length) {

                valid = false;

            }

        });

        // VALIDASI PERKEMBANGAN
        $('[name^="perkembangan"]').each(function() {

            let name = $(this).attr('name');

            if (!$(`input[name="${name}"]:checked`).length) {

                valid = false;

            }

        });

        // VALIDASI SELECT & INPUT
        const requiredFields = [
            'mood',
            'minum_air',
            'selera_makan',
            'toilet_pipis',
            'toilet_pup',
            'kondisi_popok'
        ];

        requiredFields.forEach(function(field) {

            if (!$(`[name="${field}"]`).val()) {

                valid = false;

            }

        });

        // VALIDASI KONDISI FISIK
        if (!$('input[name="kondisi_fisik[]"]:checked').length) {

            valid = false;

        }

        // VALIDASI TTD
        if (padPengasuh.isEmpty() || padOrangtua.isEmpty()) {

            valid = false;

        }

        // ERROR
        if (!valid) {

            Swal.fire({
                icon: 'warning',
                title: 'Form Belum Lengkap',
                text: 'Pastikan seluruh penilaian telah diisi kecuali bagian catatan',
                confirmButtonColor: '#16a34a'
            });

            return;

        }

        // KONFIRMASI
        Swal.fire({

            title: 'Simpan Laporan?',
            text: 'Pastikan seluruh penilaian harian sudah benar',
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

            buttonsStyling: false

        }).then((result) => {

            if (result.isConfirmed) {

                $('#ttd_pengasuh').val(
                    padPengasuh.toDataURL()
                );

                $('#ttd_orangtua').val(
                    padOrangtua.toDataURL()
                );

                Swal.fire({

                    title: 'Menyimpan Laporan...',
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

                $('form').submit();

            }

        });

    });
</script>
@endsection
@endsection