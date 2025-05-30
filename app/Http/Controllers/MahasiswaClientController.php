<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;

class MahasiswaClientController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index()
    {
        $response = $this->apiService->get('/mahasiswa');
        $mahasiswa = $response['data'] ?? [];

        return view('mahasiswa.index', compact('mahasiswa'));
    }

    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|string|max:15|unique:mahasiswas,nim',
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:mahasiswas,email',
            'jurusan' => 'required|string|max:100',
            'telepon' => 'required|string|max:20',
        ]);

        $response = $this->apiService->post('/mahasiswa', $request->all());

        if (isset($response['success']) && $response['success']) {
            return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil ditambahkan!');
        }

        return back()->withErrors(['error' => $response['message'] ?? 'Gagal menambahkan data'])->withInput();
    }

    public function show($id)
    {
        $response = $this->apiService->get("/mahasiswa/{$id}");

        if (isset($response['data'])) {
            return view('mahasiswa.show', ['mahasiswa' => $response['data']]);
        }

        return redirect()->route('mahasiswa.index')->withErrors(['error' => 'Data tidak ditemukan']);
    }

    public function edit($id)
    {
        $response = $this->apiService->get("/mahasiswa/{$id}");

        if (isset($response['data'])) {
            return view('mahasiswa.edit', ['mahasiswa' => $response['data']]);
        }

        return redirect()->route('mahasiswa.index')->withErrors(['error' => 'Data tidak ditemukan']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nim' => 'required|string|max:15|unique:mahasiswas,nim',
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:mahasiswas,email',
            'jurusan' => 'required|string|max:100',
            'telepon' => 'required|string|max:20',
        ]);

        $response = $this->apiService->put("/mahasiswa/{$id}", $request->all());

        if (isset($response['success']) && $response['success']) {
            return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diupdate!');
        }

        return back()->withErrors(['error' => $response['message'] ?? 'Gagal mengupdate data'])->withInput();
    }

    public function destroy($id)
    {
        $response = $this->apiService->delete("/mahasiswa/{$id}");

        if (isset($response['success']) && $response['success']) {
            return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus!');
        }

        return back()->withErrors(['error' => $response['message'] ?? 'Gagal menghapus data']);
    }
}
