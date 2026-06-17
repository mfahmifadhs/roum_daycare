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
            <div class="col-lg-6 right-side my-auto">

                <!-- TITLE -->
                <div class="text-center">

                    <h2 class="login-title">
                        Selamat Datangs
                    </h2>

                    <div class="subtitle">
                        Silakan login untuk mengakses sistem DayCare Kemenkes
                    </div>

                </div>

                <!-- FORM -->
                <form id="formLogin" action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label">
                            NIP
                        </label>

                        <input type="text" name="nip" class="form-control" placeholder="Masukkan NIP" required>
                    </div>

                    <div class="mb-4">

                        <label class="form-label">
                            Password
                        </label>

                        <div class="password-wrapper">

                            <input type="password" name="password" class="form-control" placeholder="Masukkan password"
                                id="password">

                            <i class="bi bi-eye" id="togglePassword"></i>

                        </div>

                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <div class="form-check remember-me">
                            <input class="form-check-input" type="checkbox" id="remember">

                            <label class="form-check-label" for="remember">
                                Remember Me
                            </label>
                        </div>

                        <a href="#" class="text-decoration-none small">
                            Lupa Password?
                        </a>

                    </div>

                    <button type="button" class="btn btn-primary w-100 btn-login" id="btnLogin">
                        <i class="bi bi-box-arrow-in-right me-2"></i>
                        Login
                    </button>

                    <div class="text-center mt-4 bottom-link">
                        Belum punya akun?
                        <a href="{{ route('register') }}">Daftar Sekarang</a>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

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
        document.getElementById('btnLogin')
            .addEventListener('click', function() {

                const form = document.getElementById('formLogin');

                // VALIDASI
                if (!form.checkValidity()) {

                    form.reportValidity();

                    return;

                }

                // LOADING SPINNER
                Swal.fire({

                    width: '220px',
                    background: 'transparent',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    allowEscapeKey: false,

                    customClass: {
                        popup: 'border-0 shadow-none bg-transparent'
                    },

                    html: `
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="bg-white rounded-circle d-flex justify-content-center align-items-center shadow-lg"
                                style="
                                    width:110px;
                                    height:110px;
                                    border: 6px solid rgba(13,110,253,0.08);
                                ">
                                <div class="spinner-border"
                                    role="status"
                                    style="
                                        width:3.8rem;
                                        height:3.8rem;
                                        color:#0d6efd;
                                        border-width: .35em;
                                    ">
                                </div>
                            </div>
                        </div>
                    `
                });

                // SUBMIT FORM
                setTimeout(() => {

                    form.requestSubmit();

                }, 500);

            });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
    <script>
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: `{!! session('success') !!}`,
            showConfirmButton: false,
            timer: 3000
        });
    </script>
    @endif

    @if (session('error'))
    <script>
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: `{!! session('error') !!}`,
            showConfirmButton: false,
            confirmButtonColor: '#dc3545'
        });
    </script>
    @endif

</body>

</html>