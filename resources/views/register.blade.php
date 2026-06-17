<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login DayCare Kemenkes</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #009688, #00bfa5, #4dd0e1);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
        }

        .login-modal {
            width: 100%;
            max-width: 1200px;
            background: #fff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .left-side {
            background: linear-gradient(180deg, #e8fffb, #f4fffe);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 50px;
            min-height: 720px;
            position: relative;
        }

        .left-side::before {
            content: "";
            position: absolute;
            width: 350px;
            height: 350px;
            background: rgba(0, 150, 136, 0.08);
            border-radius: 50%;
            top: -80px;
            left: -80px;
        }

        .left-side::after {
            content: "";
            position: absolute;
            width: 280px;
            height: 280px;
            background: rgba(77, 208, 225, 0.12);
            border-radius: 50%;
            bottom: -60px;
            right: -60px;
        }

        .logo-kemenkes {
            width: 120px;
            margin-bottom: 30px;
            z-index: 2;
        }

        .illustration {
            width: 100%;
            max-width: 360px;
            z-index: 2;
        }

        .left-text {
            text-align: center;
            margin-top: 30px;
            z-index: 2;
        }

        .left-text h3 {
            font-size: 30px;
            font-weight: 700;
            color: #00695c;
        }

        .left-text p {
            color: #5f6d7a;
            font-size: 15px;
        }

        .right-side {
            padding: 55px 70px;
            position: relative;
        }

        .close-btn {
            position: absolute;
            top: 25px;
            right: 25px;
            font-size: 24px;
            color: #555;
            cursor: pointer;
        }

        .social-btn {
            height: 48px;
            font-size: 14px;
            font-weight: 500;
            border-radius: 10px;
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 15px;
            margin: 30px 0;
            color: #999;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: #ddd;
        }

        .login-title {
            font-size: 30px;
            font-weight: 700;
            color: #00695c;
            margin-bottom: 10px;
        }

        .subtitle {
            color: #7b8794;
            font-size: 14px;
            margin-bottom: 35px;
        }

        .form-label {
            font-size: 14px;
            font-weight: 500;
            color: #555;
        }

        .form-control {
            height: 54px;
            border-radius: 14px;
            border: 1px solid #d8e2e7;
            padding-left: 18px;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: #00a896;
            box-shadow: 0 0 0 0.15rem rgba(0, 168, 150, 0.2);
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper i {
            position: absolute;
            top: 50%;
            right: 18px;
            transform: translateY(-50%);
            color: #777;
            cursor: pointer;
        }

        .remember-me {
            font-size: 14px;
            color: #555;
        }

        .form-check-input:checked {
            background-color: #00a896;
            border-color: #00a896;
        }

        .btn-login {
            height: 54px;
            border-radius: 14px;
            background: linear-gradient(to right, #00a896, #00c2a8);
            border: none;
            font-weight: 600;
            font-size: 16px;
        }

        .btn-login:hover {
            background: linear-gradient(to right, #009688, #00bfa5);
        }

        .bottom-link {
            font-size: 14px;
            color: #666;
        }

        .bottom-link a {
            text-decoration: none;
            font-weight: 600;
            color: #00a896;
        }

        @media(max-width: 991px) {

            body {
                padding: 15px;
            }

            .left-side {
                display: none;
            }

            .right-side {
                padding: 40px 25px;
            }
        }
    </style>
</head>

<body>

    <div class="login-modal">

        <div class="row g-0">

            <!-- LEFT SIDE -->
            <div class="col-lg-6 left-side">

                <!-- LOGO KEMENKES -->
                <img src="{{ asset('dist/images/logo-kemenkes.png') }}" alt="Logo Kemenkes" class="logo-kemenkes">

                <!-- ILLUSTRATION -->
                <img src="https://cdn-icons-png.flaticon.com/512/6195/6195699.png" alt="Illustration"
                    class="illustration">

                <div class="left-text">
                    <h3>DayCare Kemenkes</h3>
                    <p>
                        Sistem Informasi Pelayanan dan Monitoring DayCare<br>
                        Kementerian Kesehatan Republik Indonesia
                    </p>
                </div>

            </div>

            <!-- RIGHT SIDE -->
            <div class="col-lg-6 right-side">

                <!-- TITLE -->
                <div class="text-center mb-4">

                    <h2 class="login-title">
                        Pendaftaran Akun
                    </h2>

                    <div class="subtitle">
                        Silakan lengkapi data untuk membuat akun DayCare Kemenkes
                    </div>

                </div>

                <!-- FORM -->
                <form id="formRegister" action="{{ route('register.post') }}" method="POST">
                    @csrf

                    <!-- UNIT UTAMA -->
                    <div class="mb-4">
                        <label class="form-label">
                            Unit Utama <span class="text-danger">*</span>
                        </label>

                        <select class="form-select" id="unitUtama" required>
                            <option value="">Pilih Unit Utama</option>
                            @foreach ($utama as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->nama_utama }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- UNIT KERJA -->
                    <div class="mb-4">
                        <label class="form-label">
                            Unit Kerja <span class="text-danger">*</span>
                        </label>

                        <select class="form-select" id="unitKerja" name="uker_id" required>
                            <option value="">Pilih Unit Kerja</option>
                        </select>
                    </div>

                    <!-- NAMA -->
                    <div class="mb-4">
                        <label class="form-label">
                            Nama Lengkap <span class="text-danger">*</span>
                        </label>

                        <input type="text" class="form-control" placeholder="Masukkan nama lengkap" name="nama"
                            required>
                    </div>

                    <!-- NIK -->
                    <div class="mb-4">
                        <label class="form-label">
                            NIK <span class="text-danger">*</span>
                        </label>

                        <input type="text" class="form-control" placeholder="Masukkan NIK" name="nik" required>
                    </div>

                    <!-- NIP -->
                    <div class="mb-4">
                        <label class="form-label">
                            NIP <span class="text-danger">*</span>
                        </label>

                        <input type="text" class="form-control" placeholder="Masukkan NIP" id="nip" name="nip" required>


                        <small id="nipMessage" class="text-danger d-none">
                            NIP sudah digunakan
                        </small>
                    </div>

                    <!-- JABATAN -->
                    <div class="mb-4">
                        <label class="form-label">
                            Jabatan
                        </label>

                        <input type="text" class="form-control" placeholder="Masukkan jabatan" name="jabatan">
                    </div>

                    <!-- GOLONGAN -->
                    <div class="mb-4">
                        <label class="form-label">
                            Golongan
                        </label>

                        <input type="text" class="form-control" placeholder="Masukkan golongan" name="golongan">
                    </div>

                    <!-- EMAIL -->
                    <div class="mb-4">
                        <label class="form-label">
                            Email <span class="text-danger">*</span>
                        </label>

                        <input type="email" class="form-control" placeholder="Masukkan email" name="email" required>
                    </div>

                    <!-- NO HP -->
                    <div class="mb-4">
                        <label class="form-label">
                            No HP <span class="text-danger">*</span>
                        </label>

                        <input type="text" class="form-control" placeholder="Masukkan nomor HP" name="no_hp" required>
                    </div>

                    <!-- PASSWORD -->
                    <div class="mb-4">

                        <label class="form-label">
                            Password <span class="text-danger">*</span>
                        </label>

                        <div class="password-wrapper">

                            <input type="password" class="form-control" placeholder="Masukkan password" name="password"
                                id="password" required>

                            <i class="bi bi-eye" id="togglePassword"></i>

                        </div>

                    </div>

                    <!-- BUTTON -->
                    <button type="button" class="btn btn-primary w-100 btn-login" id="btnDaftar">
                        <i class="bi bi-person-plus me-2"></i>
                        Daftar Akun
                    </button>

                    <!-- LOGIN LINK -->
                    <div class="text-center mt-4 bottom-link">
                        Sudah punya akun?
                        <a href="{{ route('login') }}">Login Sekarang</a>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');

        togglePassword.addEventListener('click', function() {

            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';

            password.setAttribute('type', type);

            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });
    </script>

    <script>
        $('#unitUtama').on('change', function() {

            let id = $(this).val();

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
        document.getElementById('btnDaftar')
            .addEventListener('click', function() {

                const form = document.getElementById('formRegister');

                // VALIDASI FORM
                if (!form.checkValidity()) {

                    form.reportValidity();

                    return;

                }

                // SWEET ALERT
                Swal.fire({

                    width: '420px',

                    background: '#fff',

                    showCloseButton: true,

                    showConfirmButton: true,
                    showCancelButton: true,

                    confirmButtonText: `
            <i class="bi bi-check-lg me-1"></i>
            Ya, Daftar
        `,

                    cancelButtonText: 'Tidak',

                    customClass: {

                        popup: 'rounded-4 border-0 shadow',
                        title: 'fw-bold fs-4',
                        htmlContainer: 'text-muted',
                        confirmButton: 'btn btn-success rounded-pill px-4',
                        cancelButton: 'btn btn-light rounded-pill px-4 me-2'

                    },

                    buttonsStyling: false,

                    title: 'Daftar Akun?',

                    html: `

            <div class="text-center py-2">

                <div class="mb-4">

                    <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center"
                        style="width:80px;height:80px;">

                        <i class="bi bi-person-check text-success"
                            style="font-size:35px;">
                        </i>

                    </div>

                </div>

                <p class="text-muted mb-0">
                    Apakah Anda yakin ingin membuat akun DayCare Kemenkes?
                </p>

            </div>

        `

                }).then((result) => {

                    if (result.isConfirmed) {

                        Swal.fire({

                            html: `

                        <div class="py-3">

                            <div class="spinner-border text-success mb-3"
                                style="width: 3rem; height: 3rem;"
                                role="status">
                            </div>

                            <h5 class="mb-1 fw-semibold">
                                Memproses...
                            </h5>

                        </div>

                    `,

                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showConfirmButton: false,

                            background: '#fff',

                            customClass: {
                                popup: 'border-0 rounded-4 shadow-sm'
                            }

                        });

                        form.submit();

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

</body>

</html>