<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>
    <style>
        body{font-family:system-ui,-apple-system,"Segoe UI",sans-serif;background:#f4f6f8;color:#243042;margin:0}
        main{max-width:440px;margin:8vh auto;padding:2rem;background:#fff;border:1px solid #e1e6eb;border-radius:12px;box-shadow:0 8px 28px #24304212}
        h1{font-size:1.5rem;margin-top:0}label{display:block;font-weight:600;margin:.9rem 0 .35rem}
        input{box-sizing:border-box;width:100%;padding:.7rem;border:1px solid #bcc6d0;border-radius:6px;font:inherit}
        button{margin-top:1rem;width:100%;padding:.75rem;background:#1769aa;color:white;border:0;border-radius:6px;font:inherit;font-weight:600;cursor:pointer}
        a{color:#1769aa}.error{color:#a51d2d}.status{padding:.7rem;background:#e9f6ed;border-radius:6px}
    </style>
</head>
<body>
<main>
    <a href="{{ url('/') }}">{{ config('app.name') }}</a>
    @yield('content')
</main>
</body>
</html>
