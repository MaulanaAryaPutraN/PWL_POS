@extends('layouts.template')
@section('content')
<div class="card card-outline card-primary">
<div class="card-header">
<h3 class="card-title">{{ $page->title }}</h3>
<div class="card-tools"></div>
</div>
<div class="card-body">
@empty($penjualandetail)
<div class="alert alert-danger alert-dismissible">
<h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
Data yang Anda cari tidak ditemukan.
</div>
@else
<table class="table table-bordered table-striped table-hover tablesm">
<tr>
    <th>Nama User</th>
<td>{{ $penjualandetail->penjualan->user->nama }}</td>
</tr>
<tr>
<th>Pembeli</th>
<td>{{ $penjualandetail->penjualan->pembeli }}</td>
</tr>
<tr>
<th>Nama Baranag</th>
<td>{{ $penjualandetail->barang->barang_nama }}</td>
</tr>
<tr>
<th>Penjualan Kode</th>
<td>{{ $penjualandetail->penjualan->penjualan_kode }}</td>
</tr>
<tr>
<th>Penjualan Tanggal</th>
<td>{{ $penjualandetail->penjualan->penjualan_tanggal }}</td>
</tr>
<tr>
<th>harga</th>
<td>{{ $penjualandetail->harga }}</td>
</tr>
<tr>
<th>Jumlah</th>
<td>{{ $penjualandetail->jumlah }}</td>
</tr>
</table>
@endempty
<a href="{{ url('transaksi') }}" class="btn btn-sm btn-default mt2">Kembali</a>
</div>
</div>
@endsection
@push('css')
@endpush
@push('js')
@endpush