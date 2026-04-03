<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lookify Admin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-slate-800 bg-slate-50">

    <div class="flex h-screen overflow-hidden">

        <aside class="w-64 bg-white border-r border-gray-200 flex flex-col fixed h-full z-30">
            <div class="h-20 flex items-center px-8 border-b border-surface">
                <img src="{{ asset('assets/lookify-primary.png') }}" alt="Lookify Logo" class="h-16 w-auto">
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">

                <a href="{{ url('/admin/dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-colors
        {{ request()->is('admin/dashboard') ? 'bg-primary/10 text-primary' : 'text-slate-600 hover:bg-slate-50 hover:text-primary' }}">
                    <iconify-icon icon="mdi:view-dashboard-outline" width="22"></iconify-icon>
                    Dashboard
                </a>

                <a href="{{ url('/admin/siswa') }}"
                    class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-colors
        {{ request()->is('admin/siswa*') ? 'bg-primary/10 text-primary' : 'text-slate-600 hover:bg-slate-50 hover:text-primary' }}">
                    <iconify-icon icon="famicons:people-outline" width="22"></iconify-icon>
                    Data Siswa
                </a>

                <a href="{{ url('/admin/kategori') }}"
                    class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-colors
        {{ request()->is('admin/kategori*') ? 'bg-primary/10 text-primary' : 'text-slate-600 hover:bg-slate-50 hover:text-primary' }}">
                    <iconify-icon icon="ph:stack" width="22"></iconify-icon>
                    Data Kategori
                </a>

                <a href="{{ url('/admin/kelola-pengaduan') }}"
                    class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-colors
        {{ request()->is('admin/kelola-pengaduan*') ? 'bg-primary/10 text-primary' : 'text-slate-600 hover:bg-slate-50 hover:text-primary' }}">
                    <iconify-icon icon="mingcute:clipboard-line" width="22"></iconify-icon>
                    Kelola Pengaduan
                </a>

            </nav>

            <div class="p-4 border-t border-surface">
                <form id="form-logout" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button onclick="confirmLogout()" type="button"
                        class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-red-500 rounded-xl hover:bg-red-50 transition-colors cursor-pointer">
                        <iconify-icon icon="mdi:logout" width="22"></iconify-icon>
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col ml-64 transition-all duration-300">

            <header class="h-20 bg-white border-b border-gray-200 sticky top-0 z-20">
                <div class="flex items-center justify-between px-8 h-full max-w-7xl mx-auto w-full">

                    <h2 class="text-xl font-bold text-slate-800">@yield('title', 'Dashboard')</h2>

                    <div class="flex items-center gap-3">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-semibold text-slate-900">{{ auth()->user()->full_name }}</p>
                            <p class="text-xs text-slate-500">SMKN 4 TANGERANG</p>
                        </div>
                        <div
                            class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center text-slate-500">
                            <iconify-icon icon="mdi:user" width="20"></iconify-icon>
                        </div>
                    </div>

                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-8">
                <div class="max-w-7xl mx-auto w-full">
                    @yield('content')
                </div>
            </main>
        </div>

    </div>

</body>

<script type="module">
    window.confirmLogout = function () {
        Swal.fire({
            title: "Konfirmasi Keluar",
            text: "Apakah anda yakin ingin keluar dari aplikasi?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Keluar",
            cancelButtonText: "Batal",
            buttonsStyling: false,
            customClass: {
                popup: 'rounded-[2rem] p-8',
                title: 'text-2xl font-bold text-slate-900 mt-4',
                htmlContainer: 'text-slate-600 text-base mt-2',
                confirmButton: 'bg-red-500 hover:bg-red-600 text-white font-semibold py-3 px-8 rounded-xl mt-6 transition duration-200 mx-2 cursor-pointer',
                cancelButton: 'bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold py-3 px-8 rounded-xl mt-6 transition duration-200 mx-2 cursor-pointer'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-logout').submit();
            }
        });
    }
</script>

</html>