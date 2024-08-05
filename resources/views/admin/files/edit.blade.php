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
@endpush
