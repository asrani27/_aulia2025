@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Welcome Section -->
    <div class="glass-effect rounded-2xl shadow-xl p-8 mb-8 border border-white/20">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Sistem Informasi Aplikasi Tindak Lanjut Temuan pada
                    Inspektorat Daerah Provinsi Kalimantan Selatan</h1>
                <p class="text-gray-600 text-lg">Selamat Datang, {{ auth()->user()->name }}! 👋 Kelola data audit dan
                    tindak lanjut dengan mudah dan efisien.</p>
            </div>
            <div class="hidden md:block">
                <div
                    class="w-20 h-20 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center shadow-lg floating">
                    <span class="text-white font-bold text-2xl">{{ strtoupper(substr(auth()->user()->name, 0, 1))
                        }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    @if(auth()->user()->role === 'pimpinan')
    <!-- Pimpinan Dashboard - Simplified View -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="card-hover bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Jadwal Audit</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalJadwalAudit }}</p>
                    <p class="text-xs text-orange-600 mt-2">
                        <i class="fas fa-calendar-alt"></i> Total Jadwal
                    </p>
                </div>
                <div
                    class="w-14 h-14 bg-gradient-to-r from-orange-500 to-orange-600 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-calendar-alt text-white text-xl"></i>
                </div>
            </div>
        </div>

        <div class="card-hover bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Pemeriksaan</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalPemeriksaan }}</p>
                    <p class="text-xs text-cyan-600 mt-2">
                        <i class="fas fa-search"></i> Total Pemeriksaan
                    </p>
                </div>
                <div
                    class="w-14 h-14 bg-gradient-to-r from-cyan-500 to-cyan-600 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-search text-white text-xl"></i>
                </div>
            </div>
        </div>

        <div class="card-hover bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Tindak Lanjut</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalTindakLanjut }}</p>
                    <p class="text-xs text-red-600 mt-2">
                        <i class="fas fa-tasks"></i> Total Tindak Lanjut
                    </p>
                </div>
                <div
                    class="w-14 h-14 bg-gradient-to-r from-red-500 to-red-600 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-tasks text-white text-xl"></i>
                </div>
            </div>
        </div>
    </div>
    @else
    <!-- Admin/Other Roles Dashboard -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6 mb-8">
        <!-- Users Card -->
        @if(auth()->user()->role === 'admin')
        <div class="card-hover bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Users</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalUsers }}</p>
                    <p class="text-xs text-blue-600 mt-2">
                        <i class="fas fa-users"></i> Total Pengguna
                    </p>
                </div>
                <div
                    class="w-14 h-14 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-user text-white text-xl"></i>
                </div>
            </div>
        </div>
        @endif

        <!-- Pegawai Card -->
        <div class="card-hover bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Pegawai</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalPegawai }}</p>
                    <p class="text-xs text-green-600 mt-2">
                        <i class="fas fa-users"></i> Total Pegawai
                    </p>
                </div>
                <div
                    class="w-14 h-14 bg-gradient-to-r from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-users text-white text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Tim Audit Card -->
        <div class="card-hover bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Tim Audit</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalTimAudit }}</p>
                    <p class="text-xs text-purple-600 mt-2">
                        <i class="fas fa-user-tie"></i> Total Tim
                    </p>
                </div>
                <div
                    class="w-14 h-14 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-user-tie text-white text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Jadwal Audit Card -->
        <div class="card-hover bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Jadwal Audit</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalJadwalAudit }}</p>
                    <p class="text-xs text-orange-600 mt-2">
                        <i class="fas fa-calendar-alt"></i> Total Jadwal
                    </p>
                </div>
                <div
                    class="w-14 h-14 bg-gradient-to-r from-orange-500 to-orange-600 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-calendar-alt text-white text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Pemeriksaan Card -->
        <div class="card-hover bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Pemeriksaan</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalPemeriksaan }}</p>
                    <p class="text-xs text-cyan-600 mt-2">
                        <i class="fas fa-search"></i> Total Pemeriksaan
                    </p>
                </div>
                <div
                    class="w-14 h-14 bg-gradient-to-r from-cyan-500 to-cyan-600 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-search text-white text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Tindak Lanjut Card -->
        <div class="card-hover bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Tindak Lanjut</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalTindakLanjut }}</p>
                    <p class="text-xs text-red-600 mt-2">
                        <i class="fas fa-tasks"></i> Total Tindak Lanjut
                    </p>
                </div>
                <div
                    class="w-14 h-14 bg-gradient-to-r from-red-500 to-red-600 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-tasks text-white text-xl"></i>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Quick Actions & Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Quick Actions -->
        <div class="lg:col-span-2">
            <div class="glass-effect rounded-2xl shadow-xl p-6 border border-white/20">
                <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-bolt text-purple-600 mr-3"></i>
                    Aksi Cepat
                </h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @if(auth()->user()->role === 'admin')
                    <a href="{{ route('users.index') }}"
                        class="group p-4 bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl hover:from-blue-100 hover:to-blue-200 transition-all duration-300 hover:scale-105 border border-blue-100">
                        <i
                            class="fas fa-user text-2xl text-blue-600 mb-2 group-hover:scale-110 transition-transform"></i>
                        <p class="text-sm font-medium text-gray-700">Manajemen User</p>
                    </a>
                    @endif

                    <a href="{{ route('pegawai.index') }}"
                        class="group p-4 bg-gradient-to-r from-green-50 to-green-100 rounded-xl hover:from-green-100 hover:to-green-200 transition-all duration-300 hover:scale-105 border border-green-100">
                        <i
                            class="fas fa-users text-2xl text-green-600 mb-2 group-hover:scale-110 transition-transform"></i>
                        <p class="text-sm font-medium text-gray-700">Data Pegawai</p>
                    </a>

                    <a href="{{ route('tim_audit.index') }}"
                        class="group p-4 bg-gradient-to-r from-purple-50 to-purple-100 rounded-xl hover:from-purple-100 hover:to-purple-200 transition-all duration-300 hover:scale-105 border border-purple-100">
                        <i
                            class="fas fa-user-tie text-2xl text-purple-600 mb-2 group-hover:scale-110 transition-transform"></i>
                        <p class="text-sm font-medium text-gray-700">Tim Audit</p>
                    </a>

                    <a href="{{ route('jadwal_audit.index') }}"
                        class="group p-4 bg-gradient-to-r from-orange-50 to-orange-100 rounded-xl hover:from-orange-100 hover:to-orange-200 transition-all duration-300 hover:scale-105 border border-orange-100">
                        <i
                            class="fas fa-calendar-alt text-2xl text-orange-600 mb-2 group-hover:scale-110 transition-transform"></i>
                        <p class="text-sm font-medium text-gray-700">Jadwal Audit</p>
                    </a>

                    <a href="{{ route('pemeriksaan.index') }}"
                        class="group p-4 bg-gradient-to-r from-cyan-50 to-cyan-100 rounded-xl hover:from-cyan-100 hover:to-cyan-200 transition-all duration-300 hover:scale-105 border border-cyan-100">
                        <i
                            class="fas fa-search text-2xl text-cyan-600 mb-2 group-hover:scale-110 transition-transform"></i>
                        <p class="text-sm font-medium text-gray-700">Pemeriksaan</p>
                    </a>

                    <a href="{{ route('tindak_lanjut.index') }}"
                        class="group p-4 bg-gradient-to-r from-red-50 to-red-100 rounded-xl hover:from-red-100 hover:to-red-200 transition-all duration-300 hover:scale-105 border border-red-100">
                        <i
                            class="fas fa-tasks text-2xl text-red-600 mb-2 group-hover:scale-110 transition-transform"></i>
                        <p class="text-sm font-medium text-gray-700">Tindak Lanjut</p>
                    </a>

                    <a href="{{ route('laporan.index') }}"
                        class="group p-4 bg-gradient-to-r from-indigo-50 to-indigo-100 rounded-xl hover:from-indigo-100 hover:to-indigo-200 transition-all duration-300 hover:scale-105 border border-indigo-100">
                        <i
                            class="fas fa-file-alt text-2xl text-indigo-600 mb-2 group-hover:scale-110 transition-transform"></i>
                        <p class="text-sm font-medium text-gray-700">Laporan</p>
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="lg:col-span-1">
            <div class="glass-effect rounded-2xl shadow-xl p-6 border border-white/20">
                <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-history text-purple-600 mr-3"></i>
                    Aktivitas Terbaru
                </h3>
                <div class="space-y-4">
                    <div
                        class="flex items-start space-x-3 p-3 bg-gradient-to-r from-purple-50 to-pink-50 rounded-lg border border-purple-100">
                        <div class="w-2 h-2 bg-purple-500 rounded-full mt-2"></div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-800">Selamat datang!</p>
                            <p class="text-xs text-gray-500">Login ke sistem</p>
                            <p class="text-xs text-gray-400 mt-1">Baru saja</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-center py-8">
                        <div class="text-center">
                            <i class="fas fa-inbox text-4xl text-gray-300 mb-3"></i>
                            <p class="text-sm text-gray-500">Belum ada aktivitas lain</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Information Cards -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Tindak Lanjut Status -->
        <div class="glass-effect rounded-2xl shadow-xl p-6 border border-white/20">
            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-chart-pie text-purple-600 mr-3"></i>
                Statistik Tindak Lanjut
            </h3>
            <div class="grid grid-cols-3 gap-4">
                <div class="text-center p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                    <p class="text-2xl font-bold text-yellow-600">{{ $tindakLanjutBelumDiproses }}</p>
                    <p class="text-sm text-gray-600 mt-1">Belum Diproses</p>
                </div>
                <div class="text-center p-4 bg-blue-50 rounded-lg border border-blue-200">
                    <p class="text-2xl font-bold text-blue-600">{{ $tindakLanjutDalamProses }}</p>
                    <p class="text-sm text-gray-600 mt-1">Dalam Proses</p>
                </div>
                <div class="text-center p-4 bg-green-50 rounded-lg border border-green-200">
                    <p class="text-2xl font-bold text-green-600">{{ $tindakLanjutSelesai }}</p>
                    <p class="text-sm text-gray-600 mt-1">Selesai</p>
                </div>
            </div>
        </div>

        <!-- Upcoming Audits -->
        <div class="glass-effect rounded-2xl shadow-xl p-6 border border-white/20">
            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-calendar-check text-purple-600 mr-3"></i>
                Jadwal Audit Mendatang
            </h3>
            <div class="space-y-3">
                @forelse($upcomingAudits as $audit)
                <div
                    class="flex items-center justify-between p-3 bg-gradient-to-r from-orange-50 to-red-50 rounded-lg border border-orange-100">
                    <div>
                        <p class="font-medium text-gray-800">{{ $audit->nama_kegiatan }}</p>
                        <p class="text-sm text-gray-600">{{ $audit->nama_instansi }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-medium text-orange-600">{{ $audit->tgl_audit->format('d M Y') }}</p>
                        <p class="text-xs text-gray-500">{{ $audit->timAudit->nama_tim ?? '-' }}</p>
                    </div>
                </div>
                @empty
                <div class="text-center py-8">
                    <i class="fas fa-calendar-times text-4xl text-gray-300 mb-3"></i>
                    <p class="text-sm text-gray-500">Tidak ada jadwal audit mendatang</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
