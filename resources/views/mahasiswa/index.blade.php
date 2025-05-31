@extends('layouts.app')

@section('title', 'Data Mahasiswa')

@section('content')
    <!-- Header Section -->
    <div class="row">
        <div class="col-12">
            <div
                class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                <div>
                    <h1 class="h3 mb-1 fw-bold text-dark">Data Mahasiswa</h1>
                    <p class="text-muted mb-0">Kelola data mahasiswa dengan mudah dan efisien</p>
                </div>
                <div class="d-flex flex-wrap align-items-start gap-2">
                    <!-- Form Pencarian -->
                    <form method="GET" action="{{ route('mahasiswa.index') }}" class="flex-grow-1" style="max-width: 600px;">
                        <div class="input-group shadow-sm">
                            <span class="input-group-text bg-white border-end-0 border-secondary">
                                <i class="bi bi-search text-muted"></i>
                            </span>
                            <input type="text" name="search" class="form-control border-start-0 border-secondary ps-0"
                                placeholder="Cari nama, NIM, atau email..." value="{{ request('search') }}">
                            <button class="btn btn-outline-secondary" type="submit">Cari</button>
                        </div>
                    </form>

                    <!-- Dropdown Filter -->
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-funnel me-1"></i> Filter
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('mahasiswa.index') }}">Semua Jurusan</a></li>
                            <li><a class="dropdown-item"
                                    href="{{ route('mahasiswa.index', ['filter_jurusan' => 'Teknik Informatika']) }}">
                                    Teknik Informatika</a></li>
                            <li><a class="dropdown-item"
                                    href="{{ route('mahasiswa.index', ['filter_jurusan' => 'Sistem Informasi']) }}">
                                    Sistem Informasi</a></li>
                            <li><a class="dropdown-item"
                                    href="{{ route('mahasiswa.index', ['filter_jurusan' => 'Manajemen']) }}">
                                    Manajemen</a></li>
                        </ul>
                    </div>

                    <!-- Tombol Tambah -->
                    <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary shadow-sm">
                        <i class="bi bi-plus-lg me-1"></i> Tambah Mahasiswa
                    </a>
                </div>

            </div>
        </div>
    </div>

    <!-- Search Bar -->


    <!-- Stats Cards -->
    {{-- <div class="row mb-4 g-3">
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body text-center">
                <div class="text-primary mb-2">
                    <i class="bi bi-people-fill display-6"></i>
                </div>
                <h5 class="card-title mb-1">{{ count($mahasiswa ?? []) }}</h5>
                <p class="card-text text-muted small">Total Mahasiswa</p>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body text-center">
                <div class="text-success mb-2">
                    <i class="bi bi-mortarboard-fill display-6"></i>
                </div>
                <h5 class="card-title mb-1">4</h5>
                <p class="card-text text-muted small">Jurusan Aktif</p>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body text-center">
                <div class="text-warning mb-2">
                    <i class="bi bi-calendar-check-fill display-6"></i>
                </div>
                <h5 class="card-title mb-1">{{ date('Y') }}</h5>
                <p class="card-text text-muted small">Tahun akademik</p>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body text-center">
                <div class="text-info mb-2">
                    <i class="bi bi-graph-up-arrow display-6"></i>
                </div>
                <h5 class="card-title mb-1">95%</h5>
                <p class="card-text text-muted small">Tingkat Kelulusan</p>
            </div>
        </div>
    </div>
</div> --}}

    <!-- Main Content -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 text-dark fw-semibold">
                            <i class="bi bi-table me-2"></i>Daftar Mahasiswa
                        </h6>
                        <div class="d-flex gap-2">
                            <a href="#" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-download me-1"></i> Export
                            </a>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#" onclick="window.print()"><i
                                                class="bi bi-printer me-2"></i>Print</a></li>
                                    <li><a class="dropdown-item" href="#"><i
                                                class="bi bi-file-earmark-excel me-2"></i>Export Excel</a></li>
                                    <li><a class="dropdown-item" href="#"><i
                                                class="bi bi-file-earmark-pdf me-2"></i>Export PDF</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    @if (empty($mahasiswa))
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="bi bi-inbox display-1 text-muted opacity-50"></i>
                            </div>
                            <h5 class="text-dark mb-2">Belum ada data mahasiswa</h5>
                            <p class="text-muted mb-4">Mulai dengan menambahkan data mahasiswa pertama Anda</p>
                            <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-lg me-1"></i> Tambah Mahasiswa Pertama
                            </a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="border-0 fw-semibold text-dark ps-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="selectAll">
                                            </div>
                                        </th>
                                        <th class="border-0 fw-semibold text-dark">No.</th>
                                        <th class="border-0 fw-semibold text-dark">NIM</th>
                                        <th class="border-0 fw-semibold text-dark">Mahasiswa</th>
                                        <th class="border-0 fw-semibold text-dark">Jurusan</th>
                                        <th class="border-0 fw-semibold text-dark">Kontak</th>
                                        <th class="border-0 fw-semibold text-dark text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mahasiswa as $index => $mhs)
                                        <tr class="border-bottom">
                                            <td class="ps-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="{{ $mhs['id'] }}">
                                                </div>
                                            </td>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <span
                                                    class="badge bg-light text-dark fw-normal">{{ $mhs['nim'] ?? '-' }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-circle bg-primary text-white me-3 d-flex align-items-center justify-content-center"
                                                        style="width: 40px; height: 40px; border-radius: 50%; font-weight: 600;">
                                                        {{ strtoupper(substr($mhs['nama'] ?? 'N', 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <div class="fw-semibold text-dark">{{ $mhs['nama'] ?? '-' }}</div>
                                                        <small class="text-muted">{{ $mhs['email'] ?? '-' }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                {{ $mhs['jurusan'] ?? '-' }}
                                            </td>
                                            <td>
                                                <div class="small">
                                                    <div class="text-dark">{{ $mhs['telepon'] ?? '-' }}</div>
                                                    <div class="text-muted">{{ $mhs['email'] ?? '-' }}</div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-1">
                                                    <a href="{{ route('mahasiswa.show', $mhs['id']) }}"
                                                        class="btn btn-sm btn-outline-info" data-bs-toggle="tooltip"
                                                        title="Lihat Detail">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('mahasiswa.edit', $mhs['id']) }}"
                                                        class="btn btn-sm btn-outline-warning" data-bs-toggle="tooltip"
                                                        title="Edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <form action="{{ route('mahasiswa.destroy', $mhs['id']) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                                            data-bs-toggle="tooltip" title="Hapus"
                                                            onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="card-footer bg-white border-0 py-3">
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                                <div class="text-muted small">
                                    Menampilkan <strong>1-{{ count($mahasiswa) }}</strong> dari
                                    <strong>{{ count($mahasiswa) }}</strong> data
                                </div>

                                <!-- Custom Pagination -->
                                @if (isset($mahasiswa) && is_object($mahasiswa) && method_exists($mahasiswa, 'links'))
                                    {{ $mahasiswa->appends(request()->query())->links('custom.pagination') }}
                                @else
                                    <nav aria-label="Table pagination">
                                        <ul class="pagination pagination-sm mb-0">
                                            <li class="page-item {{ request('page', 1) == 1 ? 'disabled' : '' }}">
                                                <a class="page-link"
                                                    href="{{ request()->fullUrlWithQuery(['page' => request('page', 1) - 1]) }}"
                                                    tabindex="-1">
                                                    <i class="bi bi-chevron-left"></i>
                                                </a>
                                            </li>
                                            @for ($i = 1; $i <= 5; $i++)
                                                <li class="page-item {{ request('page', 1) == $i ? 'active' : '' }}">
                                                    <a class="page-link"
                                                        href="{{ request()->fullUrlWithQuery(['page' => $i]) }}">{{ $i }}</a>
                                                </li>
                                            @endfor
                                            <li class="page-item">
                                                <a class="page-link"
                                                    href="{{ request()->fullUrlWithQuery(['page' => request('page', 1) + 1]) }}">
                                                    <i class="bi bi-chevron-right"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                @endif

                                <!-- Items per page selector -->
                                <div class="d-flex align-items-center gap-2">
                                    <small class="text-muted">Tampilkan:</small>
                                    <form method="GET" action="{{ route('mahasiswa.index') }}" class="d-inline">
                                        @foreach (request()->except('per_page') as $key => $value)
                                            <input type="hidden" name="{{ $key }}"
                                                value="{{ $value }}">
                                        @endforeach
                                        <select name="per_page" class="form-select form-select-sm" style="width: auto;"
                                            onchange="this.form.submit()">
                                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>
                                                10</option>
                                            <option value="25" {{ request('per_page', 10) == 25 ? 'selected' : '' }}>
                                                25</option>
                                            <option value="50" {{ request('per_page', 10) == 50 ? 'selected' : '' }}>
                                                50</option>
                                            <option value="100" {{ request('per_page', 10) == 100 ? 'selected' : '' }}>
                                                100</option>
                                        </select>
                                    </form>
                                    <small class="text-muted">per halaman</small>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Bulk Actions Bar (Hidden by default) -->
    <div class="bulk-actions-bar position-fixed bottom-0 start-50 translate-middle-x bg-primary text-white px-4 py-3 rounded-top shadow"
        style="display: none; z-index: 1050;">
        <div class="d-flex align-items-center gap-3">
            <span class="selected-count">0 item terpilih</span>
            <div class="vr"></div>
            <button class="btn btn-sm btn-outline-light" onclick="exportSelected()">
                <i class="bi bi-download me-1"></i> Export
            </button>
            <button class="btn btn-sm btn-outline-light" onclick="deleteSelected()">
                <i class="bi bi-trash me-1"></i> Hapus
            </button>
            <button class="btn btn-sm btn-light text-primary ms-2" onclick="clearSelection()">
                <i class="bi bi-x"></i>
            </button>
        </div>
    </div>

    <!-- Bulk Delete Form -->
    <form id="bulkDeleteForm" action="#" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
        <input type="hidden" name="selected_ids" id="selectedIds">
    </form>

    @push('styles')
        <style>
            .avatar-circle {
                transition: all 0.2s ease;
            }

            .table tbody tr:hover {
                background-color: rgba(0, 0, 0, 0.02);
            }

            .btn-group .btn {
                border-radius: 0.375rem !important;
                margin-right: 0.25rem;
            }

            .card {
                transition: all 0.2s ease;
            }

            .card:hover {
                transform: translateY(-1px);
            }

            .bulk-actions-bar {
                transition: all 0.3s ease;
            }

            .page-link {
                border-radius: 0.375rem !important;
                margin: 0 0.125rem;
                border: 1px solid #dee2e6;
            }

            .page-item.active .page-link {
                background-color: var(--bs-primary);
                border-color: var(--bs-primary);
            }

            .form-select-sm {
                font-size: 0.875rem;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize tooltips
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });

                // Handle select all checkbox
                const selectAllCheckbox = document.getElementById('selectAll');
                const itemCheckboxes = document.querySelectorAll('tbody input[type="checkbox"]');
                const bulkActionsBar = document.querySelector('.bulk-actions-bar');
                const selectedCountSpan = document.querySelector('.selected-count');

                if (selectAllCheckbox) {
                    selectAllCheckbox.addEventListener('change', function() {
                        itemCheckboxes.forEach(checkbox => {
                            checkbox.checked = this.checked;
                        });
                        updateBulkActions();
                    });
                }

                itemCheckboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', updateBulkActions);
                });

                function updateBulkActions() {
                    const checkedBoxes = document.querySelectorAll('tbody input[type="checkbox"]:checked');
                    const count = checkedBoxes.length;

                    if (count > 0) {
                        selectedCountSpan.textContent = `${count} item terpilih`;
                        bulkActionsBar.style.display = 'block';
                    } else {
                        bulkActionsBar.style.display = 'none';
                    }

                    // Update select all checkbox state
                    if (selectAllCheckbox) {
                        selectAllCheckbox.indeterminate = count > 0 && count < itemCheckboxes.length;
                        selectAllCheckbox.checked = count === itemCheckboxes.length;
                    }
                }

                // Clear selection function
                window.clearSelection = function() {
                    itemCheckboxes.forEach(checkbox => {
                        checkbox.checked = false;
                    });
                    if (selectAllCheckbox) {
                        selectAllCheckbox.checked = false;
                        selectAllCheckbox.indeterminate = false;
                    }
                    bulkActionsBar.style.display = 'none';
                };

                // Export selected function
                window.exportSelected = function() {
                    const checkedBoxes = document.querySelectorAll('tbody input[type="checkbox"]:checked');
                    const selectedIds = Array.from(checkedBoxes).map(cb => cb.value);

                    if (selectedIds.length === 0) {
                        alert('Pilih minimal satu item untuk diekspor');
                        return;
                    }

                    // Create form and submit
                    const form = document.createElement('form');
                    form.method = 'POST';

                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = '{{ csrf_token() }}';

                    const idsInput = document.createElement('input');
                    idsInput.type = 'hidden';
                    idsInput.name = 'selected_ids';
                    idsInput.value = JSON.stringify(selectedIds);

                    form.appendChild(csrfInput);
                    form.appendChild(idsInput);
                    document.body.appendChild(form);
                    form.submit();
                    document.body.removeChild(form);
                };

                // Delete selected function
                window.deleteSelected = function() {
                    const checkedBoxes = document.querySelectorAll('tbody input[type="checkbox"]:checked');
                    const selectedIds = Array.from(checkedBoxes).map(cb => cb.value);

                    if (selectedIds.length === 0) {
                        alert('Pilih minimal satu item untuk dihapus');
                        return;
                    }

                    if (confirm(`Yakin ingin menghapus ${selectedIds.length} item yang dipilih?`)) {
                        document.getElementById('selectedIds').value = JSON.stringify(selectedIds);
                        document.getElementById('bulkDeleteForm').submit();
                    }
                };
            });
        </script>
    @endpush
@endsection
