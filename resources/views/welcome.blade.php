@extends('layouts.app')
@section('title', 'Welcome')
    @section('content')
        <section class="">
            <div class="jumbotron text-center">
                <h1>Welcome to Larablog</h1>
                <p>Just me trying out laravel for the first time</p>
                <p>
                    <a href="/login" class="btn btn-primary btn-lg" role="button">Login</a>
                    <a href="/register" class="btn btn-success btn-lg" role="button">Register</a>
                </p>
            </div>
        </section>
@endsection


