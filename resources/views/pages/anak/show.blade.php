@extends('pages.app')

@section('content')
<div class="pc-container">
    <div class="pc-content">

        <!-- Page Header -->
        <div class="page-header mb-4">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h3 class="mb-1">Daftar Anak</h3>
                        <p class="text-muted mb-0">
                            Kelola data anak penitipan anak
                        </p>
                    </div>

                    <div class="col-md-6 text-md-end mt-3 mt-md-0">
                        <button class="btn btn-success rounded-pill px-4 shadow-sm" data-bs-toggle="modal"
                            data-bs-target="#modalTambahAnak">
                            <i class="ti ti-plus me-1"></i>
                            Tambah Anak
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body">

                <form method="GET" action="{{ route('anak') }}">
                    <div class="row g-3">
                        <div class="col-md-7">
                            <label class="form-label">
                                Search
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="ti ti-search"></i>
                                </span>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    class="form-control border-0 bg-light" placeholder="Cari Anak/Orang Tua/Unit Kerja...">
                            </div>
                        </div>

                        <!-- Sorting -->
                        <div class="col-md-3">
                            <label class="form-label">
                                Sorting
                            </label>

                            <select class="form-select" name="sort">
                                <option value="terbaru"
                                    {{ request('sort') == 'terbaru' ? 'selected' : '' }}>
                                    Terbaru
                                </option>

                                <option value="terlama"
                                    {{ request('sort') == 'terlama' ? 'selected' : '' }}>
                                    Terlama
                                </option>

                                <option value="nama_asc"
                                    {{ request('sort') == 'nama_asc' ? 'selected' : '' }}>
                                    Nama A-Z
                                </option>

                                <option value="nama_desc"
                                    {{ request('sort') == 'nama_desc' ? 'selected' : '' }}>
                                    Nama Z-A
                                </option>
                            </select>
                        </div>

                        <!-- Button -->
                        <div class="col-md-2 d-flex align-items-end">
                            <button class="btn btn-success w-100">
                                <i class="ti ti-filter"></i>
                                Filter
                            </button>
                        </div>

                    </div>

                </form>
            </div>
        </div>

        <!-- Table -->
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table align-middle mb-0">

                        <thead class="bg-light">
                            <tr>
                                <th>No</th>
                                <th class="ps-4">Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Tanggal Lahir</th>
                                <th>Usia</th>
                                <th>Orang Tua</th>
                                <th>Unit Kerja</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody id="anakTable">

                            <!-- User 1 -->
                            @foreach ($anak as $data)
                            <tr>
                                <td class="text-center">{{ $loop->iteration + ($anak->currentPage() - 1) * $anak->perPage() }}</td>
                                <td>
                                    <h6 class="mb-0"><small>{{ $data->kode }}</small> <br> {{ $data->nama }}</h6>
                                </td>
                                <td>{{ $data->jenis_kelamin == 'P' ? 'Perempuan' : 'Laki-laki' }}</td>
                                <td>[{{ $data->tempat_lahir }}, {{ Carbon\Carbon::parse($data->tanggal_lahir)->isoFormat('DD MMMM Y') }}]</td>
                                <td>{{ \Carbon\Carbon::parse($data->tanggal_lahir)->diff(now())->y }} tahun
                                    ({{ round(\Carbon\Carbon::parse($data->tanggal_lahir)->diffInMonths(now())) }} bulan)
                                </td>
                                <td>{{ $data->user->nama }}</td>
                                <td>{{ $data->user->uker->nama_uker }}</td>
                                <td class="text-center">

                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm rounded-pill" data-bs-toggle="dropdown">
                                            <i class="ti ti-dots"></i>
                                        </button>

                                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('anak.detail', $data->id) }}">
                                                    <i class="ti ti-info-circle me-2"></i> Detail
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item btn-edit" href="{{ route('anak.edit', $data->id) }}">
                                                    <i class="ti ti-pencil me-2"></i> Edit
                                                </a>
                                            </li>

                                            <li>
                                                <a
                                                    class="dropdown-item text-danger btn-delete"
                                                    href="#"
                                                    data-id="{{ $data->id }}"
                                                    data-nama="{{ $data->nama }}">

                                                    <i class="ti ti-trash me-2"></i>
                                                    Hapus

                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <form
                        id="formDelete"
                        method="POST"
                        style="display:none;">
                        @csrf
                    </form>

                </div>

            </div>

            <!-- Pagination -->
            <div class="card-footer bg-white border-0">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <!-- INFO -->
                    <small class="text-muted">

                        Menampilkan
                        {{ $anak->firstItem() }}
                        sampai
                        {{ $anak->lastItem() }}

                        dari
                        {{ $anak->total() }}
                        data

                    </small>

                    <!-- PAGINATION -->
                    <nav>

                        {{ $anak->links('pagination::bootstrap-5') }}

                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH ANAK -->
