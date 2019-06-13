@extends('layouts.app')
@section('title', 'Create Post')
@section('content')
    <section class="mt-4">
        <div class="col-sm-12 mb-5">
            <form method="post" class="form-signin col-sm-9" style="margin:0;" action="{{action('PostsController@store')}}" enctype="multipart/form-data">
                @csrf
                <div class="text-center mb-4">
                    <h1 class="h3 mb-3 font-weight-normal">{{config('app.name')}}</h1>
                </div>

                <div class="md-form">
                    <input type="text" name="title" id="postTitle" class="form-control" autofocus>
                    <label for="postTitle">Title</label>
                </div>

                <div class="md-form">
                    <label for="article-ckeditor">Article</label>
                    <textarea class="md-textarea form-control" name="article" id="article-ckeditor" placeholder="Article" rows="3"></textarea>
                </div>

                <div class="md-form">
                    <label for="postVideo">Video Link</label>
                    <input type="text" name="videolinks" id="postVideo"  class="form-control" autofocus>
                </div>

                <div class="md-form text-center">
                    <label class="btn btn-outline-cyan" >
                    Click To Upload Article Image
                        <input type="file" id="image" name="cover_image" class="form-control" hidden>
                    </label>
                </div>

                <br><br>

                <div class="md-form text-center">
                    <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                </div>
            </form>
        </div>
    </section>
@endsection
@section('text-editor')
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js" defer></script>
<script src="{{asset('js/main.js')}}" defer></script>
@endsection


