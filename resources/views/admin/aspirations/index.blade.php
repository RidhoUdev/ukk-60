@extends('layouts.admin')

@section('title', 'Kelola Pengaduan')

@section('content')
    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-8">

        <div class="relative w-full sm:flex-1">
            <form action="{{ route('admin.aspirasi.index') }}" method="GET">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <iconify-icon icon="mdi:magnify" class="text-slate-400" width="20"></iconify-icon>
                </div>
                <input name="search" type="text" value="{{ request('search') }}"
                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 rounded-xl leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary sm:text-sm transition duration-150 ease-in-out"
                    placeholder="Cari pelapor, Judul laporan, Kelas, Lokasi">
            </form>
        </div>

        <div class="flex gap-3 w-full sm:w-auto" x-data>
            <a href="{{ route('admin.aspirasi.index') }}"
                class="inline-flex justify-center items-center px-4 py-2.5 border border-red-200 text-sm font-medium rounded-xl text-red-600 bg-red-50 hover:bg-red-100 transition duration-150 w-full sm:w-auto cursor-pointer">
                <iconify-icon icon="mdi:filter-remove-outline" class="mr-2" width="20"></iconify-icon>
                Reset
            </a>
            <button x-on:click="$dispatch('open-modal', 'filter-pengaduan')"
                class="inline-flex justify-center items-center px-4 py-2.5 border border-gray-200 text-sm font-medium rounded-xl text-slate-600 bg-white hover:bg-slate-50 transition duration-150 w-full sm:w-auto cursor-pointer">
                <iconify-icon icon="mdi:filter-variant" class="mr-2" width="20"></iconify-icon>
                Filter
            </button>
        </div>
    </div>

    <x-modal name="filter-pengaduan" title="Filter Pengaduan">
        <form action="{{ route('admin.aspirasi.index') }}" method="GET">
            @if(request('search'))
                <input type="hidden" name="search" value="{{ request('search') }}">
            @endif

            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Mulai Tanggal</label>
                        <input type="date" name="start_date" value="{{ request('start_date') }}"
                            class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Sampai Tanggal</label>
                        <input type="date" name="end_date" value="{{ request('end_date') }}"
                            class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary focus:outline-none">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Kategori</label>
                    <select name="category_id"
                        class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary focus:outline-none">
                        <option value="">Semua Kategori</option>
                        @foreach($categories ?? [] as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Status</label>
                    <select name="status"
                        class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary focus:outline-none">
                        <option value="">Semua Status</option>
                        <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="Proses" {{ request('status') == 'Proses' ? 'selected' : '' }}>Proses</option>
                        <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
            </div>

            <div class="mt-8 flex items-center justify-end">
                <div class="flex gap-3">
                    <button type="button" x-on:click="$dispatch('close-modal', 'filter-pengaduan')"
                        class="px-4 py-2 border border-gray-200 text-sm font-medium rounded-xl text-slate-600 bg-white hover:bg-slate-50 transition-colors cursor-pointer">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium rounded-xl text-white bg-primary hover:bg-primary-dark transition-colors cursor-pointer">
                        Terapkan Filter
                    </button>
                </div>
            </div>
        </form>
    </x-modal>

    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-600 text-xs uppercase tracking-wider border-b border-gray-100">
                        <th class="px-6 py-4 font-bold w-16">No</th>
                        <th class="px-6 py-4 font-bold">Tanggal</th>
                        <th class="px-6 py-4 font-bold">Pelapor</th>
                        <th class="px-6 py-4 font-bold max-w-xs">Judul Laporan</th>
                        <th class="px-6 py-4 font-bold">Kategori & Lokasi</th>
                        <th class="px-6 py-4 font-bold">Status</th>
                        <th class="px-6 py-4 font-bold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-sm text-slate-700">
                    @forelse ($aspirations as $index => $aspiration)
                        <tr class="hover:bg-slate-50 transition-colors border-b border-surface">
                            <td class="px-6 py-4 text-slate-500">{{ $aspirations->firstItem() + $index }}</td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-slate-900">{{ $aspiration->created_at->format('d-m-Y') }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-slate-900">{{ $aspiration->user->full_name }}</div>
                                <div class="text-xs text-slate-400">
                                    {{ $aspiration->user->class }}
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-600 truncate max-w-xs">
                                {{ $aspiration->description }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-slate-900">{{ $aspiration->category->category_name }}</div>
                                <div class="text-xs text-slate-400 font-semibold">
                                    Lokasi : {{ $aspiration->location }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if($aspiration->status === 'Menunggu')
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-orange-50 text-orange-600 border border-orange-100">
                                        {{ $aspiration->status }}
                                    </span>
                                @elseif($aspiration->status === 'Proses')
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-purple-50 text-purple-600 border border-orange-100">
                                        {{ $aspiration->status }}
                                    </span>
                                @elseif($aspiration->status === 'Selesai')
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-teal-50 text-teal-600 border border-orange-100">
                                        {{ $aspiration->status }}
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-50 text-red-600 border border-orange-100">
                                        {{ $aspiration->status }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 float-end">
                                <a href="{{ route('admin.aspirasi.show', $aspiration->id) }}"
                                    class="inline-flex justify-center items-center px-2.5 py-1 border border-transparent text-sm font-medium rounded-md text-white bg-primary hover:bg-primary-dark transition duration-150 w-full sm:w-auto shrink-0 cursor-pointer">
                                    Detail
                                    <iconify-icon icon="flowbite:arrow-right-outline" class="mr-2" width="20"></iconify-icon>
                                </a>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-16">
                                <div class="flex flex-col items-center justify-center gap-4 text-slate-500">
                                    <iconify-icon icon="iconamoon:search-light" width="64"
                                        class="text-slate-900"></iconify-icon>
                                    <span class="text-lg font-medium text-slate-900">Data Tidak Ditemukan</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($aspirations->hasPages())
            <div class="px-6 py-4 border-t border-gray-50">
                {{ $aspirations->links() }}
            </div>
        @endif

    </div>
@endsection