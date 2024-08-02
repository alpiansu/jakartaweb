@extends('adminlte::page')

@section('title', 'Manage Services')

@section('content_header')
    <h1>Manage Services</h1>
@stop

@section('content')
<div class="container-fluid">

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

    <!-- SubService -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">SubService</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.service.subservice.update') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="heading">Heading</label>
                    <input type="text" class="form-control" id="heading" name="heading" value="{{ $subservice->heading }}" required>
                </div>
                <div class="form-group">
                    <label for="sub_heading">Sub Heading</label>
                    <input type="text" class="form-control" id="sub_heading" name="sub_heading" value="{{ $subservice->sub_heading }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>

    <!-- Services -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Services</h6>
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-primary mb-3" onclick="openServiceModal()">
                Tambah Service
            </button>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Icon Class</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $service)
                        <tr>
                            <td>{{ $service->title }}</td>
                            <td>{{ $service->description }}</td>
                            <td>{{ $service->icon_class }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary" onclick="openServiceModal({{ json_encode($service) }})">
                                    Edit
                                </button>
                                <form action="{{ route('admin.service.destroy', $service->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus service ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Counters -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Counters</h6>
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-primary mb-3" onclick="openCounterModal()">
                Tambah Counter
            </button>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Value</th>
                            <th>Subtitle</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($counters as $counter)
                        <tr>
                            <td>{{ $counter->value }}</td>
                            <td>{{ $counter->subtitle }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary" onclick="openCounterModal({{ json_encode($counter) }})">
                                    Edit
                                </button>
                                <form action="{{ route('admin.service.counter.destroy', $counter->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus counter ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Service Modal -->
    <div class="modal fade" id="serviceModal" tabindex="-1" role="dialog" aria-labelledby="serviceModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="serviceModalLabel">Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="serviceForm" method="POST">
                        @csrf
                        <input type="hidden" id="serviceId" name="id">
                        <div class="form-group">
                            <label for="title">Judul</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="icon_class">Icon Class</label>
                            <input type="text" class="form-control" id="icon_class" name="icon_class" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Counter Modal -->
    <div class="modal fade" id="counterModal" tabindex="-1" role="dialog" aria-labelledby="counterModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="counterModalLabel">Counter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="counterForm" method="POST">
                        @csrf
                        <input type="hidden" id="counterId" name="id">
                        <div class="form-group">
                            <label for="value">Value</label>
                            <input type="text" class="form-control" id="value" name="value" required>
                        </div>
                        <div class="form-group">
                            <label for="subtitle">Subtitle</label>
                            <input type="text" class="form-control" id="subtitle" name="subtitle" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    function openServiceModal(service = null) {
        const modal = $('#serviceModal');
        const form = $('#serviceForm');
        const modalTitle = $('#serviceModalLabel');

        if (service) {
            modalTitle.text('Edit Service');
            form.attr('action', `/admin/service/${service.id}`);
            form.append('<input type="hidden" name="_method" value="PUT">');
            $('#serviceId').val(service.id);
            $('#title').val(service.title);
            $('#description').val(service.description);
            $('#icon_class').val(service.icon_class);
        } else {
            modalTitle.text('Tambah Service');
            form.attr('action', '/admin/service');
            form.find('input[name="_method"]').remove();
            form[0].reset();
        }

        modal.modal('show');
    }

    function openCounterModal(counter = null) {
        const modal = $('#counterModal');
        const form = $('#counterForm');
        const modalTitle = $('#counterModalLabel');

        if (counter) {
            modalTitle.text('Edit Counter');
            form.attr('action', `/admin/service/counter/${counter.id}`);
            form.append('<input type="hidden" name="_method" value="PUT">');
            $('#counterId').val(counter.id);
            $('#value').val(counter.value);
            $('#subtitle').val(counter.subtitle);
        } else {
            modalTitle.text('Tambah Counter');
            form.attr('action', '/admin/service/counter');
            form.find('input[name="_method"]').remove();
            form[0].reset();
        }

        modal.modal('show');
    }
</script>
@stop