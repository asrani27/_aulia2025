@extends('layouts.app')

@section('title', 'Manajemen Pegawai')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="glass-effect rounded-2xl shadow-xl p-6 mb-6 border border-white/20">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Manajemen Pegawai</h1>
                <p class="text-gray-600">Kelola data pegawai sistem</p>
            </div>
            <a href="{{ route('pegawai.create') }}" 
               class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-6 py-3 rounded-lg hover:from-purple-700 hover:to-pink-700 transition-all duration-300 flex items-center space-x-2 hover:scale-105">
                <i class="fas fa-plus"></i>
                <span>Tambah Pegawai</span>
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

    <!-- Pegawai Table -->
    <div class="glass-effect rounded-2xl shadow-xl p-6 border border-white/20">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">No</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Nama</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Tanggal Lahir</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Jenis Kelamin</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Pangkat</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Golongan</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Jabatan</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Telepon</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pegawais as $index => $pegawai)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                        <td class="py-3 px-4">{{ ($pegawais->currentpage() - 1) * $pegawais->perpage() + $index + 1 }}</td>
                        <td class="py-3 px-4">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-white text-sm font-bold">{{ strtoupper(substr($pegawai->nama, 0, 1)) }}</span>
                                </div>
                                <span class="font-medium text-gray-800">{{ $pegawai->nama }}</span>
                            </div>
                        </td>
                        <td class="py-3 px-4 text-gray-600">{{ $pegawai->tgl_lahir->format('d/m/Y') }}</td>
                        <td class="py-3 px-4">
                            <span class="px-3 py-1 rounded-full text-xs font-medium
                                @if($pegawai->jkel === 'L') bg-blue-100 text-blue-800
                                @else bg-pink-100 text-pink-800 @endif">
                                {{ $pegawai->jkel === 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-gray-600">{{ $pegawai->pangkat }}</td>
                        <td class="py-3 px-4 text-gray-600">{{ $pegawai->golongan }}</td>
                        <td class="py-3 px-4 text-gray-600">{{ $pegawai->jabatan }}</td>
                        <td class="py-3 px-4 text-gray-600">{{ $pegawai->telp }}</td>
                        <td class="py-3 px-4">
                            <div class="flex space-x-2">
                                <a href="{{ route('pegawai.edit', $pegawai->id) }}" 
                                   class="text-blue-600 hover:text-blue-800 transition-colors"
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('pegawai.destroy', $pegawai->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-800 transition-colors"
                                            title="Hapus"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data pegawai ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-8 text-gray-500">
                            <i class="fas fa-users text-4xl mb-3"></i>
                            <p>Belum ada data pegawai</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($pegawais->hasPages())
            <div class="mt-6 flex justify-center">
                {{ $pegawais->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
