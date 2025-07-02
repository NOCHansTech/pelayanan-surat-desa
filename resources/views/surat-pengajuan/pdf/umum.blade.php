<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'Times New Roman', serif;
            font-size: 12pt;
            line-height: 1.5;
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
            margin: 5px 0 20px;
        }

        table {
            width: 100%;
            margin-top: 10px;
        }

        td {
            padding: 3px 0;
            vertical-align: top;
        }
    </style>
</head>

<body>
    <div class="center">
        <img src="{{ public_path('assets/images/garuda.png') }}" class="logo">
    </div>
    <div class="kop">
        PEMERINTAH DESA KARANGMEKAR<br>
        KECAMATAN CIMANGGU KABUPATEN SUKABUMI
    </div>
    <hr>

    <div class="center">
        <h3 style="margin-bottom: 0;"><u>SURAT KETERANGAN</u></h3>
        <p style="margin-top: 5px;">
            Nomor: 470 / {{ $surat->nomor_surat }} / 2004 / {{ $bulanRomawi[$bulan] }} / {{ $tahun }}
        </p>
    </div>

    <p>
        Yang bertanda tangan di bawah ini, Kepala Desa Karangmekar Kecamatan Cimanggu Kabupaten Sukabumi
        menerangkan bahwa:
    </p>

    <table>
        <tr>
            <td width="35%">Nama Lengkap</td>
            <td>: {{ $surat->resident->nama_lengkap }}</td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>: {{ $surat->resident->nik }}</td>
        </tr>
        <tr>
            <td>Tempat, Tanggal Lahir</td>
            <td>: {{ $surat->resident->tempat_lahir }},
                {{ \Carbon\Carbon::parse($surat->resident->tanggal_lahir)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>: {{ $surat->resident->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: {{ $surat->resident->alamat }}</td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td>: {{ $surat->resident->pekerjaan }}</td>
        </tr>
    </table>

    <p>
        Berdasarkan data yang ada dan pengajuan yang bersangkutan, surat ini diberikan untuk keperluan:
    </p>

    <blockquote>
        <strong>{{ $surat->jenisSurat->nama }}</strong><br>
        <em>{{ $surat->jenisSurat->deskripsi }}</em>
    </blockquote>

    @if ($surat->catatan)
        <p>Keterangan tambahan:</p>
        <ul>
            @foreach (preg_split('/\r\n|\r|\n/', $surat->catatan) as $item)
                <li>{{ preg_replace('/^\d+\.\s*/', '', $item) }}</li>
            @endforeach
        </ul>
    @endif

    <p>
        Demikian surat keterangan ini dibuat untuk digunakan sebagaimana mestinya.
    </p>

    <br><br>
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
</body>

</html>
