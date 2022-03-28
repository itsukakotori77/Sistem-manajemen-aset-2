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
                <th class="td">Merek Aset</th>
                <th class="td">Ruangan</th>
                <th class="td">Tanggal Masuk</th>
                <th class="td">Umur Ekonomis</th>
                <th class="td">Harga Satuan</th>
                <th class="td">Jumlah Aset</th>
                <th class="td">Total Harga</th>
                <th class="td">Sumber</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['aset'] as $aset)
                <tr>
                    <td class="td"><p class="text-center">{{ $loop->iteration }}</p></td>
                    <td class="td"><p class="text-center">{{ $aset->Nama_Aset }}</p></td>
                    <td class="td"><p class="text-center">{{ $aset->Merek_Aset }}</p></td>
                    <td class="td"><p class="text-center">{{ $aset->Nama_Ruangan }}</p></td>
                    <td class="td"><p class="text-center">{{ date('d/m/Y', strtotime($aset->Tanggal_Masuk)) }}</p></td>
                    <td class="td"><p class="text-center">{{ $aset->Umur_Ergonomis }}</p></td>
                    <td class="td"><p class="text-center">{{ $aset->Harga_Aset }}</p></td>
                    <td class="td"><p class="text-center">{{ $aset->Jumlah_Aset }}</p></td>
                    <td class="td"><p class="text-center">{{ $aset->Total_Harga }}</p></td>
                    @if($aset->Sumber_Aset === 1)
                        <td class="td"><p class="text-center">Sekolah</p></td>
                    @else 
                        <td class="td"><p class="text-center">Pemerintah</p></td>
                    @endif 
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>