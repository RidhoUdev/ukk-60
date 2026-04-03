<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lookify - Layanan Aspirasi Sekolah</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-slate-800">

    <nav class="fixed top-0 left-0 right-0 w-full bg-white/20 backdrop-blur-md border-b border-gray-100 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex-shrink-0 flex items-center gap-2">
                    <img src="{{ asset('assets/lookify-primary.png') }}" alt="Lookify Logo" class="w-32 max-w-md h-auto object-contain">
                </div>
                <div>
                    <a href="{{ url('/login') }}" class="inline-flex items-center px-6 py-2 border border-primary text-sm font-medium rounded-full text-slate-700 bg-white hover:bg-primary hover:text-white transition ease-in-out duration-150">
                        Masuk
                        <iconify-icon icon="mdi:chevron-right" class="ml-1" width="20"></iconify-icon>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="pt-20">
        @yield('content')
    </main>

    <footer class="bg-primary-dark text-white py-8 mt-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-sm font-medium">Copyright &copy; 2026 SMKN 4 Kota Tangerang - Rekayasa Perangkat Lunak</p>
        </div>
    </footer>

</body>
</html>