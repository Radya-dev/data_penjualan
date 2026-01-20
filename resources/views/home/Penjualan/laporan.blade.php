<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan Bulanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
        }
        .summary p {
            font-weight: bold;
        }
        .print-button {
            margin-bottom: 20px;
        }
        @media print {
            .print-button {
                display: none;
            }
        }
    </style>
</head>
<body>

<h1>Laporan Penjualan Bulanan</h1>
<p>Perusahaan: Riseloka</p>
<p>Periode: April 2025</p>
<p>Tanggal Laporan: {{ \Carbon\Carbon::now()->format('d F Y') }}</p>


<table>
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Nama Produk</th>
        <th>Jumlah Terjual</th>
        <th>Harga Satuan</th>
        <th>Total Penjualan</th>
    </tr>
    @php
        $totalPenjualan = 0;
    @endphp
    @foreach($penjualans as $index => $penjualan)
    <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ \Carbon\Carbon::parse($penjualan->tanggal)->format('d-m-Y') }}</td>
        <td>{{ $penjualan->produk ? $penjualan->produk->merek->nama_merek : $penjualan->nama_produk }}</td>
        <td>{{ $penjualan->jumlah_pembelian }}</td>
        <td>Rp {{ number_format($penjualan->harga_satuan, 0, ',', '.') }}</td>
        <td>Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</td>
    </tr>
    @php
        $totalPenjualan += $penjualan->total_harga;
    @endphp
    @endforeach
</table>

<div class="summary">
    <p>Total Penjualan Bulanan: Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</p>
    <p>Biaya Operasional: Rp 5.000.000</p>
    <p>Laba Bersih: Rp {{ number_format($totalPenjualan - 5000000, 0, ',', '.') }}</p>
</div>
<div class="print-button">
    <button onclick="window.print()" style="padding: 6px 12px; font-size: 14px; cursor: pointer;">
        <i class="fas fa-print"></i> Print Laporan
    </button>
</div>

</body>
</html>
