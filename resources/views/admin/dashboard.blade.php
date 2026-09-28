@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    <div>
        <h1 class="text-2xl md:text-3xl font-bold">Ringkasan Dashboard</h1>
        <p class="text-sm text-base-content/70">Ikhtisar aktivitas dan data toko buku WahyuStore</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
        <div class="card bg-base-100 shadow-sm border border-base-300">
            <div class="card-body p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-xs font-bold uppercase text-base-content/60">Total Buku</div>
                        <div class="text-2xl font-extrabold mt-1 text-primary">{{ $totalBooks }}</div>
                    </div>
                    <div class="p-3 bg-primary/10 text-primary rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="card bg-base-100 shadow-sm border border-base-300">
            <div class="card-body p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-xs font-bold uppercase text-base-content/60">Total Kategori</div>
                        <div class="text-2xl font-extrabold mt-1">{{ $totalCategories }}</div>
                    </div>
                    <div class="p-3 bg-secondary/10 text-secondary rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="card bg-base-100 shadow-sm border border-base-300">
            <div class="card-body p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-xs font-bold uppercase text-base-content/60">Customer</div>
                        <div class="text-2xl font-extrabold mt-1">{{ $totalUsers }}</div>
                    </div>
                    <div class="p-3 bg-accent/10 text-accent rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="card bg-base-100 shadow-sm border border-base-300">
            <div class="card-body p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-xs font-bold uppercase text-base-content/60">Order Pending</div>
                        <div class="text-2xl font-extrabold mt-1 text-warning">{{ $totalPendingOrders }}</div>
                    </div>
                    <div class="p-3 bg-warning/10 text-warning rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="card bg-base-100 shadow-sm border border-base-300">
            <div class="card-body p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-xs font-bold uppercase text-base-content/60">Pesan Baru</div>
                        <div class="text-2xl font-extrabold mt-1 text-info">{{ $unreadMessagesCount }}</div>
                    </div>
                    <div class="p-3 bg-info/10 text-info rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Pesanan Terbaru -->
        <div class="card bg-base-100 shadow-sm border border-base-300">
            <div class="card-body p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-bold">Pesanan Terbaru</h2>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-ghost btn-xs text-primary font-bold">Semua Pesanan &rarr;</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="table table-sm">
                        <thead>
                            <tr class="bg-base-200 text-xs">
                                <th>Kode Order</th>
                                <th>Pembeli</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentOrders as $order)
                                <tr>
                                    <td class="font-mono font-bold text-xs">{{ $order->order_code }}</td>
                                    <td>
                                        <div class="font-semibold text-xs">{{ $order->customer_name }}</div>
                                    </td>
                                    <td class="font-bold text-xs text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                    <td>
                                        @if($order->status === 'pending')
                                            <span class="badge badge-warning badge-xs uppercase">{{ $order->status }}</span>
                                        @elseif($order->status === 'paid')
                                            <span class="badge badge-success badge-xs text-white uppercase">{{ $order->status }}</span>
                                        @else
                                            <span class="badge badge-error badge-xs text-white uppercase">{{ $order->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-xs btn-outline">Detail</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-6 text-base-content/60">Belum ada pesanan yang masuk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pesan Masuk Terbaru -->
        <div class="card bg-base-100 shadow-sm border border-base-300">
            <div class="card-body p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-bold">Pesan Masuk Terbaru</h2>
                    <a href="{{ route('admin.messages.index') }}" class="btn btn-ghost btn-xs text-primary font-bold">Semua Pesan &rarr;</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="table table-sm">
                        <thead>
                            <tr class="bg-base-200 text-xs">
                                <th>Pengirim</th>
                                <th>Subjek</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentMessages as $msg)
                                <tr class="{{ !$msg->is_read ? 'bg-primary/5' : '' }}">
                                    <td>
                                        <div class="font-semibold text-xs">{{ $msg->user ? $msg->user->name : 'User #' . $msg->user_id }}</div>
                                        <div class="text-[11px] text-base-content/60">{{ $msg->created_at->diffForHumans() }}</div>
                                    </td>
                                    <td>
                                        <div class="text-xs font-medium truncate max-w-[150px]">{{ $msg->subject }}</div>
                                    </td>
                                    <td>
                                        @if(!$msg->is_read)
                                            <span class="badge badge-warning badge-xs font-bold">Baru</span>
                                        @else
                                            <span class="badge badge-ghost badge-xs text-base-content/60">Dibaca</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.messages.show', $msg) }}" class="btn btn-xs btn-outline btn-primary">Buka</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-6 text-base-content/60">Belum ada pesan masuk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
