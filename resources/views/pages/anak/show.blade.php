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
                                <th class="ps-4">Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Tanggal Lahir</th>
                                <th>Usia</th>
                                <th>Orang Tua</th>
                                <th>Unit Kerja</th>
                            </tr>
                        </thead>

                        <tbody id="anakTable">

                            <!-- User 1 -->
                            @foreach ($anak as $data)
                            <tr>

                                <td><h6 class="mb-0">{{ $data->nama }}</h6></td>
                                <td>{{ $data->jenis_kelamin == 'P' ? 'Perempuan' : 'Laki=laki' }}</td>
                                <td>[{{ $data->tempat_lahir }}, {{ Carbon\Carbon::parse($data->tanggal_lahir)->isoFormat('DD MMMM Y') }}]</td>
                                <td>{{ \Carbon\Carbon::parse($data->tanggal_lahir)->diff(now())->y }} tahun
                                    ({{ round(\Carbon\Carbon::parse($data->tanggal_lahir)->diffInMonths(now())) }} bulan)
                                </td>
                                <td>{{ $data->user->nama }}</td>
                                <td>{{ $data->user->uker->nama_uker }}</td>
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
@endsection
@endsection