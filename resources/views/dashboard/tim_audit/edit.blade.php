@extends('layouts.app')

@section('title', 'Edit Tim Audit')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="glass-effect rounded-2xl shadow-xl p-6 mb-6 border border-white/20">
        <div class="flex items-center">
            <a href="{{ route('tim_audit.index') }}" class="text-gray-600 hover:text-gray-800 mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Edit Tim Audit</h1>
                <p class="text-gray-600">Form edit tim audit</p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="glass-effect rounded-2xl shadow-xl p-6 border border-white/20">
        <form action="{{ route('tim_audit.update', $timAudit->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Nama Tim -->
            <div class="mb-6">
                <label for="nama_tim" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Tim <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="nama_tim" 
                       name="nama_tim" 
                       value="{{ old('nama_tim', $timAudit->nama_tim) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200"
                       placeholder="Masukkan nama tim"
                       required>
                @error('nama_tim')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Bidang -->
            <div class="mb-6">
                <label for="bidang" class="block text-sm font-medium text-gray-700 mb-2">
                    Bidang <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="bidang" 
                       name="bidang" 
                       value="{{ old('bidang', $timAudit->bidang) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200"
                       placeholder="Masukkan bidang tim"
                       required>
                @error('bidang')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Anggota -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Anggota <span class="text-red-500">*</span>
                </label>
                <div class="space-y-2 max-h-60 overflow-y-auto border border-gray-300 rounded-lg p-4">
                    @forelse($pegawais as $pegawai)
                    <div class="flex items-center">
                        <input type="checkbox" 
                               id="pegawai_{{ $pegawai->id }}" 
                               name="anggota[]" 
                               value="{{ $pegawai->id }}"
                               class="w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500"
                               {{ old('anggota') && in_array($pegawai->id, old('anggota')) ? 'checked' : (in_array($pegawai->id, $timAudit->anggota->pluck('id')->toArray()) ? 'checked' : '') }}>
                        <label for="pegawai_{{ $pegawai->id }}" class="ml-2 text-sm text-gray-700 cursor-pointer">
                            {{ $pegawai->nama }} - {{ $pegawai->jabatan }}
                        </label>
                    </div>
                    @empty
                    <p class="text-gray-500 text-sm">Belum ada data pegawai</p>
                    @endforelse
                </div>
                @error('anggota')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex justify-end space-x-3">
                <a href="{{ route('tim_audit.index') }}" 
                   class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg hover:from-purple-700 hover:to-pink-700 transition-all duration-200">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
