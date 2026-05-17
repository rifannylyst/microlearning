<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Microlearning</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        @include('admin.partials.sidebar')

        <div class="flex-1 flex flex-col">

        {{-- HEADER --}}
        @include('admin.partials.header')

        {{-- CONTENT --}}
        <main class="p-6">
            @yield('content')
        </main>

        {{-- FOOTER --}}
        @include('admin.partials.footer')

    </div>
    </div>
</body>
</html>