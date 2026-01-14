<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Tim Audit Inspektorat Daerah</title>
    <style>
        @page {
            size: 40cm 25cm;
            margin: 1cm;
        }


        body {
            font-family: 'Times New Roman', serif;
            font-size: 12px;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
            position: relative;
        }

        .logo-container {
            position: absolute;
            left: 0;
            top: 0;
            width: 80px;
            height: 120px;
        }

        .logo-container img {
            width: 100%;
            height: auto;
            max-height: 120px;
        }

        .header-content {
            margin-left: 100px;
        }

        .header h1 {
            font-size: 18px;
            font-weight: bold;
            margin: 5px 0;
            text-transform: uppercase;
        }

        .header h2 {
            font-size: 18px;
            font-weight: bold;
            margin: 5px 0;
            text-transform: uppercase;
        }

        .header p {
            font-size: 12px;
            margin: 3px 0;
        }

        .divider {
            border-top: 2px solid #000;
            padding: 0px 0;
            margin: 0px 0;
        }

        .title {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            margin: 20px 0;
            text-transform: uppercase;
        }

        .table-container {
            margin: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
        }

        .no-column {
            width: 5%;
            text-align: center;
        }

        .id-jadwal-column {
            width: 10%;
            text-align: center;
        }

        .nama-instansi-column {
            width: 25%;
        }

        .alamat-column {
            width: 20%;
        }

        .id-tim-column {
            width: 10%;
            text-align: center;
        }

        .tanggal-column {
            width: 12%;
            text-align: center;
        }

        .status-column {
            width: 10%;
            text-align: center;
        }

        .keterangan-column {
            width: 13%;
        }

        .anggota-list {
            margin: 0;
            padding-left: 15px;
        }

        .anggota-list li {
            margin: 2px 0;
        }

        .footer {
            margin-top: 10px;
            text-align: right;
        }

        .signature {
            margin-top: 0px;
            text-align: left;
            width: 200px;
            float: right;
        }

        .signature p {
            margin: 0px 0;
            font-size: 14px;
        }

        .signature-line {
            border-bottom: 1px solid #000;
            height: 30px;
            margin: 10px 0;
        }

        .clear {
            clear: both;
        }

        .no-data {
            text-align: center;
            font-style: italic;
            padding: 20px;
        }
    </style>
</head>

<body>
    <!-- Header Institution Information -->
    <div class="header">
        <div class="logo-container">
            <img src="{{ public_path('logo/kalsel.png') }}" alt="Logo Kalimantan Selatan">
        </div>
        <div class="header-content">
            <h1>PEMERINTAH PROVINSI KALIMANTAN SELATAN</h1>
            <h2>INSPEKTORAT DAERAH</h2>
            <p>Jalan Palam, Kecamatan Cempaka, Kota Banjar Baru, Kalimantan Selatan, 70732</p>
            <p>Telp (0511) 6749235</p>
        </div>
    </div>

    <div class="divider"></div>

    <!-- Report Title -->
    <div class="title">
        LAPORAN PEMERIKSAAN AUDIT
    </div>

    <!-- Period Information -->
    <div style="text-align: center; margin-bottom: 20px;">
        @php
        $namaBulan = 'Bulan';
        if(isset($bulan)) {
        $months = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        $namaBulan = $months[$bulan] ?? 'Bulan';
        }
        @endphp
        Bulan : {{ $namaBulan }}, &emsp;&emsp;Tahun : {{ isset($tahun) ?
        $tahun : 'yyyy' }}
    </div>
    <!-- Data Table -->
    <div class="table-container">
        @if(isset($pemeriksaans) && $pemeriksaans->count() > 0)
        <table>
            <thead>
                <tr>
                    <th class="no-column">NO</th>
                    <th class="nama-instansi-column">INSTANSI</th>
                    <th class="tanggal-column">TANGGAL PEMERIKSAAN</th>
                    <th class="status-column">HASIL TEMUAN</th>
                    <th class="keterangan-column">KETERANGAN</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach($pemeriksaans as $pemeriksaan)
                <tr>
                    <td class="no-column">{{ $no++ }}</td>
                    <td class="nama-instansi-column">{{ $pemeriksaan->jadwalAudit->nama_instansi ?? '-' }}</td>
                    <td class="tanggal-column">{{ date('d-m-Y', strtotime($pemeriksaan->tanggal)) }}</td>
                    <td class="status-column">{{ $pemeriksaan->hasil_temuan ?? '-' }}</td>
                    <td class="keterangan-column">{{ $pemeriksaan->keterangan ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="no-data">
            Tidak ada data pemeriksaan untuk periode yang dipilih.
        </div>
        @endif
    </div>

    <!-- Footer with Date and Signature -->
    <div class="footer">
        <div class="signature">
            <p>Banjarbaru, {{ isset($tanggal) ? $tanggal : date('d-m-Y') }}</p>
            <p>Kepala Inspektorat Daerah</p>
            <p>Provinsi Kalimantan Selatan,</p>
            <br /><br /><br />
            <p><strong>(Nama Lengkap)</strong></p>
            <hr>
            <p>NIP. 999999999999</p>
        </div>
        <div class="clear"></div>
    </div>
</body>

</html>