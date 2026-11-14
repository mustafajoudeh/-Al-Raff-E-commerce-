<!doctype html>
<html lang="ar" dir="rtl" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#F6F3EE">
    <title>@yield('title', 'تسجيل الدخول') | الرَّف</title>
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
    <main class="auth-page">
        <section class="auth-art">
            <div class="auth-brand">
                <x-logo width="54" height="62" />
                <div class="brand-name"><strong>الرَّف</strong><small>AL-RAFF · BOOKS</small></div>
            </div>
            <div class="auth-message">
                <h1>لكل كتاب مكان، ولكل قارئ حكاية.</h1>
                <p>إدارة هادئة ومنظّمة لمكتبة الرَّف، من تفاصيل الكتب إلى إدارة المستخدمين والتصنيفات.</p>
            </div>
            <div class="auth-art-foot">الرَّف · مكتبة القارئ المتأنّي</div>
        </section>

        <section class="auth-side">
            <div class="auth-card">
                <div class="auth-small-logo">
                    <x-logo width="54" height="62" />
                </div>
                @yield('content')
            </div>
        </section>
    </main>

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