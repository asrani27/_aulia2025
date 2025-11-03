@extends('layouts.app')

@section('title', 'Tindak Lanjut')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="glass-effect rounded-2xl shadow-xl p-6 mb-6 border border-white/20">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Data Tindak Lanjut</h1>
                <p class="text-gray-600">Kelola data tindak lanjut audit</p>
            </div>
            <a href="{{ route('tindak_lanjut.create') }}" 
               class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-6 py-3 rounded-lg hover:from-purple-700 hover:to-pink-700 transition-all duration-300 flex items-center space-x-2 hover:scale-105">
                <i class="fas fa-plus"></i>
                <span>Tambah Tindak Lanjut</span>
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

    <!-- Tindak Lanjut Table -->
    <div class="glass-effect rounded-2xl shadow-xl p-6 border border-white/20">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">No Urut</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Nomor</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Tanggal</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Pemeriksaan</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Uraian</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Tindak Lanjut</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Rekomendasi/Saran</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Status</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tindakLanjuts as $index => $tindakLanjut)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                        <td class="py-3 px-4">{{ $tindakLanjuts->firstItem() + $index }}</td>
                        <td class="py-3 px-4">{{ $tindakLanjut->nomor ?? '-' }}</td>
                        <td class="py-3 px-4 text-gray-600">{{ $tindakLanjut->tanggal->format('d/m/Y') }}</td>
                        <td class="py-3 px-4">
                            @if($tindakLanjut->pemeriksaan)
                                <div>
                                    <span class="font-medium text-gray-800">{{ $tindakLanjut->pemeriksaan->jadwalAudit->nama_kegiatan ?? '-' }}</span>
                                    <br>
                                    <small class="text-gray-500">{{ $tindakLanjut->pemeriksaan->tanggal->format('d/m/Y') }}</small>
                                </div>
                            @else
                                <span class="text-gray-500">-</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-gray-600">{{ Str::limit($tindakLanjut->uraian, 50) }}</td>
                        <td class="py-3 px-4 text-gray-600">{{ Str::limit($tindakLanjut->tindak_lanjut, 50) }}</td>
                        <td class="py-3 px-4 text-gray-600">{{ Str::limit($tindakLanjut->rekomendasi_saran ?? '-', 50) }}</td>
                        <td class="py-3 px-4">{!! $tindakLanjut->status_label !!}</td>
                        <td class="py-3 px-4">
                            <div class="flex space-x-2">
                                <a href="{{ route('tindak_lanjut.show', $tindakLanjut) }}" 
                                   class="text-blue-600 hover:text-blue-800 transition-colors"
                                   title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('tindak_lanjut.edit', $tindakLanjut) }}" 
                                   class="text-yellow-600 hover:text-yellow-800 transition-colors"
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('tindak_lanjut.destroy', $tindakLanjut) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-800 transition-colors"
                                            title="Hapus"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-8 text-gray-500">
                            <i class="fas fa-tasks text-4xl mb-3"></i>
                            <p>Data tidak tersedia</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($tindakLanjuts->hasPages())
            <div class="mt-6 flex justify-between items-center">
                <div class="text-sm text-gray-600">
                    Menampilkan {{ $tindakLanjuts->firstItem() }} - {{ $tindakLanjuts->lastItem() }} 
                    dari {{ $tindakLanjuts->total() }} data
                </div>
                <div class="flex justify-center">
                    {{ $tindakLanjuts->links() }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
