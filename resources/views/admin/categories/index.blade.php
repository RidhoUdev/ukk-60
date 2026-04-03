@extends('layouts.admin')

@section('title', 'Data Kategori')

@section('content')
    <div x-data>

        @if (session('success'))
            <script type="module">
                Swal.fire({
                    icon: "success",
                    title: "Berhasil!",
                    text: "{{ session('success') }}",
                    confirmButtonText: "OK",
                    buttonsStyling: false,
                    timer: 2000,
                    customClass: {
                        popup: 'rounded-[2rem] p-8',
                        title: 'text-3xl font-bold text-slate-900 mt-4',
                        htmlContainer: 'text-slate-600 text-base mt-2',
                        confirmButton: 'bg-primary hover:bg-primary-dark text-white font-semibold py-3 px-10 rounded-xl mt-6 transition duration-200'
                    }
                });
            </script>
        @endif

        @if ($errors->any())
            <script type="module">
                Swal.fire({
                    icon: "error",
                    title: "Gagal!",
                    text: "{{ $errors->first() }}",
                    confirmButtonText: "OK",
                    buttonsStyling: false,
                    timer: 2000,
                    customClass: {
                        popup: 'rounded-[2rem] p-8',
                        title: 'text-3xl font-bold text-slate-900 mt-4',
                        htmlContainer: 'text-slate-600 text-base mt-2',
                        confirmButton: 'bg-red-500 hover:bg-red-600 text-white font-semibold py-3 px-10 rounded-xl mt-6 transition duration-200'
                    }
                });
            </script>
        @endif

        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-8">
            <div class="relative w-full sm:flex-1">
                <form action="{{ route('admin.kategori.index') }}" method="GET">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <iconify-icon icon="mdi:magnify" class="text-slate-400" width="20"></iconify-icon>
                    </div>
                    <input type="text" name="search"
                        class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 rounded-xl leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary sm:text-sm transition duration-150 ease-in-out"
                        value="{{ request('search') }}" placeholder="Cari kategori...">
                </form>
            </div>

            <button type="button" x-on:click="$dispatch('open-modal', 'add-category-modal')"
                class="inline-flex justify-center items-center px-5 py-2.5 border border-transparent text-sm font-medium rounded-xl text-white bg-primary hover:bg-primary-dark transition duration-150 shadow-lg shadow-primary/30 w-full sm:w-auto shrink-0 cursor-pointer">
                <iconify-icon icon="mdi:plus" class="mr-2" width="20"></iconify-icon>
                Tambah Kategori
            </button>
        </div>

        <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 text-slate-600 text-xs uppercase tracking-wider border-b border-gray-100">
                            <th class="px-6 py-4 font-bold w-16">No</th>
                            <th class="px-6 py-4 font-bold">Nama Kategori</th>
                            <th class="px-6 py-4 font-bold text-center w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm text-slate-700">
                        @forelse ($categories as $index => $kategori)
                            <tr class="hover:bg-slate-50 transition-colors border-b border-surface">
                                <td class="px-6 py-4 text-slate-500">
                                    {{ $categories->firstItem() + $index }}
                                </td>
                                <td class="px-6 py-4 font-medium text-slate-900">
                                    {{ $kategori->category_name }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center items-center gap-2">
                                        <button type="button"
                                            x-on:click="$dispatch('open-modal', 'edit-category-modal-{{ $kategori->id }}')"
                                            class="text-blue-600 hover:text-blue-700 transition-colors cursor-pointer"
                                            title="Edit">
                                            <iconify-icon icon="mdi:pencil-outline" width="20"></iconify-icon>
                                        </button>
                                        <button type="button"
                                            x-on:click="$dispatch('open-modal', 'delete-category-modal-{{ $kategori->id }}')"
                                            class="text-red-500 hover:text-red-600 transition-colors cursor-pointer"
                                            title="Hapus">
                                            <iconify-icon icon="mdi:trash-can-outline" width="20"></iconify-icon>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <x-modal name="edit-category-modal-{{ $kategori->id }}" title="Edit Kategori">
                                <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST"
                                    class="space-y-5">
                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" name="form_type" value="edit_{{ $kategori->id }}">

                                    <div>
                                        <label for="category_name_{{ $kategori->id }}"
                                            class="block text-sm font-bold text-slate-900 mb-2">Nama Kategori</label>
                                        <input type="text" id="category_name_{{ $kategori->id }}" name="category_name"
                                            value="{{ old('form_type') == 'edit_' . $kategori->id ? old('category_name') : $kategori->category_name }}"
                                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition duration-200 text-slate-800"
                                            required autofocus>
                                        @if($errors->has('category_name') && old('form_type') == 'edit_' . $kategori->id)
                                            <p class="text-red-500 text-xs mt-1">{{ $errors->first('category_name') }}</p>
                                        @endif
                                    </div>

                                    <div class="flex gap-3 pt-4">
                                        <button type="button"
                                            x-on:click="$dispatch('close-modal', 'edit-category-modal-{{ $kategori->id }}')"
                                            class="w-full px-4 py-3 rounded-xl bg-slate-100 text-slate-700 font-semibold hover:bg-slate-200 transition duration-200 cursor-pointer">
                                            Batal
                                        </button>
                                        <button type="submit"
                                            class="w-full px-4 py-3 rounded-xl bg-primary text-white font-semibold hover:bg-primary-dark shadow-lg shadow-primary/30 transition duration-200 cursor-pointer">
                                            Simpan Perubahan
                                        </button>
                                    </div>
                                </form>
                            </x-modal>

                            <x-modal name="delete-category-modal-{{ $kategori->id }}" title="Hapus Kategori"
                                title-class="text-red-600">
                                <div class="space-y-6">
                                    <p class="text-slate-700 leading-relaxed">
                                        Apakah anda yakin ingin menghapus kategori
                                        <strong>{{ $kategori->category_name }}</strong> secara permanen?
                                    </p>
                                    <div class="flex gap-3">
                                        <button type="button"
                                            x-on:click="$dispatch('close-modal', 'delete-category-modal-{{ $kategori->id }}')"
                                            class="w-full px-4 py-3 rounded-xl bg-slate-100 text-slate-700 font-semibold hover:bg-slate-200 transition duration-200 cursor-pointer">
                                            Batal
                                        </button>
                                        <form action="{{ route('admin.kategori.destroy', $kategori->id) }}" method="POST"
                                            class="w-full">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-full px-4 py-3 rounded-xl bg-red-600 text-white font-semibold hover:bg-red-700 shadow-lg shadow-red-600/30 transition duration-200 cursor-pointer">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </x-modal>

                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-16">
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

            @if ($categories->hasPages())
                <div class="px-6 py-4 border-t border-gray-50">
                    {{ $categories->links() }}
                </div>
            @endif
        </div>

        <x-modal name="add-category-modal" title="Tambah Kategori">
            <form action="{{ route('admin.kategori.store') }}" method="POST" class="space-y-5">
                @csrf
                <input type="hidden" name="form_type" value="add">

                <div>
                    <label for="category_name" class="block text-sm font-bold text-slate-900 mb-2">Nama Kategori</label>
                    <input type="text" id="category_name" name="category_name"
                        value="{{ old('form_type') === 'add' ? old('category_name') : '' }}"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition duration-200 placeholder-gray-400 text-slate-800"
                        placeholder="Contoh: Gedung & Bangunan" required autofocus>
                    @if($errors->has('full_name') && old('form_type') === 'add')
                        <p class="text-red-500 text-xs mt-1">{{ $errors->first('full_name') }}</p>
                    @endif
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="button" x-on:click="$dispatch('close-modal', 'add-category-modal')"
                        class="w-full px-4 py-3 rounded-xl bg-slate-100 text-slate-700 font-semibold hover:bg-slate-200 transition duration-200 cursor-pointer">
                        Batal
                    </button>
                    <button type="submit"
                        class="w-full px-4 py-3 rounded-xl bg-primary text-white font-semibold hover:bg-primary-dark shadow-lg shadow-primary/30 transition duration-200 cursor-pointer">
                        Simpan
                    </button>
                </div>
            </form>
        </x-modal>

    </div>
@endsection