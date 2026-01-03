@extends('layouts.app')

@section('title', 'Laporan')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="glass-effect rounded-2xl shadow-xl p-6 mb-6 border border-white/20">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Laporan</h1>
                <p class="text-gray-600">Generate laporan audit dalam format PDF</p>
            </div>
        </div>
    </div>

    <!-- Form Laporan -->
    <div class="glass-effect rounded-2xl shadow-xl p-6 border border-white/20">
        <form id="laporanForm" action="{{ route('laporan.export.pdf') }}" method="POST">
            @csrf
            
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-triangle mr-2 mt-1"></i>
                        <div>
                            <p class="font-semibold mb-2">Terjadi kesalahan:</p>
                            <ul class="list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Pilihan Bulan -->
                <div id="bulanField">
                    <label for="bulan" class="block text-sm font-medium text-gray-700 mb-2">
                        Bulan <span class="text-red-500" id="bulanRequired">*</span>
                    </label>
                    <select name="bulan" id="bulan" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('bulan') border-red-500 @enderror">
                        <option value="">-- Pilih Bulan (Opsional) --</option>
                        <option value="1" @if(old('bulan') == 1) selected @endif>Januari</option>
                        <option value="2" @if(old('bulan') == 2) selected @endif>Februari</option>
                        <option value="3" @if(old('bulan') == 3) selected @endif>Maret</option>
                        <option value="4" @if(old('bulan') == 4) selected @endif>April</option>
                        <option value="5" @if(old('bulan') == 5) selected @endif>Mei</option>
                        <option value="6" @if(old('bulan') == 6) selected @endif>Juni</option>
                        <option value="7" @if(old('bulan') == 7) selected @endif>Juli</option>
                        <option value="8" @if(old('bulan') == 8) selected @endif>Agustus</option>
                        <option value="9" @if(old('bulan') == 9) selected @endif>September</option>
                        <option value="10" @if(old('bulan') == 10) selected @endif>Oktober</option>
                        <option value="11" @if(old('bulan') == 11) selected @endif>November</option>
                        <option value="12" @if(old('bulan') == 12) selected @endif>Desember</option>
                    </select>
                    @error('bulan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Pilihan Tahun -->
                <div id="tahunField">
                    <label for="tahun" class="block text-sm font-medium text-gray-700 mb-2">
                        Tahun <span class="text-red-500" id="tahunRequired">*</span>
                    </label>
                    <select name="tahun" id="tahun" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('tahun') border-red-500 @enderror" 
                            required>
                        <option value="">-- Pilih Tahun --</option>
                        @for($year = date('Y'); $year >= 2020; $year--)
                            <option value="{{ $year }}" @if(old('tahun') == $year) selected @endif>{{ $year }}</option>
                        @endfor
                    </select>
                    @error('tahun')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jenis Laporan -->
                <div>
                    <label for="jenis_laporan" class="block text-sm font-medium text-gray-700 mb-2">
                        Jenis Laporan <span class="text-red-500">*</span>
                    </label>
                    <select name="jenis_laporan" id="jenis_laporan" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('jenis_laporan') border-red-500 @enderror" 
                            required>
                        <option value="">-- Pilih Jenis Laporan --</option>
                        <option value="tim_audit" @if(old('jenis_laporan') == 'tim_audit') selected @endif>Tim Audit</option>
                        <option value="jadwal_audit" @if(old('jenis_laporan') == 'jadwal_audit') selected @endif>Jadwal Audit</option>
                        <option value="pemeriksaan" @if(old('jenis_laporan') == 'pemeriksaan') selected @endif>Pemeriksaan</option>
                        <option value="tindak_lanjut" @if(old('jenis_laporan') == 'tindak_lanjut') selected @endif>Tindak Lanjut</option>
                    </select>
                    @error('jenis_laporan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Informasi Laporan -->
            <div class="mt-8 p-4 bg-blue-50 rounded-lg border border-blue-200">
                <h3 class="text-sm font-semibold text-blue-800 mb-2">
                    <i class="fas fa-info-circle mr-2"></i>Informasi Laporan
                </h3>
                <p class="text-sm text-blue-700" id="infoText">
                    Pilih periode (bulan dan tahun) serta jenis laporan yang ingin Anda generate. 
                    Laporan akan berisi data sesuai dengan filter yang dipilih dan dapat diunduh dalam format PDF.
                </p>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end space-x-4 mt-8">
                <button type="reset" 
                        class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-all duration-300 flex items-center space-x-2">
                    <i class="fas fa-redo"></i>
                    <span>Reset</span>
                </button>
                <button type="submit" 
                        class="px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg hover:from-purple-700 hover:to-pink-700 transition-all duration-300 flex items-center space-x-2 hover:scale-105">
                    <i class="fas fa-file-pdf"></i>
                    <span>Export PDF</span>
                </button>
            </div>
        </form>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('laporanForm');
    const jenisLaporanSelect = document.getElementById('jenis_laporan');
    const bulanField = document.getElementById('bulanField');
    const tahunField = document.getElementById('tahunField');
    const bulanRequired = document.getElementById('bulanRequired');
    const tahunRequired = document.getElementById('tahunRequired');
    const bulanSelect = document.getElementById('bulan');
    const tahunSelect = document.getElementById('tahun');
    const infoText = document.getElementById('infoText');
    
    // Function to toggle date fields based on report type
    function toggleDateFields() {
        const jenisLaporan = jenisLaporanSelect.value;
        
        if (jenisLaporan === 'tim_audit') {
            // Hide date fields for Tim Audit
            bulanField.style.display = 'none';
            tahunField.style.display = 'none';
            bulanRequired.style.display = 'none';
            tahunRequired.style.display = 'none';
            bulanSelect.removeAttribute('required');
            tahunSelect.removeAttribute('required');
            
            // Update info text
            infoText.textContent = 'Laporan Tim Audit akan menampilkan semua data tim audit yang tersedia tanpa filter periode.';
        } else {
            // Show date fields for other report types
            bulanField.style.display = 'block';
            tahunField.style.display = 'block';
            tahunRequired.style.display = 'inline';
            bulanRequired.style.display = 'none'; // Make bulan optional
            bulanSelect.removeAttribute('required');
            tahunSelect.setAttribute('required', 'required');
            
            // Update info text
            infoText.textContent = 'Pilih tahun (wajib) dan bulan (opsional). Jika hanya tahun yang dipilih, laporan akan menampilkan data untuk seluruh tahun tersebut. Laporan dapat diunduh dalam format PDF.';
        }
    }
    
    // Initial check
    toggleDateFields();
    
    // Listen for changes in report type
    jenisLaporanSelect.addEventListener('change', toggleDateFields);
    
    // Form submission with loading state and PDF generation
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalContent = submitBtn.innerHTML;
        const jenisLaporan = jenisLaporanSelect.value;
        const bulan = bulanSelect.value;
        const tahun = tahunSelect.value;
        
        // Validate form
        if (!jenisLaporan) {
            alert('Silakan pilih jenis laporan');
            return;
        }
        
        // For non-Tim Audit reports, validate year field (bulan is optional)
        if (jenisLaporan !== 'tim_audit') {
            if (!tahun) {
                alert('Silakan pilih tahun');
                return;
            }
        }
        
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <i class="fas fa-spinner fa-spin"></i>
            <span>Memproses...</span>
        `;
        
        // Use dedicated PDF routes for specific report types
        if (jenisLaporan === 'tim_audit') {
            const url = `{{ route('laporan.tim-audit.pdf') }}`;
            window.location.href = url;
        } else if (jenisLaporan === 'jadwal_audit') {
            let url = `{{ route('laporan.jadwal-audit.pdf') }}?tahun=${tahun}`;
            if (bulan) {
                url += `&bulan=${bulan}`;
            }
            window.location.href = url;
        } else if (jenisLaporan === 'pemeriksaan') {
            let url = `{{ route('laporan.pemeriksaan.pdf') }}?tahun=${tahun}`;
            if (bulan) {
                url += `&bulan=${bulan}`;
            }
            window.location.href = url;
        } else if (jenisLaporan === 'tindak_lanjut') {
            let url = `{{ route('laporan.tindak-lanjut.pdf') }}?tahun=${tahun}`;
            if (bulan) {
                url += `&bulan=${bulan}`;
            }
            window.location.href = url;
        } else {
            // For other report types, submit the form normally
            form.submit();
        }
        
        // Re-enable after a timeout (in case of errors)
        setTimeout(() => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalContent;
        }, 5000);
    });
});
</script>
@endsection
