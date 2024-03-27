@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">CRUD User</div>

                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="mb-4">
                        <a class="btn btn-success" href="{{ route('m_user.create') }}">Input User</a>
                    </div>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">User ID</th>
                                <th  class="text-center">Level ID</th>
                                <th  class="text-center">Level Name</th>
                                <th  class="text-center">Username</th>
                                <th  class="text-center">Nama</th>
                                <th  class="text-center">Password</th>
                                <th  class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($useri as $m_user)
                                <tr>
                                    <td>{{ $m_user->user_id }}</td>
                                    <td>{{ $m_user->level_id }}</td>
                                    <td>{{ $m_user->level->level_nama }}</td>
                                    <td>{{ $m_user->username }}</td>
                                    <td>{{ $m_user->nama }}</td>
                                    <td>{{ substr($m_user->password, 0, 10) }}</td>
                                    <td class="text-center">
                                        <div class="row">
                                            <form action="{{ route('m_user.destroy', $m_user->user_id) }}" method="POST">
                                                <a class="btn btn-info btn-sm mx-1" href="{{ route('m_user.show', $m_user->user_id) }}">Show</a>
                                                <a class="btn btn-primary btn-sm mx-1" href="{{ route('m_user.edit', $m_user->user_id) }}">Edit</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm mx-1" onclick="return confirm('Are you sure you want to delete this data?')">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection