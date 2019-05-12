@extends('layouts.app')

@section('content')
    <h1>Edit Image</h1>

    <form action="{{ action('ImagesController@update', $image->id) }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col">
            <img src="/storage/images/{{$image->image_name}}" alt="image">
            </div>
        </div><br><br>
        <div class="row">
            <div class="col-lg-2">
                Change Image: 
            </div>
            <div class="col-lg-10 form-file-upload form-file-simple">
                <input type="file" name="image">
            </div>
        </div><br>
        <div class="row">
            <div class="col-lg-2">
                Caption: 
            </div>
            <div class="col-lg-10">
            <input type="text" name="caption" value="{{$image->caption}}" placeholder="Caption"> 
            </div>
        </div><br>
        {{Form::hidden('_method', 'PUT')}}
        <input type="submit" class="btn btn-primary" value="Submit">
    </form>

@endsection