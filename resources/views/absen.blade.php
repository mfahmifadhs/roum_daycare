<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Absensi DayCare Kemenkes</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #009688, #00bfa5, #4dd0e1);
            min-height: 100vh;
            padding: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .main-card {
            width: 100%;
            max-width: 1400px;
            background: #fff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0, 0, 0, .15);
        }

        .left-side {

            background: linear-gradient(180deg, #e8fffb, #f4fffe);

            min-height: 850px;

            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;

            padding: 50px;
        }

        .logo-kemenkes {
            width: 120px;
            margin-bottom: 30px;
        }

        .illustration {
            width: 100%;
            max-width: 320px;
        }

        .left-title {
            margin-top: 30px;
            text-align: center;
        }

        .left-title h3 {
            color: #00695c;
            font-weight: 700;
        }

        .left-title p {
            color: #666;
        }

        .right-side {
            padding: 50px;
        }

        .page-title {
            font-size: 32px;
            font-weight: 700;
            color: #00695c;
        }

        .subtitle {
            color: #6c757d;
            margin-bottom: 30px;
        }

        .form-control {
            height: 58px;
            border-radius: 16px;
        }

        .scan-box {
            border: 2px dashed #00a896;
            border-radius: 20px;
            padding: 25px;
            background: #f8fffe;
        }

        .table thead th {
            background: #f8f9fa;
            font-size: 14px;
        }

        @media(max-width:991px) {

            .left-side {
                display: none;
            }

            .right-side {
                padding: 25px;
            }
        }
    </style>

</head>

<body>

    <div class="main-card">

        <div class="row g-0">

            {{-- LEFT --}}
            <div class="col-lg-4 left-side">

                <img src="{{ asset('dist/images/logo-kemenkes.png') }}"
                    class="logo-kemenkes">

                <img src="https://cdn-icons-png.flaticon.com/512/3022/3022256.png"
                    class="illustration">

                <div class="left-title">

                    <h3>
                        Absensi DayCare
                    </h3>

                    <p>

                        Scan QR Code peserta untuk
                        Check-In dan Check-Out otomatis

                    </p>

                </div>

            </div>

            {{-- RIGHT --}}
            <div class="col-lg-8 right-side">

                <div class="page-title">
                    Absensi Kehadiran Anak
                </div>

                <div class="subtitle">

                    Scan QR Code atau masukkan kode peserta

                </div>

                {{-- FORM ABSENSI --}}
                <div class="scan-box mb-4">

                    <form id="formAbsensi"
                        action="{{ route('absen.store') }}"
                        method="POST">

                        @csrf

                        <label class="form-label fw-semibold">

                            Kode Peserta

                        </label>

                        <div class="input-group input-group-lg">

                            <span class="input-group-text bg-success text-white">

                                <i class="bi bi-qr-code-scan"></i>

                            </span>

                            <input type="text"
                                class="form-control"
                                name="kode"
                                id="kode"
                                placeholder="Scan QR Code..."
                                autofocus
                                required>

                        </div>

                        <small class="text-muted">

                            QR Scanner akan langsung mengisi kode peserta

                        </small>

                    </form>

                </div>

                {{-- RIWAYAT --}}
                <div class="card border-0 shadow-sm">

                    <div class="card-header bg-white">

                        <div class="d-flex justify-content-between align-items-center">

                            <h5 class="mb-0 fw-bold">

                                Riwayat Kehadiran Hari Ini

                            </h5>

                            <span class="badge bg-success">

                                {{ $dataAbsen->count() }} Kehadiran

                            </span>

                        </div>

                    </div>

                    <div class="table-responsive">

                        <table class="table align-middle mb-0">

                            <thead>

                                <tr>

                                    <th>Nama Anak</th>
                                    <th>Orang Tua</th>
                                    <th>Datang</th>
                                    <th>Pulang</th>
                                    <th>Status</th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($dataAbsen as $item)

                                <tr>

                                    <td>

                                        {{ $item->anak->nama }}

                                    </td>

                                    <td>

                                        {{ $item->anak->user->nama }}

                                    </td>

                                    <td>

                                        @if($item->check_in)

                                        <span class="badge bg-light-success text-success">

                                            {{ \Carbon\Carbon::parse($item->check_in)->format('H:i') }}

                                        </span>

                                        @else

                                        -

                                        @endif

                                    </td>

                                    <td>

                                        @if($item->check_out)

                                        <span class="badge bg-light-primary text-primary">

                                            {{ \Carbon\Carbon::parse($item->check_out)->format('H:i') }}

                                        </span>

                                        @else

                                        -

                                        @endif

                                    </td>

                                    <td>

                                        @if($item->status == 'true')

                                        <span class="badge bg-success">
                                            Hadir
                                        </span>

                                        @elseif($item->status == 'false')

                                        <span class="badge bg-warning">
                                            Tidak Hadir
                                        </span>

                                        @else

                                        <span class="badge bg-danger">
                                            Penalti
                                        </span>

                                        @endif

                                    </td>

                                </tr>

                                @empty

                                <tr>

                                    <td colspan="5"
                                        class="text-center py-5 text-muted">

                                        <i class="bi bi-inbox fs-1 d-block mb-2"></i>

                                        Belum ada data kehadiran

                                    </td>

                                </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script>

        document.addEventListener('DOMContentLoaded', function() {

            const kode = document.getElementById('kode');

            kode.focus();

            kode.addEventListener('change', function() {

                if (this.value.trim() !== '') {

                    document.getElementById(
                        'formAbsensi'
                    ).submit();

                }

            });

        });

    </script>

</body>

</html>