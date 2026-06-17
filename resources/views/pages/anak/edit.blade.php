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
                            Edit Data Anak
                        </h3>

                        <p class="text-muted mb-0">

                            Perbarui data anak dan skrining kesehatan

                        </p>

                    </div>

                    <div class="col-md-4 text-md-end mt-3 mt-md-0">

                        <a href="{{ route('anak.detail', $anak->id) }}"
                            class="btn btn-light rounded-pill px-4">

                            <i class="ti ti-arrow-left me-1"></i>
                            Kembali

                        </a>

                    </div>

                </div>

            </div>

        </div>

        <form method="POST" action="{{ route('anak.update', $anak->id) }}" enctype="multipart/form-data">
            @csrf

            <div class="row">

                {{-- DATA ANAK --}}
                <div class="col-lg-4">

                    <div class="card border-0 shadow-sm rounded-4 mb-4">

                        <div class="card-header bg-white border-0 pt-4">

                            <h5 class="fw-bold mb-0">
                                Data Anak
                            </h5>

                        </div>

                        <div class="card-body">

                            {{-- FOTO --}}
                            <div class="text-center mb-4">

                                {{-- PREVIEW --}}
                                <img id="previewFoto"
                                    src="{{ $anak->foto ? asset('storage/' . $anak->foto) : asset('assets/images/user/avatar-1.jpg') }}"
                                    class="rounded-circle border mb-3"
                                    width="120"
                                    height="120"
                                    style="object-fit:cover;">

                                {{-- INPUT --}}
                                <input type="file"
                                    class="form-control"
                                    name="foto"
                                    id="foto"
                                    accept="image/*">

                            </div>

                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Nama Anak
                                </label>

                                <input type="text"
                                    class="form-control"
                                    name="nama"
                                    value="{{ old('nama', $anak->nama) }}">

                            </div>

                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Jenis Kelamin
                                </label>

                                <select class="form-select"
                                    name="jenis_kelamin">

                                    <option value="L"
                                        {{ $anak->jenis_kelamin == 'L' ? 'selected' : '' }}>

                                        Laki-laki

                                    </option>

                                    <option value="P"
                                        {{ $anak->jenis_kelamin == 'P' ? 'selected' : '' }}>

                                        Perempuan

                                    </option>

                                </select>

                            </div>

                            <div class="row">

                                <div class="col-md-6 mb-3">

                                    <label class="form-label fw-semibold">
                                        Tempat Lahir
                                    </label>

                                    <input type="text"
                                        class="form-control"
                                        name="tempat_lahir"
                                        value="{{ old('tempat_lahir', $anak->tempat_lahir) }}">

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label class="form-label fw-semibold">
                                        Tanggal Lahir
                                    </label>

                                    <input type="date"
                                        class="form-control"
                                        name="tanggal_lahir"
                                        value="{{ old('tanggal_lahir', $anak->tanggal_lahir) }}">

                                </div>

                            </div>

                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Golongan Darah
                                </label>

                                <input type="text"
                                    class="form-control"
                                    name="golongan_darah"
                                    value="{{ old('golongan_darah', $anak->golongan_darah) }}">

                            </div>

                        </div>

                    </div>

                </div>

                {{-- SKRINING --}}
                <div class="col-lg-8">

                    <div class="card border-0 shadow-sm rounded-4 mb-4">

                        <div class="card-header bg-white border-0 pt-4">

                            <h5 class="fw-bold mb-0">
                                Skrining Anak
                            </h5>

                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-6 mb-3">

                                    <label class="form-label fw-semibold">
                                        Berat Badan
                                    </label>

                                    <input type="number"
                                        class="form-control"
                                        name="berat_badan"
                                        value="{{ old('berat_badan', $anak->skrining?->berat_badan) }}">

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label class="form-label fw-semibold">
                                        Tinggi Badan
                                    </label>

                                    <input type="number"
                                        class="form-control"
                                        name="tinggi_badan"
                                        value="{{ old('tinggi_badan', $anak->skrining?->tinggi_badan) }}">

                                </div>

                            </div>

                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Riwayat Alergi
                                </label>

                                <textarea class="form-control"
                                    rows="3"
                                    name="alergi">{{ old('alergi', $anak->skrining?->alergi) }}</textarea>

                            </div>

                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Riwayat Penyakit
                                </label>

                                <textarea class="form-control"
                                    rows="3"
                                    name="riwayat_penyakit">{{ old('riwayat_penyakit', $anak->skrining?->riwayat_penyakit) }}</textarea>

                            </div>

                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Kebutuhan Khusus
                                </label>

                                <textarea class="form-control"
                                    rows="3"
                                    name="kebutuhan_khusus">{{ old('kebutuhan_khusus', $anak->skrining?->kebutuhan_khusus) }}</textarea>

                            </div>


                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Konsumsi Obat
                                </label>

                                <input type="text"
                                    class="form-control"
                                    name="konsumsi_obat"
                                    value="{{ old('konsumsi_obat', $anak->skrining?->konsumsi_obat) }}">

                            </div>

                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Riwayat Rawat Inap
                                </label>

                                <input type="text"
                                    rows="3"
                                    class="form-control"
                                    name="riwayat_rawat_inap"
                                    value="{{ old('riwayat_rawat_inap', $anak->skrining?->riwayat_rawat_inap) }}">

                            </div>

                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Imunisasi Dasar
                                </label>

                                <select class="form-select" name="imunisasi_dasar">

                                    <option value="">Pilih Status</option>
                                    <option value="true" {{ old('imunisasi_dasar', $anak->skrining?->imunisasi_dasar) == 'true' ? 'selected' : '' }}>Sudah</option>
                                    <option value="false" {{ old('imunisasi_dasar', $anak->skrining?->imunisasi_dasar) == 'false' ? 'selected' : '' }}>Belum</option>

                                </select>

                            </div>

                            <div class="mb-4">

                                <label class="form-label fw-semibold">
                                    Catatan Orang Tua
                                </label>

                                <textarea class="form-control"
                                    rows="4"
                                    name="catatan_orang_tua">{{ old('catatan_orang_tua', $anak->skrining?->catatan_orang_tua) }}</textarea>

                            </div>

                            <button type="button"
                                class="btn btn-success rounded-pill w-100 py-2"
                                id="btnUpdateAnak">

                                <i class="ti ti-device-floppy me-1"></i>
                                Simpan Perubahan

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
    $('#btnUpdateAnak').on('click', function() {

        Swal.fire({

            title: 'Simpan Perubahan?',
            text: 'Pastikan data anak dan skrining sudah benar',
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

                    title: 'Menyimpan Data...',
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

<script>
    $('#foto').on('change', function(e) {

        const file = e.target.files[0];

        if (!file) return;

        const reader = new FileReader();

        reader.onload = function(event) {

            $('#previewFoto').attr(
                'src',
                event.target.result
            );

        };

        reader.readAsDataURL(file);

    });
</script>

@endsection
@endsection