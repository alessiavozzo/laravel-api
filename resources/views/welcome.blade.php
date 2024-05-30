@extends('layouts.app')
@section('content')
    @guest
        <div class="welcome">
            welcome-page
        </div>
    @else
        <div class="container py-5">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-lg" type="button">Dashboard</a>

        </div>

    @endguest
@endsection
