@if ($errors->count() > 0)
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            {{$error}}
        </div>
    @endforeach
@endif

@if (session('success'))
    <div class="aler alert-success">
        {{session('success')}}
    </div>
@endif

@if (session('error'))
    <div class="aler alert-danger">
        {{session('error')}}
    </div>
@endif
