@php
    $navItems = [
        [
            'route' => 'admin.dashboard',
            'match' => 'admin.dashboard',
            'label' => 'الرئيسية',
            'icon' => 'dashboard',
            'pending' => false,
        ],
        [
            'route' => 'admin.users.index',
            'match' => 'admin.users.*',
            'label' => 'المستخدمون',
            'icon' => 'users',
            'pending' => false,
        ],
        [
            'route' => 'admin.products.index',
            'match' => 'admin.products.*',
            'label' => 'الكتب والمنتجات',
            'icon' => 'book',
            'pending' => false,
        ],
        [
            'route' => 'admin.categories.index',
            'match' => 'admin.categories.*',
            'label' => 'التصنيفات',
            'icon' => 'folders',
            'pending' => false,
        ],
        ['route' => null, 'match' => null, 'label' => 'الطلبات', 'icon' => 'cart', 'pending' => true],
    ];
    $currentUser = auth()->user();
@endphp
<!doctype html>
<html lang="ar" dir="rtl" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#F6F3EE">
    <title>@yield('title', 'لوحة التحكم') | الرَّف</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Cormorant+Garamond:wght@500;600&family=IBM+Plex+Sans+Arabic:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://jsdelivr.net" rel="stylesheet">
    <script>
        try {
            var t = localStorage.getItem('alraff-theme');
            if (t === 'light' || t === 'dark') 
            document.documentElement.dataset.theme = t
        } catch (e) {}
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>

<body>
    <div class="page-shell">
        <div class="sidebar-overlay" id="sidebar-overlay" hidden></div>

        <aside class="sidebar" id="sidebar">
            <div class="brand">
                <x-logo class="brand-mark" />
                <div class="brand-name"><strong>الرَّف</strong><small>AL-RAFF</small></div>
            </div>

            <nav class="nav-group" aria-label="القائمة الرئيسية">
                <span class="nav-caption">إدارة المتجر</span>
                @foreach ($navItems as $item)
                    @if ($item['pending'])
                        <a class="nav-link disabled-link" href="#" data-pending="true">
                            <x-icon :name="$item['icon']" />
                            <span>{{ $item['label'] }}</span>
                            <span class="pill pill-neutral">قريباً</span>
                        </a>
                    @else
                        <a class="nav-link {{ request()->routeIs($item['match']) ? 'active' : '' }}"
                            href="{{ Route::has($item['route']) ? route($item['route']) : '#' }}">
                            <x-icon :name="$item['icon']" />
                            <span>{{ $item['label'] }}</span>
                        </a>
                    @endif
                @endforeach
            </nav>

            <div class="sidebar-bottom">
                <div class="sidebar-note">
                    <strong>مكتبة القارئ المتأنّي</strong>
                    إدارة الكتب والتصنيفات والمستخدمين من مكان واحد.
                </div>
                <form method="POST" action="{{ Route::has('logout') ? route('logout') : '#' }}">
                    @csrf
                    <button class="nav-link" type="submit" id="sidebar-logout">
                        <x-icon name="logout" />
                        <span>تسجيل الخروج</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="admin-main">
            <header class="topbar">
                <div class="topbar-start">
                    <button class="icon-button mobile-menu" type="button" id="mobile-menu" aria-label="فتح القائمة">
                        <x-icon name="menu" />
                    </button>
                    <div class="topbar-title">
                        <strong>@yield('title', 'لوحة التحكم')</strong>
                        <span>@yield('subtitle', 'لوحة إدارة متجر الرَّف')</span>
                    </div>
                </div>
                <div class="topbar-actions">
                    <button class="icon-button" type="button" id="theme-toggle" aria-label="تبديل المظهر">
                        <x-icon name="moon" />
                    </button>
                    <div class="user-chip">
                        <span class="avatar">{{ mb_strtoupper(mb_substr($currentUser->name ?? 'م', 0, 1)) }}</span>
                        <div>
                            <strong>{{ $currentUser->name ?? 'المسؤول' }}</strong>
                            <small>مسؤول النظام</small>
                        </div>
                    </div>
                </div>
            </header>

            <section id="page-content">
                @yield('content')
            </section>
        </main>
    </div>

    <div id="toast-root" class="toast-root" aria-live="polite" aria-atomic="true">
        @if (session('success'))
            <div class="toast success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="toast error">{{ session('error') }}</div>
        @endif
    </div>

    @stack('scripts')
</body>

</html>
