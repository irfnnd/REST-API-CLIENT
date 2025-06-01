<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KampusController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        // Parameter untuk API
        $params = ['country' => 'Indonesia'];
        if ($search) {
            $params['name'] = $search;
        }

        $response = Http::get('http://universities.hipolabs.com/search', $params);
        $kampus = $response->json();

        // Jika tidak ada hasil dari API dengan parameter search, coba cari manual
        if ($search && empty($kampus)) {
            $response = Http::get('http://universities.hipolabs.com/search', [
                'country' => 'Indonesia'
            ]);
            $allKampus = $response->json();

            // Filter manual berdasarkan nama
            $kampus = array_filter($allKampus, function($item) use ($search) {
                return stripos($item['name'], $search) !== false;
            });
        }

        return view('public-api.data-kampus', compact('kampus', 'search'));
    }
}
