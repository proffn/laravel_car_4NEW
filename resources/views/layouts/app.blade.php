<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Отдам даром')</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Play:wght@400;700&display=swap" rel="stylesheet" />
    
    <!-- Наши стили -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" />
    
    @stack('styles')
</head>
<body>
    @include('partials.header')
    
    <main class="container my-5">
        @yield('content')
        
        <!-- Модальное окно -->
        @include('partials.modal')
    </main>
    
    @include('partials.footer')
    
    <!-- Наши скрипты -->
    <script src="{{ mix('js/app.js') }}"></script>
    
    @stack('scripts')
</body>
</html>