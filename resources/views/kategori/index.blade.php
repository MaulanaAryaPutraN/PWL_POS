@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Welcome')
@section('content_header_title', 'Kategori')
@section('content_header_subtitle', 'Kategori')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Manage Kategori</div>
        <div class="card-body">
            {{$dataTable->table()}}
            <a href="{{url ('/kategori/create') }}">+ Tambah Kategori</a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{$dataTable->scripts()}}
@endpush
    
