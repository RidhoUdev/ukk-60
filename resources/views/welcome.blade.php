@extends('layouts.landing')

@section('content')
    <section class="py-16 lg:py-24">
        <div class="max-w-4xl mx-auto text-center px-4">
            <h1 class="text-4xl lg:text-5xl font-bold text-slate-900 leading-tight mb-4">
                Layanan Aspirasi & Pengaduan <br>
                <span class="text-primary">Sarana</span> Sekolah
            </h1>
            
            <p class="text-slate-600 text-lg mb-8 max-w-2xl mx-auto">
                Sampaikan laporan kerusakan fasilitas sekolah dengan mudah, cepat, dan transparan demi kenyamanan bersama.
            </p>

            <div class="mb-12">
                <a href="{{ url('/login') }}" class="inline-flex items-center px-8 py-3 border border-transparent text-base font-semibold rounded-full text-white bg-primary hover:bg-primary-dark transition duration-150 shadow-lg shadow-primary/30">
                    Lapor Sekarang
                </a>
            </div>

            <div class="flex justify-center mb-16">
                <img src="{{ asset('assets/asset1.png') }}" alt="Ilustrasi Pengaduan" class="w-full max-w-md h-auto object-contain">
            </div>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-slate-900 mb-2">Alur Pengaduan</h2>
                <p class="text-slate-600">Sampaikan laporan dalam 3 langkah mudah, dan cepat</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition duration-300">
                    <div class="w-14 h-14 rounded-full border-2 border-primary flex items-center justify-center mb-6 text-primary">
                        <iconify-icon icon="mdi:pencil-outline" width="28" height="28"></iconify-icon>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Tulis Laporan</h3>
                    <p class="text-slate-500 leading-relaxed">
                        Jelaskan keluhan Anda dan sertakan foto bukti kerusakan fasilitas.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition duration-300">
                    <div class="w-14 h-14 rounded-full border-2 border-primary flex items-center justify-center mb-6 text-primary">
                        <iconify-icon icon="mdi:clock-time-four-outline" width="28" height="28"></iconify-icon>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Tindak Lanjut</h3>
                    <p class="text-slate-500 leading-relaxed">
                        Laporan diverifikasi dan ditangani langsung oleh petugas sarana.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition duration-300">
                    <div class="w-14 h-14 rounded-full border-2 border-primary flex items-center justify-center mb-6 text-primary">
                        <iconify-icon icon="mdi:check-circle-outline" width="28" height="28"></iconify-icon>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Selesai</h3>
                    <p class="text-slate-500 leading-relaxed">
                        Pantau progres pengerjaan hingga perbaikan selesai tuntas.
                    </p>
                </div>

            </div>
        </div>
    </section>
@endsection