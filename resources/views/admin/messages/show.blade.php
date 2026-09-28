@extends('layouts.admin')

@section('content')
<div class="space-y-6 max-w-4xl">
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.messages.index') }}" class="btn btn-ghost btn-sm gap-1 mb-2">
                &larr; Kembali ke Daftar Pesan
            </a>
            <h1 class="text-2xl font-bold">Detail Pesan</h1>
        </div>
        <div class="flex items-center gap-2">
            <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-error text-white">Hapus Pesan</button>
            </form>
        </div>
    </div>

    <div class="card bg-base-100 shadow-sm border border-base-300">
        <div class="card-body p-6 space-y-6">
            <div class="border-b border-base-200 pb-4">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                    <div>
                        <span class="text-xs uppercase font-bold text-base-content/60">Pengirim</span>
                        <div class="font-bold text-lg text-primary">{{ $message->user ? $message->user->name : 'User ID: ' . $message->user_id }}</div>
                        <div class="text-sm text-base-content/70">
                            Email: <a href="mailto:{{ $message->user ? $message->user->email : '' }}" class="link link-hover text-primary font-medium">{{ $message->user ? $message->user->email : '-' }}</a>
                            @if($message->user && $message->user->phone)
                                &bull; Telp/WA: {{ $message->user->phone }}
                            @endif
                        </div>
                    </div>
                    <div class="text-xs text-base-content/60 sm:text-right">
                        <div>Diterima pada:</div>
                        <div class="font-semibold text-sm text-base-content/80">{{ $message->created_at->format('d M Y, H:i') }} ({{ $message->created_at->diffForHumans() }})</div>
                    </div>
                </div>
            </div>

            <div>
                <span class="text-xs uppercase font-bold text-base-content/60">Subjek</span>
                <h2 class="text-xl font-bold mt-1 text-base-content">{{ $message->subject }}</h2>
            </div>

            <div>
                <span class="text-xs uppercase font-bold text-base-content/60">Isi Pesan</span>
                <div class="bg-base-200/60 p-4 rounded-xl mt-2 text-sm text-base-content whitespace-pre-line leading-relaxed border border-base-300">
                    {{ $message->body }}
                </div>
            </div>

            <div class="pt-4 border-t border-base-200 flex flex-wrap gap-3">
                @if($message->user && $message->user->email)
                    <a href="mailto:{{ $message->user->email }}?subject=Re: {{ rawurlencode($message->subject) }}" class="btn btn-primary btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Balas via Email
                    </a>
                @endif
                <a href="{{ route('admin.messages.index') }}" class="btn btn-outline btn-sm">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
