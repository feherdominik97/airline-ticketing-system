@extends('layout')
@section('content')
    <div class="row">
        <div class="col-6">

        </div>
        <form class="col-6 d-flex flex-row-reverse" method="get" action="{{ route('logout-airline-ticketing-system') }}">
                <button class="btn btn-lg" type="submit">Logout <i class="bi bi-box-arrow-right"></i></button>
        </form>
    </div>
    <div id="app"></div>
@endsection
