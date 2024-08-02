@extends('adminlte::page')

@section('title', 'Manage Carousel')

@section('content_header')
    <h1>Manage Carousel</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#createCarouselModal">Add New Carousel</button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Button Text</th>
                <th>Button Link</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($carousels as $carousel)
                <tr>
                    <td>{{ $carousel->title }}</td>
                    <td>{{ $carousel->description }}</td>
                    <td><img src="{{ asset($carousel->image_url) }}" width="100"></td>
                    <td>{{ $carousel->button_text }}</td>
                    <td>{{ $carousel->button_link }}</td>
                    <td>
                        <button class="btn btn-warning editCarousel" data-id="{{ $carousel->id }}" data-toggle="modal" data-target="#editCarouselModal">Edit</button>
                        <form action="{{ route('admin.home.carousel.destroy', $carousel->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Create Carousel Modal -->
    <div class="modal fade" id="createCarouselModal" tabindex="-1" role="dialog" aria-labelledby="createCarouselModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.home.carousel.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createCarouselModalLabel">Add New Carousel</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image_url">Image</label>
                            <input type="file" class="form-control" id="image_url" name="image_url" required>
                        </div>
                        <div class="form-group">
                            <label for="button_text">Button Text</label>
                            <input type="text" class="form-control" id="button_text" name="button_text" required>
                        </div>
                        <div class="form-group">
                            <label for="button_link">Button Link</label>
                            <input type="text" class="form-control" id="button_link" name="button_link" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Carousel Modal -->
    <div class="modal fade" id="editCarouselModal" tabindex="-1" role="dialog" aria-labelledby="editCarouselModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="editCarouselForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCarouselModalLabel">Edit Carousel</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_title">Title</label>
                            <input type="text" class="form-control" id="edit_title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_description">Description</label>
                            <textarea class="form-control" id="edit_description" name="description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit_image_path">Image</label>
                            <input type="file" class="form-control" id="edit_image_path" name="image_url">
                            <img id="edit_image_preview" src="" width="100" class="mt-2">
                        </div>
                        <div class="form-group">
                            <label for="edit_button_text">Button Text</label>
                            <input type="text" class="form-control" id="edit_button_text" name="button_text" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_button_link">Button Link</label>
                            <input type="text" class="form-control" id="edit_button_link" name="button_link" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('.editCarousel').click(function() {
                var id = $(this).data('id');
                $.get('/admin/home/carousel/edit/' + id, function(data) {
                    $('#editCarouselForm').attr('action', '/admin/home/carousel/' + id);
                    $('#edit_title').val(data.title);
                    $('#edit_description').val(data.description);
                    $('#edit_image_preview').attr('src', '/' + data.image_url);
                    $('#edit_button_text').val(data.button_text);
                    $('#edit_button_link').val(data.button_link);
                });
            });
        });
    </script>
@stop
