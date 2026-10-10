<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Hobby Saya') · {{ config('app.name', 'Laravel') }}</title>
    <style>
        :root {
            color-scheme: light;
            font-family: system-ui, sans-serif;
            color: #172033;
            background: #f4f6fb;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
        }

        header {
            background: #172033;
            color: #fff;
        }

        .nav,
        main {
            width: min(960px, calc(100% - 32px));
            margin: auto;
        }

        .nav {
            min-height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .brand {
            color: #fff;
            font-weight: 700;
            text-decoration: none;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        main {
            padding: 32px 0;
        }

        .card {
            background: #fff;
            border: 1px solid #e2e7f0;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 4px 16px #1720330a;
        }

        h1 {
            margin-top: 0;
        }

        .muted {
            color: #65718a;
        }

        .row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
        }

        .actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .button,
        button {
            display: inline-block;
            border: 0;
            border-radius: 8px;
            background: #334fca;
            color: white;
            padding: 10px 14px;
            font: inherit;
            text-decoration: none;
            cursor: pointer;
        }

        .button.secondary {
            background: #e9edf7;
            color: #172033;
        }

        .button.danger {
            background: #b42335;
        }

        .link {
            color: #334fca;
        }

        label {
            display: block;
            margin: 18px 0 6px;
            font-weight: 600;
        }

        input {
            width: 100%;
            max-width: 520px;
            padding: 11px 12px;
            border: 1px solid #bbc5d6;
            border-radius: 8px;
            font: inherit;
        }

        .error {
            color: #b42335;
            margin-top: 6px;
        }

        .notice {
            padding: 12px 14px;
            border-radius: 8px;
            margin-bottom: 16px;
            background: #e8f7ee;
            color: #17663a;
        }

        .notice.error-box {
            background: #fff0f0;
            color: #a11b2b;
        }

        .hobby {
            padding: 16px 0;
            border-bottom: 1px solid #e7eaf0;
        }

        .hobby:last-child {
            border-bottom: 0;
        }

        .inline {
            display: inline;
        }

        @media (max-width: 560px) {
            .nav {
                align-items: flex-start;
                padding: 14px 0;
                flex-direction: column;
            }

            .nav-right,
            .row {
                align-items: flex-start;
                flex-direction: column;
            }

            .card {
                padding: 18px;
            }
        }
    </style>
</head>

<body>
    <header>
        <nav class="nav" aria-label="Navigasi utama">
            <a class="brand" href="{{ route('hobbies.index') }}">Hobby Saya</a>
            @auth
                <div class="nav-right">
                    <span>{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="button secondary">Logout</button>
                    </form>
                </div>
            @endauth
        </nav>
    </header>
    <main>
        @if (session('status'))
            <div class="notice" role="status">{{ session('status') }}</div>
        @endif
        @if ($errors->any())
            <div class="notice error-box" role="alert">Periksa kembali input yang ditandai.</div>
        @endif
        @yield('content')
    </main>
</body>

</html>