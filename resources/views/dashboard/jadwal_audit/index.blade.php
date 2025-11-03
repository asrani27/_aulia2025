@extends('layouts.app')

@section('title', 'Jadwal Audit')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="glass-effect rounded-2xl shadow-xl p-6 mb-6 border border-white/20">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Jadwal Audit</h1>
                <p class="text-gray-600">Manajemen jadwal audit</p>
            </div>
            <a href="{{ route('jadwal_audit.create') }}" 
               class="px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg hover:from-purple-700 hover:to-pink-700 transition-all duration-200 shadow-lg">
                <i class="fas fa-plus mr-2"></i>Tambah Jadwal
            </a>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6">
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
    </div>
    @endif

    <!-- Table -->
    <div class="glass-effect rounded-2xl shadow-xl border border-white/20 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-purple-50 to-pink-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Nama Instansi</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Tim Audit</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($jadwalAudits as $index => $jadwalAudit)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ ($jadwalAudits->currentPage() - 1) * $jadwalAudits->perPage() + $index + 1 }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $jadwalAudit->nama_instansi }}</div>
                            <div class="text-sm text-gray-500">{{ Str::limit($jadwalAudit->alamat, 50) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $jadwalAudit->timAudit->nama_tim }}</div>
                            <div class="text-sm text-gray-500">{{ $jadwalAudit->timAudit->bidang }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $jadwalAudit->tgl_audit->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if($jadwalAudit->status == 'Selesai') bg-green-100 text-green-800
                                @elseif($jadwalAudit->status == 'Sedang Berlangsung') bg-blue-100 text-blue-800
                                @elseif($jadwalAudit->status == 'Dijadwalkan') bg-yellow-100 text-yellow-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ $jadwalAudit->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('jadwal_audit.show', $jadwalAudit->id) }}" 
                                   class="text-blue-600 hover:text-blue-900 transition-colors">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('jadwal_audit.edit', $jadwalAudit->id) }}" 
                                   class="text-indigo-600 hover:text-indigo-900 transition-colors">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('jadwal_audit.destroy', $jadwalAudit->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')"
                                            class="text-red-600 hover:text-red-900 transition-colors">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            <i class="fas fa-calendar-alt text-4xl mb-3"></i>
                            <p class="text-lg">Belum ada data jadwal audit</p>
                            <p class="text-sm mt-1">Tambah jadwal audit untuk memulai</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($jadwalAudits->hasPages())
        <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
            <div class="flex-1 flex justify-between sm:hidden">
                {{ $jadwalAudits->links() }}
            </div>
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-700">
                        Menampilkan <span class="font-medium">{{ $jadwalAudits->firstItem() }}</span> 
                        hingga <span class="font-medium">{{ $jadwalAudits->lastItem() }}</span> 
                        dari <span class="font-medium">{{ $jadwalAudits->total() }}</span> hasil
                    </p>
                </div>
                <div>
                    {{ $jadwalAudits->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
