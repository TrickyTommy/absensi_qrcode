<!DOCTYPE html>
<html>
<head>
    <title>Print Kartu Siswa</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background:rgb(245, 245, 245);
            margin: 0;
            padding: 20px;
        }

        .page {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            flex-wrap: wrap;
            justify-content: space-around;
            page-break-after: always;
        }

        .card {
            width: 5.5cm;
            height: 8.5cm;
            padding: 15px;
            background: aqua;
            border-radius: 15px;
            margin: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
            flex: 0 0 calc(33.333% - 20px);
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
            display: flex;
            margin-bottom: 5px;
            border-bottom: 2px solid #f1f5f9;
        }
        .header .tittle{
            padding:10px;
            margin-top:auto;
            margin-bottom:auto;
        }

        .header h2 {
            margin: 0;
            color: #1e293b;
            font-size: 15px;
            font-weight: bold;
        }

        .header h3 {
            margin-top: 0px;
            color: #64748b;
            font-size: 10px;
            font-weight: 200;
        }

        .header img{
            width: 50px;
        }

        .student-info {
            width: 100%;
            display: grid;
            grid-template-columns: 60% 40%;
            grid-template-columns: 2;
            background: #f8fafc;
        }

        .info-row {
            margin: 8px 0;

            align-items: center;
        }

        .info-row strong {
            width: 80px;
            color: #475569;
            font-size: 12px;
        }

        .info-row span {
            color: #0f172a;
            font-size: 10px;
            font-weight: 500;
            display: block;

        }
        .box{
            border: solid 2px black;
            width: 3cm;
            height: 2cm;
        }

        .qr{
            margin-top:0px;
            position: absolute;
            z-index: 1;
            width: 200px;
        }
        .qr-code {
            margin-top:40px;
            text-align: center;
            border-radius: 10px;
        }
    
        .qr-code svg {
            position: relative;
            z-index: 2;
            max-width: 100px;
            height: auto;
           
        }


        .validity {
            position: relative;
            z-index: 2;
            text-align: center;
            font-size: 10px;
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
                page-break-inside: avoid;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="page">
        @foreach ($students as $student)
            <div class="card">
                <div class="header">
                    <div class="logo">

                        <!-- Add your school logo here -->
                        <img src="{{ asset('images/logo_smk.png') }}" alt="School Logo" class="school-logo">
                    </div>
                    <div class="tittle">

                            
                            <h2>KARTU PELAJAR</h2>
                            <h3>SMK BUDI MULIA KARAWANG</h3>
                    </div>
                    
                </div>
                <div class="student-info">
                    <div class="photo">
                        <div class="box">

                        </div>
                    </div>

                    <div class="student">

                        <div class="info-row">
                            <span>{{ $student->nama }}</span>
                            <span>{{ $student->kelas }}</span>
                            <span>{{ $student->jurusan }}</span>
                        </div>
                        
                    </div>
                </div>
                
                <img class="qr" src="{{ asset('images/barcode_bg.png') }}" alt="">
                <div class="qr-code">
                    {!! $qrCodes[$student->id] !!}
                </div>
                <div class="validity">
                    Kartu ini berlaku selama yang bersangkutan menjadi siswa<br>
                    SMK BUDI MULIA KARAWANG
                </div>
            </div>
        @endforeach
    </div>
    <div class="no-print" style="text-align: center;">
        <button onclick="window.print()">Print Kartu</button>
    </div>
</body>
</html>

