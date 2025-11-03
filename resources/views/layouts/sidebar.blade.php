<!-- Sidebar -->
<aside id="sidebar"
    class="w-64 bg-white shadow-xl min-h-screen transition-all duration-300 transform lg:translate-x-0 -translate-x-full fixed lg:relative lg:block hidden border-r border-gray-200">
    <div class="p-6">
        <!-- User Profile Section -->
        <div class="mb-8 p-4 bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl">
            <div class="flex items-center">
                <div
                    class="w-12 h-12 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 flex items-center justify-center">
                    <span class="text-white font-bold text-lg">{{ strtoupper(substr(auth()->user()->name, 0, 1))
                        }}</span>
                </div>
                <div class="ml-3">
                    <p class="font-semibold text-gray-800">{{ auth()->user()->name }}</p>
                    <p class="text-sm text-gray-500">{{ ucfirst(auth()->user()->role) }}</p>
                </div>
            </div>
        </div>

        <!-- Navigation Menu -->
        <ul class="space-y-2">
            <li>
                <a href="{{ route('dashboard') }}"
                    class="sidebar-gradient-hover @if(request()->routeIs('dashboard')) active @endif flex items-center p-3 rounded-lg text-gray-700 font-medium relative">
                    <i class="fas fa-tachometer-alt w-5 text-purple-600"></i>
                    <span class="ml-3">Dashboard</span>
                    @if(request()->routeIs('dashboard'))
                    <i class="fas fa-chevron-right ml-auto text-purple-600"></i>
                    @else
                    <i class="fas fa-chevron-right ml-auto text-gray-400"></i>
                    @endif
                </a>
            </li>
            @if(auth()->user()->role === 'admin')
            <li>
                <a href="{{ route('users.index') }}"
                    class="sidebar-gradient-hover @if(request()->routeIs('users.*')) active @endif flex items-center p-3 rounded-lg text-gray-700 font-medium relative">
                    <i class="fas fa-user w-5 text-purple-600"></i>
                    <span class="ml-3">User</span>
                    @if(request()->routeIs('users.*'))
                    <i class="fas fa-chevron-right ml-auto text-purple-600"></i>
                    @else
                    <i class="fas fa-chevron-right ml-auto text-gray-400"></i>
                    @endif
                </a>
            </li>
            @endif
            <li>
                <a href="{{ route('pegawai.index') }}"
                    class="sidebar-gradient-hover @if(request()->routeIs('pegawai.*')) active @endif flex items-center p-3 rounded-lg text-gray-700 font-medium relative">
                    <i class="fas fa-users w-5 text-purple-600"></i>
                    <span class="ml-3">Pegawai</span>
                    @if(request()->routeIs('pegawai.*'))
                    <i class="fas fa-chevron-right ml-auto text-purple-600"></i>
                    @else
                    <i class="fas fa-chevron-right ml-auto text-gray-400"></i>
                    @endif
                </a>
            </li>
            <li>
                <a href="{{ route('tim_audit.index') }}"
                    class="sidebar-gradient-hover @if(request()->routeIs('tim_audit.*')) active @endif flex items-center p-3 rounded-lg text-gray-700 font-medium relative">
                    <i class="fas fa-user-tie w-5 text-purple-600"></i>
                    <span class="ml-3">Tim Audit</span>
                    @if(request()->routeIs('tim_audit.*'))
                    <i class="fas fa-chevron-right ml-auto text-purple-600"></i>
                    @else
                    <i class="fas fa-chevron-right ml-auto text-gray-400"></i>
                    @endif
                </a>
            </li>
            <li>
                <a href="{{ route('jadwal_audit.index') }}"
                    class="sidebar-gradient-hover @if(request()->routeIs('jadwal_audit.*')) active @endif flex items-center p-3 rounded-lg text-gray-700 font-medium relative">
                    <i class="fas fa-calendar-alt w-5 text-purple-600"></i>
                    <span class="ml-3">Jadwal Audit</span>
                    @if(request()->routeIs('jadwal_audit.*'))
                    <i class="fas fa-chevron-right ml-auto text-purple-600"></i>
                    @else
                    <i class="fas fa-chevron-right ml-auto text-gray-400"></i>
                    @endif
                </a>
            </li>
            <li>
                <a href="{{ route('pemeriksaan.index') }}"
                    class="sidebar-gradient-hover @if(request()->routeIs('pemeriksaan.*')) active @endif flex items-center p-3 rounded-lg text-gray-700 font-medium relative">
                    <i class="fas fa-search w-5 text-purple-600"></i>
                    <span class="ml-3">Pemeriksaan</span>
                    @if(request()->routeIs('pemeriksaan.*'))
                    <i class="fas fa-chevron-right ml-auto text-purple-600"></i>
                    @else
                    <i class="fas fa-chevron-right ml-auto text-gray-400"></i>
                    @endif
                </a>
            </li>
            <li>
                <a href="{{ route('tindak_lanjut.index') }}"
                    class="sidebar-gradient-hover @if(request()->routeIs('tindak_lanjut.*')) active @endif flex items-center p-3 rounded-lg text-gray-700 font-medium relative">
                    <i class="fas fa-tasks w-5 text-purple-600"></i>
                    <span class="ml-3">Tindak Lanjut</span>
                    @if(request()->routeIs('tindak_lanjut.*'))
                    <i class="fas fa-chevron-right ml-auto text-purple-600"></i>
                    @else
                    <i class="fas fa-chevron-right ml-auto text-gray-400"></i>
                    @endif
                </a>
            </li>
            <li>
                <a href="{{ route('laporan.index') }}"
                    class="sidebar-gradient-hover @if(request()->routeIs('laporan.*')) active @endif flex items-center p-3 rounded-lg text-gray-700 font-medium relative">
                    <i class="fas fa-file-alt w-5 text-purple-600"></i>
                    <span class="ml-3">Laporan</span>
                    @if(request()->routeIs('laporan.*'))
                    <i class="fas fa-chevron-right ml-auto text-purple-600"></i>
                    @else
                    <i class="fas fa-chevron-right ml-auto text-gray-400"></i>
                    @endif
                </a>
            </li>
            <li>
                <a href="#" onclick="confirmLogout(event)"
                    class="sidebar-gradient-hover flex items-center p-3 rounded-lg text-gray-700 font-medium relative">
                    <i class="fas fa-sign-out-alt w-5 text-purple-600"></i>
                    <span class="ml-3">Keluar</span>
                    <i class="fas fa-chevron-right ml-auto text-gray-400"></i>
                </a>
            </li>
        </ul>

    </div>
</aside>
