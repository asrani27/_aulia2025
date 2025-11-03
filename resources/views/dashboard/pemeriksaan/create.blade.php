@extends('layouts.app')

@section('title', 'Tambah Pemeriksaan')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="glass-effect rounded-2xl shadow-xl p-6 mb-6 border border-white/20">
        <div class="flex items-center mb-4">
            <a href="{{ route('pemeriksaan.index') }}" class="text-gray-600 hover:text-gray-900 mr-3">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Tambah Pemeriksaan</h1>
                <p class="text-gray-600">Form tambah data pemeriksaan audit</p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="glass-effect rounded-2xl shadow-xl p-6 border border-white/20">
        <form action="{{ route('pemeriksaan.store') }}" method="POST">
            @csrf
            
            <!-- Nomor -->
            <div class="mb-6">
                <label for="nomor" class="block text-sm font-medium text-gray-700 mb-2">
                    Nomor
                </label>
                <input type="text" id="nomor" name="nomor"
                       value="{{ old('nomor') }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200"
                       placeholder="Masukkan nomor pemeriksaan (opsional)">
                @error('nomor')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Jadwal Audit -->
            <div class="mb-6">
                <label for="jadwal_audit_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Jadwal Audit <span class="text-red-500">*</span>
                </label>
                <select id="jadwal_audit_id" name="jadwal_audit_id" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200">
                    <option value="">-- Pilih Jadwal Audit --</option>
                    @foreach($jadwalAudits as $jadwal)
                    <option value="{{ $jadwal->id }}" 
                            data-instansi="{{ $jadwal->nama_instansi }}"
                            data-tim="{{ $jadwal->timAudit->nama_tim }}"
                            data-tgl="{{ $jadwal->tgl_audit->format('d M Y') }}">
                        {{ $jadwal->nama_instansi }} - {{ $jadwal->timAudit->nama_tim }} ({{ $jadwal->tgl_audit->format('d M Y') }})
                    </option>
                    @endforeach
                </select>
                @error('jadwal_audit_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Info Jadwal yang Dipilih -->
            <div id="jadwalInfo" class="hidden mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                <h3 class="text-sm font-medium text-blue-800 mb-2">Informasi Jadwal Audit:</h3>
                <div class="text-sm text-blue-700">
                    <p><strong>Instansi:</strong> <span id="infoInstansi"></span></p>
                    <p><strong>Tim Audit:</strong> <span id="infoTim"></span></p>
                    <p><strong>Tanggal Audit:</strong> <span id="infoTgl"></span></p>
                </div>
            </div>

            <!-- Tanggal Pemeriksaan -->
            <div class="mb-6">
                <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-2">
                    Tanggal Pemeriksaan <span class="text-red-500">*</span>
                </label>
                <input type="date" id="tanggal" name="tanggal" required
                       value="{{ old('tanggal', date('Y-m-d')) }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200">
                @error('tanggal')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Hasil Temuan -->
            <div class="mb-6">
                <label for="hasil_temuan" class="block text-sm font-medium text-gray-700 mb-2">
                    Hasil Temuan <span class="text-red-500">*</span>
                </label>
                <textarea id="hasil_temuan" name="hasil_temuan" rows="6" required
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200"
                          placeholder="Masukkan hasil temuan pemeriksaan...">{{ old('hasil_temuan') }}</textarea>
                @error('hasil_temuan')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Keterangan -->
            <div class="mb-6">
                <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">
                    Keterangan
                </label>
                <textarea id="keterangan" name="keterangan" rows="3"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200"
                          placeholder="Masukkan keterangan tambahan (opsional)...">{{ old('keterangan') }}</textarea>
                @error('keterangan')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex justify-end space-x-3">
                <a href="{{ route('pemeriksaan.index') }}" 
                   class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-all duration-200">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg hover:from-purple-700 hover:to-pink-700 transition-all duration-200 shadow-lg">
                    <i class="fas fa-save mr-2"></i>Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const jadwalSelect = document.getElementById('jadwal_audit_id');
    const jadwalInfo = document.getElementById('jadwalInfo');
    const infoInstansi = document.getElementById('infoInstansi');
    const infoTim = document.getElementById('infoTim');
    const infoTgl = document.getElementById('infoTgl');
    const tanggalInput = document.getElementById('tanggal');

    jadwalSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        
        if (this.value) {
            // Show info
            infoInstansi.textContent = selectedOption.dataset.instansi;
            infoTim.textContent = selectedOption.dataset.tim;
            infoTgl.textContent = selectedOption.dataset.tgl;
            jadwalInfo.classList.remove('hidden');
            
            // Set tanggal pemeriksaan ke tanggal audit
            const auditDate = selectedOption.dataset.tgl;
            // Convert "d M Y" to "Y-m-d"
            const months = {
                'Jan': '01', 'Feb': '02', 'Mar': '03', 'Apr': '04', 'May': '05', 'Jun': '06',
                'Jul': '07', 'Aug': '08', 'Sep': '09', 'Oct': '10', 'Nov': '11', 'Dec': '12'
            };
            const dateParts = auditDate.split(' ');
            const formattedDate = `${dateParts[2]}-${months[dateParts[1]]}-${dateParts[0].padStart(2, '0')}`;
            tanggalInput.value = formattedDate;
        } else {
            jadwalInfo.classList.add('hidden');
            tanggalInput.value = '{{ date('Y-m-d') }}';
        }
    });
});
</script>
@endsection
