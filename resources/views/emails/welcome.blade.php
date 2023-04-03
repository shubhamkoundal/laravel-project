@extends('layouts.app')
@section('content')

<!DOCTYPE html>
<html>
<head>
    <title>Welcome </title>
</head>
<body>
    <h1>Welcome, {{ $user->name }}!</h1>
    <p>Thank you for registering. We hope you enjoy using our service.</p>
    <a href="{{ url('login') }}" style="display: inline-block; background-color: #2196F3; color: #fff; padding: 10px; text-decoration: none;"> click here to Login Now</a>
</body>
</html>
@endsection
