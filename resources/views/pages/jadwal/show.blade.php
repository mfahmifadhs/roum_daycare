@extends('pages.app')

@section('content')
<div class="pc-container">
    <div class="pc-content">

        <!-- Page Header -->
        <div class="page-header mb-4">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h3 class="mb-1">Daftar Jadwal</h3>
                        <p class="text-muted mb-0">
                            Kelola data jadwal penitipan anak
                        </p>
                    </div>

                    <div class="col-md-6 text-md-end mt-3 mt-md-0">
                        <button class="btn btn-success rounded-pill px-4 shadow-sm" data-bs-toggle="modal"
                            data-bs-target="#modalTambahJadwal">
                            <i class="ti ti-plus me-1"></i>
                            Tambah Jadwal
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('jadwal') }}">

                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">
                                Bulan
                            </label>
                            <select class="form-select" name="bulan">
                                <option value="">Semua Bulan</option>

                                @foreach(range(1,12) as $bulan)
                                <option value="{{ $bulan }}" {{ request('bulan') == $bulan ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create()->month($bulan)->locale('id')->translatedFormat('F') }}
                                </option>
                                @endforeach
                            </select>

                        </div>

                        <!-- FILTER TAHUN -->
                        <div class="col-md-3">

                            <label class="form-label">Tahun</label>

                            <select class="form-select" name="tahun">
                                <option value="">Semua Tahun</option>

                                @foreach(range(date('Y') - 2, date('Y') + 2) as $tahun)
                                <option
                                    value="{{ $tahun }}"
                                    {{ request('tahun') == $tahun ? 'selected' : '' }}>
                                    {{ $tahun }}
                                </option>
                                @endforeach

                            </select>
                        </div>

                        <!-- SORTING -->
                        <div class="col-md-3">

                            <label class="form-label">
                                Sorting
                            </label>

                            <select
                                class="form-select"
                                name="sort">

                                <option value="terbaru"
                                    {{ request('sort') == 'terbaru' ? 'selected' : '' }}>

                                    Terbaru

                                </option>

                                <option value="terlama"
                                    {{ request('sort') == 'terlama' ? 'selected' : '' }}>

                                    Terlama

                                </option>

                            </select>

                        </div>

                        <!-- BUTTON -->
                        <div class="col-md-3 d-flex align-items-end">

                            <button class="btn btn-success w-100">

                                <i class="ti ti-filter me-1"></i>
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
                                <th class="ps-4">Tanggal</th>
                                <th class="text-center">Kuota</th>
                                <th>Pengasuh</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody id="jadwalTable">

                            <!-- Jadwal 1 -->
                            @foreach ($jadwal as $data)
                            <tr>
                                <td>
                                    {{ \Carbon\Carbon::parse($data->tanggal)->locale('id')->isoFormat('dddd') }} <br>
                                    {{ \Carbon\Carbon::parse($data->tanggal)->locale('id')->isoFormat('DD-MM-Y') }}
                                </td>
                                <td class="text-center">{{ $data->peserta->count() }}/{{ $data->kuota }}</td>
                                <td>{{ $data->pengasuh->nama ?? 'Tidak ada pengasuh' }}</td>
                                <td class="text-center">

                                    <div class="dropdown">

                                        <button class="btn btn-light btn-sm rounded-pill" data-bs-toggle="dropdown">

                                            <i class="ti ti-dots"></i>

                                        </button>

                                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow">

                                            <li>
                                                <a class="dropdown-item" href="#" onclick="updatePeserta('{{ $data->id }}')">
                                                    Update Peserta
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('jadwal.detail', $data->id) }}">
                                                    Detail
                                                </a>
                                            </li>

                                            <li>
                                                <a class="dropdown-item btn-edit" href="#" data-id="{{ $data->id }}">
                                                    Edit
                                                </a>
                                            </li>

                                            <li>
                                                <a
                                                    class="dropdown-item text-danger btn-delete"
                                                    href="#"
                                                    data-id="{{ $data->id }}"
                                                    data-tanggal="{{ $data->tanggal }}">

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
                        {{ $jadwal->firstItem() }}
                        sampai
                        {{ $jadwal->lastItem() }}

                        dari
                        {{ $jadwal->total() }}
                        data

                    </small>

                    <!-- PAGINATION -->
                    <nav>

                        {{ $jadwal->links('pagination::bootstrap-5') }}

                    </nav>

                </div>

            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambahJadwal" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content border-0 rounded-4 shadow">

            <!-- HEADER -->
            <div class="modal-header border-0 pb-0">

                <div>

                    <h4 class="fw-bold mb-1">
                        Tambah Jadwal
                    </h4>

                    <p class="text-muted small mb-0">
                        Tambahkan jadwal penitipan DayCare
                    </p>

                </div>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <!-- BODY -->
            <div class="modal-body pt-4">

                <form
                    action="{{ route('jadwal.store') }}"
                    method="POST"
                    id="formTambahJadwal">

                    @csrf

                    <div class="row">

                        <!-- TANGGAL -->
                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">
                                Tanggal
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="date"
                                class="form-control rounded-3"
                                name="tanggal"
                                value="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                required>

                        </div>

                        <!-- KUOTA -->
                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">
                                Kuota
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="number"
                                class="form-control rounded-3"
                                name="kuota"
                                placeholder="Masukkan kuota"
                                value="{{ $kuota }}"
                                required>

                        </div>

                        <!-- PENGASUH -->
                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">
                                Pengasuh
                                <span class="text-danger">*</span>
                            </label>

                            <select class="form-select rounded-3" name="pengasuh_id" required>
                                <option value="">Pilih Pengasuh</option>
                                @foreach ($pengasuh as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>

                        </div>

                        <!-- JENIS INPUT -->
                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">
                                Jenis Jadwal
                                <span class="text-danger">*</span>
                            </label>

                            <select
                                class="form-select rounded-3"
                                name="jenis_input"
                                required>

                                <option value="1">
                                    1 Hari
                                </option>

                                <option value="5">
                                    5 Hari Kerja
                                </option>

                                <option value="7">
                                    7 Hari Kerja
                                </option>

                            </select>

                        </div>

                    </div>

                </form>

            </div>

            <!-- FOOTER -->
            <div class="modal-footer border-0 pt-0">

                <button
                    type="button"
                    class="btn btn-light rounded-pill px-4"
                    data-bs-dismiss="modal">

                    Batal

                </button>

                <button
                    type="button"
                    class="btn btn-success rounded-pill px-4 shadow-sm"
                    id="btnSimpanJadwal">

                    <i class="ti ti-device-floppy me-1"></i>
                    Simpan Jadwal

                </button>

            </div>

        </div>

    </div>

</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEditJadwal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Edit Data Jadwal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="formEditJadwal" method="POST">
                    @csrf
                    <input type="hidden" id="edit_id" name="id">
                    <div class="row">

                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-semibold">
                                Tanggal
                                <span class="text-danger">*</span>
                            </label>

                            <input id="edit_tanggal" type="date" class="form-control rounded-3" name="tanggal" value="{{ date('Y-m-d') }}" readonly>
                        </div>

                        <!-- KUOTA -->
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-semibold">
                                Kuota
                                <span class="text-danger">*</span>
                            </label>

                            <input id="edit_kuota" type="number" class="form-control rounded-3" name="kuota" placeholder="Masukkan kuota" value="{{ $kuota }}" required>
                        </div>

                        <div class="col-md-12 mb-4">

                            <label class="form-label fw-semibold">
                                Pengasuh
                                <span class="text-danger">*</span>
                            </label>

                            <select id="edit_pengasuh_id" class="form-select rounded-3" name="pengasuh_id" required>
                                <option value="">Pilih Pengasuh</option>
                                @foreach ($pengasuh as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>

                        </div>

                    </div>
                </form>
            </div>

            <div class="modal-footer border-0 pt-0">

                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>

                <button type="submit" class="btn btn-success rounded-pill px-4 shadow-sm" id="btnUpdate">
                    <i class="ti ti-device-floppy me-1"></i>
                    Simpan Jadwal
                </button>
            </div>
        </div>
    </div>
</div>

@section('js')
<script>
    $('#btnSimpanJadwal').on('click', function() {

        const form = $('#formTambahJadwal')[0];

        // VALIDASI
        if (!form.checkValidity()) {

            form.reportValidity();

            return;

        }

        Swal.fire({

            width: '420px',

            background: '#fff',

            showCloseButton: true,

            showCancelButton: true,
            showConfirmButton: true,

            confirmButtonText: `
            <i class="ti ti-check me-1"></i>
            Ya, Simpan
        `,

            cancelButtonText: 'Batal',

            customClass: {

                popup: 'rounded-4 border-0 shadow',
                confirmButton: 'btn btn-success rounded-pill px-4',
                cancelButton: 'btn btn-light rounded-pill px-4 me-2'

            },

            buttonsStyling: false,

            title: 'Simpan Jadwal?',

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
                    Jadwal penitipan akan ditambahkan ke sistem
                </p>

            </div>

        `

        }).then((result) => {

            if (result.isConfirmed) {

                Swal.fire({

                    title: 'Menyimpan Jadwal...',

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

                    form.requestSubmit();

                }, 500);

            }

        });

    });
</script>

<script>
    $('.btn-delete').on('click', function(e) {

        e.preventDefault();

        let id = $(this).data('id');
        let tanggal = $(this).data('tanggal');

        Swal.fire({

            width: '420px',

            background: '#fff',

            showCloseButton: true,

            showCancelButton: true,
            showConfirmButton: true,

            confirmButtonText: `
            <i class="ti ti-trash me-1"></i>
            Ya, Hapus
        `,

            cancelButtonText: 'Batal',

            customClass: {

                popup: 'rounded-4 border-0 shadow',
                confirmButton: 'btn btn-danger rounded-pill px-4',
                cancelButton: 'btn btn-light rounded-pill px-4 me-2'

            },

            buttonsStyling: false,

            title: 'Hapus Jadwal?',

            html: `

            <div class="text-center py-2">

                <div class="mb-4">

                    <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center"
                        style="width:80px;height:80px;">

                        <i class="ti ti-trash text-danger"
                            style="font-size:35px;">
                        </i>

                    </div>

                </div>

                <p class="text-muted mb-0">
                    Apakah Anda yakin ingin menghapus jadwal
                    <br>
                    <strong>${tanggal}</strong> ?
                </p>

            </div>

        `

        }).then((result) => {

            if (result.isConfirmed) {

                // LOADING
                Swal.fire({

                    title: 'Menghapus Data...',

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

                // SUBMIT DELETE
                $('#formDelete')
                    .attr('action', `/jadwal/delete/${id}`)
                    .submit();

            }

        });

    });
</script>

<!-- Modal Edit Jadwal -->
<script>
    $('.btn-edit').on('click', function() {
        let id = $(this).data('id');

        // Tampilkan loading sebentar saat ambil data
        Swal.fire({
            title: 'Mengambil Data...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $.get(`/jadwal/edit/${id}`, function(data) {
            Swal.close();

            $('#edit_id').val(data.id);
            $('#edit_tanggal').val(data.tanggal);
            $('#edit_kuota').val(data.kuota);
            $('#edit_pengasuh_id').val(data.pengasuh_id);

            $('#modalEditJadwal').modal('show');

            $('#formEditJadwal').attr('action', `/jadwal/update/${id}`);

        }).fail(function() {
            Swal.fire('Error', 'Gagal mengambil data jadwal', 'error');
        });
    });

    $('#btnUpdate').on('click', function(e) {
        e.preventDefault();
        const form = $('#formEditJadwal')[0];

        Swal.fire({
            title: 'Memperbarui Data...',
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

        form.submit();
    });
</script>

<!-- Modal update -->
<script>
    function updatePeserta(id) {

        Swal.fire({

            width: '430px',

            background: '#fff',

            showCloseButton: true,

            showCancelButton: true,

            showConfirmButton: true,

            confirmButtonText: `
            <i class="ti ti-refresh me-1"></i>
            Ya, Update
        `,

            cancelButtonText: 'Batal',

            buttonsStyling: false,

            customClass: {

                popup: 'rounded-4 border-0 shadow',
                confirmButton: 'btn btn-success rounded-pill px-4',
                cancelButton: 'btn btn-light rounded-pill px-4 me-2'

            },

            title: 'Update Data Peserta?',

            html: `

            <div class="text-center py-2">

                <div class="mb-4">

                    <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center"
                        style="width:80px;height:80px;">

                        <i class="ti ti-users-group text-success"
                            style="font-size:35px;">
                        </i>

                    </div>

                </div>

                <p class="text-muted mb-0">

                    Status peserta akan diperbarui
                    sesuai kehadiran hari ini

                </p>

            </div>

        `

        }).then((result) => {

            if (result.isConfirmed) {

                Swal.fire({

                    title: 'Memperbarui Peserta...',

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
                        `/jadwal/update-peserta/${id}`;

                }, 500);

            }

        });

    }
</script>
@endsection
@endsection