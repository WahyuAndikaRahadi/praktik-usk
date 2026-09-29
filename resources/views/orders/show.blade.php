@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center gap-2">
                <h1 class="text-2xl md:text-3xl font-bold">Rincian Pesanan</h1>
                @if($order->status === 'pending')
                    <span class="badge badge-warning font-bold uppercase">{{ $order->status }}</span>
                @elseif($order->status === 'paid')
                    <span class="badge badge-success text-white font-bold uppercase">Selesai (Paid)</span>
                @else
                    <span class="badge badge-error text-white font-bold uppercase">Dibatalkan</span>
                @endif
            </div>
            <p class="text-sm text-base-content/70 mt-1">Kode: <span class="font-mono font-bold text-primary">{{ $order->order_code }}</span> &bull; Waktu Pesan: {{ $order->created_at->translatedFormat('d F Y, H:i') }} WIB</p>
        </div>
        <a href="{{ route('orders.index') }}" class="btn btn-ghost btn-sm">
            &larr; Kembali ke Pesanan Saya
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="md:col-span-2 space-y-6">
            <div class="card bg-base-100 shadow-sm border border-base-300 p-6">
                <h2 class="font-bold text-base mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    Buku yang Dipesan
                </h2>

                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr class="bg-base-200 text-xs uppercase">
                                <th>Buku</th>
                                <th class="text-right">Harga</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                                <tr>
                                    <td>
                                        <div class="font-bold text-sm">{{ $item->book_title }}</div>
                                        @if($item->book)
                                            <a href="{{ route('books.show', $item->book) }}" class="text-xs text-primary link link-hover">
                                                Lihat di Katalog &rarr;
                                            </a>
                                        @endif
                                    </td>
                                    <td class="text-right text-xs">
                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </td>
                                    <td class="text-center text-xs font-semibold">
                                        {{ $item->qty }}
                                    </td>
                                    <td class="text-right text-xs font-bold text-primary">
                                        Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="bg-base-100 font-bold border-t border-base-200">
                                <td colspan="3" class="text-right text-sm">Total Pembayaran:</td>
                                <td class="text-right text-primary text-base">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="card bg-base-100 shadow-sm border border-base-300 p-6">
                <h2 class="font-bold text-base mb-2 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Alamat Pengiriman
                </h2>
                <div class="bg-base-200 p-4 rounded-lg text-sm leading-relaxed whitespace-pre-line">
                    {{ $order->shipping_address }}
                </div>
            </div>
        </div>

        <div class="md:col-span-1 space-y-6">
            <div class="card bg-base-100 shadow-sm border border-base-300 p-6 space-y-4">
                <h2 class="font-bold text-base border-b border-base-200 pb-2">Info Pembayaran</h2>

                <div class="space-y-3 text-sm">
                    <div>
                        <div class="text-xs text-base-content/60">Metode Bayar</div>
                        <div class="badge badge-outline badge-primary font-bold uppercase mt-1">
                            {{ $order->payment_method }} (Bayar di Tempat)
                        </div>
                    </div>
                    <div>
                        <div class="text-xs text-base-content/60">Status Pesanan</div>
                        <div class="font-semibold text-sm mt-0.5">
                            @if($order->status === 'pending')
                                <span class="text-warning font-bold">Sedang Diproses</span>
                            @elseif($order->status === 'paid')
                                <span class="text-success font-bold">Lunas / Selesai</span>
                            @else
                                <span class="text-error font-bold">Dibatalkan</span>
                            @endif
                        </div>
                    </div>
                    <div>
                        <div class="text-xs text-base-content/60">Penerima</div>
                        <div class="font-semibold">{{ $order->customer_name }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-base-content/60">Email</div>
                        <div class="font-semibold">{{ $order->customer_email }}</div>
                    </div>
                    <div class="pt-2 border-t border-base-200">
                        <div class="text-xs text-base-content/60">Total yang harus dibayar</div>
                        <div class="text-xl font-extrabold text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                    </div>
                </div>

                <div class="divider my-1"></div>

                <a href="{{ route('contact.index') }}" class="btn btn-outline btn-sm w-full">
                    Ada Kendala? Hubungi Admin
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
