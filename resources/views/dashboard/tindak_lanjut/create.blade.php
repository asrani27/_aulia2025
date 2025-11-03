@extends('layouts.app')

@section('title', 'Tambah Tindak Lanjut')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="glass-effect rounded-2xl shadow-xl p-6 mb-6 border border-white/20">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Tambah Tindak Lanjut</h1>
                <p class="text-gray-600">Form tambah data tindak lanjut audit</p>
            </div>
            <a href="{{ route('tindak_lanjut.index') }}" 
               class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition-all duration-300 flex items-center space-x-2 hover:scale-105">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div>

    <!-- Form -->
    <div class="glass-effect rounded-2xl shadow-xl p-6 border border-white/20">
        <form action="{{ route('tindak_lanjut.store') }}" method="POST">
            @csrf
            
            <!-- Nomor -->
            <div class="mb-6">
                <label for="nomor" class="block text-sm font-medium text-gray-700 mb-2">
                    Nomor
                </label>
                <input type="text" id="nomor" name="nomor"
                       value="{{ old('nomor') }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200"
                       placeholder="Masukkan nomor tindak lanjut (opsional)">
                @error('nomor')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-triangle mr-2 mt-1"></i>
                        <div>
                            <p class="font-semibold mb-2">Terjadi kesalahan:</p>
                            <ul class="list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="pemeriksaan_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Pemeriksaan <span class="text-red-500">*</span>
                    </label>
                    <select name="pemeriksaan_id" id="pemeriksaan_id" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('pemeriksaan_id') border-red-500 @enderror" 
                            required>
                        <option value="">-- Pilih Pemeriksaan --</option>
                        @foreach($pemeriksaans as $pemeriksaan)
                            <option value="{{ $pemeriksaan->id }}" 
                                    @if(old('pemeriksaan_id') == $pemeriksaan->id) selected @endif>
                                {{ $pemeriksaan->jadwalAudit->nama_kegiatan ?? 'Tidak ada nama kegiatan' }} 
                                - {{ $pemeriksaan->tanggal->format('d/m/Y') }}
                            </option>
                        @endforeach
                    </select>
                    @error('pemeriksaan_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-2">
                        Tanggal <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="tanggal" id="tanggal" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('tanggal') border-red-500 @enderror" 
                           value="{{ old('tanggal') }}" required>
                    @error('tanggal')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6">
                <label for="uraian" class="block text-sm font-medium text-gray-700 mb-2">
                    Uraian <span class="text-red-500">*</span>
                </label>
                <textarea name="uraian" id="uraian" rows="4" 
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('uraian') border-red-500 @enderror" 
                          placeholder="Masukkan uraian temuan atau masalah" required>{{ old('uraian') }}</textarea>
                @error('uraian')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6">
                <label for="tindak_lanjut" class="block text-sm font-medium text-gray-700 mb-2">
                    Tindak Lanjut <span class="text-red-500">*</span>
                </label>
                <textarea name="tindak_lanjut" id="tindak_lanjut" rows="4" 
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('tindak_lanjut') border-red-500 @enderror" 
                          placeholder="Masukkan tindak lanjut yang akan dilakukan" required>{{ old('tindak_lanjut') }}</textarea>
                @error('tindak_lanjut')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select name="status" id="status" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('status') border-red-500 @enderror" 
                            required>
                        <option value="">-- Pilih Status --</option>
                        <option value="B" @if(old('status') == 'B') selected @endif>Belum Diproses</option>
                        <option value="DP" @if(old('status') == 'DP') selected @endif>Dalam Proses</option>
                        <option value="S" @if(old('status') == 'S') selected @endif>Selesai</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">
                        Keterangan
                    </label>
                    <textarea name="keterangan" id="keterangan" rows="3" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('keterangan') border-red-500 @enderror" 
                              placeholder="Masukkan keterangan tambahan (opsional)">{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6">
                <label for="rekomendasi_saran" class="block text-sm font-medium text-gray-700 mb-2">
                    Rekomendasi/Saran
                </label>
                <textarea name="rekomendasi_saran" id="rekomendasi_saran" rows="4" 
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('rekomendasi_saran') border-red-500 @enderror" 
                          placeholder="Masukkan rekomendasi atau saran (opsional)">{{ old('rekomendasi_saran') }}</textarea>
                @error('rekomendasi_saran')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>


            <div class="flex justify-end space-x-4 mt-8">
                <a href="{{ route('tindak_lanjut.index') }}" 
                   class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-all duration-300 flex items-center space-x-2">
                    <i class="fas fa-times"></i>
                    <span>Batal</span>
                </a>
                <button type="submit" 
                        class="px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg hover:from-purple-700 hover:to-pink-700 transition-all duration-300 flex items-center space-x-2 hover:scale-105">
                    <i class="fas fa-save"></i>
                    <span>Simpan</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
