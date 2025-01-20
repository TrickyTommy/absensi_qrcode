<!DOCTYPE html>
<html>
<head>
    <title>Kartu Pelajar</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 20px;
        }

        .card {
            width: 380px;
            padding: 25px;
            background: white;
            border-radius: 15px;
            margin: 20px auto;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 8px;
            background: linear-gradient(90deg, #2563eb, #3b82f6);
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f1f5f9;
        }

        .header h2 {
            margin: 0;
            color: #1e293b;
            font-size: 24px;
            font-weight: 700;
        }

        .header h3 {
            margin: 5px 0 0;
            color: #64748b;
            font-size: 16px;
            font-weight: 500;
        }

        .student-info {
            margin-bottom: 25px;
            padding: 15px;
            background: #f8fafc;
            border-radius: 10px;
        }

        .info-row {
            margin: 12px 0;
            display: flex;
            align-items: center;
        }

        .info-row strong {
            width: 100px;
            color: #475569;
            font-size: 14px;
        }

        .info-row span {
            color: #0f172a;
            font-size: 14px;
            font-weight: 500;
        }

        .qr-code {
            text-align: center;
            padding: 15px;
            background: white;
            border-radius: 10px;
            margin-top: 20px;
        }

        .qr-code svg {
            max-width: 200px;
            height: auto;
        }

        .school-logo {
            width: 60px;
            height: 60px;
            margin-bottom: 10px;
        }

        .validity {
            text-align: center;
            margin-top: 15px;
            font-size: 12px;
            color: #64748b;
        }

        .no-print {
            margin-top: 30px;
        }

        .no-print button {
            background: #2563eb;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .no-print button:hover {
            background: #1d4ed8;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }
            .card {
                box-shadow: none;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="header">
            <!-- Add your school logo here -->
            <!-- <img src="/path/to/logo.png" alt="School Logo" class="school-logo"> -->
            <h2>KARTU PELAJAR</h2>
            <h3>SMK EXAMPLE</h3>
        </div>

        <div class="student-info">
            <div class="info-row">
                <strong>NIS:</strong>
                <span>{{ $siswa->nis }}</span>
            </div>
            <div class="info-row">
                <strong>Nama:</strong>
                <span>{{ $siswa->nama }}</span>
            </div>
            <div class="info-row">
                <strong>Kelas:</strong>
                <span>{{ $siswa->kelas }}</span>
            </div>
            <div class="info-row">
                <strong>Jurusan:</strong>
                <span>
                    @switch($siswa->jurusan)
                        @case('RPL')
                            Rekayasa Perangkat Lunak
                            @break
                        @case('TKJ')
                            Teknik Komputer dan Jaringan
                            @break
                        @case('AKT')
                            Akuntansi
                            @break
                    @endswitch
                </span>
            </div>
        </div>

        <div class="qr-code">
            {!! $qrCode !!}
        </div>

        <div class="validity">
            Kartu ini berlaku selama yang bersangkutan menjadi siswa<br>
            SMK EXAMPLE
        </div>
    </div>

    <div class="no-print" style="text-align: center;">
        <button onclick="window.print()">Print Kartu</button>
    </div>
</body>
</html>
