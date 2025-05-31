@extends('layouts.app')

@section('title', 'Detail Mahasiswa')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary me-2">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <h2>Detail Mahasiswa</h2>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="card-title mb-0">Informasi Mahasiswa</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <strong>NIM:</strong>
                    </div>
                    <div class="col-sm-9">
                        {{ $mahasiswa['nim'] ?? '-' }}
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col-sm-3">
                        <strong>Nama Lengkap:</strong>
                    </div>
                    <div class="col-sm-9">
                        {{ $mahasiswa['nama'] ?? '-' }}
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col-sm-3">
                        <strong>Email:</strong>
                    </div>
                    <div class="col-sm-9">
                        {{ $mahasiswa['email'] ?? '-' }}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <strong>Telepon:</strong>
                    </div>
                    <div class="col-sm-9">
                        {{ $mahasiswa['telepon'] ?? '-' }}
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col-sm-3">
                        <strong>Jurusan:</strong>
                    </div>
                    <div class="col-sm-9">
                        {{ $mahasiswa['jurusan'] ?? '-' }}
                    </div>
                </div>
                <hr>
            </div>
            <div class="card-footer">
                <div class="d-flex gap-2">
                    <a href="{{ route('mahasiswa.edit', $mahasiswa['id']) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <form action="{{ route('mahasiswa.destroy', $mahasiswa['id']) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Yakin ingin menghapus data ini?')">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
