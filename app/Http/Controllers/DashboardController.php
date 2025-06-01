<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\ApiService;

class DashboardController extends Controller
{
     protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index()
    {
        $response = $this->apiService->get('/data-mahasiswa');
        $mahasiswa = $response['data'] ?? [];
        $totalMahasiswa = count($mahasiswa);

        $response2 = $this->apiService->get('/data-dosen');
        $dosen = $response2['data'] ?? [];
        $totalDosen = count($dosen);
        return view('dashboard', compact('totalMahasiswa', 'totalDosen'));
    }
}
