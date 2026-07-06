<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MicroLearn Admin</title>

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Fonts Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-800">

<div class="flex min-h-screen">

    {{-- Sidebar --}}
    @include('admin.partials.sidebar')

    {{-- Content Area --}}
    <div class="flex-1 flex flex-col bg-slate-50/50">

        {{-- Header --}}
        @include('admin.partials.header')

        {{-- Main Content --}}
        <main class="flex-1 p-6 overflow-y-auto bg-slate-50">
            @yield('content')
        </main>

        {{-- Footer --}}
        @include('admin.partials.footer')

    </div>

</div>

@stack('scripts')

</body>
</html>