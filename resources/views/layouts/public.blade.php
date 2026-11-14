<!doctype html>
<html lang="ar" dir="rtl" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#F6F3EE">
    <meta name="description"
        content="@yield('description', 'الرَّف، مكتبة القارئ المتأنّي. اكتشف كتباً مختارة ورتّب مكتبتك على مهل.')">
    <title>@yield('title', 'الرَّف') | مكتبة القارئ المتأنّي</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Cormorant+Garamond:wght@500;600&family=IBM+Plex+Sans+Arabic:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <script>
        try {
            var t = localStorage.getItem('alraff-theme');
            if (t === 'light' || t === 'dark') document.documentElement.dataset.theme = t
        } catch (e) { }
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>

<body>
    <header class="site-header">
        <div class="site-header-inner container">
            <a class="site-brand" href="{{ route('home') }}" aria-label="الرَّف - الرئيسية">
                <x-logo class="brand-mark" />
                <span><strong>الرَّف</strong><small>AL-RAFF · BOOKS</small></span>
            </a>

            <nav class="site-nav" aria-label="التنقل الرئيسي">
                <a href="{{ route('home') }}#home">الرئيسية</a>
                <a href="{{ route('home') }}#categories">الأقسام</a>
                <a href="{{ route('home') }}#catalog">مكتبتنا</a>
            </nav>

            <div class="site-actions">
                @auth
                    @if(auth()->user()->role === 'Admin')
                        <a class="btn btn-primary site-register" href="{{ route('admin.dashboard') }}">لوحة التحكم</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="site-login" type="submit">تسجيل الخروج</button>
                    </form>
                @else
                    <a class="site-login" href="{{ route('login') }}">تسجيل الدخول</a>
                    @if(Route::has('register'))
                        <a class="btn btn-primary site-register" href="{{ route('register') }}">إنشاء حساب</a>
                    @endif
                @endauth
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="container footer-inner">
            <a class="site-brand footer-brand" href="{{ route('home') }}">
                <x-logo class="brand-mark" />
                <span><strong>الرَّف</strong><small>AL-RAFF · BOOKS</small></span>
            </a>
            <p>مكتبة القارئ المتأنّي.</p>
            <div class="footer-links">
                <a href="{{ route('login') }}">دخول المسؤولين</a>
                @if(Route::has('register'))
                    <a href="{{ route('register') }}">إنشاء حساب</a>
                @endif
            </div>
            <small class="copyright">© {{ date('Y') }} الرَّف. جميع الحقوق محفوظة.</small>
        </div>
    </footer>

    <div id="toast-root" class="toast-root" aria-live="polite" aria-atomic="true">
        @if(session('success'))
            <div class="toast success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="toast error">{{ session('error') }}</div>
        @endif
    </div>

    @stack('scripts')
</body>

</html>