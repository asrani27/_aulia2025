@extends('layouts.app')

@section('title', 'Detail Tindak Lanjut')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="glass-effect rounded-2xl shadow-xl p-6 mb-6 border border-white/20">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Detail Tindak Lanjut</h1>
                <p class="text-gray-600">Informasi lengkap data tindak lanjut audit</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('tindak_lanjut.edit', $tindakLanjut) }}" 
                   class="bg-yellow-600 text-white px-6 py-3 rounded-lg hover:bg-yellow-700 transition-all duration-300 flex items-center space-x-2 hover:scale-105">
                    <i class="fas fa-edit"></i>
                    <span>Edit</span>
                </a>
                <a href="{{ route('tindak_lanjut.index') }}" 
                   class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition-all duration-300 flex items-center space-x-2 hover:scale-105">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Detail Information -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Basic Information -->
        <div class="glass-effect rounded-2xl shadow-xl p-6 border border-white/20">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-info-circle mr-2 text-purple-600"></i>
                Informasi Dasar
            </h2>
            <div class="space-y-4">
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-gray-600 font-medium">Tanggal</span>
                    <span class="text-gray-800 font-semibold">{{ $tindakLanjut->tanggal->format('d/m/Y') }}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-gray-600 font-medium">Status</span>
                    <span>{!! $tindakLanjut->status_label !!}</span>
                </div>
                <div class="py-2 border-b border-gray-100">
                    <span class="text-gray-600 font-medium block mb-2">Pemeriksaan</span>
                    @if($tindakLanjut->pemeriksaan)
                        <div class="text-gray-800">
                            <span class="font-semibold">{{ $tindakLanjut->pemeriksaan->jadwalAudit->nama_kegiatan ?? '-' }}</span>
                            <br>
                            <small class="text-gray-500">
                                Tanggal Pemeriksaan: {{ $tindakLanjut->pemeriksaan->tanggal->format('d/m/Y') }}
                            </small>
                        </div>
                    @else
                        <span class="text-gray-500">-</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Timestamp Information -->
        <div class="glass-effect rounded-2xl shadow-xl p-6 border border-white/20">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-clock mr-2 text-purple-600"></i>
                Informasi Waktu
            </h2>
            <div class="space-y-4">
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-gray-600 font-medium">Dibuat</span>
                    <span class="text-gray-800 font-semibold">{{ $tindakLanjut->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-gray-600 font-medium">Diperbarui</span>
                    <span class="text-gray-800 font-semibold">{{ $tindakLanjut->updated_at->format('d/m/Y H:i') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Sections -->
    <div class="space-y-6">
        <!-- Uraian Temuan -->
        <div class="glass-effect rounded-2xl shadow-xl p-6 border border-white/20">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-exclamation-triangle mr-2 text-purple-600"></i>
                Uraian Temuan
            </h2>
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-gray-700 leading-relaxed">{{ $tindakLanjut->uraian }}</p>
            </div>
        </div>

        <!-- Tindak Lanjut -->
        <div class="glass-effect rounded-2xl shadow-xl p-6 border border-white/20">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-tasks mr-2 text-purple-600"></i>
                Tindak Lanjut
            </h2>
            <div class="bg-blue-50 rounded-lg p-4">
                <p class="text-gray-700 leading-relaxed">{{ $tindakLanjut->tindak_lanjut }}</p>
            </div>
        </div>

        <!-- Keterangan (if exists) -->
        @if($tindakLanjut->keterangan)
            <div class="glass-effect rounded-2xl shadow-xl p-6 border border-white/20">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-sticky-note mr-2 text-purple-600"></i>
                    Keterangan
                </h2>
                <div class="bg-yellow-50 rounded-lg p-4">
                    <p class="text-gray-700 leading-relaxed">{{ $tindakLanjut->keterangan }}</p>
                </div>
            </div>
        @endif

        <!-- Rekomendasi/Saran (if exists) -->
        @if($tindakLanjut->rekomendasi_saran)
            <div class="glass-effect rounded-2xl shadow-xl p-6 border border-white/20">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-lightbulb mr-2 text-purple-600"></i>
                    Rekomendasi/Saran
                </h2>
                <div class="bg-green-50 rounded-lg p-4">
                    <p class="text-gray-700 leading-relaxed">{{ $tindakLanjut->rekomendasi_saran }}</p>
                </div>
            </div>
        @endif

        <!-- Hasil Temuan Pemeriksaan (if exists) -->
        @if($tindakLanjut->pemeriksaan && $tindakLanjut->pemeriksaan->hasil_temuan)
            <div class="glass-effect rounded-2xl shadow-xl p-6 border border-white/20">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-search mr-2 text-purple-600"></i>
                    Hasil Temuan Pemeriksaan
                </h2>
                <div class="bg-orange-50 rounded-lg p-4">
                    <p class="text-gray-700 leading-relaxed mb-4">{{ $tindakLanjut->pemeriksaan->hasil_temuan }}</p>
                    @if($tindakLanjut->pemeriksaan->keterangan)
                        <hr class="border-orange-200 my-4">
                        <h6 class="font-semibold text-gray-800 mb-2">Keterangan Pemeriksaan:</h6>
                        <p class="text-gray-700 leading-relaxed">{{ $tindakLanjut->pemeriksaan->keterangan }}</p>
                    @endif
                </div>
            </div>
        @endif
    </div>

    <!-- Action Buttons -->
    <div class="glass-effect rounded-2xl shadow-xl p-6 border border-white/20 mt-6">
        <div class="flex justify-between items-center">
            <div class="flex space-x-3">
                <a href="{{ route('tindak_lanjut.index') }}" 
                   class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-all duration-300 flex items-center space-x-2">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali</span>
                </a>
                <a href="{{ route('tindak_lanjut.edit', $tindakLanjut) }}" 
                   class="px-6 py-3 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition-all duration-300 flex items-center space-x-2">
                    <i class="fas fa-edit"></i>
                    <span>Edit</span>
                </a>
            </div>
            <form action="{{ route('tindak_lanjut.destroy', $tindakLanjut) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all duration-300 flex items-center space-x-2"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                    <i class="fas fa-trash"></i>
                    <span>Hapus</span>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
