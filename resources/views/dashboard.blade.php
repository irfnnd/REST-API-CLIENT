@extends('layouts.app')

@section('title', 'Dashboard - Academic System')

@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="mb-4">Dashboard</h2>
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="card-title">Total Mahasiswa</h6>
                        <h2 class="mb-0">#</h2>
                    </div>
                    <div>
                        <i class="bi bi-people display-4 opacity-50"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="#" class="text-white text-decoration-none">
                    Lihat Detail <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="card-title">Total Dosen</h6>
                        <h2 class="mb-0">4</h2>
                    </div>
                    <div>
                        <i class="bi bi-person-badge display-4 opacity-50"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="#" class="text-white text-decoration-none">
                    Lihat Detail <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Selamat Datang</h5>
            </div>
            <div class="card-body">
                <p>Selamat datang di Academic System. Aplikasi ini memungkinkan Anda untuk mengelola data mahasiswa dan dosen melalui antarmuka web yang terintegrasi dengan API backend.</p>

                <div class="row">
                    <div class="col-md-6">
                        <h6>Fitur yang tersedia:</h6>
                        <ul>
                            <li>Manajemen data mahasiswa (CRUD)</li>
                            <li>Manajemen data dosen (CRUD)</li>
                            <li>Dashboard dengan statistik</li>
                            <li>Autentikasi berbasis token</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6>Menu Navigasi:</h6>
                        <div class="d-grid gap-2">
                            <a href="#" class="btn btn-outline-primary">
                                <i class="bi bi-people"></i> Kelola Mahasiswa
                            </a>
                            <a href="#" class="btn btn-outline-success">
                                <i class="bi bi-person-badge"></i> Kelola Dosen
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
