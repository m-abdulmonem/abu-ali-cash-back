@extends('admin.layouts.auth')

@section("content")
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">{{ trans("login.welcome") }}</p>
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route("login") }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="{{ trans("login.auth") }}" name="email" autofocus required value="{{ old("email") }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-at"></span>
                        </div>
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control @error('email') is-invalid @enderror" placeholder="{{ trans("login.password") }}" name="password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')--}}
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-8">
                        <label class="checkbox">
                            <input type="checkbox" {{ old('remember_me') == 'on' ? "checked" : "unchecked" }} name="remember">
                            <span><small>{{ trans("login.remember_me") }}</small></span>
                        </label>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">{{ trans("login.sign_in") }}</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <p class="mb-1">
                <a href="{{ route('password.request') }}">{{ trans("login.password_forget") }}</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
@endsection
