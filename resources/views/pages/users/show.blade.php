@extends('pages.app')

@section('content')
<div class="pc-container">
    <div class="pc-content">

        <!-- Page Header -->
        <div class="page-header mb-4">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h3 class="mb-1">Daftar Users</h3>
                        <p class="text-muted mb-0">
                            Kelola data pegawai penitipan anak
                        </p>
                    </div>

                    <div class="col-md-6 text-md-end mt-3 mt-md-0">
                        <button class="btn btn-success rounded-pill px-4 shadow-sm" data-bs-toggle="modal"
                            data-bs-target="#modalTambahUser">
                            <i class="ti ti-plus me-1"></i>
                            Tambah User
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body">

                <form method="GET" action="{{ route('users') }}">
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
                                    class="form-control border-0 bg-light" placeholder="Cari users...">
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
                                <th class="ps-4">Users</th>
                                <th>NIP/NIK</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody id="userTable">

                            <!-- User 1 -->
                            @foreach ($users as $user)
                            <tr>

                                <td>
                                    <small>[{{ $user->role->role }}]</small>
                                    <h6 class="mb-0">{{ $user->nama }}</h6>
                                    <small class="text-muted">{{ $user->uker->nama_uker }}</small>
                                </td>
                                <td>{{ $user->nip }}</td>
                                <td>[{{ $user->email }}]</td>
                                <td>
                                    <span class="badge bg-light-success text-success">
                                        Aktif
                                    </span>
                                </td>
                                <td class="text-center">

                                    <div class="dropdown">

                                        <button class="btn btn-light btn-sm rounded-pill" data-bs-toggle="dropdown">

                                            <i class="ti ti-dots"></i>

                                        </button>

                                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow">

                                            <li>
                                                <a class="dropdown-item btn-detail" href="#" data-id="{{ $user->id }}">
                                                    Detail
                                                </a>
                                            </li>

                                            <li>
                                                <a class="dropdown-item btn-edit" href="#" data-id="{{ $user->id }}">
                                                    Edit
                                                </a>
                                            </li>

                                            <li>
                                                <a
                                                    class="dropdown-item text-danger btn-delete"
                                                    href="#"
                                                    data-id="{{ $user->id }}"
                                                    data-nama="{{ $user->nama }}">

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
                        {{ $users->firstItem() }}
                        sampai
                        {{ $users->lastItem() }}

                        dari
                        {{ $users->total() }}
                        data

                    </small>

                    <!-- PAGINATION -->
                    <nav>

                        {{ $users->links('pagination::bootstrap-5') }}

                    </nav>

                </div>

            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah User -->
