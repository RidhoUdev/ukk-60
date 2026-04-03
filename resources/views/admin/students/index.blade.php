@extends('layouts.admin')

@section('title', 'Data Siswa')

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
                <form action="{{ route('admin.siswa.index') }}" method="GET">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <iconify-icon icon="mdi:magnify" class="text-slate-400" width="20"></iconify-icon>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 rounded-xl leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary sm:text-sm transition duration-150 ease-in-out"
                        placeholder="Cari NIS, Nama, atau Kelas ...">
                </form>
            </div>


            <button type="button" x-on:click="$dispatch('open-modal', 'add-student-modal')"
                class="inline-flex items-center px-5 py-2.5 border border-transparent text-sm font-medium rounded-xl text-white bg-primary hover:bg-primary-dark transition duration-150 shadow-lg shadow-primary/30 cursor-pointer">
                <iconify-icon icon="mdi:plus" class="mr-2" width="20"></iconify-icon>
                Tambah Siswa
            </button>
        </div>

        <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 text-slate-600 text-xs uppercase tracking-wider border-b border-gray-100">
                            <th class="px-6 py-4 font-bold">No</th>
                            <th class="px-6 py-4 font-bold">NIS</th>
                            <th class="px-6 py-4 font-bold">Nama Siswa</th>
                            <th class="px-6 py-4 font-bold">Kelas</th>
                            <th class="px-6 py-4 font-bold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm text-slate-700">
                        @forelse($students as $index => $student)
                            <tr class="hover:bg-slate-50 transition-colors border-b border-surface">
                                <td class="px-6 py-4 text-slate-500">{{ $students->firstItem() + $index }}</td>
                                <td class="px-6 py-4 font-mono text-slate-600">{{ $student->username }}</td>
                                <td class="px-6 py-4">
                                    <div class="font-medium text-slate-900">{{ $student->full_name }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class=" font-medium">
                                        {{ $student->class }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center items-center gap-2" x-data>
                                        <button type="button"
                                            x-on:click="$dispatch('open-modal', 'edit-student-modal-{{ $student->id }}')"
                                            class="text-blue-600 hover:text-blue-700 transition-colors cursor-pointer"
                                            title="Edit">
                                            <iconify-icon icon="mdi:pencil-outline" width="20"></iconify-icon>
                                        </button>
                                        <button type="button"
                                            x-on:click="$dispatch('open-modal', 'delete-student-modal-{{ $student->id }}')"
                                            class="text-red-500 hover:text-red-600 transition-colors cursor-pointer"
                                            title="Hapus">
                                            <iconify-icon icon="mdi:trash-can-outline" width="20"></iconify-icon>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <x-modal name="edit-student-modal-{{ $student->id }}" title="Edit Data Siswa"
                                description="Edit data siswa dan klik simpan jika data sudah benar.">
                                <form action="{{ route('admin.siswa.update', $student->id) }}" method="POST" class="space-y-5">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="form_type" value="edit_{{ $student->id }}">

                                    <div>
                                        <label for="username_{{ $student->id }}"
                                            class="block text-sm font-bold text-slate-900 mb-2">NIS</label>
                                        <input type="number" id="username_{{ $student->id }}" name="username"
                                            value="{{ old('form_type') == 'edit_' . $student->id ? old('username') : $student->username }}"
                                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition duration-200 placeholder-gray-400 text-slate-800"
                                            placeholder="Contoh: 12345678" required autofocus>
                                        @if($errors->has('username') && old('form_type') == 'edit_' . $student->id)
                                            <p class="text-red-500 text-xs mt-1">{{ $errors->first('username') }}</p>
                                        @endif
                                    </div>

                                    <div>
                                        <label for="full_name_{{ $student->id }}"
                                            class="block text-sm font-bold text-slate-900 mb-2">Nama
                                            Siswa</label>
                                        <input type="text" id="full_name_{{ $student->id }}" name="full_name"
                                            value="{{ old('form_type') == 'edit_' . $student->id ? old('full_name') : $student->full_name }}"
                                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition duration-200 placeholder-gray-400 text-slate-800"
                                            placeholder="Contoh: John Doe" required>
                                        @if($errors->has('full_name') && old('form_type') == 'edit_' . $student->id)
                                            <p class="text-red-500 text-xs mt-1">{{ $errors->first('full_name') }}</p>
                                        @endif
                                    </div>

                                    <div>
                                        <label for="class_{{ $student->class }}"
                                            class="block text-sm font-bold text-slate-900 mb-2">Kelas</label>
                                        <input type="text" id="class_{{ $student->id }}" name="class"
                                            value="{{ old('form_type') == 'edit_' . $student->id ? old('class') : $student->class }}"
                                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition duration-200 placeholder-gray-400 text-slate-800"
                                            placeholder="Contoh: X RPL I" required>
                                        @if($errors->has('class') && old('form_type') == 'edit_' . $student->id)
                                            <p class="text-red-500 text-xs mt-1">{{ $errors->first('class') }}</p>
                                        @endif
                                    </div>

                                    <div>
                                        <label for="password_{{ $student->id }}"
                                            class="block text-sm font-bold text-slate-900 mb-2">Password</label>
                                        <input type="password" id="class_{{ $student->id }}" name="password"
                                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition duration-200 placeholder-gray-400 text-slate-800"
                                            placeholder="Kosongkan jika tidak ingin mengganti password.">
                                        @if($errors->has('password') && old('form_type') == 'edit_' . $student->id)
                                            <p class="text-red-500 text-xs mt-1">{{ $errors->first('password') }}</p>
                                        @endif
                                    </div>

                                    <div>
                                        <label for="password_confirmation_{{ $student->id }}"
                                            class="block text-sm font-bold text-slate-900 mb-2">Konfirmasi Password</label>
                                        <input type="password" id="password_{{ $student->id }}" name="password_confirmation"
                                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition duration-200 placeholder-gray-400 text-slate-800"
                                            placeholder="Ulangi Password">
                                    </div>

                                    <div class="flex gap-3 pt-4">
                                        <button type="button"
                                            x-on:click="$dispatch('close-modal', 'edit-student-modal-{{ $student->id }}')"
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

                            <x-modal name="delete-student-modal-{{ $student->id }}" title="Hapus Data Siswa"
                                title-class="text-red-600">
                                <div class="space-y-6">
                                    <p class="text-slate-700 leading-relaxed">
                                        Apakah anda yakin ingin menghapus data siswa ini secara permanen?
                                    </p>

                                    <div class="flex gap-3">
                                        <button type="button"
                                            x-on:click="$dispatch('close-modal', 'delete-student-modal-{{ $student->id }}')"
                                            class="w-full px-4 py-3 rounded-xl bg-slate-100 text-slate-700 font-semibold hover:bg-slate-200 transition duration-200 cursor-pointer">
                                            Batal
                                        </button>

                                        <form action="{{ route('admin.siswa.destroy', $student->id) }}" method="POST"
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
                                <td colspan="5" class="px-6 py-16">
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

            @if ($students->hasPages())
                <div class="px-6 py-4 border-t border-gray-50">
                    {{ $students->links() }}
                </div>
            @endif


        </div>
    </div>

    <x-modal name="add-student-modal" title="Tambah Data Siswa" description="Masukkan data siswa baru dengan benar.">
        <form action="{{ route('admin.siswa.store') }}" method="POST" class="space-y-5">
            @csrf
            <input type="hidden" name="form_type" value="add">

            <div>
                <label for="username" class="block text-sm font-bold text-slate-900 mb-2">NIS</label>
                <input type="number" id="username" name="username"
                    value="{{ old('form_type') === 'add' ? old('username') : '' }}"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition duration-200 placeholder-gray-400 text-slate-800"
                    placeholder="Contoh: 12345678" required autofocus>
                @if($errors->has('username') && old('form_type') === 'add')
                    <p class="text-red-500 text-xs mt-1">{{ $errors->first('username') }}</p>
                @endif
            </div>

            <div>
                <label @if ($students->hasPages()) <div class="px-6 py-4 border-t border-gray-50">
                            {{ $students->links() }}
                    </div>
                @endif for="full_name" class="block text-sm font-bold text-slate-900 mb-2">Nama Siswa</label>
            <input type="text" id="full_name" name="full_name"
                value="{{ old('form_type') === 'add' ? old('full_name') : '' }}"
                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition duration-200 placeholder-gray-400 text-slate-800"
                placeholder="Contoh: John Doe" required autofocus>
            @if($errors->has('full_name') && old('form_type') === 'add')
                <p class="text-red-500 text-xs mt-1">{{ $errors->first('full_name') }}</p>
            @endif
            </div>

            <div>
                <label for="class" class="block text-sm font-bold text-slate-900 mb-2">Kelas</label>
                <input type="text" name="class" id="class" value="{{ old('form_type') === 'add' ? old('class') : '' }}"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition duration-200 placeholder-gray-400 text-slate-800"
                    placeholder="X RPL I" required>
                @if($errors->has('class') && old('form_type') === 'add')
                    <p class="text-red-500 text-xs mt-1">{{ $errors->first('class') }}</p>
                @endif
            </div>

            <div>
                <label for="password" class="block text-sm font-bold text-slate-900 mb-2">Password</label>
                <input type="password" id="class" name="password"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition duration-200 placeholder-gray-400 text-slate-800"
                    placeholder="Password minimal 8 karakter">
                @if($errors->has('password') && old('form_type') === 'add')
                    <p class="text-red-500 text-xs mt-1">{{ $errors->first('password') }}</p>
                @endif
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-bold text-slate-900 mb-2">Konfirmasi
                    Password</label>
                <input type="password" id="password" name="password_confirmation"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition duration-200 placeholder-gray-400 text-slate-800"
                    placeholder="Ulangi Password">
            </div>

            <div class="flex gap-3 pt-4">
                <button type="button" x-on:click="$dispatch('close-modal', 'add-student-modal')"
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
@endsection