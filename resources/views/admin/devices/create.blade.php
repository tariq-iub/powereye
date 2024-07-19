@extends('layouts.powereye')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('devices.index') }}">Devices</a></li>
            <li class="breadcrumb-item active">Add Device</li>
        </ol>
    </nav>

    <form class="mb-9" action="{{ route('devices.store') }}" method="POST">
        @csrf
        <div class="row g-3 flex-between-end mb-5">
            <div class="col-auto">
                <h2 class="mb-2">Add a device</h2>
                <h5 class="text-body-tertiary fw-semibold">
                    Add a device for your clients.
                </h5>
            </div>

            <div class="col-auto">
                <button class="btn btn-phoenix-secondary me-2 mb-2 mb-sm-0" type="reset">
                    Discard
                </button>
                <button class="btn btn-primary mb-2 mb-sm-0" type="submit">
                    Add device
                </button>
            </div>
        </div>

        <div class="row g-5">
            <div class="col-12 col-xl-8">
                @csrf
                <div class="mb-5">
                    <h5>Description</h5>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>
            </div>
        </div>
    </form>
@endsection
