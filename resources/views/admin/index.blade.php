@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-xl font-semibold text-gray-800">Daftar Produk</h1>
    <a href="{{ route('admin.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">
        + Tambah Produk
    </a>
</div>

<form action="{{ route('admin.index') }}" method="GET" class="mb-4 flex gap-2">
    <div class="relative w-full max-w-sm">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama produk..." 
            class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        <svg class="absolute left-3 top-2.5 text-gray-400" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/>
        </svg>
    </div>
    <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-700 transition">Cari</button>
    @if(request('search'))
        <a href="{{ route('admin.index') }}" class="bg-red-100 text-red-600 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-red-200 transition">Reset</a>
    @endif
</form>

<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="text-left px-4 py-3 text-gray-600 font-medium">Nama Produk</th>
                <th class="text-left px-4 py-3 text-gray-600 font-medium">Harga</th>
                <th class="text-left px-4 py-3 text-gray-600 font-medium">Stok</th>
                <th class="text-left px-4 py-3 text-gray-600 font-medium">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr class="border-b border-gray-100 hover:bg-gray-50">
                <td class="px-4 py-3 text-gray-800">{{ $product->name }}</td>
                <td class="px-4 py-3 text-gray-600">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                <td class="px-4 py-3">
                    <span class="px-2 py-1 rounded-full text-xs
                        {{ $product->stock > 5 ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                        {{ $product->stock }}
                    </span>
                </td>
                <td class="px-4 py-3">
                    <form id="delete-form-{{ $product->id }}" action="{{ route('admin.destroy', $product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="openDeleteModal('delete-form-{{ $product->id }}', '{{ addslashes($product->name) }}')"
                            class="bg-red-100 text-red-600 px-3 py-1 rounded-lg text-xs hover:bg-red-200">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Konfirmasi Hapus -->
<div id="deleteModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(224, 231, 255, 0.6); z-index:9999; align-items:center; justify-content:center; backdrop-filter:blur(3px);">
    <div style="padding:40px; text-align:center; max-width:450px;">
        <h2 id="deleteModalText" style="font-size:1.4rem; font-weight:800; color:#1e293b; margin-bottom:32px; line-height:1.4;">Hapus produk ...?</h2>
        <div style="display:flex; justify-content:center; gap:16px;">
            <button type="button" onclick="closeDeleteModal()" style="background:#ef4444; color:white; font-weight:900; font-size:1.1rem; padding:12px 36px; border-radius:12px; border:none; cursor:pointer; box-shadow:0 4px 6px rgba(239,68,68,0.3);">TIDAK</button>
            <button type="button" onclick="submitDelete()" style="background:#86efac; color:#064e3b; font-weight:900; font-size:1.1rem; padding:12px 36px; border-radius:12px; border:none; cursor:pointer; box-shadow:0 4px 6px rgba(134,239,172,0.4);">YA</button>
        </div>
    </div>
</div>

@if(session('success') && str_contains(session('success'), 'permanen'))
<!-- Pop-up Sukses Terhapus -->
<style> .alert-success { display: none !important; } </style>
<div id="successPopup" style="position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); background:#cbd5e1; color:#334155; padding:16px 40px; border-radius:20px; font-weight:800; font-size:1.4rem; z-index:9999; box-shadow:0 10px 25px rgba(0,0,0,0.08);">
    Produk Terhapus ✓
</div>
<script>
    setTimeout(() => { document.getElementById('successPopup').style.display = 'none'; }, 2500);
</script>
@endif

<script>
    let formToSubmit = null;
    function openDeleteModal(formId, productName) {
        document.getElementById('deleteModalText').innerText = 'Hapus produk\n' + productName + '?';
        document.getElementById('deleteModal').style.display = 'flex';
        formToSubmit = document.getElementById(formId);
    }
    function closeDeleteModal() {
        document.getElementById('deleteModal').style.display = 'none';
        formToSubmit = null;
    }
    function submitDelete() {
        if(formToSubmit) formToSubmit.submit();
    }
</script>
@endsection