@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto">
    <h1 class="text-xl font-semibold text-gray-800 mb-6">Checkout</h1>

    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <h3 class="font-medium text-gray-700 mb-4">Ringkasan Pesanan</h3>

        @foreach($items as $item)
        <div class="flex justify-between items-center py-3 border-b border-gray-100">
            <div>
                <p class="text-sm font-medium text-gray-800">{{ $item->product->name }}</p>
                <p class="text-xs text-gray-400">{{ $item->quantity }} x Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
            </div>
            <p class="text-sm font-semibold text-gray-700">
                Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
            </p>
        </div>
        @endforeach

            <div class="flex justify-between items-center pt-4 mt-2">
                <span class="font-semibold text-gray-800">Total Pembayaran</span>
                <span class="font-bold text-blue-600 text-lg">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>

            @if($payment === 'saldo')
            <div class="flex justify-between items-center pt-2 mt-2 border-t border-gray-100">
                <span class="text-sm font-medium text-gray-500">Saldo Anda</span>
                <span class="text-sm font-semibold {{ Auth::user()->balance < $total ? 'text-red-500' : 'text-green-600' }}">
                    Rp {{ number_format(Auth::user()->balance, 0, ',', '.') }}
                </span>
            </div>
            
            @if(Auth::user()->balance < $total)
            <div class="mt-3 p-3 bg-red-50 border border-red-200 rounded-lg text-xs text-red-600 font-medium">
                Peringatan: Saldo Anda tidak mencukupi untuk pembayaran ini. Silakan <a href="{{ route('topup.index') }}" class="underline font-bold">Top Up Saldo</a>.
            </div>
            @endif
            @else
            <div class="flex justify-between items-center pt-2 mt-2 border-t border-gray-100">
                <span class="text-sm font-medium text-gray-500">Metode Tagihan</span>
                <span class="text-sm font-semibold text-gray-700 capitalize">
                    {{ $payment === 'qr' ? 'Kode QR (Qris)' : 'Kartu Debit' }}
                </span>
            </div>
            @endif

        <div class="flex mt-6" style="display: flex; gap: 12px; margin-top: 24px;">
            <a href="{{ route('cart.index') }}"
               style="flex: 1; text-align: center; border: 1px solid #D1D5DB; color: #4B5563; padding: 10px; border-radius: 8px; text-decoration: none; font-size: .875rem;">
                Kembali ke Keranjang
            </a>
            <form action="{{ route('order.confirm') }}" method="POST" style="flex: 1;">
                @csrf
                <input type="hidden" name="payment" value="{{ $payment }}">
                <button type="submit"
                    {{ ($payment === 'saldo' && Auth::user()->balance < $total) ? 'disabled' : '' }}
                    style="width: 100%; border: none; padding: 10px; border-radius: 8px; font-size: .875rem; font-weight: bold; color: #ffffff; cursor: {{ ($payment === 'saldo' && Auth::user()->balance < $total) ? 'not-allowed' : 'pointer' }}; background-color: {{ ($payment === 'saldo' && Auth::user()->balance < $total) ? '#9CA3AF' : '#2563EB' }}; transition: background-color 0.2s;">
                    Bayar
                </button>
            </form>
        </div>
    </div>
</div>
@endsection