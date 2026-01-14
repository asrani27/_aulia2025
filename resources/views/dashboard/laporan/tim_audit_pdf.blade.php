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

        .nama-tim-column {
            width: 25%;
        }

        .bidang-column {
            width: 20%;
        }

        .anggota-column {
            width: 50%;
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
        LAPORAN KEGIATAN AUDIT INSPEKTORAT DAERAH
    </div>

    <!-- Data Table -->
    <div class="table-container">
        @if(isset($timAudits) && $timAudits->count() > 0)
        <table>
            <thead>
                <tr>
                    <th class="no-column">No</th>
                    <th class="nama-tim-column">Nama Kegiatan</th>
                    <th class="bidang-column">Bidang</th>
                    <th class="anggota-column">Anggota Tim</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach($timAudits as $timAudit)
                <tr>
                    <td class="no-column">{{ $no++ }}</td>
                    <td>{{ $timAudit->nama_tim }}</td>
                    <td>{{ $timAudit->bidang }}</td>
                    <td>
                        @if($timAudit->anggota && $timAudit->anggota->count() > 0)
                        <ul class="anggota-list">
                            @foreach($timAudit->anggota as $anggota)
                            <li>{{ $anggota->nama }}</li>
                            @endforeach
                        </ul>
                        @else
                        <em>Belum ada anggota tim</em>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="no-data">
            Tidak ada data tim audit untuk periode yang dipilih.
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