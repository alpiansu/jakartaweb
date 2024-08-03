@extends('adminlte::page')

@section('title', 'Configuration')

@section('content_header')
    <h1>Configuration</h1>
@stop

@section('content')
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
<div class="container-fluid">
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card shadow">
        <div class="card-header">
            <h3 class="card-title">Main Configuration</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.config.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="logo">Logo</label>
                    <input type="file" name="logo" class="form-control">
                    @if($config && $config->logo)
                        <img src="{{ asset('assets/img/' . $config->logo) }}" alt="Logo" style="width: 100px;">
                    @endif
                </div>
                <div class="form-group">
                    <label for="favicon">Favicon</label>
                    <input type="file" name="favicon" class="form-control">
                    @if($config && $config->favicon)
                        <img src="{{ asset('assets/img/' . $config->favicon) }}" alt="Favicon" style="width: 50px;">
                    @endif
                </div>
                <div class="form-group">
                    <label for="footer_logo">Footer Logo</label>
                    <input type="file" name="footer_logo" class="form-control">
                    @if($config && $config->footer_logo)
                        <img src="{{ asset('assets/img/' . $config->footer_logo) }}" alt="Footer Logo" style="width: 100px;">
                    @endif
                </div>
                <div class="form-group">
                    <label for="footer_text">Footer Text</label>
                    <textarea name="footer_text" class="form-control" rows="3">{{ $config ? $config->footer_text : '' }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Save Configuration</button>
            </form>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header">
            <h3 class="card-title">Social Media</h3>
            <button class="btn btn-success float-right" data-toggle="modal" data-target="#addSocialMediaModal">Add Social Media</button>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Icon</th>
                        <th>Name</th>
                        <th>Link</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($socialMedias as $socialMedia)
                        <tr>
                            <td><i class="{{ $socialMedia->icon }}"></i></td>
                            <td>{{ $socialMedia->name }}</td>
                            <td>{{ $socialMedia->link }}</td>
                            <td>
                                <button class="btn btn-info" data-toggle="modal" data-target="#editSocialMediaModal-{{ $socialMedia->id }}">Edit</button>
                                <form action="{{ route('admin.config.destroy', $socialMedia->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this social media?')">Delete</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Social Media Modal -->
                        <div class="modal fade" id="editSocialMediaModal-{{ $socialMedia->id }}" tabindex="-1" role="dialog" aria-labelledby="editSocialMediaModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editSocialMediaModalLabel">Edit Social Media</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.config.updateSocialMedia', $socialMedia->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="icon">Icon (Text)</label>
                                                <input type="text" name="icon" class="form-control" value="{{ $socialMedia->icon }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" name="name" class="form-control" value="{{ $socialMedia->name }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="link">Link</label>
                                                <input type="text" name="link" class="form-control" value="{{ $socialMedia->link }}" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update Social Media</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Social Media Modal -->
<div class="modal fade" id="addSocialMediaModal" tabindex="-1" role="dialog" aria-labelledby="addSocialMediaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSocialMediaModalLabel">Add Social Media</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.config.storeSocialMedia') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="icon">Icon (Text)</label>
                        <input type="text" name="icon" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="link">Link</label>
                        <input type="text" name="link" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Social Media</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    $(document).ready(function() {
        // Add custom JS if needed
    });
</script>
@stop
