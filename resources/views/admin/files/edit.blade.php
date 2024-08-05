@extends('layouts.powereye')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/files') }}">Data Files</a></li>
            <li class="breadcrumb-item active">Edit Data File</li>
        </ol>
    </nav>

    <form class="mb-9" method="POST" action="{{ route('files.update', $dataFile->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row g-3 flex-between-end mb-5">
            <div class="col-auto">
                <h2 class="mb-3">{{ $dataFile->file_name }}</h2>
                <h5 class="text-body-tertiary fw-semibold">
                    Edit Data File.
                </h5>
            </div>
            <div class="col-auto">
                <a href="{{ route('files.index') }}" class="btn btn-phoenix-secondary me-2 mb-2 mb-sm-0">Discard</a>
                <button class="btn btn-primary mb-2 mb-sm-0" type="submit">Update file</button>
            </div>
        </div>

        <div class="mb-3">
            <label for="site_id" class="form-label">Site</label>
            <select class="form-select " id="site_id" name="site_id">
                <option value="">None</option>
                @foreach($sites as $site)
                    <option value="{{$site->id}}">
                        {{$site->title}}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="device_serial" class="form-label">Device</label>
            <select class="form-select " id="device_serial" name="device_serial">
                <option value="">None</option>
                @foreach($devices as $device)
                    <option value="{{$device->serial_number}}">
                        {{$device->serial_number}}
                    </option>
                @endforeach
            </select>
        </div>

    </form>
@endsection

@push('scripts')
    <script>
        $(".factory").on("change", function() {
            var id = $(this).val();
            $("#site_id").empty();
            fetch(`{{ url('api/factories?id=') }}${id}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response is not OK');
                    }
                    return response.json();
                })
                .then(data => {
                    $("#site_id").append(`<option value=''></option>`);
                    data.sites.forEach((item, index) => {
                        $("#site_id").append(`<option value='${item.id}'>${item.title}</option>`);
                    });
                })
                .catch(error => {
                    alert('There was a problem with the fetch operation:' + error);
                });
        });

        $("#site_id").on("change", function() {
            var id = $(this).val();
            $("#component_id").empty();
            fetch(`{{ url('api/sites?id=') }}${id}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response is not OK');
                    }
                    return response.json();
                })
                .then(data => {
                    $("#component_id").append(`<option value=''>Not Applicable</option>`);
                    data.components.forEach((item, index) => {
                        $("#component_id").append(`<option value='${item.id}'>${item.title}</option>`);
                    });
                })
                .catch(error => {
                    alert('There was a problem with the fetch operation:' + error);
                });
        });
    </script>
@endpush
