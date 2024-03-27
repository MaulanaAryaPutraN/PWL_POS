@extends('layouts.app')
{{-- Customize layout sections --}}
@section('subtitle', 'Kategori')
@section('content_header_title', 'User')
@section('content_header_subtitle', 'Create')
{{-- Content body: main page content --}}
@section('content')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <div class="card-title">Buat User baru</div>
            </div>

            <form action="../user" method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label for="level_kode">Username</label>
                        <input type="text" id="username" name="username"
                               class="form-control @error('username') is-invalid @enderror">

                        @error('username')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                        
                    </div>
                    <div class="form-group">
                        <label for="level_nama">Password</label>
                        <input type="text" name="password" id="password" 
                        class="form-control @error('password') is-invalid @enderror">

                        @error('password')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="level_nama">Nama</label>
                        <input type="text" name="nama" id="nama" 
                        class="form-control @error('nama') is-invalid @enderror">
    
                        @error('nama')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="level_nama">Level ID</label>
                        <input type="text" name="level_id" id="level_id" 
                        class="form-control @error('level_id') is-invalid @enderror">
    
                        @error('level_id')
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