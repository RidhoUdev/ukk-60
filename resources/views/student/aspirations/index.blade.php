@extends('layouts.student')

@section('title', 'Laporan Saya')

@section('content')
    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-8" x-data>

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

        <div class="relative w-full sm:flex-1">
            <form action="{{ route('siswa.aspirasi.index') }}" method="GET">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <iconify-icon icon="mdi:magnify" class="text-slate-400" width="20"></iconify-icon>
                </div>
                <input name="search" type="text"
                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 rounded-xl leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary sm:text-sm transition duration-150 ease-in-out"
                    placeholder="Cari laporan saya...">
            </form>
        </div>

        <button type="button" x-on:click="$dispatch('open-modal', 'add-aspiration-modal')"
            class="inline-flex justify-center items-center px-5 py-2.5 border border-transparent text-sm font-medium rounded-xl text-white bg-primary hover:bg-primary-dark transition duration-150 shadow-lg shadow-primary/30 w-full sm:w-auto shrink-0 cursor-pointer">
            <iconify-icon icon="mdi:plus-circle-outline" class="mr-2" width="20"></iconify-icon>
            Tulis Laporan
        </button>
    </div>

    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden p-6">

        <h3 class="text-lg font-bold text-slate-800 mb-6">Daftar Laporan Saya</h3>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-900 text-sm font-bold border-b border-gray-100">
                        <th class="px-4 py-4 w-12">No</th>
                        <th class="px-4 py-4 w-1/4">Judul</th>
                        <th class="px-4 py-4 w-1/3">Isi Laporan</th>
                        <th class="px-4 py-4">Kategori</th>
                        <th class="px-4 py-4">Status</th>
                        <th class="px-4 py-4 text-center w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-sm text-slate-700">
                    @forelse ($aspirations as $index => $aspiration)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-4 py-4 text-slate-500">{{ $aspirations->firstItem() + $index }}</td>
                            <td class="px-4 py-4 font-medium text-slate-900">
                                {{ $aspiration->title }}
                            </td>
                            <td class="px-4 py-4 text-slate-500 truncate max-w-xs">
                                {{ $aspiration->description }}
                            </td>
                            <td class="px-4 py-4 text-slate-600 whitespace-nowrap">
                                {{ $aspiration->category->category_name }}
                            </td>
                            <td class="px-4 py-4">
                                @if ($aspiration->status === 'Menunggu')
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-orange-50 text-orange-600 border border-orange-100">
                                        {{ $aspiration->status }}
                                    </span>
                                @elseif ($aspiration->status === 'Proses')
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-purple-50 text-purple-600 border border-orange-100">
                                        {{ $aspiration->status }}
                                    </span>
                                @elseif ($aspiration->status === 'Selesai')
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
                            <td class="px-4 py-4 text-center">
                                <div class="flex justify-center items-center gap-3" x-data>
                                    <button type="button"
                                        x-on:click="$dispatch('open-modal', 'edit-aspiration-modal-{{ $aspiration->id }}')"
                                        class="text-primary hover:text-primary-dark transition-colors cursor-pointer"
                                        title="Edit">
                                        <iconify-icon icon="mdi:pencil-outline" width="20"></iconify-icon>
                                    </button>
                                    <button type="button"
                                        x-on:click="$dispatch('open-modal', 'delete-aspiration-modal-{{ $aspiration->id }}')"
                                        class="text-red-500 hover:text-red-700 transition-colors cursor-pointer" title="Hapus">
                                        <iconify-icon icon="mdi:trash-can-outline" width="20"></iconify-icon>
                                    </button>
                                    <a href="{{ route('siswa.aspirasi.show', $aspiration->id) }}"
                                        class="text-primary hover:text-primary-dark transition-colors cursor-pointer"
                                        title="Lihat Detail">
                                        <iconify-icon icon="mdi:eye-outline" width="20"></iconify-icon>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <x-modal name="edit-aspiration-modal-{{ $aspiration->id }}" title="Tulis Laporan"
                            description="Tuliskan laporan anda dan klik simpan jika data sudah benar.">
                            <form action="{{ route('siswa.aspirasi.update', $aspiration->id) }}" method="POST"
                                enctype="multipart/form-data" class="space-y-5">
                                @csrf
                                @method('PUT')

                                <input type="hidden" name="form_type" value="edit_{{ $aspiration->id }}">

                                <div>
                                    <label for="title_{{ $aspiration->id }}"
                                        class="block text-sm font-bold text-slate-900 mb-2">judul Laporan</label>
                                    <input type="text" id="title_{{ $aspiration->id }}" name="title"
                                        value="{{ old('form_type') == 'edit_' . $aspiration->id ? old('title') : $aspiration->title }}"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition duration-200 placeholder-gray-400 text-slate-800"
                                        placeholder="" required>
                                    @if($errors->has('title') && old('form_type') == 'edit_' . $aspiration->id)
                                        <p class="text-red-500 text-xs mt-1">{{ $errors->first('title') }}</p>
                                    @endif
                                </div>

                                <div>
                                    <label for="description_{{ $aspiration->id }}"
                                        class="block text-sm font-bold text-slate-900 mb-2">isi Laporan</label>
                                    <textarea id="description_{{ $aspiration->id }}" name="description" rows="4"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition duration-200 placeholder-gray-400 text-slate-800 resize-none"
                                        placeholder="" required>{{ $aspiration->description }}</textarea>
                                    @if($errors->has('description') && old('form_type') == 'edit_' . $aspiration->id)
                                        <p class="text-red-500 text-xs mt-1">{{ $errors->first('description') }}</p>
                                    @endif
                                </div>

                                <div>
                                    <label for="category_id_{{ $aspiration->id }}"
                                        class="block text-sm font-bold text-slate-900 mb-2">Kategori</label>
                                    <div class="relative">
                                        <select id="category_id{{ $aspiration->id }}" name="category_id"
                                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition duration-200 bg-white text-slate-800 appearance-none cursor-pointer"
                                            required>
                                            <option value="" disabled>Pilih Kategori</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" selected>
                                                    {{ $category->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div
                                            class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-500">
                                            <iconify-icon icon="mdi:chevron-down" width="24"></iconify-icon>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label for="location_{{ $aspiration->id }}"
                                        class="block text-sm font-bold text-slate-900 mb-2">Lokasi</label>
                                    <input type="text" id="location_{{ $aspiration->id }}" name="location"
                                        value="{{ old('form_type') == 'edit_' . $aspiration->id ? old('location') : $aspiration->location }}"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition duration-200 placeholder-gray-400 text-slate-800"
                                        placeholder="" required>
                                    @if($errors->has('location') && old('form_type') == 'edit_' . $aspiration->id)
                                        <p class="text-red-500 text-xs mt-1">{{ $errors->first('location') }}</p>
                                    @endif
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-slate-900 mb-2">Bukti Foto</label>
                                    <div class="relative w-full"
                                        x-data="{ imageUrl: '{{ $aspiration->photo ? asset('storage/' . $aspiration->photo) : '' }}' }">
                                        <label for="photo_{{ $aspiration->id }}"
                                            class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-gray-200 rounded-xl cursor-pointer bg-slate-50 hover:bg-slate-100 hover:border-primary/50 transition duration-300 overflow-hidden relative">

                                            <div x-show="!imageUrl"
                                                class="flex flex-col items-center justify-center pt-5 pb-6 text-center px-4">
                                                <iconify-icon icon="mdi:cloud-upload-outline"
                                                    class="text-slate-300 text-5xl mb-3"></iconify-icon>
                                                <p class="text-sm text-slate-500 font-medium">Klik untuk mengunggah gambar
                                                </p>
                                            </div>

                                            <template x-if="imageUrl">
                                                <img :src="imageUrl" class="absolute inset-0 w-full h-full object-cover"
                                                    alt="Preview" />
                                            </template>

                                            <input id="photo_{{ $aspiration->id }}" name="photo" type="file" class="hidden"
                                                accept="image/*"
                                                x-on:change=" const file = $event.target.files[0]; if (file) { imageUrl = URL.createObjectURL(file); } else { imageUrl = null; } " />
                                        </label>
                                    </div>
                                </div>

                                <div class="flex gap-3 pt-4">
                                    <button type="button"
                                        x-on:click="$dispatch('close-modal', 'edit-aspiration-modal-{{ $aspiration->id }}')"
                                        class="w-full px-4 py-3 rounded-xl bg-gray-200 text-slate-700 font-bold hover:bg-gray-300 transition duration-200 cursor-pointer">
                                        Batal
                                    </button>

                                    <button type="submit"
                                        class="w-full px-4 py-3 rounded-xl bg-primary text-white font-bold hover:bg-primary-dark shadow-lg shadow-primary/30 transition duration-200 cursor-pointer">
                                        Simpan
                                    </button>
                                </div>

                            </form>
                        </x-modal>

                        <x-modal name="delete-aspiration-modal-{{ $aspiration->id }}" title="Hapus Laporan"
                            description="Apakah anda yakin ingin menghapus laporan ini secara permanen?"
                            titleClass="text-red-600">
                            <form action="{{ route('siswa.aspirasi.destroy', $aspiration->id) }}" method="POST"
                                enctype="multipart/form-data" class="space-y-5">
                                @csrf
                                @method('DELETE')
                                <div class="flex gap-3 pt-4">
                                    <button type="button"
                                        x-on:click="$dispatch('close-modal', 'delete-aspiration-modal-{{ $aspiration->id }}')"
                                        class="w-full px-4 py-3 rounded-xl bg-gray-200 text-slate-700 font-bold hover:bg-gray-300 transition duration-200 cursor-pointer">
                                        Batal
                                    </button>

                                    <button type="submit"
                                        class="w-full px-4 py-3 rounded-xl bg-red-600 text-white font-bold hover:bg-red-700 transition duration-200 cursor-pointer">
                                        Hapus
                                    </button>
                                </div>

                            </form>
                        </x-modal>

                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16">
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
            <div class="px-3 py-4 border-t border-gray-50">
                {{ $aspirations->links() }}
            </div>
        @endif
    </div>

    <x-modal name="add-aspiration-modal" title="Tulis Laporan"
        description="Tuliskan laporan anda dan klik simpan jika data sudah benar.">
        <form action="{{ route('siswa.aspirasi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <input type="hidden" name="form_type" value="add">

            <div>
                <label for="title" class="block text-sm font-bold text-slate-900 mb-2">Judul Laporan</label>
                <input type="text" id="title" name="title" value="{{ old('form_type') === 'add' ? old('title') : '' }}"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition duration-200 placeholder-gray-400 text-slate-800"
                    placeholder="Contoh: Komputer tidak bisa digunakan" required autofocus>
                @if ($errors->has('title') && old('form_type') === 'add')
                    <p class="text-red-500 text-xs mt-1">{{ $errors->first('title') }}</p>
                @endif
            </div>

            <div>
                <label for="description" class="block text-sm font-bold text-slate-900 mb-2">Isi Laporan</label>
                <textarea id="description" name="description" rows="4"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition duration-200 placeholder-gray-400 text-slate-800 resize-none"
                    placeholder="Jelaskan secara detail mengenai keluhan yang ingin disampaikan ..." required></textarea>
                @if ($errors->has('description') && old('form_type') === 'add')
                    <p class="text-red-500 text-xs mt-1">{{ $errors->first('description') }}</p>
                @endif
            </div>

            <div>
                <label for="category_id" class="block text-sm font-bold text-slate-900 mb-2">Kategori</label>
                <div class="relative">
                    <select id="category_id" name="category_id"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition duration-200 bg-white text-slate-800 appearance-none cursor-pointer"
                        required>
                        <option value="" disabled selected>Pilih Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-500">
                        <iconify-icon icon="mdi:chevron-down" width="24"></iconify-icon>
                    </div>
                </div>
            </div>

            <div>
                <label for="location" class="block text-sm font-bold text-slate-900 mb-2">Lokasi</label>
                <input type="text" id="location" name="location"
                    value="{{ old('form_type') === 'add' ? old('location') : '' }}"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition duration-200 placeholder-gray-400 text-slate-800"
                    placeholder="Contoh: Ruang 30, Kantin, Toilet umum" required>
                @if ($errors->has('location') && old('form_type') === 'add')
                    <p class="text-red-500 text-xs mt-1">{{ $errors->first('location') }}</p>
                @endif
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-900 mb-2">Bukti Foto</label>
                <div class="relative w-full" x-data="{ imageUrl: null }">
                    <label for="photo_add"
                        class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-gray-200 rounded-xl cursor-pointer bg-slate-50 hover:bg-slate-100 hover:border-primary/50 transition duration-300 overflow-hidden relative">

                        <div x-show="!imageUrl"
                            class="flex flex-col items-center justify-center pt-5 pb-6 text-center px-4">
                            <iconify-icon icon="mdi:cloud-upload-outline"
                                class="text-slate-300 text-5xl mb-3"></iconify-icon>
                            <p class="text-sm text-slate-500 font-medium">Klik untuk mengunggah gambar</p>
                        </div>

                        <template x-if="imageUrl">
                            <img :src="imageUrl" class="absolute inset-0 w-full h-full object-cover" alt="Preview" />
                        </template>

                        <input id="photo_add" name="photo" type="file" class="hidden" accept="image/*"
                            x-on:change=" const file = $event.target.files[0]; if (file) { imageUrl = URL.createObjectURL(file); } else { imageUrl = null; } " />
                    </label>
                </div>
                <p class="mt-2 text-xs text-slate-400 flex items-start gap-1">
                    <iconify-icon icon="mdi:information-outline" class="mt-0.5 shrink-0"></iconify-icon>
                    Laporan yang sudah ditindak lanjuti oleh admin, tidak dapat diubah ataupun dihapus!
                </p>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="button" x-on:click="$dispatch('close-modal', 'add-aspiration-modal')"
                    class="w-full px-4 py-3 rounded-xl bg-gray-200 text-slate-700 font-bold hover:bg-gray-300 transition duration-200 cursor-pointer">
                    Batal
                </button>

                <button type="submit"
                    class="w-full px-4 py-3 rounded-xl bg-primary text-white font-bold hover:bg-primary-dark shadow-lg shadow-primary/30 transition duration-200 cursor-pointer">
                    Simpan
                </button>
            </div>

        </form>
    </x-modal>

    @if(request('action') === 'create')
        <div x-data x-init="$dispatch('open-modal', 'add-aspiration-modal')"></div>
    @endif
@endsection