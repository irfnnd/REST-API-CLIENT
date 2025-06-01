@extends('layouts.app') {{-- sesuaikan layout jika pakai template sendiri --}}

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <div class="bg-primary text-white p-4 rounded-3 shadow-sm">
                    <h1 class="display-6 mb-2">
                        <i class="fas fa-university"></i>Daftar Kampus di Indonesia
                    </h1>
                    <p class="lead mb-0">Temukan informasi kampus-kampus terbaik di Indonesia</p>
                </div>
            </div>
        </div>

        <form method="GET" action="{{ url()->current() }}" class="row g-3 align-items-end mb-3">
            <div class="col-md-8 col-lg-10">
                <label for="search" class="form-label fw-semibold text-muted">
                    <i class="fas fa-search me-2"></i>Cari Kampus
                </label>
                <input type="text" class="form-control border-2" id="search" name="search"
                    value="{{ $search ?? '' }}" placeholder="Masukkan nama kampus yang ingin dicari..." autocomplete="off">
            </div>
            <div class="col-md-4 col-lg-2">
                <div class="d-grid gap-2 d-md-flex">
                    <button type="submit" class="btn btn-primary px-4 me-md-2">
                        <i class="fas fa-search"></i>Cari
                    </button>
                    @if ($search)
                        <a href="{{ url()->current() }}" class="btn btn-outline-secondary px-3">
                            <i class="fas fa-times"></i>Reset
                        </a>
                    @endif
                </div>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No.</th>
                        <th>Nama Kampus</th>
                        <th>Domain</th>
                        <th>Website</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kampus as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['domains'][0] ?? '-' }}</td>
                            <td><a href="{{ $item['web_pages'][0] ?? '#' }}"
                                    target="_blank">{{ $item['web_pages'][0] ?? '-' }}</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
