<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Tidak Mampu</title>
    <style>
        @page {
            size: 215mm 330mm; /* F4 size */
            margin: 20mm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12pt;
            margin: 0;
            padding: 0;
            background-color: white;
        }

        .container {
            width: 100%;
            box-sizing: border-box;
        }

        .kop-surat {
            text-align: center;
            border-bottom: 2px solid #000;
            margin-bottom: 10px;
        }

        .kop-surat img {
            width: 80px;
            margin-top: -20px;
            margin-bottom: 5px;
        }

        .kop-surat h1 {
            font-size: 16pt;
            margin: 0;
            text-transform: uppercase;
        }

        .kop-surat p {
            margin: 2px 0;
            font-size: 11pt;
        }

        .judul {
            text-align: center;
            margin: 15px 0;
        }

        .judul h2 {
            font-size: 14pt;
            margin: 0;
            text-decoration: underline;
        }

        .judul p {
            margin: 0;
            font-size: 11pt;
        }

        .content {
            margin-top: 15px;
        }

        .content p {
            text-indent: 30px;
            text-align: justify;
            margin-bottom: 10px;
        }

        table.data-table {
            width: 100%;
            margin-top: 10px;
        }

        .data-table td {
            padding: 4px;
            vertical-align: top;
        }

        .data-table td:first-child {
            width: 180px;
        }

        .data-table td:nth-child(2) {
            width: 10px;
        }

        table.reason-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .reason-table th, .reason-table td {
            border: 1px solid #000;
            padding: 6px;
            font-size: 11pt;
        }

        .reason-table th {
            text-align: center;
            background-color: #f0f0f0;
        }

        .reason-table td:last-child {
            text-align: left;
        }

        .signature {
            margin-top: 40px;
            width: 100%;
        }

        .signature td {
            text-align: center;
            vertical-align: top;
            padding-top: 40px;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 10pt;
            color: #555;
        }

        @media print {
            body {
                margin: 0;
            }
            @page {
                size: 215mm 330mm;
                margin: 20mm;
            }
        }
    </style>
</head>
<body onload="window.print()">
    @php
        $bulanRomawi = [1=>'I',2=>'II',3=>'III',4=>'IV',5=>'V',6=>'VI',7=>'VII',8=>'VIII',9=>'IX',10=>'X',11=>'XI',12=>'XII'];
        $bulan = \Carbon\Carbon::parse($surat->tanggal_pengajuan)->format('n');
        $tahun = \Carbon\Carbon::parse($surat->tanggal_pengajuan)->format('Y');
        $catatanList = preg_split('/\r\n|\r|\n/', $surat->catatan);
    @endphp

    <div class="container">
        <div class="kop-surat">
            <img src="{{ public_path('assets/images/garuda.png') }}" alt="Logo Garuda">
            <h1>PEMERINTAH DESA KARANGMEKAR</h1>
            <p>KECAMATAN CIMANGGU, KABUPATEN SUKABUMI</p>
            <p>Jl. Raya Batununggul No.001 KM 02 – Kode Pos 43178</p>
            <p>Email: desakarangmekar@yahoo.com</p>
        </div>

        <div class="judul">
            <h2>SURAT KETERANGAN TIDAK MAMPU (SKTM)</h2>
            <p>Nomor: 400 / {{ $surat->nomor_surat }} / 2004 / {{ $bulanRomawi[$bulan] }} / {{ $tahun }}</p>
        </div>

        <div class="content">
            <p>Yang bertanda tangan di bawah ini, Kepala Desa Karangmekar Kecamatan Cimanggu Kabupaten Sukabumi, dengan ini menerangkan bahwa:</p>

            <table class="data-table">
                <tr><td>Nama</td><td>:</td><td><strong>{{ $surat->resident->nama_lengkap }}</strong></td></tr>
                <tr><td>Tempat/Tgl Lahir</td><td>:</td><td>{{ $surat->resident->tempat_lahir }}, {{ \Carbon\Carbon::parse($surat->resident->tanggal_lahir)->translatedFormat('d F Y') }}</td></tr>
                <tr><td>Jenis Kelamin</td><td>:</td><td>{{ $surat->resident->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td></tr>
                <tr><td>Alamat</td><td>:</td><td>{{ $surat->resident->alamat }}</td></tr>
                <tr><td>Nama Orang Tua</td><td>:</td><td>{{ $surat->resident->nama_ayah }}</td></tr>
                <tr><td>Agama</td><td>:</td><td>{{ $surat->resident->agama }}</td></tr>
                <tr><td>Pekerjaan</td><td>:</td><td>{{ $surat->resident->pekerjaan }}</td></tr>
            </table>

            <p>Adalah benar salah satu warga Desa kami yang tergolong keluarga tidak mampu/miskin (Pra-KS).</p>

            <p>Alasan tidak mampu:</p>
                <table class="reason-table">
                    <tr>
                        <th style="width: 40px; text-align: center;">No</th>
                        <th>Alasan</th>
                    </tr>
                    @php
                        $i = 0; // Inisialisasi variabel i
                    @endphp
                    @foreach ($catatanList as $alasan)
                        @php
                            $i++; // Increment i untuk nomor urut
                        @endphp
                        @if ($alasan !== '')
                            <tr>
                                <td style="text-align: center;">{{ $i }}</td>
                                <td>{{ $alasan }}</td>
                            </tr>
                        @endif
                    @endforeach
                </table>

            <p>Demikian surat ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>

            <table class="signature">
                <tr>
                    <td style="width: 50%;"></td>
                    <td>
                        Karangmekar, {{ \Carbon\Carbon::parse($surat->tanggal_pengajuan)->translatedFormat('d F Y') }}<br>
                        Kepala Desa Karangmekar<br><br><br><br>
                        <strong><u>SARIP HIDAYAT</u></strong>
                    </td>
                </tr>
            </table>

            <div class="footer">
                Jl. Raya Batununggul No.001 KM 02 – Karangmekar – Cimanggu – Sukabumi – Jawa Barat<br>
                Email: desakarangmekar@yahoo.com
            </div>
        </div>
    </div>
</body>
</html>
