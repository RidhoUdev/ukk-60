@extends('layouts.auth')

@section('content')
<div class="min-h-screen flex">
    
    <div class="hidden lg:flex lg:w-1/2 bg-primary-dark flex-col justify-center items-center relative overflow-hidden">
        
        <div class="absolute top-0 left-0 w-full h-full opacity-10">
             </div>

        <div class="z-10 text-center px-12">
            <div class="mb-12">
                <img src="{{ asset('assets/lookify-white.png') }}" alt="Lookify Logo White" class="w-56 mx-auto object-contain">
            </div>

            <div>
                <img src="{{ asset('assets/asset-login.png') }}" alt="Ilustrasi Login" class="w-full max-w-md mx-auto object-contain -translate-y-12 drop-shadow-2xl">
            </div>
        </div>
    </div>

    <div class="w-full lg:w-1/2 bg-white flex items-center justify-center p-8">
        
        <div class="w-full max-w-md bg-white border border-gray-200 rounded-[2rem] p-10 shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
            
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-slate-900">Masuk</h2>
            </div>

            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label for="username" class="block text-sm font-medium text-slate-700 mb-2">
                        NIP / NIS
                    </label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username"
                        value="{{ old('username') }}" 
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition duration-200 placeholder-gray-400"
                        placeholder="Masukkan NIP atau NIS"
                        @error('border-red-500 focus:ring-red-200')@enderror
                        required
                    >
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-2">
                        Password
                    </label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition duration-200 placeholder-gray-400"
                        placeholder="Masukkan password"
                        required
                    >
                </div>

                <div>
                    @error('username')
                        <p class="text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white font-semibold py-3.5 px-4 rounded-xl transition duration-200 shadow-lg shadow-primary/30 cursor-pointer">
                        Masuk
                    </button>
                </div>

            </form>
        </div>

    </div>

</div>
@endsection