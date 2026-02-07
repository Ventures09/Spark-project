<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @section('title')
        Aces Tagum College
        @show
    </title>

    <link rel="icon" href="{{ asset('storage/iictlogo.png') }}" type="image/png">

    <!-- CSS -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- PAGE STYLES -->
    @stack('styles')
</head>

<body>

    @include('navbar')

    <!-- PAGE CONTENT -->
    <div class="container" style="margin-top: 100px;">
        @yield('content')
    </div>

    <!-- JS -->
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- 🔥 THIS WAS MISSING -->
    @stack('scripts')

</body>
</html>
