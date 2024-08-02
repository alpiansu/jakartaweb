@extends('adminlte::page')

@section('title', 'Manage About Us')

@section('content_header')
    <h1>Manage About Us</h1>
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

    @if($about)
        <button class="btn btn-warning mb-3 editAbout" data-id="{{ $about->id }}" data-toggle="modal" data-target="#editAboutModal">Edit About Us</button>
    @else
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#createAboutModal">Add About Us</button>
    @endif
    <button class="btn btn-success mb-3" data-toggle="modal" data-target="#createFeatureModal">Add New Feature</button>

    @if($about)
        <h2>About Us Details</h2>
        <table class="table table-bordered">
            <tr>
                <th>Title</th>
                <td>{{ $about->title }}</td>
            </tr>
            <tr>
                <th>Description</th>
                <td>{{ $about->description }}</td>
            </tr>
            <tr>
                <th>Image</th>
                <td><img src="{{ asset($about->image_url) }}" width="100"></td>
            </tr>
            <tr>
                <th>Title 2</th>
                <td>{{ $about->title2 }}</td>
            </tr>
            <tr>
                <th>Description 2</th>
                <td>{{ $about->description2 }}</td>
            </tr>
        </table>

        <h2>Features</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Icon</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($about->features as $feature)
                    <tr>
                        <td><i class="{{ $feature->icon }}"></i> {{ $feature->icon }}</td>
                        <td>{{ $feature->title }}</td>
                        <td>{{ $feature->description }}</td>
                        <td>
                            <button class="btn btn-warning editFeature" data-id="{{ $feature->id }}" data-toggle="modal" data-target="#editFeatureModal">Edit</button>
                            <form action="{{ route('admin.home.about.feature.destroy', $feature->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No About Us information available. Please add one.</p>
    @endif

    <!-- Create About Us Modal -->
    <div class="modal fade" id="createAboutModal" tabindex="-1" role="dialog" aria-labelledby="createAboutModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.home.about.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createAboutModalLabel">Add About Us</h5>
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
                            <label for="title2">Title 2</label>
                            <input type="text" class="form-control" id="title2" name="title2" required>
                        </div>
                        <div class="form-group">
                            <label for="description2">Description 2</label>
                            <textarea class="form-control" id="description2" name="description2" required></textarea>
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

    <!-- Edit About Us Modal -->
    <div class="modal fade" id="editAboutModal" tabindex="-1" role="dialog" aria-labelledby="editAboutModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="editAboutForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editAboutModalLabel">Edit About Us</h5>
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
                            <label for="edit_image_url">Image</label>
                            <input type="file" class="form-control" id="edit_image_url" name="image_url">
                            <img id="edit_image_preview" src="" width="100" class="mt-2">
                        </div>
                        <div class="form-group">
                            <label for="edit_title2">Title 2</label>
                            <input type="text" class="form-control" id="edit_title2" name="title2" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_description2">Description 2</label>
                            <textarea class="form-control" id="edit_description2" name="description2" required></textarea>
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

    <!-- Create Feature Modal -->
    <div class="modal fade" id="createFeatureModal" tabindex="-1" role="dialog" aria-labelledby="createFeatureModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.home.about.feature.store', $about->id ?? 0) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createFeatureModalLabel">Add Feature</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="icon">Icon</label>
                            <input type="text" class="form-control" id="icon" name="icon" required>
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
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

    <!-- Edit Feature Modal -->
    <div class="modal fade" id="editFeatureModal" tabindex="-1" role="dialog" aria-labelledby="editFeatureModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="editFeatureForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editFeatureModalLabel">Edit Feature</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_feature_icon">Icon</label>
                            <input type="text" class="form-control" id="edit_feature_icon" name="icon" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_feature_title">Title</label>
                            <input type="text" class="form-control" id="edit_feature_title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_feature_description">Description</label>
                            <textarea class="form-control" id="edit_feature_description" name="description" required></textarea>
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
            $('.editAbout').click(function() {
                var id = $(this).data('id');
                $.get('/admin/home/about/' + id, function(data) {
                    $('#editAboutForm').attr('action', '/admin/home/about/' + id);
                    $('#edit_title').val(data.title);
                    $('#edit_description').val(data.description);
                    $('#edit_image_preview').attr('src', '/' + data.image_url);
                    $('#edit_title2').val(data.title2);
                    $('#edit_description2').val(data.description2);
                });
            });

            $('.editFeature').click(function() {
                var id = $(this).data('id');
                $.get('/admin/home/about/feature/' + id, function(data) {
                    $('#editFeatureForm').attr('action', '/admin/home/about/feature/' + id);
                    $('#edit_feature_icon').val(data.icon);
                    $('#edit_feature_title').val(data.title);
                    $('#edit_feature_description').val(data.description);
                });
            });
        });
    </script>
@stop