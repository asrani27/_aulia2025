@extends('layouts.app')

@section('title', 'Detail Tim Audit')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="glass-effect rounded-2xl shadow-xl p-6 mb-6 border border-white/20">
        <div class="flex items-center">
            <a href="{{ route('tim_audit.index') }}" class="text-gray-600 hover:text-gray-800 mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Detail Tim Audit</h1>
                <p class="text-gray-600">Informasi lengkap tim audit</p>
            </div>
        </div>
    </div>

    <!-- Tim Audit Info -->
    <div class="glass-effect rounded-2xl shadow-xl p-6 mb-6 border border-white/20">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-sm font-medium text-gray-500 mb-1">Nama Tim</h3>
                <p class="text-lg font-semibold text-gray-800">{{ $timAudit->nama_tim }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500 mb-1">Bidang</h3>
                <p class="text-lg font-semibold text-gray-800">
                    <span class="px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                        {{ $timAudit->bidang }}
                    </span>
                </p>
            </div>
        </div>
    </div>

    <!-- Anggota -->
    <div class="glass-effect rounded-2xl shadow-xl p-6 border border-white/20">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Anggota Tim</h2>
        
        @forelse($timAudit->anggota as $anggota)
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
            <p>Belum ada anggota dalam tim ini</p>
        </div>
        @endforelse

        <!-- Action Buttons -->
        <div class="flex justify-end space-x-3 mt-6">
            <a href="{{ route('tim_audit.edit', $timAudit->id) }}" 
               class="px-6 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg hover:from-purple-700 hover:to-pink-700 transition-all duration-200">
                <i class="fas fa-edit mr-2"></i>Edit Tim
            </a>
        </div>
    </div>
</div>
@endsection