<div class="modal fade" id="modalTambahUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Tambah Pengguna Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="formTambahUser" action="{{ route('register.post') }}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- ROLE & UNIT -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Role <span class="text-danger">*</span></label>
                            <select class="form-select rounded-3" name="role_id" required>
                                <option value="">Pilih Role</option>
                                @foreach ($data->role as $item)
                                <option value="{{ $item->id }}">{{ $item->role }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Unit Utama <span class="text-danger">*</span></label>
                            <select class="form-select rounded-3" id="unitUtama" name="utama" required>
                                <option value="">Pilih Unit Utama</option>
                                @foreach ($data->utama as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_utama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Unit Kerja <span class="text-danger">*</span></label>
                            <select class="form-select rounded-3" id="unitKerja" name="uker_id" required>
                                <option value="">Pilih Unit Kerja</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">NIP <span class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-3" id="nip" name="nip"
                                placeholder="Cek NIP..." required>
                            <div id="nipMessage" class="text-danger small mt-1 d-none">NIP sudah digunakan</div>
                        </div>

                        <!-- DATA DIRI -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Nama Lengkap <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-3" name="nama" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">NIK <span class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-3" name="nik" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Jabatan</label>
                            <input type="text" class="form-control rounded-3" name="jabatan">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Golongan</label>
                            <input type="text" class="form-control rounded-3" name="golongan">
                        </div>

                        <!-- KONTAK & AKSES -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control rounded-3" name="email" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">No HP <span class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-3" name="no_hp" required>
                        </div>

                        <div class="col-12 mb-4">
                            <label class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="password" class="form-control rounded-start-3" id="modalPass"
                                    name="password" required>
                                <button class="btn btn-outline-secondary rounded-end-3" type="button" id="btnShowPass">
                                    <i class="ti ti-eye" id="iconPass"></i>
                                </button>
                            </div>
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
<div class="modal fade" id="modalEditUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Edit Data Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="formEditUser" method="POST">
                    @csrf
                    <input type="hidden" id="edit_id" name="id">

                    <div class="row">
                        <!-- BARIS 1: ROLE & NIP -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Role <span class="text-danger">*</span></label>
                            <select class="form-select rounded-3" id="edit_role" name="role_id" required>
                                @foreach ($data->role as $item)
                                <option value="{{ $item->id }}">{{ $item->role }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">NIP <span class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-3" id="edit_nip" name="nip" required>
                        </div>

                        <!-- BARIS 2: UNIT UTAMA & UNIT KERJA -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Unit Utama <span class="text-danger">*</span></label>
                            <select class="form-select rounded-3" id="edit_utama" name="utama_id" required>
                                <option value="">Pilih Unit Utama</option>
                                @foreach ($data->utama as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_utama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Unit Kerja <span class="text-danger">*</span></label>
                            <select class="form-select rounded-3" id="edit_unitKerja" name="uker_id" required>
                                <option value="">Pilih Unit Kerja</option>
                            </select>
                        </div>

                        <!-- BARIS 3: NAMA & NIK -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Nama Lengkap <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-3" id="edit_nama" name="nama" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">NIK <span class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-3" id="edit_nik" name="nik" required>
                        </div>

                        <!-- BARIS 4: JABATAN & EMAIL -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Jabatan</label>
                            <input type="text" class="form-control rounded-3" id="edit_jabatan" name="jabatan">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Golongan</label>
                            <input type="text" class="form-control rounded-3" id="edit_golongan" name="golongan">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control rounded-3" id="edit_email" name="email" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">No. HP <span class="text-danger">*</span></label>
                            <input type="number" class="form-control rounded-3" id="edit_no_hp" name="no_hp" required>
                        </div>

                        <!-- BARIS 5: PASSWORD (SHOW/HIDE) -->
                        <div class="col-12 mb-3">
                            <label class="form-label fw-semibold">Password Baru (Kosongkan jika tidak ganti)</label>
                            <div class="input-group">
                                <input type="password" class="form-control rounded-start-3" id="edit_password"
                                    name="password" placeholder="********">
                                <button class="btn btn-outline-secondary rounded-end-3" type="button" id="btnEditPass">
                                    <i class="ti ti-eye" id="iconEditPass"></i>
                                </button>
                            </div>
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

        let rows = document.querySelectorAll('#userTable tr');

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
    $('#btnShowPass').click(function() {
        const passInput = $('#modalPass');
        const icon = $('#iconPass');
        if (passInput.attr('type') === 'password') {
            passInput.attr('type', 'text');
            icon.removeClass('ti-eye').addClass('ti-eye-off');
        } else {
            passInput.attr('type', 'password');
            icon.removeClass('ti-eye-off').addClass('ti-eye');
        }
    });
</script>

<script>
    $('#unitUtama').on('change', function() {

        let id = $(this).val();
        console.log('Unit Utama ID:', id);

        $('#unitKerja').html(
            '<option>Loading...</option>'
        );

        $.ajax({

            url: '/getUker/' + id,
            type: 'GET',

            success: function(data) {

                let html = '<option value="">Pilih Unit Kerja</option>';

                data.forEach(function(item) {

                    html += `
                        <option value="${item.id}">
                            ${item.nama_uker}
                        </option>
                    `;

                });

                $('#unitKerja').html(html);

            }

        });

    });
</script>

<script>
    let nipValid = false;

    // CEK NIP REALTIME
    $('#nip').on('keyup', function() {

        let nip = $(this).val();

        if (nip.length < 3) {

            $('#nipMessage')
                .addClass('d-none');

            $('#btnDaftar')
                .prop('disabled', true);

            return;

        }

        $.ajax({

            url: '/check-nip',
            type: 'GET',
            data: {
                nip: nip
            },

            success: function(response) {

                if (response.exists) {

                    nipValid = false;

                    $('#nipMessage')
                        .removeClass('d-none');

                    $('#btnDaftar')
                        .prop('disabled', true);

                } else {

                    nipValid = true;

                    $('#nipMessage')
                        .addClass('d-none');

                    $('#btnDaftar')
                        .prop('disabled', false);

                }

            }

        });

    });
</script>

<script>
    document.getElementById('btnDaftar')
        .addEventListener('click', function() {

            const form = document.getElementById('formTambahUser');

            // VALIDASI
            if (!form.checkValidity()) {

                form.reportValidity();

                return;

            }

            Swal.fire({

                title: 'Simpan Data User?',

                text: 'Pastikan data user sudah benar',

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
        $('#btnEditPass').click(function() {
            // Pastikan ID ini sesuai dengan atribut id di tag <input> dan <i>
            const passInput = $('#edit_password');
            const icon = $('#iconEditPass');

            if (passInput.attr('type') === 'password') {
                passInput.attr('type', 'text');
                // Ganti icon menjadi mata tertutup (eye-off)
                icon.removeClass('ti-eye').addClass('ti-eye-off');
            } else {
                passInput.attr('type', 'password');
                // Ganti icon kembali ke mata terbuka
                icon.removeClass('ti-eye-off').addClass('ti-eye');
            }
        });

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

            $.get(`/users/edit/${id}`, function(data) {
                Swal.close(); // Tutup loading fetch
                console.log('Data user yang diambil:', data);

                // Isi form modal dengan data dari database
                $('#edit_id').val(data.id);
                $('#edit_nama').val(data.nama);
                $('#edit_jabatan').val(data.jabatan);
                $('#edit_golongan').val(data.golongan);
                $('#edit_email').val(data.email);
                $('#edit_nik').val(data.nik);
                $('#edit_nip').val(data.nip);
                $('#edit_no_hp').val(data.no_hp);
                $('#edit_role').val(data.role_id);
                $('#edit_utama').val(data.uker.utama_id);
                $('#edit_unitKerja').html(`
                    <option value="${data.uker_id}" selected>
                        ${data.uker.nama_uker}
                    </option>
                `);

                // Set action URL form secara dinamis
                $('#formEditUser').attr('action', `/users/update/${id}`);

                // Tampilkan modal
                $('#modalEditUser').modal('show');
            }).fail(function() {
                Swal.fire('Error', 'Gagal mengambil data user', 'error');
            });
        });

        $('#edit_utama').change(function() {
            loadUnitKerja($(this).val());
        });

        function loadUnitKerja(utamaId, selectedId = null) {
            if (!utamaId) return;

            console.log('Load Unit Kerja untuk Utama ID:', utamaId);

            $('#edit_unitKerja').html('<option value="">Loading...</option>');
            $.get(`/getUker/${utamaId}`, function(res) {
                let options = '<option value="">Pilih Unit Kerja</option>';
                res.forEach(item => {
                    let selected = (selectedId == item.id) ? 'selected' : '';
                    options += `<option value="${item.id}" ${selected}>${item.nama_uker}</option>`;
                });
                $('#edit_unitKerja').html(options);
            });
        }

        // 2. Submit Update dengan Loading Smooth
        $('#formEditUser').on('submit', function(e) {

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
    $(document).ready(function() {
        $('#formTambahUser').on('submit', function(e) {
            e.preventDefault();

            const form = this;

            Swal.fire({
                title: 'Simpan Data?',
                text: "Pastikan data yang diinput sudah benar.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Simpan!',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#00ab55', // Hijau modern (Success)
                cancelButtonColor: '#f4f6f8',
                customClass: {
                    popup: 'rounded-4',
                    confirmButton: 'rounded-pill px-4',
                    cancelButton: 'rounded-pill px-4 text-dark'
                },
                reverseButtons: true // Tombol batal di kiri
            }).then((result) => {
                if (result.isConfirmed) {
                    // Tampilkan Loading Smooth setelah dikonfirmasi
                    Swal.fire({
                        title: 'Sedang Memproses...',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        },
                        background: '#ffffff',
                        backdrop: `rgba(0,0,0,0.2)`,
                        customClass: {
                            popup: 'rounded-4 border-0 shadow-sm'
                        }
                    });

                    // Kirim form ke server
                    form.submit();
                }
            });
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

            title: 'Hapus User?',

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
                    .attr('action', `/users/delete/${id}`)
                    .submit();

            }

        });

    });
</script>
@endsection
@endsection