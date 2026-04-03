@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                <iconify-icon icon="mdi:file-document-multiple-outline" width="24"></iconify-icon>
            </div>
            <div>
                <p class="text-slate-500 text-sm">Total Laporan</p>
                <h3 class="text-2xl font-bold text-slate-800">{{ $allAspirations }}</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-orange-50 flex items-center justify-center text-orange-500">
                <iconify-icon icon="mdi:clock-alert-outline" width="24"></iconify-icon>
            </div>
            <div>
                <p class="text-slate-500 text-sm">Belum Diproses</p>
                <h3 class="text-2xl font-bold text-slate-800">{{ $pendingAspirations }}</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-purple-50 flex items-center justify-center text-purple-600">
                <iconify-icon icon="mdi:progress-wrench" width="24"></iconify-icon>
            </div>
            <div>
                <p class="text-slate-500 text-sm">Sedang Diproses</p>
                <h3 class="text-2xl font-bold text-slate-800">{{ $processedAspirations }}</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-teal-50 flex items-center justify-center text-primary">
                <iconify-icon icon="mdi:check-circle-outline" width="24"></iconify-icon>
            </div>
            <div>
                <p class="text-slate-500 text-sm">Selesai</p>
                <h3 class="text-2xl font-bold text-slate-800">{{ $resolvedAspirations }}</h3>
            </div>
        </div>
    </div>

    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-50">
            <h3 class="text-lg font-bold text-slate-800">Laporan Masuk Terbaru</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-600 uppercase text-sm tracking-wider">
                        <th class="px-6 py-4 font-medium">Tanggal</th>
                        <th class="px-6 py-4 font-medium">Pelapor</th>
                        <th class="px-6 py-4 font-medium">Judul Laporan</th>
                        <th class="px-6 py-4 font-medium">Lokasi</th>
                        <th class="px-6 py-4 font-medium">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-sm text-slate-700">
                    @forelse ($aspirations as $aspiration)
                        <tr class="hover:bg-slate-50 transition-colors border-b border-surface">
                            <td class="px-6 py-4">{{ $aspiration->created_at->format('d-m-Y') }}</td>
                            <td class="px-6 py-4 font-medium">{{ $aspiration->user->full_name }} <br>
                                <span class="text-xs text-slate-400 font-normal">
                                    {{ $aspiration->user->class }}
                                </span>
                            </td>
                            <td class="px-6 py-4">{{ $aspiration->title }}</td>
                            <td class="px-6 py-4">{{ $aspiration->location }}</td>
                            <td class="px-6 py-4">
                                @if ($aspiration->status === 'Menunggu')
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-50 text-orange-600">
                                        {{ $aspiration->status }}
                                    </span>
                                @elseif ($aspiration->status === 'Proses')
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-50 text-purple-600">
                                        {{ $aspiration->status }}
                                    </span>
                                @elseif ($aspiration->status === 'Selesai')
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-teal-50 text-teal-600">
                                        {{ $aspiration->status }}
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-50 text-red-600">
                                        {{ $aspiration->status }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16">
                                <div class="flex flex-col items-center justify-center gap-4 text-slate-500">
                                    <iconify-icon icon="iconamoon:search-light" width="64" class="text-slate-900"></iconify-icon>
                                    <span class="text-lg font-medium text-slate-900">Data Tidak Ditemukan</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection