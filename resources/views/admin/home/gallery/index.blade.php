@extends('adminlte::page')

@section('title', 'Manage Gallery')

@section('content_header')
    <h1>Gallery Management</h1>
@stop

@section('content')
<div class="container-fluid">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Gallery Content</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.home.gallery.update', $gallery->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $gallery->title }}" required>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" id="content" name="content" rows="3" required>{{ $gallery->content }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update Content</button>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Upload New Image</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.home.gallery.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="file" class="form-control-file" id="image" name="image" required>
                </div>
                <button type="submit" class="btn btn-success">Upload Image</button>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Gallery Images</h6>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach($images as $image)
                    @if($image != '.' && $image != '..')
                        <div class="col-md-3 mb-3">
                            <img src="{{ asset('assets/galleries/' . $image) }}" class="img-fluid" alt="{{ $image }}">
                            <form action="{{ route('admin.home.gallery.destroy', $image) }}" method="POST" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this image?')">Delete</button>
                            </form>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection