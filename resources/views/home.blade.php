@extends('layouts.app')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="container">
    <h1>User Dashboard</h1>
    <p>Name: {{ Auth::user()->name }}</p>
    <p>Email: {{ Auth::user()->email }}</p>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 mt-5 wrapper">
            @foreach($data as $key => $value)
                <div class="card text-center">
                    <h4 class="card-header">{{ $key }}</h4>
                    <div class="card-body">
                        <p class="card-text">{{ $value }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
