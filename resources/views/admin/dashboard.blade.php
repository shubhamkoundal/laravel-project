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

                    @else
                        <span class="text-muted">Already an Admin</span>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<a href="{{ route('download') }}" class="btn btn-success">Download as Excel</a>

@endsection