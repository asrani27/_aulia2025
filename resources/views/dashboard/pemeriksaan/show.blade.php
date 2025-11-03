@extends('layouts.app')

@section('title', 'Detail Pemeriksaan')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="glass-effect rounded-2xl shadow-xl p-6 mb-6 border border-white/20">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <a href="{{ route('pemeriksaan.index') }}" class="text-gray-600 hover:text-gray-900 mr-3">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Detail Pemeriksaan</h1>
                    <p class="text-gray-600">Informasi lengkap data pemeriksaan audit</p>
                </div>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('pemeriksaan.edit', $pemeriksaan->id) }}" 
                   class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-all duration-200">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
            </div>
        </div>
    </div>

    <!-- Detail Information -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Informasi Jadwal Audit -->
        <div class="glass-effect rounded-2xl shadow-xl p-6 border border-white/20">
            <div class="flex items-center mb-4">
                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-calendar-alt text-purple-600"></i>
                </div>
                <h2 class="text-lg font-semibold text-gray-800">Informasi Jadwal Audit</h2>
            </div>
            
            <div class="space-y-3">
                <div>
                    <label class="text-sm font-medium text-gray-500">Instansi</label>
                    <p class="text-gray-900 font-medium">{{ $pemeriksaan->jadwalAudit->nama_instansi }}</p>
                </div>
                
                <div>
                    <label class="text-sm font-medium text-gray-500">Tim Audit</label>
                    <p class="text-gray-900 font-medium">{{ $pemeriksaan->jadwalAudit->timAudit->nama_tim }}</p>
                    <p class="text-sm text-gray-600">{{ $pemeriksaan->jadwalAudit->timAudit->bidang }}</p>
                </div>
                
                <div>
                    <label class="text-sm font-medium text-gray-500">Tanggal Audit</label>
                    <p class="text-gray-900 font-medium">{{ $pemeriksaan->jadwalAudit->tgl_audit->format('d F Y') }}</p>
                </div>
                
                <div>
                    <label class="text-sm font-medium text-gray-500">Status</label>
                    <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full
                        @if($pemeriksaan->jadwalAudit->status == 'selesai') bg-green-100 text-green-800
                        @elseif($pemeriksaan->jadwalAudit->status == 'berlangsung') bg-blue-100 text-blue-800
                        @else bg-yellow-100 text-yellow-800
                        @endif">
                        {{ ucfirst($pemeriksaan->jadwalAudit->status) }}
                    </span>
                </div>
                
                @if($pemeriksaan->jadwalAudit->keterangan)
                <div>
                    <label class="text-sm font-medium text-gray-500">Keterangan Jadwal</label>
                    <p class="text-gray-900">{{ $pemeriksaan->jadwalAudit->keterangan }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Informasi Pemeriksaan -->
        <div class="glass-effect rounded-2xl shadow-xl p-6 border border-white/20">
            <div class="flex items-center mb-4">
                <div class="w-10 h-10 bg-pink-100 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-search text-pink-600"></i>
                </div>
                <h2 class="text-lg font-semibold text-gray-800">Informasi Pemeriksaan</h2>
            </div>
            
            <div class="space-y-3">
                <div>
                    <label class="text-sm font-medium text-gray-500">Tanggal Pemeriksaan</label>
                    <p class="text-gray-900 font-medium">{{ $pemeriksaan->tanggal->format('d F Y') }}</p>
                </div>
                
                <div>
                    <label class="text-sm font-medium text-gray-500">Hasil Temuan</label>
                    <div class="mt-1 p-3 bg-gray-50 rounded-lg">
                        <p class="text-gray-900 whitespace-pre-wrap">{{ $pemeriksaan->hasil_temuan }}</p>
                    </div>
                </div>
                
                @if($pemeriksaan->keterangan)
                <div>
                    <label class="text-sm font-medium text-gray-500">Keterangan</label>
                    <div class="mt-1 p-3 bg-gray-50 rounded-lg">
                        <p class="text-gray-900 whitespace-pre-wrap">{{ $pemeriksaan->keterangan }}</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="glass-effect rounded-2xl shadow-xl p-6 border border-white/20 mt-6">
        <div class="flex justify-between items-center">
            <div class="text-sm text-gray-500">
                <i class="fas fa-info-circle mr-1"></i>
                Data pemeriksaan ini terkait dengan jadwal audit {{ $pemeriksaan->jadwalAudit->nama_instansi }}
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('pemeriksaan.index') }}" 
                   class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-all duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <a href="{{ route('pemeriksaan.edit', $pemeriksaan->id) }}" 
                   class="px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg hover:from-purple-700 hover:to-pink-700 transition-all duration-200 shadow-lg">
                    <i class="fas fa-edit mr-2"></i>Edit Data
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
