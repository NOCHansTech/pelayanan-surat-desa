<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.4;
        }

        .center {
            text-align: center;
        }

        .logo {
            width: 80px;
            display: block;
            margin: 0 auto 10px;
        }

        .kop {
            text-align: center;
            font-size: 14pt;
            font-weight: bold;
        }

        hr {
            border: 1px solid black;
            margin: 5px 0 15px;
        }

        .table-data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table-data td {
            vertical-align: top;
            padding: 2px 0;
        }
    </style>
</head>

<body>

    <div class="center">
        <img src="{{ public_path('assets/images/garuda.png') }}" alt="Logo Garuda" class="logo">
    </div>

    <div class="kop">
        KEPALA DESA KARANGMEKAR<br>
        KECAMATAN CIMANGGU KABUPATEN SUKABUMI<br>
        PROVINSI JAWA BARAT
    </div>

    <hr>

    <div class="center">
        <h3 style="margin-bottom: 5px;"><u>SURAT KETERANGAN DOMISILI LEMBAGA</u></h3>
        @php
            $bulanRomawi = [
                1 => 'I',
                2 => 'II',
                3 => 'III',
                4 => 'IV',
                5 => 'V',
                6 => 'VI',
                7 => 'VII',
                8 => 'VIII',
                9 => 'IX',
                10 => 'X',
                11 => 'XI',
                12 => 'XII',
            ];
            $bulan = \Carbon\Carbon::parse($surat->tanggal_pengajuan)->format('n');
            $tahun = \Carbon\Carbon::parse($surat->tanggal_pengajuan)->format('Y');
        @endphp
        <p style="margin-top: 0;">
            Nomor: 470 / {{ $surat->nomor_surat }} / 2004 / {{ $bulanRomawi[$bulan] }} / {{ $tahun }}
        </p>
    </div>

    <p>
        Yang bertandatangan di bawah ini Kepala Desa Karangmekar Kecamatan Cimanggu Kabupaten Sukabumi,
        dengan ini menerangkan bahwa:
    </p>

    <table class="table-data">
        <tr>
            <td width="35%">Nama Lembaga</td>
            <td width="5%">:</td>
            <td>{{ $surat->resident->nama_lengkap }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $surat->resident->alamat }}</td>
        </tr>

        <tr>
            <td>Bidang Kegiatan</td>
            <td>:</td>
            <td>{{ $surat->catatan }}</td>
        </tr>
    </table>

    <p>
        Lembaga tersebut di atas benar berdomisili di wilayah Desa Karangmekar Kecamatan Cimanggu
        Kabupaten Sukabumi, dan keberadaannya diketahui oleh pemerintah desa.
    </p>

    <p>
        Surat keterangan ini dibuat sebagai bukti domisili lembaga yang bersangkutan untuk keperluan administrasi dan
        kelengkapan berkas lainnya.
    </p>

    <br>
    <table width="100%">
        <tr>
            <td width="50%"></td>
            <td class="center">
                Karangmekar, {{ \Carbon\Carbon::parse($surat->tanggal_pengajuan)->translatedFormat('d F Y') }}<br>
                Kepala Desa Karangmekar<br><br><br><br>
                <u><strong>SARIP HIDAYAT</strong></u>
            </td>
        </tr>
    </table>

    <br><br>
    <hr>
    <div class="center" style="font-size: 10pt;">
        Jalan Batununggul No. 01 KM 02 | Email: desaKarangmekar@yahoo.com | Kode Pos 43388 – Sukabumi
    </div>

</body>

</html>
