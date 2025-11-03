@extends('layouts.app')

@section('title', 'Manajemen Tim Audit')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="glass-effect rounded-2xl shadow-xl p-6 mb-6 border border-white/20">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Manajemen Tim Audit</h1>
                <p class="text-gray-600">Kelola data tim audit sistem</p>
            </div>
            <a href="{{ route('tim_audit.create') }}" 
               class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-6 py-3 rounded-lg hover:from-purple-700 hover:to-pink-700 transition-all duration-300 flex items-center space-x-2 hover:scale-105">
                <i class="fas fa-plus"></i>
                <span>Tambah Tim Audit</span>
            </a>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <!-- Tim Audit Table -->
    <div class="glass-effect rounded-2xl shadow-xl p-6 border border-white/20">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">No</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Nama Tim</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Bidang</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Anggota</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($timAudits as $index => $timAudit)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                        <td class="py-3 px-4">{{ $index + 1 }}</td>
                        <td class="py-3 px-4">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-r from-green-500 to-blue-500 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-white text-sm font-bold">{{ strtoupper(substr($timAudit->nama_tim, 0, 1)) }}</span>
                                </div>
                                <span class="font-medium text-gray-800">{{ $timAudit->nama_tim }}</span>
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                {{ $timAudit->bidang }}
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex flex-wrap gap-1">
                                @forelse($timAudit->anggota as $anggota)
                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">
                                        {{ $anggota->nama }}
                                    </span>
                                @empty
                                    <span class="text-gray-500 text-sm">Belum ada anggota</span>
                                @endforelse
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex space-x-2">
                                <a href="{{ route('tim_audit.show', $timAudit->id) }}" 
                                   class="text-green-600 hover:text-green-800 transition-colors"
                                   title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('tim_audit.edit', $timAudit->id) }}" 
                                   class="text-blue-600 hover:text-blue-800 transition-colors"
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('tim_audit.destroy', $timAudit->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-800 transition-colors"
                                            title="Hapus"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus tim audit ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-8 text-gray-500">
                            <i class="fas fa-user-tie text-4xl mb-3"></i>
                            <p>Belum ada data tim audit</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
