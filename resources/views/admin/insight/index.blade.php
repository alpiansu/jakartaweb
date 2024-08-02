@extends('adminlte::page')

@section('title', 'Insight Management')

@section('content_header')
    <h1>Manage Insight</h1>
@stop

@section('content')
<section class="content">
    <div class="container-fluid mt-3">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Insight Management</h3>
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addInsightModal">Add New Insight</button>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Link</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($blogs as $blog)
                            <tr>
                                <td>{{ $blog->title }}</td>
                                <td>{{ Str::limit($blog->description, 50) }}</td>
                                <td><img src="{{ asset('assets/img/insights/' . $blog->image_path) }}" alt="{{ $blog->title }}" width="100"></td>
                                <td><a href="{{ $blog->link }}" target="_blank">{{ $blog->link }}</a></td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editInsightModal"
                                        data-id="{{ $blog->id }}"
                                        data-title="{{ $blog->title }}"
                                        data-description="{{ $blog->description }}"
                                        data-link="{{ $blog->link }}"
                                        data-image="{{ asset('assets/img/insights/' . $blog->image_path) }}"
                                        data-action="{{ route('admin.insight.update', $blog->id) }}">Edit
                                    </button>
                                    <form action="{{ route('admin.insight.destroy', $blog->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- Add Insight Modal -->
<div class="modal fade" id="addInsightModal" tabindex="-1" role="dialog" aria-labelledby="addInsightModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.insight.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addInsightModalLabel">Add New Insight</h5>
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
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image_path">Image</label>
                        <input type="file" class="form-control" id="image_path" name="image_path">
                    </div>
                    <div class="form-group">
                        <label for="link">Link</label>
                        <input type="text" class="form-control" id="link" name="link" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Insight Modal -->
<div class="modal fade" id="editInsightModal" tabindex="-1" role="dialog" aria-labelledby="editInsightModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="editInsightForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editInsightModalLabel">Edit Insight</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editInsightId" name="id">
                    <div class="form-group">
                        <label for="editTitle">Title</label>
                        <input type="text" class="form-control" id="editTitle" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="editDescription">Description</label>
                        <textarea class="form-control" id="editDescription" name="description" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="editImage">Image</label>
                        <input type="file" class="form-control" id="editImage" name="image_path">
                        <img id="editImagePreview" src="" alt="" width="100" class="mt-2">
                    </div>
                    <div class="form-group">
                        <label for="editLink">Link</label>
                        <input type="text" class="form-control" id="editLink" name="link" required>
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

@section('js')
<script>
    $('#editInsightModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var title = button.data('title');
        var description = button.data('description');
        var link = button.data('link');
        var image = button.data('image');
        var action = button.data('action');

        var modal = $(this);
        modal.find('#editInsightForm').attr('action', action);
        modal.find('#editInsightId').val(id);
        modal.find('#editTitle').val(title);
        modal.find('#editDescription').val(description);
        modal.find('#editLink').val(link);
        modal.find('#editImagePreview').attr('src', image);
    });
</script>
@endsection
@endsection
