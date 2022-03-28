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
                <th class="td">Nama Pengajuan</th>
                <th class="td">Nama Perencanaan</th>
                <th class="td">Tanggal Pengajuan</th>
                <th class="td">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['pengajuan'] as $pengajuan)
                <tr>
                    <td class="td"><p class="text-center">{{ $loop->iteration }}</p></td>
                    <td class="td"><p class="text-center">{{ $pengajuan->Nama_Pengajuan }}</p></td>
                    <td class="td">
                        @foreach($pengajuan->perencanaan as $perencanaan)
                            <ul>
                                <li>{{ $perencanaan->Nama_Pengaju }}</li>
                            </ul>
                        @endforeach
                    </td>
                    <td class="td"><p class="text-center">{{ date('d/m/Y', strtotime($pengajuan->Tanggal_Pengajuan)) }}</p></td>
                    @if($pengajuan->Status === 1)
                        <td class="td"><p class="text-center">Belum Diajukan</p></td>
                    @elseif($pengajuan->Status === 2)
                        <td class="td"><p class="text-center">Sedang Diajukan</p></td>
                    @elseif($pengajuan->Status === 3)
                        <td class="td"><p class="text-center">Disetujui</p></td>
                    @elseif($pengajuan->Status === 4)
                        <td class="td"><p class="text-center">Tidak Disetujui</p></td>
                    @else 
                        <td class="td"><p class="text-center">Selesai Ditambahkan</p></td>
                    @endif

                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>