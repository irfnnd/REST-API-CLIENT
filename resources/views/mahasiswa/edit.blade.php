@extends('layouts.app')

@section('title', 'Edit Mahasiswa')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary me-2">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <h2>Edit Data Mahasiswa</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('mahasiswa.update', $mahasiswa['id']) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nim" class="form-label">NIM *</label>
                                <input type="text" class="form-control @error('nim') is-invalid @enderror" id="nim"
                                    name="nim" value="{{ old('nim', $mahasiswa['nim'] ?? '') }}" required>
                                @error('nim')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="nama" class="form-label">Nama Lengkap *</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="nama" name="nama" value="{{ old('nama', $mahasiswa['nama'] ?? '') }}"
                                    required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email', $mahasiswa['email'] ?? '') }}"
                                    required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="telepon" class="form-label">Telepon *</label>
                                <input type="text" class="form-control @error('telepon') is-invalid @enderror"
                                    id="telepon" name="telepon" value="{{ old('telepon', $mahasiswa['telepon'] ?? '') }}"
                                    required>
                                @error('telepon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="jurusan" class="form-label">Jurusan *</label>
                                <select id="jurusan" class="form-control" name="jurusan" required>
                                    <option disabled
                                        {{ old('jurusan', $mahasiswa['jurusan'] ?? '') == '' ? 'selected' : '' }}>- Pilih
                                        Jurusan -</option>
                                    <option value="Teknik Informatika"
                                        {{ old('jurusan', $mahasiswa['jurusan'] ?? '') == 'Teknik Informatika' ? 'selected' : '' }}>
                                        Teknik Informatika</option>
                                    <option value="Sistem Informasi"
                                        {{ old('jurusan', $mahasiswa['jurusan'] ?? '') == 'Sistem Informasi' ? 'selected' : '' }}>
                                        Sistem Informasi</option>
                                    <option value="Teknik Komputer"
                                        {{ old('jurusan', $mahasiswa['jurusan'] ?? '') == 'Teknik Komputer' ? 'selected' : '' }}>
                                        Teknik Komputer</option>
                                    <option value="Manajemen Informatika"
                                        {{ old('jurusan', $mahasiswa['jurusan'] ?? '') == 'Manajemen Informatika' ? 'selected' : '' }}>
                                        Manajemen Informatika</option>
                                </select>
                                @error('jurusan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Update
                            </button>
                            <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">
                                <i class="bi bi-x"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
