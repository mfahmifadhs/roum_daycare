@extends('pages.app')

@section('content')
<div class="pc-container">
    <div class="pc-content">
        <div class="container py-4">

            <div class="row justify-content-center">

                <div class="col-lg-7">

                    <div class="card border-0 shadow rounded-4">

                        <div class="card-body p-4">

                            <h4 class="fw-bold mb-4">Profil Pengguna</h4>

                            <form id="formProfile" method="POST" action="{{ route('profile.update') }}">
                                @csrf
                                <!-- UNIT UTAMA -->
                                <div class="mb-3">
                                    <label class="form-label">Unit Utama</label>
                                    <input type="text" class="form-control"
                                        value="{{ $user->uker->utama->nama_utama }}" disabled>
                                </div>

                                <!-- UNIT KERJA -->
                                <div class="mb-3">
                                    <label class="form-label">Unit Kerja</label>
                                    <input type="text" class="form-control" value="{{ $user->uker->nama_uker }}"
                                        disabled>
                                </div>

                                <!-- NAMA -->
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" name="nama" class="form-control"
                                        value="{{ $user->nama }}" required>
                                </div>

                                <!-- NIK -->
                                <div class="mb-3">
                                    <label class="form-label">NIK</label>
                                    <input type="text" name="nik" class="form-control"
                                        value="{{ $user->nik }}" required>
                                </div>

                                <!-- NIP -->
                                <div class="mb-3">
                                    <label class="form-label">NIP</label>
                                    <input type="text" name="nip" class="form-control"
                                        value="{{ $user->nip }}">
                                </div>

                                <!-- JABATAN -->
                                <div class="mb-3">
                                    <label class="form-label">Jabatan</label>
                                    <input type="text" name="jabatan" class="form-control"
                                        value="{{ $user->jabatan }}">
                                </div>

                                <!-- GOLONGAN -->
                                <div class="mb-3">
                                    <label class="form-label">Golongan</label>
                                    <input type="text" name="golongan" class="form-control"
                                        value="{{ $user->golongan }}">
                                </div>

                                <!-- EMAIL -->
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control"
                                        value="{{ $user->email }}" required>
                                </div>

                                <!-- NO HP -->
                                <div class="mb-3">
                                    <label class="form-label">No HP</label>
                                    <input type="text" name="no_hp" class="form-control"
                                        value="{{ $user->no_hp }}" required>
                                </div>

                                <div class="mb-3">
                                    <label>Ganti Password (opsional)</label>
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control" id="password">
                                        <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                            👁
                                        </button>
                                    </div>
                                    <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
                                </div>

                                <button type="button" id="btnSaveProfile" class="btn btn-primary w-100 rounded-pill">
                                    Simpan Perubahan
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>
</div>
@section('js')
@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session('success ') }}'
    });
</script>
@endif

<script>
    document.getElementById('btnSaveProfile')
        .addEventListener('click', function() {

            const form = document.getElementById('formProfile');

            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            Swal.fire({

                title: 'Simpan Perubahan?',
                text: 'Data profil akan diperbarui',
                icon: 'question',

                showCancelButton: true,
                confirmButtonText: 'Ya, Simpan',
                cancelButtonText: 'Batal',

                customClass: {
                    popup: 'rounded-4',
                    confirmButton: 'btn btn-primary rounded-pill px-4',
                    cancelButton: 'btn btn-light rounded-pill px-4'
                },

                buttonsStyling: false

            }).then((result) => {

                if (result.isConfirmed) {

                    Swal.fire({

                        title: 'Menyimpan...',
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading()

                    });

                    form.submit();

                }

            });

        });
</script>

<script>
    document.getElementById('togglePassword')
        .addEventListener('click', function() {

            const input = document.getElementById('password');

            if (input.type === 'password') {
                input.type = 'text';
            } else {
                input.type = 'password';
            }

        });
</script>
@endsection
@endsection