<div class="modal fade" id="modalTambahAnak" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">

            <!-- HEADER -->
            <div class="modal-header border-0 pb-0">
                <div>
                    <h5 class="modal-title fw-bold">Tambah Data Anak</h5>
                    <p class="text-muted small mb-0">
                        Lengkapi informasi anak dan pilih orang tua yang bersangkutan.
                    </p>
                </div>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>
            </div>

            <!-- BODY -->
            <div class="modal-body p-4">

                <form id="formTambahAnak"
                    action="{{ route('anak.store') }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf

                    <div class="row">

                        <!-- ORANG TUA -->
                        <div class="col-12 mb-3">
                            <label class="form-label fw-semibold">
                                Orang Tua <span class="text-danger">*</span>
                            </label>

                            <select class="form-select rounded-3"
                                name="user_id"
                                required>

                                <option value="">Pilih Orang Tua</option>

                                @foreach ($orangTua as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->nama }}
                                    @if(!empty($item->nip))
                                    - {{ $item->nip }}
                                    @endif
                                </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-12">
                            <hr class="my-2">
                            <h6 class="fw-bold mb-3">Data Diri Anak</h6>
                        </div>

                        <!-- NAMA -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                Nama Lengkap Anak <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                class="form-control rounded-3"
                                name="nama"
                                placeholder="Masukkan nama lengkap anak"
                                required>
                        </div>

                        <!-- JENIS KELAMIN -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                Jenis Kelamin <span class="text-danger">*</span>
                            </label>

                            <select class="form-select rounded-3"
                                name="jenis_kelamin"
                                required>

                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>

                            </select>
                        </div>

                        <!-- TEMPAT LAHIR -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                Tempat Lahir
                            </label>

                            <input type="text"
                                class="form-control rounded-3"
                                name="tempat_lahir"
                                placeholder="Contoh: Jakarta">
                        </div>

                        <!-- TANGGAL LAHIR -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                Tanggal Lahir <span class="text-danger">*</span>
                            </label>

                            <input type="date"
                                class="form-control rounded-3"
                                name="tanggal_lahir"
                                max="{{ date('Y-m-d') }}"
                                required>
                        </div>

                        <!-- GOLONGAN DARAH -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                Golongan Darah
                            </label>

                            <select class="form-select rounded-3"
                                name="golongan_darah">

                                <option value="">Pilih Golongan Darah</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="AB">AB</option>
                                <option value="O">O</option>

                            </select>
                        </div>

                        <!-- FOTO -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                Foto Anak
                            </label>

                            <input type="file"
                                class="form-control rounded-3"
                                name="foto"
                                id="fotoAnak"
                                accept=".jpg,.jpeg,.png">

                            <small class="text-muted">
                                Format JPG, JPEG, PNG. Maksimal 2 MB.
                            </small>
                        </div>

                    </div>

                    <!-- FOOTER -->
                    <div class="d-flex justify-content-end gap-2 mt-3">

                        <button type="button"
                            class="btn btn-light rounded-pill px-4"
                            data-bs-dismiss="modal">
                            Batal
                        </button>

                        <button type="button"
                            class="btn btn-success rounded-pill px-4 shadow"
                            id="btnSimpanAnak">
                            <i class="ti ti-device-floppy me-1"></i>
                            Simpan Data
                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

@section('js')
<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {

        let keyword = this.value.toLowerCase();

        let rows = document.querySelectorAll('#anakTable tr');

        rows.forEach(function(row) {

            let text = row.innerText.toLowerCase();

            if (text.includes(keyword)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }

        });

    });
</script>

<script>
    document.getElementById('btnSimpanAnak')
        .addEventListener('click', function() {

            const form = document.getElementById('formTambahAnak');

            // Validasi form
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            Swal.fire({
                title: 'Simpan Data Anak?',
                text: 'Pastikan data anak dan orang tua sudah benar.',
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
                returnFocus: false,
                didOpen: () => {
                    document.querySelector('.swal2-container').style.zIndex = '2000';
                }
            }).then((result) => {

                if (result.isConfirmed) {

                    Swal.fire({
                        title: 'Menyimpan Data...',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        returnFocus: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    form.requestSubmit();
                }

            });
        });
</script>
@endsection
@endsection