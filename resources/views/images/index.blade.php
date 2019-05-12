@extends('layouts.app')

@section('content')
    <h1>Images</h1>
    @if(count($images) > 0)
        @foreach($images as $image)
            <div class="card">
                <div class="row">
                    <div class="col-lg-3">
                        <a href="/images/{{$image->id}}"><img src="/storage/images/{{$image->image_name}}" alt="image" width="100"></a>
                    </div>
                    <div class="col-lg-9">
                        <a href="/images/{{$image->id}}">{{$image->caption}}</a><br>
                        <small>Owner: {{$image->user->name}}</small>
                    </div>
                </div>
            </div>
        @endforeach
    @else
            <p>No images found</p>
    @endif
@endsection