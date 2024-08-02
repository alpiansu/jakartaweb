@extends('adminlte::page')

@section('title', 'Manage About Us')

@section('content_header')
    <h1>Feature Management</h1>
@stop

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Kelola Fitur</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Teks Fitur -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Teks Fitur</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.home.feature.text.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Judul</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $feature_text->title ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label for="content">Konten</label>
                    <textarea class="form-control" id="content" name="content" rows="3" required>{{ $feature_text->content ?? '' }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>

    <!-- Daftar Fitur -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Fitur</h6>
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addFeatureModal">
                Tambah Fitur
            </button>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Link URL</th>
                            <th>Link Text</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($features as $feature)
                        <tr>
                            <td>{{ $feature->title }}</td>
                            <td>{{ $feature->description }}</td>
                            <td>{{ $feature->link_url }}</td>
                            <td>{{ $feature->link_text }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary edit-feature" data-toggle="modal" data-target="#editFeatureModal" data-feature="{{ json_encode($feature) }}">
                                    Edit
                                </button>
                                <form action="{{ route('admin.home.feature.destroy', $feature->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus fitur ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Feature Modal -->
<div class="modal fade" id="addFeatureModal" tabindex="-1" role="dialog" aria-labelledby="addFeatureModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFeatureModalLabel">Tambah Fitur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.home.feature.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Judul</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="link_url">Link URL</label>
                        <input type="text" class="form-control" id="link_url" name="link_url" required>
                    </div>
                    <div class="form-group">
                        <label for="link_text">Link Text</label>
                        <input type="text" class="form-control" id="link_text" name="link_text" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Feature Modal -->
<div class="modal fade" id="editFeatureModal" tabindex="-1" role="dialog" aria-labelledby="editFeatureModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFeatureModalLabel">Edit Fitur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editFeatureForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_title">Judul</label>
                        <input type="text" class="form-control" id="edit_title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_description">Deskripsi</label>
                        <textarea class="form-control" id="edit_description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit_link_url">Link URL</label>
                        <input type="text" class="form-control" id="edit_link_url" name="link_url" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_link_text">Link Text</label>
                        <input type="text" class="form-control" id="edit_link_text" name="link_text" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@stop
@section('js')
<script>
    $(document).ready(function() {
        $('.edit-feature').on('click', function() {
            var feature = $(this).data('feature');
            var form = $('#editFeatureForm');
            
            form.attr('action', '/admin/home/feature/' + feature.id);
            $('#edit_title').val(feature.title);
            $('#edit_description').val(feature.description);
            $('#edit_link_url').val(feature.link_url);
            $('#edit_link_text').val(feature.link_text);
        });
    });
</script>
@stop
