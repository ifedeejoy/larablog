@extends('layouts.app')
@section('title', 'Home')
    @section('content')
        <section class="">
            <div class="row mb-4 wow fadeIn">
                @if (count($posts) >= 1)
                    @foreach ($posts as $post)
                        <div class="col-lg-9 col-md-12 mb-4">
                            <div class="card">
                                <div class="view overlay">
                                    <img class="card-img-top img-fluid" src="/storage/cover_images/{{$post->image}}" alt="Card image cap">
                                    <a href="#!">
                                        <div class="mask rgba-white-slight"></div>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title">{{$post->title}}</h4>
                                    <h6 class="text-right">Written On {{$post->created_at}}</h6>
                                    <h6 class="text-right">Written By {{$post->user->name}}</h6>
                                    <p class="card-text"></p>
                                    <a href="/posts/{{$post->id}}" class="btn btn-primary btn-md">View Post
                                        <i class="fas fa-book ml-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>No article Found</p>
                @endif
            </div>
        </section>
@endsection


