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
                            Edit Penilaian Laporan Harian Anak
                        </h3>

                        <p class="text-muted mb-0">
                            Perbarui evaluasi dan perkembangan harian peserta daycare
                        </p>

                    </div>

                    <div class="col-md-4 text-md-end mt-3 mt-md-0">

                        <a href="{{ route('laporan.detail', $laporan->id) }}"
                            class="btn btn-light rounded-pill px-4">

                            <i class="ti ti-arrow-left me-1"></i>
                            Kembali

                        </a>

                    </div>

                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('laporan.update', $laporan->id) }}">
            @csrf

            <input type="hidden"
                name="jadwal_id"
                value="{{ $laporan->jadwal_id }}">

            <input type="hidden"
                name="anak_id"
                value="{{ $laporan->anak_id }}">

            <input type="hidden"
                name="pengasuh_id"
                value="{{ $laporan->pengasuh_id }}">

            <input type="hidden"
                name="ttd_pengasuh"
                value="{{ $laporan->ttd_pengasuh }}">

            <input type="hidden"
                name="ttd_orangtua"
                value="{{ $laporan->ttd_orangtua }}">

            <div class="row">

                {{-- LEFT --}}
                <div class="col-lg-8">

                    {{-- DATA ANAK --}}
                    <div class="card border-0 shadow-sm rounded-4 mb-4">

                        <div class="card-body">

                            <div class="d-flex align-items-center">

                                <div class="flex-shrink-0">

                                    @if ($laporan->anak->foto)

                                    <img src="{{ asset('storage/' . $laporan->anak->foto) }}"
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

                                <div class="ms-3">

                                    <h4 class="mb-1 fw-bold">
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

                        </div>

                        <div class="card-body">

                            @foreach ($kegiatan as $item)

                            @php
                            $detail = $laporan->detail
                            ->where('kategori_id', $item->id)
                            ->first();
                            @endphp

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

                                    <div class="d-flex gap-4 flex-wrap">

                                        @foreach (['Sangat Baik', 'Baik', 'Cukup', 'Perlu Pendampingan'] as $nilai)

                                        <div class="form-check">

                                            <input class="form-check-input"
                                                type="radio"
                                                name="kegiatan[{{ $item->id }}]"
                                                value="{{ $nilai }}"
                                                {{ ($detail->nilai ?? '') == $nilai ? 'checked' : '' }}>

                                            <label class="form-check-label">
                                                {{ $nilai }}
                                            </label>

                                        </div>

                                        @endforeach

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
                                    name="catatan_kegiatan">{{ $laporan->catatan_kondisi }}</textarea>

                            </div>

                        </div>

                    </div>

                    {{-- PERKEMBANGAN --}}
                    <div class="card border-0 shadow-sm rounded-4 mb-4">

                        <div class="card-header bg-white border-0 pt-4">

                            <h5 class="fw-bold mb-1">
                                Perkembangan Hari Ini
                            </h5>

                        </div>

                        <div class="card-body">

                            @foreach ($perkembangan as $item)

                            @php
                            $detail = $laporan->detail
                            ->where('kategori_id', $item->id)
                            ->first();
                            @endphp

                            <div class="border rounded-4 p-3 mb-3">

                                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                                    <h6 class="mb-0">
                                        {{ $item->deskripsi }}
                                    </h6>

                                    <div class="d-flex gap-4">

                                        @foreach (['MB', 'BSH', 'BSB'] as $nilai)

                                        <div class="form-check">

                                            <input class="form-check-input"
                                                type="radio"
                                                name="perkembangan[{{ $item->id }}]"
                                                value="{{ $nilai }}"
                                                {{ ($detail->nilai ?? '') == $nilai ? 'checked' : '' }}>

                                            <label class="form-check-label">
                                                {{ $nilai }}
                                            </label>

                                        </div>

                                        @endforeach

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

                                @foreach ($mood as $item)

                                <option value="{{ $item->id }}"
                                    {{ $laporan->detail->where('kategori_id', $item->id)->count() ? 'selected' : '' }}>

                                    {{ $item->deskripsi }}

                                </option>

                                @endforeach

                            </select>

                            <label class="form-label fw-semibold">
                                Kondisi Fisik
                            </label>

                            <div class="d-flex flex-column gap-2">

                                @foreach ($kondisi as $item)

                                <div class="form-check">

                                    <input class="form-check-input"
                                        type="checkbox"
                                        name="kondisi_fisik[]"
                                        value="{{ $item->id }}"
                                        {{ $laporan->detail->where('kategori_id', $item->id)->count() ? 'checked' : '' }}>

                                    <label class="form-check-label">
                                        {{ $item->deskripsi }}
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
                                placeholder="Jumlah gelas"
                                value="{{ $laporan->minum_air }}">

                            <label class="form-label fw-semibold">
                                Selera Makan
                            </label>

                            <select class="form-select mb-4"
                                name="selera_makan">

                                <option value="">Pilih</option>

                                <option value="baik"
                                    {{ $laporan->selera_makan == 'baik' ? 'selected' : '' }}>
                                    Baik
                                </option>

                                <option value="cukup"
                                    {{ $laporan->selera_makan == 'cukup' ? 'selected' : '' }}>
                                    Cukup
                                </option>

                                <option value="kurang"
                                    {{ $laporan->selera_makan == 'kurang' ? 'selected' : '' }}>
                                    Kurang
                                </option>

                            </select>

                            <label class="form-label fw-semibold">
                                Catatan Makan
                            </label>

                            <textarea class="form-control"
                                rows="3"
                                name="catatan_makan">{{ $laporan->catatan_makan }}</textarea>

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

                                <option value="ya"
                                    {{ $laporan->toilet_pipis == 'ya' ? 'selected' : '' }}>
                                    Ya
                                </option>

                                <option value="belum"
                                    {{ $laporan->toilet_pipis == 'belum' ? 'selected' : '' }}>
                                    Belum
                                </option>

                                <option value="kadang"
                                    {{ $laporan->toilet_pipis == 'kadang' ? 'selected' : '' }}>
                                    Kadang-kadang
                                </option>

                            </select>

                            <label class="form-label fw-semibold">
                                Pup di Toilet
                            </label>

                            <select class="form-select mb-3"
                                name="toilet_pup">

                                <option value="">Pilih</option>

                                <option value="ya"
                                    {{ $laporan->toilet_pup == 'ya' ? 'selected' : '' }}>
                                    Ya
                                </option>

                                <option value="belum"
                                    {{ $laporan->toilet_pup == 'belum' ? 'selected' : '' }}>
                                    Belum
                                </option>

                                <option value="kadang"
                                    {{ $laporan->toilet_pup == 'kadang' ? 'selected' : '' }}>
                                    Kadang-kadang
                                </option>

                            </select>

                            <label class="form-label fw-semibold">
                                Kondisi Popok
                            </label>

                            <select class="form-select"
                                name="kondisi_popok">

                                <option value="">Pilih</option>

                                <option value="full"
                                    {{ $laporan->kondisi_popok == 'full' ? 'selected' : '' }}>
                                    Full
                                </option>

                                <option value="sebagian"
                                    {{ $laporan->kondisi_popok == 'sebagian' ? 'selected' : '' }}>
                                    Sebagian
                                </option>

                                <option value="kering"
                                    {{ $laporan->kondisi_popok == 'kering' ? 'selected' : '' }}>
                                    Kering
                                </option>

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
                                placeholder="Tambahkan informasi penting untuk orang tua">{{ $laporan->informasi_orang_tua }}</textarea>

                            <button type="button"
                                class="btn btn-success rounded-pill w-100 py-2"
                                id="btnUpdateLaporan">

                                <i class="ti ti-device-floppy me-1"></i>
                                Update Laporan Harian

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </form>

    </div>
</div>
@section('js')
<script>

    $('#btnUpdateLaporan').on('click', function() {

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