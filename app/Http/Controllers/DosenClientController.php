<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;

class DosenClientController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index(Request $request)
    {
        $response = $this->apiService->get('/data-dosen');
        $dosen = $response['data'] ?? [];

        $dosen = collect($dosen)->sortByDesc('created_at')->values()->all();

        if ($request->has('filter_jurusan')) {
            $jurusan = $request->filter_jurusan;
            $dosen = collect($dosen)->where('jurusan', $jurusan)->values()->all();
        }

        if ($request->has('search')) {
            $search = strtolower($request->search);
            $dosen = collect($dosen)->filter(function ($mhs) use ($search) {
                return str_contains(strtolower($mhs['nama']), $search) ||
                    str_contains(strtolower($mhs['nim']), $search) ||
                    str_contains(strtolower($mhs['email']), $search);
            })->values()->all();
        }

        $perPage = $request->get('per_page', 10);
        $currentPage = $request->get('page', 1);
        $total = count($dosen);
        $offset = ($currentPage - 1) * $perPage;
        $dosen = array_slice($dosen, $offset, $perPage);

        return view('dosen.index', compact('dosen'));
    }

    public function create()
    {
        return view('dosen.create');
    }

    public function store(Request $request)
    {

        // Ambil data dari API
        $existing = $this->apiService->get('/data-dosen');
        $data = $existing['data'] ?? [];

        // Validasi manual keunikan NIM dan Email
        // Kirim data ke API
        $response = $this->apiService->post('/data-dosen', $request->all());

        if (isset($response['success']) && $response['success']) {
            return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil ditambahkan!');
        }
        if (isset($response['errors']) && is_array($response['errors'])) {
            return redirect()->back()
                ->withErrors($response['errors']) // kirim langsung ke view
                ->withInput();
        }

        // Jika error lain
        return back()->withErrors(['error' => $response['message'] ?? 'Gagal menambahkan data'])->withInput();
    }


    public function show($id)
    {
        $response = $this->apiService->get("/data-dosen/{$id}");

        if (isset($response['data'])) {
            return view('dosen.show', ['dosen' => $response['data']]);
        }

        return redirect()->route('dosen.index')->withErrors(['error' => 'Data tidak ditemukan']);
    }

    public function edit($id)
    {
        $response = $this->apiService->get("/data-dosen/{$id}");

        if (isset($response['data'])) {
            return view('dosen.edit', ['dosen' => $response['data']]);
        }

        return redirect()->route('dosen.index')->withErrors(['error' => 'Data tidak ditemukan']);
    }

    public function update(Request $request, $id)
    {

        $response = $this->apiService->put("/data-dosen/{$id}", $request->all());

        if (isset($response['success']) && $response['success']) {
            return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil diupdate!');
        }

        return back()->withErrors(['error' => $response['message'] ?? 'Gagal mengupdate data'])->withInput();
    }

    public function destroy($id)
    {
        $response = $this->apiService->delete("/data-dosen/{$id}");

        if (isset($response['success']) && $response['success']) {
            return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil dihapus!');
        }

        return back()->withErrors(['error' => $response['message'] ?? 'Gagal menghapus data']);
    }

    public function bulkDelete(Request $request)
    {
        $ids = json_decode($request->selected_ids, true);
        if (empty($ids))
            return back()->with('error', 'Tidak ada data yang dipilih');

        $response = $this->apiService->post('/data-dosen/bulk-delete', ['ids' => $ids]);

        return $response['success']
            ? redirect()->route('dosen.index')->with('success', count($ids) . ' data berhasil dihapus')
            : back()->with('error', $response['message'] ?? 'Gagal menghapus data');
    }

    // public function export(Request $request)
    // {
    //     $response = $this->apiService->get('/data-dosen');
    //     $dosen = $response['data'] ?? [];

    //     return $request->format === 'pdf'
    //         ? $this->exportPdf($dosen)
    //         : $this->exportExcel($dosen);
    // }

    // public function exportSelected(Request $request)
    // {
    //     $ids = json_decode($request->selected_ids, true);
    //     if (empty($ids))
    //         return back()->with('error', 'Tidak ada data yang dipilih');

    //     $response = $this->apiService->post('/data-dosen/selected', ['ids' => $ids]);
    //     $dosen = $response['data'] ?? [];

    //     return $this->exportExcel($dosen);
    // }

    // private function exportExcel($data)
    // {
    //     $filename = 'data_dosen_' . date('Y-m-d_H-i-s') . '.csv';

    //     $headers = [
    //         'Content-Type' => 'text/csv',
    //         'Content-Disposition' => 'attachment; filename="' . $filename . '"',
    //     ];

    //     $callback = function () use ($data) {
    //         $file = fopen('php://output', 'w');
    //         fputcsv($file, ['NIM', 'Nama', 'Email', 'Jurusan', 'Telepon']);
    //         foreach ($data as $row) {
    //             fputcsv($file, [$row['nim'], $row['nama'], $row['email'], $row['jurusan'], $row['telepon']]);
    //         }
    //         fclose($file);
    //     };

    //     return response()->stream($callback, 200, $headers);
    // }

    // private function exportPdf($data)
    // {
    //     $html = '<h1>Data dosen</h1>';
    //     $html .= '<table border="1" cellpadding="5">';
    //     $html .= '<tr><th>NIM</th><th>Nama</th><th>Email</th><th>Jurusan</th><th>Telepon</th></tr>';

    //     foreach ($data as $row) {
    //         $html .= "<tr>
    //             <td>{$row['nim']}</td>
    //             <td>{$row['nama']}</td>
    //             <td>{$row['email']}</td>
    //             <td>{$row['jurusan']}</td>
    //             <td>{$row['telepon']}</td>
    //         </tr>";
    //     }

    //     $html .= '</table>';

    //     return response($html)->header('Content-Type', 'text/html');
    // }
}
