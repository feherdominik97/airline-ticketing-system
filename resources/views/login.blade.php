@extends('layout')
@section('content')
    <div class="d-flex justify-content-center p-5">
        <form class="col-6" method="post" action="{{ route('login-airline-ticketing-system') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

            <h1 class="h3 mb-5 fw-normal">Login <i class="bi bi-airplane"></i></h1>
            <div class="form-group form-floating mb-3">
                <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required="required" autofocus>
                <label for="floatingEmail">Email</label>
                @if ($errors->has('email'))
                    <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="form-group form-floating mb-3">
                <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required="required">
                <label for="floatingPassword">Password</label>
                @if ($errors->has('password'))
                    <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Login <i class="bi bi-box-arrow-in-right"></i></button>
        </form>
    </div>
@endsection
