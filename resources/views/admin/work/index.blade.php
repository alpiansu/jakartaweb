@extends('adminlte::page')

@section('title', 'Works')

@section('content_header')
    <h1>Manage Works</h1>
@stop

@section('content')
    <!-- Display success or error messages -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Heading Text</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.projects.updateHeading') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="heading">Heading</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $work_text->title }}" required>
                </div>
                <div class="form-group">
                    <label for="sub_heading">Sub Heading</label>
                    <input type="text" class="form-control" id="content" name="content" value="{{ $work_text->content }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>

    <!-- Add Project Button -->
    <button class="btn btn-primary mb-2" data-toggle="modal" data-target="#addProjectModal">Add Project</button>

    <!-- Projects Table -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Project List</h3>
        </div>
        <div class="card-body">
            <table id="projectsTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Type</th>
                        <th>Sector</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $project)
                        <tr>
                            <td>{{ $project->title }}</td>
                            <td>{{ $project->description }}</td>
                            <td>{{ $project->project_type }}</td>
                            <td>{{ $project->sector }}</td>
                            <td>
                                @if($project->image_path)
                                    <img src="{{ asset('assets/img/work/' . $project->image_path) }}" alt="Project Image" style="width: 100px;">
                                @endif
                            </td>
                            <td>
                                <!-- Edit Button -->
                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editProjectModal"
                                    data-action="{{ route('admin.projects.update', $project->id) }}"
                                    data-id="{{ $project->id }}"
                                    data-title="{{ $project->title }}"
                                    data-description="{{ $project->description }}"
                                    data-project_type="{{ $project->project_type }}"
                                    data-sector="{{ $project->sector }}"
                                    data-image="{{ $project->image_path }}">Edit</button>

                                <!-- Delete Button -->
                                <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Project Modal -->
    <div class="modal fade" id="addProjectModal" tabindex="-1" role="dialog" aria-labelledby="addProjectModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProjectModalLabel">Add Project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addProjectForm" method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data">
                    @csrf
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
                            <label for="project_type">Project Type</label>
                            <input type="text" class="form-control" id="project_type" name="project_type" required>
                        </div>
                        <div class="form-group">
                            <label for="sector">Sector</label>
                            <input type="text" class="form-control" id="sector" name="sector" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" id="image" name="image">
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

    <!-- Edit Project Modal -->
    <div class="modal fade" id="editProjectModal" tabindex="-1" role="dialog" aria-labelledby="editProjectModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProjectModalLabel">Edit Project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editProjectForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" id="editProjectId" name="id">
                        <div class="form-group">
                            <label for="editTitle">Title</label>
                            <input type="text" class="form-control" id="editTitle" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="editDescription">Description</label>
                            <textarea class="form-control" id="editDescription" name="description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="editProjectType">Project Type</label>
                            <input type="text" class="form-control" id="editProjectType" name="project_type" required>
                        </div>
                        <div class="form-group">
                            <label for="editSector">Sector</label>
                            <input type="text" class="form-control" id="editSector" name="sector" required>
                        </div>
                        <div class="form-group">
                            <label for="editImage">Image</label>
                            <input type="file" class="form-control-file" id="editImage" name="image">
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
        $('#editProjectModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var action = button.data('action');
            var id = button.data('id');
            var title = button.data('title');
            var description = button.data('description');
            var project_type = button.data('project_type');
            var sector = button.data('sector');
            var image = button.data('image');

            var modal = $(this);
            modal.find('#editProjectForm').attr('action', action);
            modal.find('#editProjectId').val(id);
            modal.find('#editTitle').val(title);
            modal.find('#editDescription').val(description);
            modal.find('#editProjectType').val(project_type);
            modal.find('#editSector').val(sector);
            // Optional: if you want to show the existing image, you can handle it here
        });

        $('#addProjectModal').on('show.bs.modal', function () {
            var modal = $(this);
            modal.find('form')[0].reset();  // Reset the form when showing the add modal
        });
    </script>
@stop
