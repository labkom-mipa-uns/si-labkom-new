<!DOCTYPE html>
<html>
<head>
    <title>Labkom FMIPA UNS | 503 Error</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <!-- Favicons -->
    <link rel="icon" href="favicons/favicon.ico">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: Nunito, sans-serif;
        }
        .text-9xl{
            font-size: 14rem;
        }
        @media(max-width: 645px){
            .text-9xl{
                font-size: 5.75rem;
            }
            .text-6xl{
                font-size: 1.75rem;
            }
            .text-2xl {
                font-size: 1rem;
                line-height: 1.2rem;
            }
            .py-8 {
                padding-top: 1rem;
                padding-bottom: 1rem;
            }
            .px-6 {
                padding-left: 1.2rem;
                padding-right: 1.2rem;
            }
            .mr-6{
                margin-right: 0.5rem;
            }
            .px-12 {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }
    </style>
</head>
<body>
<div class="bg-gradient-to-r from-blue-700 via-purple-600 to-purple-600">
    <div class="w-9/12 m-auto py-16 min-h-screen flex flex-col items-center justify-center">
        <img src="/img/LogoWebLabkom.png" alt="labkom-logo" class="block w-full pb-8 max-w-xs mx-auto text-white fill-current">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg pb-8">
            <div class="border-t border-gray-200 text-center pt-8">
                <h1 class="text-9xl font-bold text-purple-600">503</h1>
                <h1 class="text-6xl font-bold py-2 text-purple-600">Service Unavailable</h1>
                <p class="text-2xl pb-8 px-12 font-medium">Sorry, we are doing some maintenance. Please check back soon.</p>
                <a href="{{ route('home') }}" class="bg-gradient-to-r from-purple-400 to-blue-500 hover:from-pink-500 hover:to-orange-500 text-white font-semibold px-6 py-3 rounded-md mr-6">
                    HOME
                </a>
                <a href="mailto:labkom.mipa.uns.ac.id" class="bg-gradient-to-r from-red-400 to-red-500 hover:from-red-500 hover:to-red-500 text-white font-semibold px-6 py-3 rounded-md">
                    Contact Us
                </a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
