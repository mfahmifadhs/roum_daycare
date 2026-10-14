<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penilaian Anak | TPA Kemenkes</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        rel="stylesheet">

    <style>
        :root {
            --primary: #168653;
            --primary-dark: #106b42;
            --primary-light: #eaf7ef;
            --text-dark: #25352d;
            --text-muted: #748078;
        }

        body {
            min-height: 100vh;
            margin: 0;
            background: #f4f7f5;
            color: var(--text-dark);
            font-family: "Segoe UI", Arial, sans-serif;
        }

        .navbar-custom {
            background: #fff;
            border-bottom: 1px solid #e8eee9;
            padding: 16px 0;
        }

        .brand-icon {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            background: var(--primary-light);
            color: var(--primary);
            border-radius: 13px;
            font-size: 21px;
        }

        .brand-title {
            font-size: 17px;
            font-weight: 700;
            margin: 0;
        }

        .brand-subtitle {
            color: var(--text-muted);
            font-size: 12px;
            margin-top: 3px;
        }

        .main-container {
            max-width: 760px;
            padding-top: 42px;
            padding-bottom: 40px;
        }

        .page-heading {
            text-align: center;
            margin-bottom: 27px;
        }

        .heading-icon {
            width: 68px;
            height: 68px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            background: var(--primary-light);
            color: var(--primary);
            border-radius: 20px;
            font-size: 28px;
        }

        .page-heading h1 {
            font-size: 27px;
            font-weight: 750;
            margin-bottom: 9px;
        }

        .page-heading p {
            color: var(--text-muted);
            font-size: 14px;
            margin-bottom: 0;
        }

        .main-card {
            background: #fff;
            border: 1px solid #e9eeea;
            border-radius: 19px;
            padding: 30px;
            box-shadow: 0 8px 30px rgba(31, 65, 43, .045);
        }

        .section-title {
            font-size: 17px;
            font-weight: 700;
            margin-bottom: 7px;
        }

        .section-description {
            color: var(--text-muted);
            font-size: 13px;
            margin-bottom: 25px;
        }

        .form-label {
            font-size: 13px;
            font-weight: 650;
            margin-bottom: 8px;
        }

        .form-control {
            min-height: 49px;
            border-radius: 10px;
            border-color: #dfe6e1;
            font-size: 14px;
            padding: 12px 14px;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(22, 134, 83, .11);
        }

        .input-group .input-group-text {
            background: #f8faf8;
            border-color: #dfe6e1;
            color: #718078;
            border-radius: 10px 0 0 10px;
        }

        .input-group .form-control {
            border-radius: 0 10px 10px 0;
        }

        .btn-check-data {
            min-height: 49px;
            border: none;
            border-radius: 10px;
            background: var(--primary);
            color: #fff;
            font-weight: 650;
            transition: .2s;
        }

        .btn-check-data:hover {
            background: var(--primary-dark);
            color: #fff;
        }

        .result-card {
            margin-top: 25px;
            border: 1px solid #dcebe1;
            border-radius: 14px;
            overflow: hidden;
        }

        .result-header {
            padding: 17px 20px;
            background: #eff9f2;
            color: var(--primary-dark);
        }

        .result-header h2 {
            font-size: 15px;
            font-weight: 700;
            margin: 0 0 5px;
        }

        .result-header p {
            font-size: 12px;
            margin: 0;
        }

        .result-body {
            padding: 20px;
        }

        .info-section-title {
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .info-row {
            display: flex;
            gap: 15px;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #f0f2f0;
            font-size: 13px;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: var(--text-muted);
        }

        .info-value {
            font-weight: 600;
            text-align: right;
            overflow-wrap: anywhere;
        }

        .btn-assessment {
            min-height: 49px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            width: 100%;
            border: none;
            border-radius: 10px;
            background: var(--primary);
            color: white;
            font-size: 14px;
            font-weight: 650;
        }

        .btn-assessment:hover {
            background: var(--primary-dark);
            color: white;
        }

        .footer-text {
            text-align: center;
            color: #8a968e;
            font-size: 12px;
            margin-top: 25px;
        }

        .alert {
            border-radius: 11px;
            font-size: 13px;
        }

        @media (max-width: 576px) {
            .navbar-custom {
                padding: 12px 0;
            }

            .brand-icon {
                width: 40px;
                height: 40px;
            }

            .brand-title {
                font-size: 15px;
            }

            .main-container {
                padding: 28px 15px;
            }

            .page-heading {
                margin-bottom: 22px;
            }

            .page-heading h1 {
                font-size: 23px;
            }

            .heading-icon {
                width: 59px;
                height: 59px;
                font-size: 24px;
            }

            .main-card {
                padding: 21px 17px;
                border-radius: 15px;
            }

            .result-body {
                padding: 16px;
            }

            .info-row {
                gap: 12px;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar-custom">
        <div class="container d-flex align-items-center gap-3">
            <div class="brand-icon">
                <i class="fa-solid fa-child-reaching"></i>
            </div>

            <div>
                <p class="brand-title">TPA Kementerian Kesehatan</p>
                <div class="brand-subtitle">Sistem Informasi Penitipan Anak</div>
            </div>
        </div>
    </nav>

    <main class="container main-container">

        <div class="page-heading">
            <div class="heading-icon">
                <i class="fa-solid fa-clipboard-check"></i>
            </div>

            <h1>Penilaian Anak</h1>
            <p>Verifikasi data pengasuh dan anak sebelum melakukan penilaian.</p>
        </div>

        <div class="main-card">

            <div class="section-title">
                <i class="fa-solid fa-magnifying-glass me-2"
                    style="color: var(--primary)"></i>
                Verifikasi Data
            </div>

            <p class="section-description">
                Masukkan kode pengasuh, kode anak, dan tanggal penilaian.
            </p>

            {{-- Pesan validasi --}}
            @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <div class="fw-bold mb-1">
                    <i class="fa-solid fa-circle-exclamation me-1"></i>
                    Data belum dapat diverifikasi
                </div>

                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- Form pencarian --}}
            <form id="formCheck" action="{{ route('laporan.check') }}"
                method="POST">
                @csrf

                <div class="mb-3">
                    <label for="kode_pengasuh" class="form-label">
                        Kode Pengasuh
                    </label>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa-solid fa-user-nurse"></i>
                        </span>

                        <input type="text"
                            class="form-control"
                            id="kode_pengasuh"
                            name="kode_pengasuh"
                            value="{{ old('kode_pengasuh') }}"
                            placeholder="Masukkan kode pengasuh"
                            autocomplete="off"
                            required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="kode_anak" class="form-label">
                        Kode Anak
                    </label>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa-solid fa-child"></i>
                        </span>

                        <input type="text"
                            class="form-control"
                            id="kode_anak"
                            name="kode_anak"
                            value="{{ old('kode_anak') }}"
                            placeholder="Masukkan kode anak"
                            autocomplete="off"
                            required>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="tanggal" class="form-label">
                        Tanggal Penilaian
                    </label>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa-solid fa-calendar-days"></i>
                        </span>

                        <input type="date"
                            class="form-control"
                            id="tanggal"
                            name="tanggal"
                            value="{{ old('tanggal', now()->format('Y-m-d')) }}"
                            required>
                    </div>
                </div>

                <button type="submit" id="btnCheck()" class="btn btn-check-data w-100">
                    <i class="fa-solid fa-magnifying-glass me-2"></i>
                    Check Data
                </button>
            </form>

            {{-- Hasil verifikasi --}}
            @if (isset($pengasuh) && isset($anak))

            <div class="result-card">

                <div class="result-header">
                    <h2>
                        <i class="fa-solid fa-circle-check me-2"></i>
                        Data Berhasil Diverifikasi
                    </h2>
                    <p>Pastikan informasi pengasuh dan anak sudah benar.</p>
                </div>

                <div class="result-body">

                    <div class="info-section-title">
                        <i class="fa-solid fa-user-nurse me-2"
                            style="color: var(--primary)"></i>
                        Informasi Pengasuh
                    </div>

                    <div class="info-row">
                        <span class="info-label">Kode Pengasuh</span>
                        <span class="info-value">
                            {{ $pengasuh->kode }}
                        </span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Nama Pengasuh</span>
                        <span class="info-value">
                            {{ $pengasuh->nama }}
                        </span>
                    </div>

                    <hr class="my-4">

                    <div class="info-section-title">
                        <i class="fa-solid fa-child me-2"
                            style="color: var(--primary)"></i>
                        Informasi Anak
                    </div>

                    <div class="info-row">
                        <span class="info-label">Kode Anak</span>
                        <span class="info-value">
                            {{ $anak->kode }}
                        </span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Nama Anak</span>
                        <span class="info-value">
                            {{ $anak->nama }}
                        </span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Tanggal Penilaian</span>
                        <span class="info-value">
                            {{ \Carbon\Carbon::parse(
                                request('tanggal', old('tanggal', now()))
                            )->format('d/m/Y') }}
                        </span>
                    </div>

                    <form action="{{ route('laporan.create', $peserta->id) }}"
                        method="GET"
                        class="mt-4">
                        @csrf

                        <input type="hidden"
                            name="kode_pengasuh"
                            value="{{ $pengasuh->kode }}">

                        <input type="hidden"
                            name="kode_anak"
                            value="{{ $anak->kode }}">

                        <input type="hidden"
                            name="tanggal"
                            value="{{ request('tanggal', old('tanggal', now()->format('Y-m-d'))) }}">

                        <button type="submit" class="btn btn-assessment">
                            <i class="fa-solid fa-clipboard-list"></i>
                            Lakukan Penilaian
                            <i class="fa-solid fa-arrow-right ms-auto"></i>
                        </button>
                    </form>

                </div>
            </div>
            @endif

        </div>

        <div class="footer-text">
            TPA Kementerian Kesehatan Republik Indonesia
            <br>
            Sistem Informasi Penilaian Anak
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById('btnCheck')
            .addEventListener('click', function() {

                const form = document.getElementById('formCheck');

                Swal.fire({
                    title: 'Loading',
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

            });
    </script>


    @if (session('error'))
    <script>
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: "{{ session('error') }}", // Diperbaiki: satu baris
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
    </script>
    @endif

    @if (session('success'))
    <script>
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: "{{ session('success') }}", // Diperbaiki: satu baris & gunakan kutip dua
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true, // Tambahan agar lebih modern
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
    </script>
    @endif

</body>

</html>