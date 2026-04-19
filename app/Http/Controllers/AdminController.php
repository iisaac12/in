<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
        
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->latest()->get();
        return view('admin.index', compact('products'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|integer',
            'stock'       => 'required|integer',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name'        => $request->name,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'description' => $request->description,
            'image'       => $imagePath,
        ]);

        return redirect()->route('admin.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        try {
            $product = \App\Models\Product::findOrFail($id);
            
            // Hapus gambar fisik permanen dari storage
            if ($product->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($product->image);
            }

            $product->delete();
            return redirect()->route('admin.index')->with('success', 'Produk beserta gambarnya berhasil dihapus permanen.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('admin.index')->with('error', 'Gagal: Produk tidak dapat dihapus karena masih ada di dalam keranjang belanja atau pesanan.');
        } catch (\Exception $e) {
            return redirect()->route('admin.index')->with('error', 'Gagal menghapus produk: ' . $e->getMessage());
        }
    }
}