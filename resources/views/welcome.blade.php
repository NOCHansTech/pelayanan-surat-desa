<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>
        Sistem Pelayanan Surat Online
    </title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .hero-section {
            position: relative;
            background-image: url('assets/images/bg-index.png');
            background-size: cover;
            background-position: center;
            text-align: center;
            padding: 5rem 2rem;
            margin-top: 100px;
            color: white;
            z-index: 1;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -10;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            /* Ubah angka terakhir untuk mengatur gelap */
            filter: blur(5px);
            /* Atur tingkat blur */
            z-index: -1;
        }

        .hero-section * {
            position: relative;
            z-index: 2;
        }


        .hero-section h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .hero-section p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 500;
            border-radius: 50px;
        }

        .btn-outline-primary {
            border: 2px solid #007bff;
            color: #007bff;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 500;
            border-radius: 50px;
        }
    </style>

</head>

<body class="hero-section">

    <section>
        <h1>
            Sistem Pelayanan Surat Online
        </h1>
        <p>
            KEPALA DESA KARANGMEKAR<br>
            KECAMATAN CIMANGGU KABUPATEN SUKABUMI<br>
            PROVINSI JAWA BARAT
        </p>
        <div>
            <a class="btn btn-primary" href="{{ route('login') }}">
                Masuk
            </a>
            <a class="btn btn-primary" href="{{ route('register') }}">
                Daftar
            </a>

        </div>
    </section>

    <script>
        script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    </script>

</body>

</html>
