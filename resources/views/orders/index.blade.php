@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold">Pesanan Saya</h1>
            <p class="text-sm text-base-content/70">Pantau dan kelola riwayat pesanan buku Anda</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('books.index') }}" class="btn btn-primary btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Belanja Lagi
            </a>
        </div>
    </div>

    <div class="card bg-base-100 shadow-sm border border-base-300">
        <div class="p-4 border-b border-base-200 flex flex-col sm:flex-row gap-2 justify-between items-center">
            <form action="{{ route('orders.index') }}" method="GET" class="flex flex-wrap items-center gap-2 w-full sm:w-auto">
                <select name="status" class="select select-sm select-bordered w-full sm:w-44">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending (Menunggu)</option>
                    <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Paid (Selesai/Lunas)</option>
                    <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled (Dibatalkan)</option>
                </select>
                <button type="submit" class="btn btn-sm btn-outline">Filter</button>
                @if(request('status'))
                    <a href="{{ route('orders.index') }}" class="btn btn-sm btn-ghost">Reset</a>
                @endif
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr class="bg-base-200 text-xs uppercase">
                        <th>Kode Pesanan</th>
                        <th>Tanggal</th>
                        <th>Item Buku</th>
                        <th>Total Tagihan</th>
                        <th>Status</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr class="hover">
                            <td>
                                <span class="font-mono font-bold text-xs text-primary">{{ $order->order_code }}</span>
                                <div class="text-[11px] text-base-content/60 uppercase">{{ $order->payment_method }} (Bayar di Tempat)</div>
                            </td>
                            <td class="text-xs text-base-content/70">
                                {{ $order->created_at->translatedFormat('d M Y, H:i') }}
                            </td>
                            <td>
                                <div class="text-xs font-medium">
                                    {{ $order->items->count() }} jenis buku ({{ $order->items->sum('qty') }} pcs)
                                </div>
                                <div class="text-[11px] text-base-content/60 truncate max-w-xs">
                                    {{ $order->items->pluck('book_title')->join(', ') }}
                                </div>
                            </td>
                            <td class="font-bold text-xs text-primary">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </td>
                            <td>
                                @if($order->status === 'pending')
                                    <span class="badge badge-warning badge-sm uppercase font-semibold">Pending</span>
                                @elseif($order->status === 'paid')
                                    <span class="badge badge-success badge-sm text-white uppercase font-semibold">Selesai (Paid)</span>
                                @else
                                    <span class="badge badge-error badge-sm text-white uppercase font-semibold">Dibatalkan</span>
                                @endif
                            </td>
                            <td class="text-right">
                                <a href="{{ route('orders.show', $order) }}" class="btn btn-xs btn-outline btn-primary">
                                    Lihat Rincian
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-12 text-base-content/60">
                                <div class="flex flex-col items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-base-content/30 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    <p class="font-medium text-base text-base-content/80">Belum Ada Riwayat Pesanan</p>
                                    <p class="text-xs text-base-content/50 mt-1">Anda belum pernah melakukan pemesanan buku.</p>
                                    <a href="{{ route('books.index') }}" class="btn btn-sm btn-primary mt-4">Jelajahi Katalog Buku</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($orders->hasPages())
            <div class="p-4 border-t border-base-200 flex justify-center">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
