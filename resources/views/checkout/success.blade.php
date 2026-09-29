@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-12">
    <div class="card bg-base-100 shadow-sm border border-base-300 p-6 md:p-10 text-center">
        <div class="w-16 h-16 bg-success/10 text-success rounded-full flex items-center justify-center mx-auto mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        </div>

        <h1 class="text-2xl md:text-3xl font-extrabold text-success">Pesanan Berhasil Dibuat!</h1>
        <p class="text-base-content/70 text-sm mt-2">Terima kasih atas pesanan Anda. Kami akan segera memproses dan mengirimkan buku pesanan Anda.</p>

        <div class="bg-base-200 rounded-lg p-6 my-6 text-left space-y-3 text-sm">
            <div class="flex justify-between border-b border-base-300 pb-2">
                <span class="text-base-content/70">Kode Pesanan:</span>
                <span class="font-bold text-primary font-mono text-base">{{ $order->order_code }}</span>
            </div>
            <div class="flex justify-between border-b border-base-300 pb-2">
                <span class="text-base-content/70">Nama Pembeli:</span>
                <span class="font-bold">{{ $order->customer_name }}</span>
            </div>
            <div class="flex justify-between border-b border-base-300 pb-2">
                <span class="text-base-content/70">Status Pesanan:</span>
                <span class="badge badge-warning uppercase font-bold">{{ $order->status }}</span>
            </div>
            <div class="flex justify-between border-b border-base-300 pb-2">
                <span class="text-base-content/70">Metode Bayar:</span>
                <span class="font-bold uppercase">{{ $order->payment_method }} (Bayar di Tempat)</span>
            </div>
            <div class="flex justify-between border-b border-base-300 pb-2">
                <span class="text-base-content/70">Alamat Kirim:</span>
                <span class="font-medium text-right max-w-xs">{{ $order->shipping_address }}</span>
            </div>
            <div class="flex justify-between pt-2 text-base font-bold">
                <span>Total Pembayaran:</span>
                <span class="text-primary text-lg">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="text-left mb-6">
            <h3 class="font-bold text-sm mb-2">Daftar Buku yang Dipesan:</h3>
            <div class="divide-y divide-base-200 text-xs">
                @foreach($order->items as $item)
                    <div class="py-2 flex justify-between">
                        <span>{{ $item->book_title }} (x{{ $item->qty }})</span>
                        <span class="font-semibold">Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex flex-col sm:flex-row justify-center gap-3">
            @auth
                <a href="{{ route('orders.index') }}" class="btn btn-outline btn-primary">Lihat Pesanan Saya</a>
            @endauth
            <a href="{{ route('books.index') }}" class="btn btn-primary">Lanjut Belanja Buku</a>
            <a href="{{ route('home') }}" class="btn btn-ghost">Kembali ke Beranda</a>
        </div>
    </div>
</div>
@endsection
