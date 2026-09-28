@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold">Pesan Masuk (Messages)</h1>
            <p class="text-sm text-base-content/70">Daftar pesan dan masukan dari pelanggan/pengunjung</p>
        </div>
    </div>

    <div class="card bg-base-100 shadow-sm border border-base-300">
        <div class="p-4 border-b border-base-200 flex flex-col md:flex-row gap-4 items-center justify-between">
            <form action="{{ route('admin.messages.index') }}" method="GET" class="flex flex-wrap gap-2 w-full md:w-auto">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari subjek / pesan / nama / email..." class="input input-sm input-bordered w-full md:w-72" />
                
                <select name="status" class="select select-sm select-bordered">
                    <option value="">Semua Status</option>
                    <option value="unread" {{ request('status') === 'unread' ? 'selected' : '' }}>Belum Dibaca</option>
                    <option value="read" {{ request('status') === 'read' ? 'selected' : '' }}>Sudah Dibaca</option>
                </select>

                <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                @if(request('search') || request('status'))
                    <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-ghost">Reset</a>
                @endif
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr class="bg-base-200 text-xs">
                        <th>Status</th>
                        <th>Pengirim</th>
                        <th>Subjek & Pesan</th>
                        <th>Tanggal</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages as $msg)
                        <tr class="{{ !$msg->is_read ? 'bg-primary/5 font-semibold' : '' }}">
                            <td>
                                @if(!$msg->is_read)
                                    <span class="badge badge-warning badge-sm font-bold">Baru</span>
                                @else
                                    <span class="badge badge-ghost badge-sm text-base-content/60">Dibaca</span>
                                @endif
                            </td>
                            <td>
                                <div class="text-sm font-bold">{{ $msg->user ? $msg->user->name : 'User ID: ' . $msg->user_id }}</div>
                                <div class="text-xs text-base-content/60">{{ $msg->user ? $msg->user->email : '-' }}</div>
                            </td>
                            <td>
                                <div class="text-sm font-medium">{{ $msg->subject }}</div>
                                <div class="text-xs text-base-content/60 truncate max-w-xs md:max-w-md">{{ \Illuminate\Support\Str::limit($msg->body, 80) }}</div>
                            </td>
                            <td class="text-xs text-base-content/70 whitespace-nowrap">
                                {{ $msg->created_at->format('d M Y, H:i') }}
                            </td>
                            <td class="text-right whitespace-nowrap">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.messages.show', $msg) }}" class="btn btn-xs btn-outline btn-primary">Buka Pesan</a>
                                    <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-xs btn-outline btn-error">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-8 text-base-content/60">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto text-base-content/30 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                </svg>
                                Belum ada pesan masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($messages->hasPages())
            <div class="p-4 border-t border-base-200 flex justify-center">
                {{ $messages->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
