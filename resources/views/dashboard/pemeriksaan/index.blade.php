@extends('layouts.app')

@section('title', 'Pemeriksaan')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="glass-effect rounded-2xl shadow-xl p-6 mb-6 border border-white/20">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Pemeriksaan</h1>
                <p class="text-gray-600">Manajemen data pemeriksaan audit</p>
            </div>
            <a href="{{ route('pemeriksaan.create') }}" 
               class="px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg hover:from-purple-700 hover:to-pink-700 transition-all duration-200 shadow-lg">
                <i class="fas fa-plus mr-2"></i>Tambah Pemeriksaan
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
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">No Urut</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Nomor</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Instansi</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Jabatan Pemeriksa</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Tim Audit</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Hasil Temuan</th>
                        
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($pemeriksaan as $index => $item)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $pemeriksaan->firstItem() + $index }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $item->nomor ?? '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $item->jadwalAudit->nama_instansi }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                {{ ucfirst($item->jabatan_pemeriksa ?? '-') }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $item->jadwalAudit->timAudit->nama_tim }}</div>
                            <div class="text-sm text-gray-500">{{ $item->jadwalAudit->timAudit->bidang }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $item->tanggal->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900 max-w-xs truncate" title="{{ $item->hasil_temuan }}">
                                {{ Str::limit($item->hasil_temuan, 50) }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('pemeriksaan.show', $item->id) }}" 
                                   class="text-blue-600 hover:text-blue-900 transition-colors"
                                   title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('pemeriksaan.edit', $item->id) }}" 
                                   class="text-indigo-600 hover:text-indigo-900 transition-colors"
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('pemeriksaan.destroy', $item->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data pemeriksaan ini?')"
                                            class="text-red-600 hover:text-red-900 transition-colors"
                                            title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                            <i class="fas fa-search text-4xl mb-3"></i>
                            <p class="text-lg">Belum ada data pemeriksaan</p>
                            <p class="text-sm mt-1">Tambah data pemeriksaan untuk memulai</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($pemeriksaan->hasPages())
        <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
            <div class="flex-1 flex justify-between sm:hidden">
                {{ $pemeriksaan->links() }}
            </div>
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-700">
                        Menampilkan <span class="font-medium">{{ $pemeriksaan->firstItem() }}</span> 
                        hingga <span class="font-medium">{{ $pemeriksaan->lastItem() }}</span> 
                        dari <span class="font-medium">{{ $pemeriksaan->total() }}</span> hasil
                    </p>
                </div>
                <div>
                    {{ $pemeriksaan->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
