@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <div class="card from-holder">
                <div class="card-body">
                    <h1>Register</h1>

                    @if (Session::has('error'))
                        <p class="text-danger">{{ Session::get('error') }}</p>
                    @endif

                    <form action="{{ route('register') }}"  method="post">
                        @csrf
                        @method('post') 

                        <div class="form-group">  
                            <!-- <label>Name</label> -->
                            <input type="name" name="name" class="form-control" placeholder="Name"/>

                            @if($errors->has('name'))
                                <p class="text-danger">{{ $errors->first('name') }}</p>
                            @endif   
                        </div> 

                        <div class="form-group">  
                            <!-- <label>Email</label> -->
                            <input type="email" name="email" class="form-control" placeholder="Email"/>

                            @if($errors->has('email'))
                                <p class="text-danger">{{ $errors->first('email') }}</p>
                            @endif   
                        </div> 

                        <div class="form-group">  
                            <!-- <label>Password</label> -->
                            <input type="password" name="password" class="form-control" placeholder="Password"/>

                            @if($errors->has('password'))
                                <p class="text-danger">{{ $errors->first('password') }}</p>
                            @endif   
                        </div> 

                        <div class="form-group">  
                            <!-- <label>Confirm password</label> -->
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password"/>

                            @if($errors->has('Confirm password'))
                                <p class="text-danger">{{ $errors->first('Confirm password') }}</p>
                            @endif   
                        </div> 
                        <!-- <div class="form-group">  
                          <input type="file" name="avatar"/>
                            @if($errors->has('avatar'))
                              <p class="text-danger">{{ $errors->first('avatar') }}</p>
                            @endif   
                         </div>  -->

                        <div class="row">
                            <div class="col-8 text-left">
                                <a href="#" class="btn btn-link">Forgot password</a>
                            </div>
                            <div class="col-4 text-right">
                                <input type="submit" class="btn btn-primary" value="Register"/>
                            </div>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
