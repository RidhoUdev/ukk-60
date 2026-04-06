@extends('layouts.student')

@section('title', 'Beranda')

@section('content')

    <div
        class="bg-primary rounded-2xl p-8 mb-8 text-white flex flex-col md:flex-row items-center justify-between gap-6 shadow-lg shadow-primary/20 relative overflow-hidden">
        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
        <div class="absolute -left-10 -bottom-10 w-32 h-32 bg-white/10 rounded-full blur-xl"></div>

        <div class="relative z-10">
            <h2 class="text-2xl font-bold mb-2">Selamat Datang, {{ auth()->user()->full_name }}!</h2>
            <p class="text-primary-100 max-w-xl">
                Jangan ragu untuk melaporkan kerusakan fasilitas sekolah. Laporanmu sangat berarti untuk kenyamanan belajar
                kita bersama.
            </p>
        </div>

        <div class="relative z-10">
            <a href="{{ route('siswa.aspirasi.index', ['action' => 'create']) }}"
                class="inline-flex items-center px-6 py-3 bg-white text-primary font-bold rounded-xl shadow-sm hover:bg-slate-50 transition transform hover:-translate-y-1">
                <iconify-icon icon="mdi:plus-circle-outline" class="mr-2" width="22"></iconify-icon>
                Buat Laporan Baru
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

        <div
            class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                <iconify-icon icon="mdi:folder-open-outline" width="24"></iconify-icon>
            </div>
            <div>
                <p class="text-slate-500 text-sm font-medium">Laporan Saya</p>
                <h3 class="text-2xl font-bold text-slate-800">{{ $allAspirations }}</h3>
            </div>
        </div>

        <div
            class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-full bg-orange-50 flex items-center justify-center text-orange-500">
                <iconify-icon icon="mdi:clock-outline" width="24"></iconify-icon>
            </div>
            <div>
                <p class="text-slate-500 text-sm font-medium">Menunggu</p>
                <h3 class="text-2xl font-bold text-slate-800">{{ $pendingAspirations }}</h3>
            </div>
        </div>

        <div
            class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-full bg-purple-50 flex items-center justify-center text-purple-600">
                <iconify-icon icon="mdi:progress-wrench" width="24"></iconify-icon>
            </div>
            <div>
                <p class="text-slate-500 text-sm font-medium">Diproses</p>
                <h3 class="text-2xl font-bold text-slate-800">{{ $processedAspirations }}</h3>
            </div>
        </div>

        <div
            class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-full bg-teal-50 flex items-center justify-center text-teal-600">
                <iconify-icon icon="mdi:check-decagram-outline" width="24"></iconify-icon>
            </div>
            <div>
                <p class="text-slate-500 text-sm font-medium">Selesai</p>
                <h3 class="text-2xl font-bold text-slate-800">{{ $resolvedAspirations }}</h3>
            </div>
        </div>
    </div>

    <div>
        <div class="mb-6">
            <h3 class="text-xl font-bold text-slate-800">Riwayat Laporan Terbaru</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($aspirations as $aspiration)
                <div
                    class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm hover:shadow-md transition-all duration-300 group">
                    <div class="flex justify-between items-start mb-4">
                        <span
                            class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-slate-100 text-slate-600">
                            {{ $aspiration->category->category_name }}
                        </span>
                        <span
                            class="text-xs text-slate-400 font-medium">{{ $aspiration->created_at->isoFormat('D MMM Y') }}</span>
                    </div>

                    <div class="mb-6">
                        <h4 class="text-base font-bold text-slate-800 mb-2 line-clamp-1">
                            {{ $aspiration->title }}
                        </h4>
                        <p class="text-sm text-slate-500 line-clamp-2 leading-relaxed">
                            AC di ruangan lab komputer 2 tidak dingin dan meneteskan air yang cukup banyak ke lantai...
                        </p>
                    </div>

                    <div class="flex items-center justify-between border-t border-gray-50 pt-4">
                        <span
                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-orange-50 text-orange-600 border border-orange-100">
                            Menunggu
                        </span>

                        <a href="{{ route('siswa.aspirasi.show', $aspiration->id) }}"
                            class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-50 text-slate-400 group-hover:bg-primary group-hover:text-white transition-all duration-300">
                            <iconify-icon icon="mdi:arrow-top-right" width="18"></iconify-icon>
                        </a>
                    </div>
                </div>

            @empty
                <div class="col-span-full px-6 py-16 flex w-full justify-center items-center">
                    <div class="flex flex-col items-center justify-center gap-4 text-slate-500">
                        <iconify-icon icon="iconamoon:search-light" width="64" class="text-slate-900"></iconify-icon>
                        <span class="text-lg font-medium text-slate-900">Data Tidak Ditemukan</span>
                    </div>
                </div>
            @endforelse

        </div>
    </div>

@endsection