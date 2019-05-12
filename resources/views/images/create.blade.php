@extends('layouts.app')

@section('content')
    <h1>Upload New Image</h1>
    {{-- {!! Form::open(array(['action' => 'ImagesController@store', 'method' => 'POST'])) !!}
        <div class="form-group">
            {{Form::label('caption', 'Caption')}}
            {{Form::text('caption', '', ['class' => 'form-control', 'placeholder' => 'Caption'])}}
        </div>
    {!! Form::close() !!} --}}
    
    <br><br>
    <form action="{{ action('ImagesController@store') }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col form-file-upload form-file-simple">
                <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg">
            </div>
        </div><br><br>
        <div class="row">
            <div class="col-lg-2">
                Caption: 
            </div>
            <div class="col-lg-10">
                <input type="text" name="caption" placeholder="Caption"> 
            </div>
        </div><br><br>
        <input type="submit" class="btn btn-primary" value="Submit">
    </form>

@endsection