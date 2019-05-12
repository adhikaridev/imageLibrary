@extends('layouts.app')

@section('content')
<img src="/storage/images/{{$image->image_name}}" alt="image">
<h1>{{$image->caption}}</h1>
<small>Owner: {{$image->user->name}}</small><br><br>
@if (!Auth::guest())
        @if (Auth::user()->id == $image->user_id)
                <div class="row">
                        <div class="col-lg-3">
                                <a href="/images/{{$image->id}}/edit" class="btn btn-primary">Edit</a>
                        </div>
                        <div class="col-lg-3">
                                <form action="{{ action('ImagesController@destroy', $image->id) }}" method="POST" accept-charset="UTF-8">
                                                @csrf
                                                {{Form::hidden('_method', 'DELETE')}}
                                                <input type="submit" class="btn btn-danger" value="Delete">
                                </form>
                        </div>
                </div> 
        @endif
           
@endif


@endsection