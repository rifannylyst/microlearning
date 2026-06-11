<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MicroLearn Admin</title>

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100">

<div class="flex min-h-screen">

    {{-- Sidebar --}}
    @include('admin.partials.sidebar')

    {{-- Content Area --}}
    <div class="flex-1 flex flex-col">

        {{-- Header --}}
        @include('admin.partials.header')

        {{-- Main Content --}}
        <main class="flex-1 p-6 overflow-y-auto">
            @yield('content')
        </main>

        {{-- Footer --}}
        @include('admin.partials.footer')

    </div>

</div>

@stack('scripts')

</body>
</html>