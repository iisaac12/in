@extends('layouts.app')

@section('content')
<style>
    .page-header { text-align: center; margin-bottom: 36px; }
    .page-header h1 { font-size: 1.875rem; font-weight: 800; color: var(--text); letter-spacing: -.5px; }
    .page-header p  { font-size: .95rem; color: var(--muted); margin-top: 6px; }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    .product-card {
        background: var(--surface);
        border-radius: 16px;
        border: 1.5px solid var(--border);
        overflow: hidden;
        transition: transform .2s, box-shadow .2s, border-color .2s;
        display: flex;
        flex-direction: column;
    }
    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 28px rgba(37,99,235,.1);
        border-color: var(--blue-light);
    }

    .product-img {
        width: 100%; height: 196px; object-fit: cover; display: block;
    }
    .product-img-placeholder {
        width: 100%; height: 196px;
        background: #F1F5F9;
        display: flex; align-items: center; justify-content: center;
        flex-direction: column; gap: 8px;
        color: #CBD5E1;
    }
    .product-img-placeholder svg { opacity: .5; }
    .product-img-placeholder span { font-size: .75rem; font-weight: 500; }

    .product-body { padding: 16px; flex: 1; display: flex; flex-direction: column; }
    .product-name {
        font-size: .9rem; font-weight: 700; color: var(--text);
        line-height: 1.35; margin-bottom: 6px;
        display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
    }
    .product-price { font-size: 1rem; font-weight: 800; color: var(--blue); margin-bottom: 14px; }

    .btn-detail {
        display: block; text-align: center;
        background: var(--blue); color: white;
        font-size: .82rem; font-weight: 700;
        padding: 10px 0; border-radius: 10px;
        text-decoration: none; transition: background .15s;
        margin-top: auto;
    }
    .btn-detail:hover { background: var(--blue-dark); }

    .empty-state {
        text-align: center; padding: 80px 24px;
        color: var(--muted);
    }
    .empty-state svg { margin: 0 auto 16px; opacity: .3; }
    .empty-state h2 { font-size: 1.1rem; font-weight: 700; color: var(--text); }
    .empty-state p  { font-size: .875rem; margin-top: 4px; }
</style>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 36px;">
    <div class="page-header" style="margin-bottom: 0; text-align: left;">
        <h1>Daftar Produk</h1>
        <p>Temukan produk terbaik di Shopind</p>
    </div>
    @if(auth()->check() && auth()->user()->isAdmin())
        <a href="{{ route('admin.create') }}" style="background:var(--blue); color:white; padding:10px 24px; border-radius:10px; text-decoration:none; font-weight:700; font-size:0.95rem; display:inline-flex; align-items:center; gap:8px;">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>
            Tambah Produk (Admin)
        </a>
    @endif
</div>

@if($products->isEmpty())
    <div class="empty-state">
        <svg width="56" height="56" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/>
        </svg>
        <h2>Belum ada produk</h2>
        <p>Produk akan segera tersedia.</p>
    </div>
@else
    <div class="product-grid">
        @foreach($products as $product)
        <div class="product-card">
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" class="product-img" alt="{{ $product->name }}">
            @else
                <div class="product-img-placeholder">
                    <svg width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/>
                        <polyline points="21 15 16 10 5 21"/>
                    </svg>
                    <span>Tidak ada gambar</span>
                </div>
            @endif
            <div class="product-body">
                <div class="product-name">{{ $product->name }}</div>
                <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                <a href="{{ route('products.show', $product->id) }}" class="btn-detail">Lihat Detail</a>
            </div>
        </div>
        @endforeach
    </div>
@endif
@endsection