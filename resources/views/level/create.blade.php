@extends('layouts.app')
{{-- Customize layout sections --}}
@section('subtitle', 'Kategori')
@section('content_header_title', 'Level')
@section('content_header_subtitle', 'Create')
{{-- Content body: main page content --}}
@section('content')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <div class="card-title">Buat Level baru</div>
            </div>

            <form action="../level" method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label for="level_kode">Kode Level</label>
                        <input type="text" id="level_kode" name="level_kode"
                               class="form-control @error('level_kode') is-invalid @enderror">

                        @error('level_kode')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                        
                    </div>
                    <div class="form-group">
                        <label for="level_nama">Nama Level</label>
                        <input type="text" name="level_nama" id="level_nama" 
                        class="form-control @error('level_nama') is-invalid @enderror">

                        @error('level_nama')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                
            </form>
        </div>
    </div>
@endsection