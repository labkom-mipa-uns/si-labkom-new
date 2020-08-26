<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice - Peminjaman Alat</title>
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
            margin: 35px auto 0;
            padding:40px;
            width:750px;
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
            width:185px;
        }
        th{
            background-color: #f0f0f0;
        }
        h4, p{
            margin:0px;
        }
    </style>
</head>
<body>
<div class="container">
    <table>
        <caption>
            Invoice Peminjaman Alat
        </caption>
        <thead>
            <tr>
                <th>Nama Alat</th>
                <th>Harga per satuan</th>
                <th>Qty</th>
                <th>Total Bayar</th>
            </tr>
        </thead>
        <tbody>
        @foreach($Transaksi as $elemen)
            <tr>
                <td>{{ $elemen->peminjamanalat->alat->nama_alat }}</td>
                <td>{{ $elemen->peminjamanalat->alat->harga_alat }}</td>
                <td>{{ $elemen->jumlah }}</td>
                <td>{{ $elemen->total_bayar }}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th colspan="3">Total</th>
            <td>Rp </td>
        </tr>
        </tfoot>
    </table>
</div>
</body>
</html>
