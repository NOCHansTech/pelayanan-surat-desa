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
        <h3 style="margin-bottom: 5px;"><u>SURAT KETERANGAN DOMISILI</u></h3>
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
            <td width="35%">NIK</td>
            <td width="5%">:</td>
            <td>{{ $surat->resident->nik }}</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>{{ $surat->resident->nama_lengkap }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td>{{ $surat->resident->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
        </tr>
        <tr>
            <td>Tempat/Tgl. Lahir</td>
            <td>:</td>
            <td>{{ $surat->resident->tempat_lahir }},
                {{ \Carbon\Carbon::parse($surat->resident->tanggal_lahir)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td>Kewarganegaraan</td>
            <td>:</td>
            <td>{{ $surat->resident->kewarganegaraan }}</td>
        </tr>
        <tr>
            <td>Agama</td>
            <td>:</td>
            <td>{{ $surat->resident->agama }}</td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td>:</td>
            <td>{{ $surat->resident->pekerjaan }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $surat->resident->alamat }}</td>
        </tr>
        <tr>
            <td>Status</td>
            <td>:</td>
            <td>{{ $surat->resident->status_perkawinan }}</td>
        </tr>
    </table>

    <p>
        Nama di atas benar berdomisili di alamat tersebut, dan tercatat sebagai penduduk di wilayah
        Desa Karangmekar Kecamatan Cimanggu Kabupaten Sukabumi. Surat ini dibuat berdasarkan data
        kependudukan yang ada di desa kami dan dipergunakan untuk: {{ $surat->catatan }}
    </p>

    {{-- <p class="center" style="font-weight: bold; text-transform: uppercase;">
        {{ $surat->catatan }}
    </p> --}}

    <p>
        Demikian surat keterangan ini kami buat dengan sebenarnya agar dapat digunakan sebagaimana mestinya.
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
