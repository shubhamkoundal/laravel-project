@extends('layouts.app')

@section('content')

@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif

<h1>Admin Dashboard</h1>
 Admin Name: {{Auth::user()->name}}
<br>
 Admin E-mail: {{Auth::user()->email}}
<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Created At</th>
            <th>Is Admin</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
    <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->created_at->format('Y-m-d') }}</td>
        <td>{{ $user->is_admin ? 'Yes' : 'No' }}</td>
        <td>
            @if (!$user->is_admin)
                <form method="POST" action="{{ route('make-admin', $user->id) }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">Make Admin</button>
                </form>
                <form method="POST" action="{{ route('delete-user', $user->id) }}" class="d-inline">
                   @csrf
                   @method('DELETE')
                  <a href="#" class="btn btn-danger" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this user?')) { this.parentNode.submit(); }">Delete User</a>
                </form>
                

            @else
                <span class="text-muted">Already an Admin</span>
            @endif
        </td>
    </tr>
@endforeach

    </tbody>
</table>
{{ $users->links() }}
<a href="{{ route('download') }}" class="btn btn-success">Download as Excel</a>
<a href="{{ route('admin.export-pdf') }}" class="btn btn-success">Export to PDF</a>



@endsection