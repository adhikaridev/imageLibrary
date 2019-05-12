@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        
                    <p><a href="/images/create" class="btn btn-primary">Upload new image</a></p><br>
                    <h3>My Images</h3>
                    @if(count($images) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th>Image</th>
                                <th>Caption</th>
                                <th>Action 1</th>
                                <th>Action 2</th>
                            </tr>
                            @foreach ($images as $image)
                                <tr>
                                    <td><img src="/storage/images/{{$image->image_name}}" alt="image" width="80"></td>
                                    <td>{{$image->caption}}</td>
                                    <td><a href="/images/{{$image->id}}/edit" class="btn btn-primary">Edit</a></td>
                                    <td>
                                            <form action="{{ action('ImagesController@destroy', $image->id) }}" method="POST" accept-charset="UTF-8">
                                                    @csrf
                                                    {{Form::hidden('_method', 'DELETE')}}
                                                    <input type="submit" class="btn btn-danger" value="Delete">
                                            </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p>You have not uploaded any images.</p>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
