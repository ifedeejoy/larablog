@extends('layouts.app')
@section('title', 'LARABLOG')
    @section('content')
        <section class="mt-4">

            <!--Grid row-->
            <div class="row">

                <!--Grid column-->
                <div class="col-md-9 mb-4">
                    <div class="card mb-4 wow fadeIn">
                        <img src="/storage/cover_images/{{$post->image}}" class="img-fluid" alt="">
                    </div>

                    <!--Card-->
                    <div class="card mb-4 wow fadeIn">
                        <iframe height="315" src="{{$post->video_links}}" frameborder="0"></iframe>
                        <!--Card content-->
                        <div class="card-body text-center">
                            <p class="h5 my-4">{{$post->title}}</p>
                            <p>{!!$post->article!!}</p>
                            <hr>
                            @auth
                                @if (Auth::id() === $post->user_id)
                                    <a href="/posts/{{$post->id}}/edit/" class="btn btn-default btn-large">Edit Post</a>
                                    <form action="{{action('PostsController@destroy', ['id'=>$post->id])}}" class="pull-right" method="post">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-lg">Delete</button>
                                    </form>
                                @endif
                            @endauth

                        </div>

                    </div>

                </div>

            </div>

        </section>
    @endsection
