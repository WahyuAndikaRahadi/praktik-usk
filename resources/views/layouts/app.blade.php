<!DOCTYPE html>
<html lang="id" data-theme="emerald">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/favicon-wahyustore.png') }}" type="image/x-icon">
    <title>{{ $title ?? 'WahyuStore - Toko Buku Online' }}</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
</head>
<body class="min-h-screen flex flex-col bg-base-200 text-base-content font-sans">

    <div class="navbar bg-base-100 shadow-sm sticky top-0 z-50 px-4 lg:px-8">
        <div class="navbar-start">
            <div class="dropdown">
                <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                    </svg>
                </div>
                <ul tabindex="0" class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li><a href="{{ route('books.index') }}">Katalog Buku</a></li>
                    <li><a href="{{ route('about') }}">Tentang Kami</a></li>
                    <li><a href="{{ route('contact.index') }}">Hubungi Admin</a></li>
                </ul>
            </div>
            <a href="{{ route('home') }}" class="btn btn-ghost text-xl font-bold text-primary tracking-tight">
                WahyuStore
            </a>
        </div>

        <div class="navbar-center hidden lg:flex">
            <ul class="menu menu-horizontal px-1 gap-1 font-medium">
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active font-bold' : '' }}">Beranda</a></li>
                <li><a href="{{ route('books.index') }}" class="{{ request()->routeIs('books.*') ? 'active font-bold' : '' }}">Katalog Buku</a></li>
                <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active font-bold' : '' }}">Tentang Kami</a></li>
                <li><a href="{{ route('contact.index') }}" class="{{ request()->routeIs('contact.*') ? 'active font-bold' : '' }}">Hubungi Admin</a></li>
            </ul>
        </div>

        <div class="navbar-end gap-2">
            @php
                $cartCount = count(session()->get('cart', []));
            @endphp
            <a href="{{ route('cart.index') }}" class="btn btn-ghost btn-circle">
                <div class="indicator">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    @if($cartCount > 0)
                        <span class="badge badge-sm badge-primary indicator-item">{{ $cartCount }}</span>
                    @endif
                </div>
            </a>

            @auth
                <div class="dropdown dropdown-end">
                    <div tabindex="0" role="button" class="btn btn-ghost gap-2">
                        <div class="avatar placeholder">
                            <div class="bg-primary text-primary-content rounded-full w-8">
                                <span class="text-xs uppercase">{{ substr(auth()->user()->name, 0, 2) }}</span>
                            </div>
                        </div>
                        <span class="hidden md:inline font-medium text-sm">{{ auth()->user()->name }}</span>
                    </div>
                    <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-1 w-52 p-2 shadow-lg mt-2">
                        @if(auth()->user()->role === 'admin')
                            <li><a href="{{ route('admin.dashboard') }}" class="text-primary font-bold">Panel Admin</a></li>
                            <li class="divider my-1"></li>
                        @endif
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit" class="w-full text-left text-error">Keluar</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn btn-ghost btn-sm">Masuk</a>
                <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Daftar</a>
            @endauth
        </div>
    </div>

    @if(session('success'))
        <div class="max-w-6xl mx-auto w-full px-4 pt-4">
            <div class="alert alert-success shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-6xl mx-auto w-full px-4 pt-4">
            <div class="alert alert-error shadow-sm text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="footer sm:footer-horizontal bg-base-100 text-base-content p-8 border-t border-base-300 mt-12">
        <aside>
            <p class="font-bold text-lg text-primary">WahyuStore</p>
            <p>Toko Buku Online Sederhana, Aman, dan Terpercaya.<br/>Melayani pengiriman ke seluruh wilayah Indonesia dengan sistem COD.</p>
        </aside>
        <nav>
            <h6 class="footer-title">Menu Cepat</h6>
            <a href="{{ route('home') }}" class="link link-hover">Beranda</a>
            <a href="{{ route('books.index') }}" class="link link-hover">Katalog Buku</a>
            <a href="{{ route('cart.index') }}" class="link link-hover">Keranjang Belanja</a>
        </nav>
        <nav>
            <h6 class="footer-title">Informasi</h6>
            <a href="{{ route('about') }}" class="link link-hover">Tentang Kami</a>
            <a href="{{ route('contact.index') }}" class="link link-hover">Hubungi Admin</a>
            <span class="text-sm text-base-content/70">Metode Bayar: COD (Bayar di Tempat)</span>
        </nav>
    </footer>

    <div class="bg-base-300 text-center py-4 text-sm text-base-content/80">
        <p>&copy; {{ date('Y') }} WahyuStore. Hak Cipta Dilindungi.</p>
    </div>

</body>
</html>
