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

                    <form id="register-form" method="POST" action="/register" enctype="multipart/form-data">
                        @csrf
                        @method('post')

                        <div class="form-group">
                            <input type="name" name="name" class="form-control" placeholder="Name"/>

                            @if($errors->has('name'))
                                <p class="text-danger">{{ $errors->first('name') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Email"/>

                            @if($errors->has('email'))
                                <p class="text-danger">{{ $errors->first('email') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password"/>

                            @if($errors->has('password'))
                                <p class="text-danger">{{ $errors->first('password') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password"/>

                            @if($errors->has('Confirm password'))
                                <p class="text-danger">{{ $errors->first('Confirm password') }}</p>
                            @endif
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_admin" id="is_admin">
                                    <label class="form-check-label" for="is_admin">
                                        {{ __('Register as admin') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                          <label for="avatar">Avatar Image</label>
                          <input id="avatar" type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar" accept="image/*">
                           @error('avatar')
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(function() {
        $('#register-form').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            $.ajax({
                type: 'POST',
                url: url,
                data: form.serialize(),
                success: function(data) {
                    if (data.success) {
                        window.location.href = "{{ route('login') }}";
                    } else {
                        alert('Registration failed.');
                    }
                },
                error: function(xhr, status, error) {
                    alert('Registration failed. Error: ' + xhr.responseText);
                }
            });
        });
    });
</script>

@endsection
    