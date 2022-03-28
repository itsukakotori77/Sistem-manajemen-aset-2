<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Pengajuan Aset</title>
    <style>
        .text-center{
            text-align: center;
        }

        .pull-left{
            text-align: left;
        }
        .pull-right{
            text-align: right;
        }

        .table{
            border-collapse: collapse;
            width: 100%;
            border: 1px solid black;
            margin-top: 40px;
        }

        .table2{
            width: 100%;
        }

        .tr{
            border-collapse: collapse;
            border: 1px solid black;
        }

        .th{
            border-collapse: collapse;
            border: 1px solid black;
        }

        .td{
            border-collapse: collapse;
            border: 1px solid black;
        }
        .p{
            margin-top: 50px;
            text-align: justify;
        }

    </style>
</head>
<body>
    <!-- Kop Surat -->
    <header>
        <img src="{{ public_path('assets/img/kop-surat.png') }}" style="width: 100%;">
    </header>
    
    <!-- Table -->
    <table class="table">
        <thead>
            <tr class="tr">
                <th class="td">Nomor</th>
                <th class="td">Nama Aset</th>
                <th class="td">Kerusakan</th>
                <th class="td">Faktor</th>
                <th class="td">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['pemeliharaan'] as $pemeliharaan)
                <tr>
                    <td class="td"><p class="text-center">{{ $loop->iteration }}</p></td>
                    <td class="td"><p class="text-center">{{ $pemeliharaan->Nama_Aset }}</p></td>
                    <td class="td"><p class="text-center">{{ $pemeliharaan->Kerusakan }}</p></td>
                    <td class="td"><p class="text-center">{{ $pemeliharaan->Faktor }}</p></td>
                    <td class="td"><p class="text-center">{{ $pemeliharaan->Jumlah }}</p></td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>