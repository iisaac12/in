@extends('layouts.app')

@section('content')
<style>
    .admin-container {
        display: flex;
        gap: 32px;
        max-width: 1100px;
        margin: 0 auto;
    }
    .admin-sidebar {
        width: 180px;
        padding-top: 10px;
    }
    .admin-sidebar-nav {
        background-color: #e2e8f0;
        border-radius: 16px;
        padding: 16px;
    }
    .admin-sidebar-nav a {
        display: block;
        font-weight: 800;
        font-size: 1.05rem;
        margin-bottom: 8px;
        text-decoration: none;
    }
    .nav-tambah { color: #2563eb; }
    .nav-hapus  { color: #475569; }

    .admin-content {
        flex: 1;
    }

    .header-title {
        text-align: center;
        margin-bottom: 24px;
        margin-top: -10px; 
    }
    .header-title h1 {
        font-size: 1.7rem;
        font-weight: 800;
        color: #0f172a;
    }
    .header-title p {
        font-size: 0.85rem;
        color: #64748b;
    }

    .form-wrapper {
        background-color: #e2e8f0;
        border-radius: 20px;
        padding: 32px 32px 32px 32px;
        position: relative;
    }
    .form-title-badge {
        background-color: white;
        color: #2563eb;
        font-size: 1.25rem;
        font-weight: 800;
        padding: 12px 36px;
        border-radius: 26px 26px 0 0;
        display: inline-block;
        position: absolute;
        top: -46px;
        left: 50%;
        transform: translateX(-50%);
        box-shadow: 0 -2px 10px rgba(0,0,0,0.02);
    }

    .form-inner-grid {
        display: flex;
        background-color: white;
        border-radius: 20px;
        overflow: hidden;
        margin-top: 16px;
    }

    .form-left {
        width: 35%;
        padding: 32px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .image-preview-box {
        width: 100%;
        aspect-ratio: 4/3;
        background-color: #f1f5f9;
        border-radius: 12px;
        object-fit: cover;
        margin-bottom: 16px;
        cursor: pointer;
    }
    .btn-tambah-gambar {
        color: #3b82f6;
        font-weight: 700;
        font-size: 1.1rem;
        background: none;
        border: none;
        cursor: pointer;
    }

    .form-right {
        width: 65%;
        background-color: #4A657A;
        padding: 32px;
        color: white;
    }

    .form-row {
        display: flex;
        align-items: flex-start;
        margin-bottom: 24px;
    }
    .form-label {
        width: 130px;
        font-weight: 700;
        font-size: 0.95rem;
        margin-top: 8px;
    }
    .form-input-wrapper {
        flex: 1;
    }
    .form-input {
        width: 100%;
        background: transparent;
        border: none;
        border-bottom: 1.5px solid #1e293b;
        color: white;
        padding: 8px 0;
        font-size: 0.95rem;
        outline: none;
        font-family: inherit;
    }
    .form-input::placeholder {
        color: #cbd5e1;
    }
    .form-textarea {
        resize: none;
        height: 60px;
    }
    .textarea-lines {
        border-bottom: 1.5px solid #1e293b; 
        margin-top: 12px;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        margin-top: 24px;
    }
    .btn-simpan {
        background-color: #5584F1;
        color: white;
        font-weight: 700;
        font-size: 1rem;
        padding: 12px 64px;
        border-radius: 999px;
        border: none;
        cursor: pointer;
        transition: background-color 0.2s;
    }
    .btn-simpan:hover {
        background-color: #2563eb;
    }
</style>

<div class="admin-container">
    <div class="admin-sidebar">
        <div class="admin-sidebar-nav">
            <a href="{{ route('admin.create') }}" class="nav-tambah">Tambah Produk</a>
            <a href="{{ route('admin.index') }}" class="nav-hapus">Hapus Produk</a>
        </div>
    </div>

    <div class="admin-content">
        <div class="header-title">
            <h1>Daftar Produk</h1>
            <p>Temukan produk terbaik di Shopind</p>
        </div>

        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div style="margin-top: 60px;">
                <div class="form-wrapper">
                    <div class="form-title-badge">Silahkan Isi Form Produk</div>
                    
                    <div class="form-inner-grid">
                        <div class="form-left">
                            <img src="" id="preview" class="image-preview-box" alt="Preview Gambar" style="display:none;">
                            <div id="placeholder-box" class="image-preview-box" style="display:flex; align-items:center; justify-content:center; color:#94a3b8; font-weight:600;">
                                Pilih Gambar
                            </div>
                            <input type="file" name="image" id="imageInput" style="display:none;" accept="image/*" onchange="previewImage(event)">
                            <button type="button" class="btn-tambah-gambar" onclick="document.getElementById('imageInput').click()">Tambah Gambar</button>
                            @error('image') <p style="color: #fca5a5; font-size: 0.8rem; margin-top: 8px;">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-right">
                            <div class="form-row">
                                <label class="form-label">Nama Produk :</label>
                                <div class="form-input-wrapper">
                                    <input type="text" name="name" class="form-input" value="{{ old('name') }}" placeholder="Kamera Sony" required>
                                    @error('name') <p style="color: #fca5a5; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <label class="form-label">Stok Produk :</label>
                                <div class="form-input-wrapper">
                                    <input type="number" name="stock" class="form-input" value="{{ old('stock') }}" placeholder="5" required>
                                    @error('stock') <p style="color: #fca5a5; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <label class="form-label">Harga Produk :</label>
                                <div class="form-input-wrapper">
                                    <input type="number" name="price" class="form-input" value="{{ old('price') }}" placeholder="8000000" required>
                                    @error('price') <p style="color: #fca5a5; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <label class="form-label">Deskripsi :</label>
                                <div class="form-input-wrapper">
                                    <textarea name="description" class="form-input form-textarea" placeholder="Kamera sony a6v7 yang..." required>{{ old('description') }}</textarea>
                                    <div class="textarea-lines"></div>
                                    <div class="textarea-lines"></div>
                                    @error('description') <p style="color: #fca5a5; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-simpan">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const preview = document.getElementById('preview');
            const placeholder = document.getElementById('placeholder-box');
            preview.src = reader.result;
            preview.style.display = 'block';
            placeholder.style.display = 'none';
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection