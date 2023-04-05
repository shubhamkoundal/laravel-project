@extends('layouts.app')
@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<h1> User Dashboard</h1>
 Name: {{Auth::user()->name}}
 <br>
E-mail {{Auth::user()->email}}

@endsection