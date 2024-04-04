@extends('layouts.template')
@section('content')
<div class="card card-outline card-primary">
<div class="card-header">
<h3 class="card-title">{{ $page->title }}</h3>
<div class="card-tools">
<a class="btn btn-sm btn-primary mt-1" href="{{ url('transaksi/create')}}">Tambah</a>
</div>
</div>
<div class="card-body">
@if (session('success'))
    <div class="alert alert-success">{{session('success')}}</div>
@endif
@if (session('error'))
    <div class="alert alert-danger">{{session('error')}}</div>   
@endif
<div class="row">
    <div class="col-md-12">
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Filter: </label>
                        <div class="col-3">
                            <select class="form-control" id="barang_id" name="barang_id" required>
                            <option value="">- Semua -</option>
                            @foreach($barang as $item)
                            <option value="{{ $item->barang_id }}">{{ $item->barang_nama }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Nama Barang</small>
                    </div>
                </div>
            </div>
        </div>
<table class="table table-bordered table-striped table-hover table-sm" id="table_penjualan_detail">
<thead>
<tr><th>ID</th><th>Nama User</th><th>Pembeli</th><th>Nama Barang</th><th>Penjualan Kode</th><th>Penjualan Tanggal</th><th>Harga</th>
<th>Jumlah</th><th>Aksi</th></tr>
</thead>
</table>
</div>
</div>
@endsection
@push('css')
@endpush
@push('js')
<script>
$(document).ready(function() {
var dataPenjualanDetail = $('#table_penjualan_detail').DataTable({
serverSide: true, // serverSide: true, jika ingin menggunakan server side processing
ajax: {
"url": "{{ url('transaksi/list') }}",
"dataType": "json",
"type": "POST",
"data": function(d){
    d.barang_id = $('#barang_id').val();
}
},
columns: [
{
data: "DT_RowIndex", // nomor urut dari laravel datatable addIndexColumn() 
className: "text-center",
orderable: false,
searchable: false
},{
data: "penjualan.user.nama",
className: "",
orderable: false, // orderable: true, jika ingin kolom ini bisa diurutkan
searchable: true // searchable: true, jika ingin kolom ini bisa dicari
},{
data: "penjualan.pembeli",
className: "",
orderable: false, // orderable: true, jika ingin kolom ini bisa diurutkan
searchable: true // searchable: true, jika ingin kolom ini bisa dicari
},{
data: "barang.barang_nama",
className: "",
orderable: false, // orderable: true, jika ingin kolom ini bisa diurutkan
searchable: true // searchable: true, jika ingin kolom ini bisa dicari
},{
data: "penjualan.penjualan_kode",
className: "",
orderable: false, // orderable: true, jika ingin kolom ini bisa diurutkan
searchable: true // searchable: true, jika ingin kolom ini bisa dicari
},{
data: "penjualan.penjualan_tanggal",
className: "",
orderable: false, // orderable: true, jika ingin kolom ini bisa diurutkan
searchable: true // searchable: true, jika ingin kolom ini bisa dicari
},{
data: "harga",
className: "",
orderable: true, // orderable: true, jika ingin kolom ini bisa diurutkan
searchable: true // searchable: true, jika ingin kolom ini bisa dicari
},{
data: "jumlah",
className: "",
orderable: true, // orderable: true, jika ingin kolom ini bisa diurutkan
searchable: true // searchable: true, jika ingin kolom ini bisa dicari
},{
data: "aksi",
className: "",
orderable: false, // orderable: true, jika ingin kolom ini bisa diurutkan
searchable: false // searchable: true, jika ingin kolom ini bisa dicari
}
]
});
$('#barang_id').on('change',function(){
    dataPenjualanDetail.ajax.reload();
});
});
</script>
@endpush 