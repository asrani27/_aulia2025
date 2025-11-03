@extends('layouts.app')

@section('title', 'Detail Jadwal Audit')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="glass-effect rounded-2xl shadow-xl p-6 mb-6 border border-white/20">
        <div class="flex items-center">
            <a href="{{ route('jadwal_audit.index') }}" class="text-gray-600 hover:text-gray-800 mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Detail Jadwal Audit</h1>
                <p class="text-gray-600">Informasi lengkap jadwal audit</p>
            </div>
        </div>
    </div>

    <!-- Jadwal Audit Info -->
    <div class="glass-effect rounded-2xl shadow-xl p-6 mb-6 border border-white/20">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-sm font-medium text-gray-500 mb-1">Nama Instansi</h3>
                <p class="text-lg font-semibold text-gray-800">{{ $jadwalAudit->nama_instansi }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500 mb-1">Status</h3>
                <p class="text-lg font-semibold text-gray-800">
                    <span class="px-3 py-1 rounded-full text-sm font-medium 
                        @if($jadwalAudit->status == 'Selesai') bg-green-100 text-green-800
                        @elseif($jadwalAudit->status == 'Sedang Berlangsung') bg-blue-100 text-blue-800
                        @elseif($jadwalAudit->status == 'Dijadwalkan') bg-yellow-100 text-yellow-800
                        @else bg-gray-100 text-gray-800 @endif">
                        {{ $jadwalAudit->status }}
                    </span>
                </p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500 mb-1">Tim Audit</h3>
                <p class="text-lg font-semibold text-gray-800">{{ $jadwalAudit->timAudit->nama_tim }}</p>
                <p class="text-sm text-gray-600">{{ $jadwalAudit->timAudit->bidang }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500 mb-1">Tanggal Audit</h3>
                <p class="text-lg font-semibold text-gray-800">
                    <i class="fas fa-calendar-alt mr-2 text-purple-600"></i>
                    {{ $jadwalAudit->tgl_audit->format('d F Y') }}
                </p>
            </div>
        </div>

        <!-- Alamat -->
        <div class="mt-6 pt-6 border-t border-gray-200">
            <h3 class="text-sm font-medium text-gray-500 mb-2">Alamat</h3>
            <p class="text-gray-800">{{ $jadwalAudit->alamat }}</p>
        </div>

        <!-- Keterangan -->
        @if($jadwalAudit->keterangan)
        <div class="mt-6 pt-6 border-t border-gray-200">
            <h3 class="text-sm font-medium text-gray-500 mb-2">Keterangan</h3>
            <p class="text-gray-800">{{ $jadwalAudit->keterangan }}</p>
        </div>
        @endif
    </div>

    <!-- Tim Audit Members -->
    <div class="glass-effect rounded-2xl shadow-xl p-6 mb-6 border border-white/20">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Anggota Tim Audit</h2>
        
        @forelse($jadwalAudit->timAudit->anggota as $anggota)
        <div class="bg-gray-50 rounded-lg p-4 mb-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center mr-3">
                        <span class="text-white font-bold">{{ strtoupper(substr($anggota->nama, 0, 1)) }}</span>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">{{ $anggota->nama }}</p>
                        <p class="text-sm text-gray-600">{{ $anggota->jabatan }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-500">{{ $anggota->pangkat }}</p>
                    <p class="text-sm text-gray-500">{{ $anggota->golongan }}</p>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-8 text-gray-500">
            <i class="fas fa-users text-4xl mb-3"></i>
            <p>Tim ini belum memiliki anggota</p>
        </div>
        @endforelse
    </div>

    <!-- Action Buttons -->
    <div class="flex justify-end space-x-3">
        <a href="{{ route('jadwal_audit.edit', $jadwalAudit->id) }}" 
           class="px-6 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg hover:from-purple-700 hover:to-pink-700 transition-all duration-200">
            <i class="fas fa-edit mr-2"></i>Edit Jadwal
        </a>
    </div>
</div>
@endsection
