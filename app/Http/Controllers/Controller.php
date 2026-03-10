<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventaris;

class InventarisController extends Controller
{
    // GET /api/inventaris
    public function index()
    {
        $inventaris = Inventaris::all();

        return response()->json([
            "status" => "success",
            "data" => $inventaris
        ], 200);
    }

    // GET /api/inventaris/{id}
    public function show($id)
    {
        $inventaris = Inventaris::find($id);

        if (!$inventaris) {
            return response()->json([
                "status" => "error",
                "message" => "Data inventaris tidak ditemukan"
            ], 404);
        }

        return response()->json([
            "status" => "success",
            "data" => $inventaris
        ], 200);
    }

    // POST /api/inventaris
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string',
            'kategori' => 'required|string',
            'jumlah' => 'required|integer|min:0',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'lokasi' => 'required|string'
        ]);

        $inventaris = Inventaris::create($validated);

        return response()->json([
            "status" => "success",
            "message" => "Data inventaris berhasil ditambahkan",
            "data" => $inventaris
        ], 201);
        
    }
}
