@extends('layouts.powereye')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('devices.index') }}">Devices</a></li>
            <li class="breadcrumb-item active">Edit Device</li>
        </ol>
    </nav>

    <form action="{{ route('devices.update', $device) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-3 flex-between-end mb-5">
            <div class="col-auto">
                <h2 class="mb-2">Edit Device</h2>
                <h5 class="text-body-tertiary fw-semibold">
                    Update the device information for your clients.
                </h5>
            </div>
            <div class="col-auto">
                <button class="btn btn-phoenix-secondary me-2 mb-2 mb-sm-0" type="reset">
                    Discard
                </button>
                <button class="btn btn-primary mb-2 mb-sm-0" type="submit">
                    Update Device
                </button>
            </div>
        </div>

        <div class="mb-5">
            <h5>Serial Number</h5>
            <input type="text" class="form-control" id="serial_number" name="serial_number"
                   value="{{ $device->serial_number }}" disabled>
        </div>

        <div class="mb-5">
            <h5>Description</h5>
            <textarea class="form-control" id="description" name="description" rows="3">
                {{ $device->description }}
            </textarea>
        </div>
    </form>
@endsection
