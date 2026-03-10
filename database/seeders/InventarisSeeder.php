<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventarisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Inventaris::create([
            'nama_barang' => 'Meja Murid',
            'kategori' => 'Furnitur',
            'jumlah' => 20,
            'kondisi' => 'Baik',
            'lokasi' => 'Kelas 1A'
        ]);

        \App\Models\Inventaris::create([
            'nama_barang' => 'Papan Tulis Whiteboard',
            'kategori' => 'Furnitur',
            'jumlah' => 1,
            'kondisi' => 'Baik',
            'lokasi' => 'Kelas 1A'
        ]);

        \App\Models\Inventaris::create([
            'nama_barang' => 'Laptop Acer',
            'kategori' => 'Elektronik',
            'jumlah' => 2,
            'kondisi' => 'Rusak Ringan',
            'lokasi' => 'Ruang Guru'
        ]);

        \App\Models\Inventaris::create([
            'nama_barang' => 'Proyektor Epson',
            'kategori' => 'Elektronik',
            'jumlah' => 1,
            'kondisi' => 'Baik',
            'lokasi' => 'Lab'
        ]);

        \App\Models\Inventaris::create([
            'nama_barang' => 'Lemari Dokumen',
            'kategori' => 'Furnitur',
            'jumlah' => 1,
            'kondisi' => 'Rusak Berat',
            'lokasi' => 'Ruang Guru'
        ]);
    }
}
