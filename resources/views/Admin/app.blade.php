<!DOCTYPE html>
<html class="h-full bg-gray-200">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="icon" href="{{ asset('favicons/favicon.ico') }}">
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('/js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', serif;
        }
        .gradient {
            background: linear-gradient(90deg, #3e33d5 0%, #8651da 100%);
        }
    </style>
    @routes
</head>
<body class="leading-none text-gray-800 tracking-normal gradient antialiased">
@inertia
</body>
</html>
