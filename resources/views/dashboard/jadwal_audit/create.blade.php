@extends('layouts.app')

@section('title', 'Tambah Jadwal Audit')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="glass-effect rounded-2xl shadow-xl p-6 mb-6 border border-white/20">
        <div class="flex items-center">
            <a href="{{ route('jadwal_audit.index') }}" class="text-gray-600 hover:text-gray-800 mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Tambah Jadwal Audit</h1>
                <p class="text-gray-600">Form tambah jadwal audit baru</p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="glass-effect rounded-2xl shadow-xl p-6 border border-white/20">
        <form action="{{ route('jadwal_audit.store') }}" method="POST">
            @csrf
            
            <!-- Nama Instansi -->
            <div class="mb-6">
                <label for="nama_instansi" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Instansi <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="nama_instansi" 
                       name="nama_instansi" 
                       value="{{ old('nama_instansi') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200"
                       placeholder="Masukkan nama instansi"
                       required>
                @error('nama_instansi')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Alamat -->
            <div class="mb-6">
                <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">
                    Alamat <span class="text-red-500">*</span>
                </label>
                <textarea id="alamat" 
                          name="alamat" 
                          rows="3"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200"
                          placeholder="Masukkan alamat lengkap"
                          required>{{ old('alamat') }}</textarea>
                @error('alamat')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tim Audit -->
            <div class="mb-6">
                <label for="tim_audit_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Tim Audit <span class="text-red-500">*</span>
                </label>
                <select id="tim_audit_id" 
                        name="tim_audit_id" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200"
                        required>
                    <option value="">-- Pilih Tim Audit --</option>
                    @foreach($timAudits as $timAudit)
                    <option value="{{ $timAudit->id }}" 
                            {{ old('tim_audit_id') == $timAudit->id ? 'selected' : '' }}>
                        {{ $timAudit->nama_tim }} - {{ $timAudit->bidang }}
                    </option>
                    @endforeach
                </select>
                @error('tim_audit_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tanggal Audit -->
            <div class="mb-6">
                <label for="tgl_audit" class="block text-sm font-medium text-gray-700 mb-2">
                    Tanggal Audit <span class="text-red-500">*</span>
                </label>
                <input type="date" 
                       id="tgl_audit" 
                       name="tgl_audit" 
                       value="{{ old('tgl_audit') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200"
                       required>
                @error('tgl_audit')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div class="mb-6">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                    Status <span class="text-red-500">*</span>
                </label>
                <select id="status" 
                        name="status" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200"
                        required>
                    <option value="">-- Pilih Status --</option>
                    <option value="Dijadwalkan" {{ old('status') == 'Dijadwalkan' ? 'selected' : '' }}>Dijadwalkan</option>
                    <option value="Sedang Berlangsung" {{ old('status') == 'Sedang Berlangsung' ? 'selected' : '' }}>Sedang Berlangsung</option>
                    <option value="Selesai" {{ old('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="Ditunda" {{ old('status') == 'Ditunda' ? 'selected' : '' }}>Ditunda</option>
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Keterangan -->
            <div class="mb-6">
                <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">
                    Keterangan
                </label>
                <textarea id="keterangan" 
                          name="keterangan" 
                          rows="3"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200"
                          placeholder="Masukkan keterangan tambahan (opsional)">{{ old('keterangan') }}</textarea>
                @error('keterangan')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex justify-end space-x-3">
                <a href="{{ route('jadwal_audit.index') }}" 
                   class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg hover:from-purple-700 hover:to-pink-700 transition-all duration-200">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
