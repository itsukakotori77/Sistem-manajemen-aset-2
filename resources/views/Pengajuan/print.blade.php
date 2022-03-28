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
    
    <!-- Yth -->
    <table style="margin-top: 20px;">
        <tr>
            <td>Yth.</td>
        </tr>
        <tr>
            <td>Kepala Sekolah</td>
        </tr>
        <tr>
            <td>SMAN 1 Darangdan</td>
        </tr>
        <tr>
            <td>Jl. Raya Sawit Bojong </td>
        </tr>
    </table>

    <p class="p">
        Dengan ini mengajukan permohonan pengajuan aset dengan nama pengajuan <strong>{{ $data['pengajuan']->Nama_Pengajuan }}</strong> 
        serta beberapa perencanaan yang dibuat dengan ketentuan berserta alasan sebagai berikut:
    </p> 
        
    
    <!-- Table -->
    <table class="table">
        <tr class="tr">
            <th class="td">Nomor</th>
            <th class="td">Nama Perencanaan</th>
            <th class="td">Pengaju</th>
            <th class="td">Nama Aset</th>
            <th class="td">Merek Aset</th>
            <th class="td">Jumlah</th>
            <th class="td">Harga Satuan</th>
            <th class="td">Harga Total</th>
        </tr>

        <!-- Loop -->
        <?php $total = 0; ?>
        @foreach($data['pengajuan']->perencanaan as $perencanaan)
            <tr class="tr">
                <td class="td">
                    <p class="text-center">{{ $loop->iteration }}</p>
                </td>
                <td class="td"><p class="text-center">{{ $perencanaan->Nama_Perencanaan }}</p></td>
                <td class="td"><p class="text-center">{{ $perencanaan->Nama_Pengaju }}</p></td>
                <td class="td"><p class="text-center">{{ $perencanaan->Nama_Aset }}</p></td>
                <td class="td"><p class="text-center">{{ $perencanaan->Merek_Aset }}</p></td>
                <td class="td">
                    <p class="text-center">{{ $perencanaan->Jumlah_Aset }}</p>
                </td>
                <td class="td">
                    <p class="text-center">{{ rupiah($perencanaan->Satuan_Harga) }}</p>
                </td>
                <td class="td">
                    <p class="text-center">{{ rupiah($perencanaan->Total_Harga) }}</p>
                </td>
            </tr>

            <!-- Variable -->
            <?php $total += $perencanaan->Total_Harga; ?>

        @endforeach
        <tr>
            <td colspan="6">&nbsp;</td>
            <td class="td">
                <p class="text-center">Total</p> 
            </td> 
            <td class="td">
                <p class="text-center">{{ rupiah($total) }}</p>
            </td>
        </tr>
    </table>


    <table width="100%" style="margin-top: 150px;">
        <thead>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <!-- TTD -->
            <tr>
                <td colspan="10">
                    <p class="pull-left">Hormat</p> 
                </td>
                <td colspan="10">
                    <div class="pull-left">
                        <img src="{{ public_path('assets/img/blank.png') }}" alt="" class="pull-right" style="width: 100px;">
                    </div>
                </td>
                <td colspan="3">
                    <p class="pull-right" style="margin-right: 10px;">Persetujuan</p>
                </td>
            </tr>
            
            <!-- TTD 2 -->
            <tr>
                <td colspan="10">
                    <p class="pull-left">TU Sarpras</p> 
                </td>
                <td colspan="10">
                    <img src="{{ public_path('assets/img/blank.png') }}" alt="" class="pull-right" style="width: 100px;">
                </td>
                <td colspan="3">
                    @if($data['pengajuan']->Status === 1 || $data['pengajuan']->Status === 2 || $data['pengajuan']->Status === 5)
                        <img src="{{ public_path('assets/img/blank.png') }}" alt="" class="pull-right" style="width: 100px; margin-left: 140px;">
                    @elseif($data['pengajuan']->Status === 3)
                        <img src="{{ public_path('assets/img/acc.png') }}" alt="" class="pull-right" style="width: 100px; margin-left: 140px;">
                    @elseif($data['pengajuan']->Status === 4)
                        <img src="{{ public_path('assets/img/rejected.png') }}" alt="" class="pull-right" style="width: 100px; margin-left: 140px;">
                    @endif
                    <p class="pull-right">Kepala Sekolah</p>
                </td>
            </tr>
        </tbody>
    </table>

</body>
</html>