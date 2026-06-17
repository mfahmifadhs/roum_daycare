@extends('pages.app')

@section('content')
<div class="pc-container">
    <div class="pc-content">

        <!-- Page Header -->
        <div class="page-header mb-4">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h3 class="mb-1">Daftar Pengasuh</h3>
                        <p class="text-muted mb-0">
                            Kelola data pengasuh penitipan anak
                        </p>
                    </div>

                    <div class="col-md-6 text-md-end mt-3 mt-md-0">
                        <button class="btn btn-success rounded-pill px-4 shadow-sm" data-bs-toggle="modal"
                            data-bs-target="#modalTambahPengasuh">
                            <i class="ti ti-plus me-1"></i>
                            Tambah Pengasuh
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body">

                <form method="GET" action="{{ route('pengasuh') }}">
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
                                    class="form-control border-0 bg-light" placeholder="Cari Pengasuh...">
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
                                <th class="ps-4">Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Tanggal Lahir</th>
                                <th>Alamat</th>
                                <th>No. HP</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody id="pengasuhTable">

                            <!-- User 1 -->
                            @foreach ($pengasuh as $data)
                            <tr>

                                <td><h6 class="mb-0">{{ $data->nama }}</h6></td>
                                <td>{{ $data->jenis_kelamin == 'P' ? 'Perempuan' : 'Laki=laki' }}</td>
                                <td>[{{ Carbon\Carbon::parse($data->tanggal_lahir)->isoFormat('DD MMMM Y') }}]</td>
                                <td>{{ $data->alamat }}</td>
                                <td>{{ $data->no_hp }}</td>
                                <td class="text-center">

                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm rounded-pill" data-bs-toggle="dropdown">
                                            <i class="ti ti-dots"></i>
                                        </button>

                                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                                            <li>
                                                <a class="dropdown-item btn-edit" href="#" data-id="{{ $data->id }}">
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
                        {{ $pengasuh->firstItem() }}
                        sampai
                        {{ $pengasuh->lastItem() }}

                        dari
                        {{ $pengasuh->total() }}
                        data

                    </small>

                    <!-- PAGINATION -->
                    <nav>

                        {{ $pengasuh->links('pagination::bootstrap-5') }}

                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Pengasuh -->
<div class="modal fade" id="modalTambahPengasuh" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Tambah Pengasuh Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="formTambahPengasuh" action="{{ route('pengasuh.post') }}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- DATA DIRI -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Nama Lengkap <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-3" name="nama" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select class="form-select rounded-3" name="jenis_kelamin" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="P">Perempuan</option>
                                <option value="L">Laki-laki</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Tanggal lahir <span class="text-danger">*</span></label>
                            <input type="date" class="form-control rounded-3" name="tanggal_lahir" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">No. HP</label>
                            <input type="number" class="form-control rounded-3" name="no_hp">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-semibold">Alamat</label>
                            <textarea name="alamat" class="form-control rounded-3"></textarea>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-2">
                        <button type="button" class="btn btn-light rounded-pill px-4"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-success rounded-pill px-4 shadow" id="btnDaftar">
                            Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEditPengasuh" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Edit Data Pengasuh</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="formEditPengasuh" method="POST">
                    @csrf
                    <input type="hidden" id="edit_id" name="id">

                    <div class="row">
                        <!-- DATA DIRI -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Nama Lengkap <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-3" name="nama" id="edit_nama" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select class="form-select rounded-3" name="jenis_kelamin" id="edit_jenis_kelamin" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="P">Perempuan</option>
                                <option value="L">Laki-laki</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Tanggal lahir <span class="text-danger">*</span></label>
                            <input type="date" class="form-control rounded-3" name="tanggal_lahir" id="edit_tanggal_lahir" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">No. HP</label>
                            <input type="number" class="form-control rounded-3" id="edit_nohp" name="no_hp">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-semibold">Alamat</label>
                            <textarea name="alamat" class="form-control rounded-3" id="edit_alamat"></textarea>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-3">
                        <button type="button" class="btn btn-light rounded-pill px-4"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success rounded-pill px-4 shadow" id="btnUpdate">Update
                            Data</button>
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

        let rows = document.querySelectorAll('#pengasuhTable tr');

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
    document.getElementById('btnDaftar')
        .addEventListener('click', function() {

            const form = document.getElementById('formTambahPengasuh');

            // VALIDASI
            if (!form.checkValidity()) {

                form.reportValidity();

                return;

            }

            Swal.fire({

                title: 'Simpan Data Pengasuh?',

                text: 'Pastikan data pengasuh sudah benar',

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
                        title: 'Proses',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        },
                        background: '#ffffff',
                        backdrop: `rgba(0,0,0,0.4)`,
                        customClass: {
                            popup: 'border-0 rounded-4 shadow-sm'
                        }
                    });

                    form.requestSubmit();

                }

            });

        });
</script>

<script>
    $(document).ready(function() {

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

            $.get(`/pengasuh/edit/${id}`, function(data) {
                Swal.close(); // Tutup loading fetch

                // Isi form modal dengan data dari database
                $('#edit_id').val(data.id);
                $('#edit_nama').val(data.nama);
                $('#edit_jenis_kelamin').val(data.jenis_kelamin);
                $('#edit_tanggal_lahir').val(data.tanggal_lahir);
                $('#edit_nohp').val(data.no_hp);
                $('#edit_alamat').val(data.alamat);

                // Set action URL form secara dinamis
                $('#formEditPengasuh').attr('action', `/pengasuh/update/${id}`);

                // Tampilkan modal
                $('#modalEditPengasuh').modal('show');
            }).fail(function() {
                Swal.fire('Error', 'Gagal mengambil data pengasuh', 'error');
            });
        });

        // 2. Submit Update dengan Loading Smooth
        $('#formEditPengasuh').on('submit', function(e) {

            e.preventDefault();

            Swal.fire({

                title: 'Memperbarui Data...',

                allowOutsideClick: false,
                allowEscapeKey: false,

                showConfirmButton: false,

                background: '#ffffff',

                customClass: {

                    popup: 'rounded-4'

                },

                didOpen: () => {

                    // LOADING
                    Swal.showLoading();

                    // Z-INDEX DI ATAS MODAL
                    document.querySelector('.swal2-container')
                        .style.zIndex = '9999';

                }

            });

            // SUBMIT FORM
            this.submit();

        });
    });
</script>

<script>
    $('.btn-delete').on('click', function(e) {

        e.preventDefault();

        let id = $(this).data('id');
        let nama = $(this).data('nama');

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

            title: 'Hapus Pengasuh?',

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
                    Apakah Anda yakin ingin menghapus user
                    <br>
                    <strong>${nama}</strong> ?
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
                    .attr('action', `/pengasuh/delete/${id}`)
                    .submit();

            }

        });

    });
</script>
@endsection
@endsection