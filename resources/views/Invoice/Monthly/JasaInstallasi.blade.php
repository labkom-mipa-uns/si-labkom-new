<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jasa Installasi - Invoice - Monthly</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body{
            font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            color:#333;
            text-align:left;
            font-size:18px;
            margin:0;
        }
        .container{
            margin: 40px;
            width:75%;
            height:auto;
            background-color:#fff;
        }
        caption{
            font-size:28px;
            margin-bottom:15px;
        }
        table{
            border:1px solid #333;
            border-collapse:collapse;
            margin:0 auto;
            width:740px;
        }
        td, tr, th{
            padding:12px;
            border:1px solid #333;
            width:160px;
        }
        th{
            background-color: #f0f0f0;
        }
        h4, p{
            margin: 0;
        }
    </style>
</head>
<body>
<div class="container">
    <table>
        <caption>
            Jasa Installasi - Monthly Report | Bulan ke-{{ $bulan }}
        </caption>
        <thead>
        <tr>
            <th>Tanggal</th>
            <th>Nama Software</th>
            <th>Harga per satuan</th>
            <th>Qty</th>
            <th>Total Bayar</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $total_semua = 0 ?>
        @foreach($Transaksi as $elemen)
            <tr>
                <td>{{ $elemen->tanggal }}</td>
                <td>{{ $elemen->jasainstallasi->software->nama_software }}</td>
                <td>Rp.{{ number_format($elemen->jasainstallasi->software->harga_software) }}</td>
                <td>{{ $elemen->jumlah }}</td>
                <td>Rp.{{ number_format($elemen->total_bayar) }}</td>
            </tr>
            <?php /** @var $elemen */
            $total_semua += (int)$elemen->total_bayar ?>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th colspan="4">Total</th>
            <td>Rp.<?= number_format($total_semua) ?></td>
        </tr>
        </tfoot>
    </table>
</div>
</body>
</html>
