@extends('layouts.admin')

@section('title', 'Detail Aspirasi')

@section('content')
    <div class="mb-6">
        <h1 class="text-lg font-medium text-slate-500">
            <a class="inline-flex items-center gap-3 hover:text-primary transition-colors duration-300"
                href="{{ url('admin/kelola-pengaduan') }}">
                <iconify-icon icon="ion:chevron-back"></iconify-icon>
                Kembali ke halaman
            </a>
        </h1>
    </div>

    <div class="bg-white border border-gray-100 rounded-[2rem] p-8 shadow-sm">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

            <div>
                <h2 class="text-lg font-bold text-slate-900 mb-8">Detail Aspirasi Siswa</h2>

                <div class="relative pl-4 border-l-2 border-dashed border-slate-200 space-y-10 mb-10 ml-2">

                    @forelse ($aspiration->feedbacks()->latest()->get() as $index => $feedback)
                        <div class="relative">
                            <div class="absolute -left-[26.5px] top-1 w-5 h-5 rounded-full 
                                {{ $index === 0 ? 'bg-primary' : 'bg-slate-200' }} 
                                border-4 border-white shadow-sm">
                            </div>
                            <p class="{{ $index === 0 ? 'text-slate-800 font-medium' : 'text-slate-500' }}">
                                {{ $feedback->description }}
                            </p>
                            <span class="text-xs text-slate-400 mt-1 block">
                                {{ $feedback->created_at->diffForHumans() }}
                            </span>
                        </div>
                    @empty
                        <div class="relative">
                            <div class="absolute -left-[26.5px] top-1 w-5 h-5 rounded-full bg-slate-200 border-4 border-white">
                            </div>
                            <p class="text-slate-400 italic">Belum ada umpan balik.</p>
                        </div>
                    @endforelse

                </div>

                <div class="rounded-2xl overflow-hidden h-64 w-full bg-slate-100">
                    <img src="{{ $aspiration->photo ? asset('storage/' . $aspiration->photo) : asset('assets/placeholder_image.jpg') }}" alt="Bukti Laporan"
                        class="w-full h-full object-cover hover:scale-105 transition duration-500 cursor-pointer">
                </div>
            </div>

            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-bold text-slate-900 mb-2">Pelapor</label>
                    <input type="text" value="{{ $aspiration->user->full_name }}" disabled
                        class="w-full px-4 py-3 rounded-xl bg-slate-100 border-none text-slate-600 font-medium focus:ring-0 cursor-not-allowed">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-slate-900 mb-2">Kelas</label>
                        <input type="text" value="{{ $aspiration->user->class }}" disabled
                            class="w-full px-4 py-3 rounded-xl bg-slate-100 border-none text-slate-600 font-medium focus:ring-0 cursor-not-allowed">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-900 mb-2">NIS</label>
                        <input type="text" value="{{ $aspiration->user->username }}" disabled
                            class="w-full px-4 py-3 rounded-xl bg-slate-100 border-none text-slate-600 font-medium focus:ring-0 cursor-not-allowed">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-900 mb-2">Judul Laporan</label>
                    <input type="text" value="{{ $aspiration->title }}" disabled
                        class="w-full px-4 py-3 rounded-xl bg-slate-100 border-none text-slate-600 font-medium focus:ring-0 cursor-not-allowed">
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-900 mb-2">Kategori</label>
                    <input type="text" value="{{ $aspiration->category->category_name }}" disabled
                        class="w-full px-4 py-3 rounded-xl bg-slate-100 border-none text-slate-600 font-medium focus:ring-0 cursor-not-allowed">
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-900 mb-2">Isi Laporan</label>
                    <textarea rows="4" disabled
                        class="w-full px-4 py-3 rounded-xl bg-slate-100 border-none text-slate-600 font-medium focus:ring-0 cursor-not-allowed resize-none">{{ $aspiration->description }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-900 mb-2">Lokasi</label>
                    <input type="text" value="{{ $aspiration->location }}" disabled
                        class="w-full px-4 py-3 rounded-xl bg-slate-100 border-none text-slate-600 font-medium focus:ring-0 cursor-not-allowed">
                </div>

                <div class="pt-4 flex items-center justify-between">
                    <div>
                        <label class="block text-sm font-bold text-slate-900 mb-2">Status</label>
                        @if ($aspiration->status === 'Menunggu')
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm bg-orange-50 text-orange-600">
                                {{ $aspiration->status }}
                            </span>
                        @elseif ($aspiration->status === 'Proses')
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm bg-purple-50 text-purple-600">
                                {{ $aspiration->status }}
                            </span>
                        @elseif ($aspiration->status === 'Selesai')
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm bg-teal-50 text-teal-600">
                                {{ $aspiration->status }}
                            </span>
                        @else
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm bg-red-50 text-red-600">
                                {{ $aspiration->status }}
                            </span>
                        @endif
                    </div>

                    <div class="mt-6" x-data>
                        <button type="button" x-on:click="$dispatch('open-modal', 'update-status-modal')"
                            class="inline-flex items-center px-6 py-2 bg-primary hover:bg-primary-dark text-white font-bold rounded-lg transition-colors cursor-pointer">
                            Tindak Lanjut
                            <iconify-icon icon="mdi:arrow-right" class="ml-2" width="20"></iconify-icon>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <x-modal name="update-status-modal" title="Tindak Lanjut Aspirasi"
        description="Masukkan umpan balik dan juga pilih status sesuai dengan keadaan.">

        <form action="{{ route('admin.aspirasi.feedback', $aspiration->id) }}" method="POST" class="space-y-5">
            @csrf

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
                            confirmButton: 'bg-primary hover:bg-primary-dark text-white font-semibold py-3 px-10 rounded-xl mt-6 transition duration-200 cursor-pointer'
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
                            confirmButton: 'bg-red-500 hover:bg-red-600 text-white font-semibold py-3 px-10 rounded-xl mt-6 transition duration-200 cursor-pointer'
                        }
                    });
                </script>
            @endif

            <div>
                <label for="feedback" class="block text-sm font-bold text-slate-900 mb-2">Umpan Balik</label>
                <textarea id="feedback" name="feedback" rows="5"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition duration-200 placeholder-gray-400 text-slate-800 resize-none"
                    placeholder="Tulis umpan balik..." required></textarea>
            </div>

            <div>
                <label for="status" class="block text-sm font-bold text-slate-900 mb-2">
                    Status
                    <span class="text-slate-400 font-normal">(opsional)</span>
                </label>
                <div class="relative">
                    <select id="status" name="status"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition duration-200 bg-white text-slate-800 appearance-none cursor-pointer">
                        <option value="">— Tidak mengubah status —</option>
                        <option value="ditolak">Ditolak</option>
                        <option value="proses">Diproses</option>
                        <option value="selesai">Selesai</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-500">
                        <iconify-icon icon="mdi:chevron-down" width="24"></iconify-icon>
                    </div>
                </div>

                <p class="mt-2 text-xs text-slate-400 flex items-start gap-1">
                    <iconify-icon icon="mdi:information-outline" class="mt-0.5 shrink-0"></iconify-icon>
                    Biarkan kosong jika tidak ingin mengubah status aspirasi.
                    Status saat ini: {{ $aspiration->status }}
                </p>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="button" x-on:click="$dispatch('close-modal', 'update-status-modal')"
                    class="w-full px-4 py-3 rounded-xl bg-gray-200 text-slate-700 font-bold hover:bg-gray-300 transition duration-200 cursor-pointer">
                    Batal
                </button>
                <button type="submit"
                    class="w-full px-4 py-3 rounded-xl bg-primary text-white font-bold hover:bg-primary-dark shadow-lg shadow-primary/30 transition duration-200 cursor-pointer">
                    Kirim
                </button>
            </div>

        </form>
    </x-modal>
@endsection