<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Bulanan Anak</title>

    <style>
        @page {
            margin: 25px 30px;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            color: #333;
            line-height: 1.5;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #168653;
            padding-bottom: 12px;
            margin-bottom: 18px;
        }

        .header h2 {
            margin: 0;
            color: #168653;
            font-size: 17px;
        }

        .header p {
            margin: 4px 0 0;
            font-size: 10px;
        }

        .section-title {
            background: #eaf5ef;
            color: #106b42;
            font-weight: bold;
            padding: 7px 9px;
            margin-top: 15px;
            margin-bottom: 7px;
            border-left: 4px solid #168653;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 6px 7px;
            vertical-align: top;
        }

        th {
            background: #f2f5f3;
            font-weight: bold;
        }

        .no-border td {
            border: none;
            padding: 3px 5px;
        }

        .label {
            width: 28%;
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        .number {
            font-size: 17px;
            font-weight: bold;
            color: #168653;
        }

        .muted {
            color: #777;
        }

        .empty {
            color: #888;
            font-style: italic;
            text-align: center;
        }

        .footer {
            margin-top: 25px;
            text-align: right;
            font-size: 9px;
            color: #777;
        }
    </style>
</head>

<body>

    {{-- HEADER --}}
    <div class="header">
        <h2>LAPORAN BULANAN PERKEMBANGAN ANAK</h2>
        <p>
            Periode {{ $namaBulan }} {{ $tahun }}
        </p>
    </div>

    {{-- 1. IDENTITAS ANAK --}}
    <div class="section-title">1. IDENTITAS ANAK</div>

    <table class="no-border">
        <tr>
            <td class="label">Nama Anak</td>
            <td>: {{ $anak->nama }}</td>
        </tr>
        <tr>
            <td class="label">Tempat, Tanggal Lahir</td>
            <td>
                : {{ $anak->tempat_lahir ?? '-' }},
                {{ $anak->tanggal_lahir
                    ? \Carbon\Carbon::parse($anak->tanggal_lahir)->translatedFormat('d F Y')
                    : '-' }}
            </td>
        </tr>
        <tr>
            <td class="label">Jenis Kelamin</td>
            <td>: {{ $anak->jenis_kelamin ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Nama Orang Tua</td>
            <td>: {{ $anak->user->name ?? ($anak->user->nama ?? '-') }}</td>
        </tr>
        <tr>
            <td class="label">Unit Kerja</td>
            <td>: {{ $anak->user->uker->nama_uker ?? '-' }}</td>
        </tr>
    </table>

    {{-- 2. KEHADIRAN --}}
    <div class="section-title">2. KEHADIRAN BULANAN</div>

    <table>
        <tr>
            <th class="text-center">Total Hari</th>
            <th class="text-center">Hari Datang</th>
            <th class="text-center">Hari Tidak Datang</th>
        </tr>
        <tr>
            <td class="text-center">
                <div class="number">{{ $totalHari }}</div>
                <small>Hari</small>
            </td>
            <td class="text-center">
                <div class="number">{{ $totalHariDatang }}</div>
                <small>Hari</small>
            </td>
            <td class="text-center">
                <div class="number">{{ $totalHariTidakDatang }}</div>
                <small>Hari</small>
            </td>
        </tr>
    </table>

    {{-- 3. RINGKASAN AKTIVITAS --}}
    <div class="section-title">3. RINGKASAN AKTIVITAS BULANAN</div>

    <table>
        <thead>
            <tr>
                <th rowspan="2" style="width: 34%;">Kegiatan</th>
                <th colspan="4" class="text-center">Hasil Penilaian</th>
            </tr>
            <tr>
                <th class="text-center">Sangat Baik</th>
                <th class="text-center">Baik</th>
                <th class="text-center">Cukup</th>
                <th class="text-center">Pendampingan</th>
            </tr>
        </thead>

        <tbody>
            @forelse($rekapAktivitas as $item)
            <tr>
                <td><strong>{{ $item['kegiatan'] }}</strong></td>
                <td class="text-center">{{ $item['sangat_baik'] }}</td>
                <td class="text-center">{{ $item['baik'] }}</td>
                <td class="text-center">{{ $item['cukup'] }}</td>
                <td class="text-center">{{ $item['pendampingan'] }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="empty">
                    Belum ada data aktivitas pada bulan ini.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- 4. MOOD DAN KONDISI --}}
    <div class="section-title">4. RINGKASAN MOOD DAN KONDISI ANAK</div>

    <table>
        <tr>
            <th width="20%">Kategori</th>
            <th width="25%">Tahap</th>
            <th>Hasil Penilaian</th>
            <th width="15%" class="text-center">Jumlah</th>
        </tr>

        @forelse($moodKondisi as $key => $jumlah)
        @php
        $pecahan = explode('|', $key);
        @endphp
        <tr>
            <td>{{ ucfirst($pecahan[0] ?? '-') }}</td>
            <td>{{ $pecahan[1] ?? '-' }}</td>
            <td>{{ $pecahan[2] ?? '-' }}</td>
            <td class="text-center">{{ $jumlah }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="empty">Belum ada data mood dan kondisi.</td>
        </tr>
        @endforelse
    </table>

    {{-- 5. PERKEMBANGAN --}}
    <div class="section-title">5. RINGKASAN PERKEMBANGAN</div>

    <table>
        <tr>
            <th>Indikator</th>
            <th width="25%" class="text-center">Jumlah</th>
        </tr>
        <tr>
            <td>Total Penilaian</td>
            <td class="text-center"><strong>{{ $totalPenilaian }}</strong></td>
        </tr>
        <tr>
            <td>Berkembang Sangat Baik (BSB)</td>
            <td class="text-center">{{ $totalBSB }}</td>
        </tr>
        <tr>
            <td>Berkembang Sesuai Harapan (BSH)</td>
            <td class="text-center">{{ $totalBSH }}</td>
        </tr>
        <tr>
            <td>Mulai Berkembang (MB)</td>
            <td class="text-center">{{ $totalMB }}</td>
        </tr>
    </table>

    {{-- 6. MAKAN DAN MINUM --}}
    <div class="section-title">6. RINGKASAN MAKAN DAN MINUM</div>

    <table>
        <tr>
            <th>Selera Makan</th>
            <th width="20%" class="text-center">Jumlah</th>
        </tr>
        @forelse($ringkasanMakan as $nama => $jumlah)
        <tr>
            <td>{{ $nama }}</td>
            <td class="text-center">{{ $jumlah }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="2" class="empty">Belum ada data makan.</td>
        </tr>
        @endforelse
    </table>

    <table>
        <tr>
            <th>Minum Air</th>
            <th width="20%" class="text-center">Jumlah</th>
        </tr>
        @forelse($ringkasanMinum as $nama => $jumlah)
        <tr>
            <td>{{ $nama }}</td>
            <td class="text-center">{{ $jumlah }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="2" class="empty">Belum ada data minum.</td>
        </tr>
        @endforelse
    </table>

    @if($catatanMakan->count() || $catatanMakanMinum->count())
    <p><strong>Catatan Makan dan Minum:</strong></p>
    @foreach($catatanMakan as $item)
    <p>- {{ $item->catatan_makan }}</p>
    @endforeach
    @foreach($catatanMakanMinum as $item)
    <p>- {{ $item->catatan_makan_minum }}</p>
    @endforeach
    @endif

    {{-- 7. TOILET TRAINING --}}
    <div class="section-title">7. RINGKASAN TOILET TRAINING</div>

    <table>
        <tr>
            <th>Indikator</th>
            <th>Hasil</th>
            <th width="20%" class="text-center">Jumlah</th>
        </tr>

        @foreach([
        'Pipis' => $ringkasanPipis,
        'Pup' => $ringkasanPup,
        'Kondisi Popok' => $ringkasanPopok
        ] as $judul => $data)
        @forelse($data as $nama => $jumlah)
        <tr>
            <td>{{ $judul }}</td>
            <td>{{ $nama }}</td>
            <td class="text-center">{{ $jumlah }}</td>
        </tr>
        @empty
        <tr>
            <td>{{ $judul }}</td>
            <td colspan="2" class="empty">Belum ada data.</td>
        </tr>
        @endforelse
        @endforeach
    </table>

    @if($catatanToilet->count())
    <p><strong>Catatan Toilet Training:</strong></p>
    @foreach($catatanToilet as $item)
    <p>- {{ $item->catatan_toilet_training }}</p>
    @endforeach
    @endif

    {{-- 8. INFORMASI ORANG TUA --}}
    <div class="section-title">8. INFORMASI UNTUK ORANG TUA</div>

    <table>
        <tr>
            <th width="25%">Tanggal</th>
            <th>Informasi</th>
        </tr>

        @forelse($informasiOrangTua as $item)
        <tr>
            <td>
                {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
            </td>
            <td>{{ $item->informasi_orang_tua }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="2" class="empty">
                Tidak ada informasi tambahan untuk orang tua.
            </td>
        </tr>
        @endforelse
    </table>

    <div class="footer">
        Dicetak pada {{ now()->translatedFormat('d F Y, H:i') }} WIB
    </div>

</body>

</html>