@extends('layouts.care')
@section('title', 'Edit Data Files')
@section('page-title', 'Edit Data Files')
@section('page-message', "Edit meta-data of uploaded data files.")

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">{{ $dataFile->file_name }}</h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    <form id="posted" method="POST" action="{{ route('data.update', $dataFile->id) }}"
                          class="needs-validation" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="inspection_id">Inspection</label>
                                <select class="custom-select select2" name="inspection_id" style="width: 100%" required>
                                    <option value="">Select Inspection</option>
                                    @foreach($inspections as $inspection)
                                        <option value="{{ $inspection->id }}" {{ ($dataFile->inspection->id == $inspection->id) ? 'selected' : '' }}>
                                            {{ $inspection->title . ' (' . $inspection->type . ')' }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Select a inspection under which data file is created.</div>
                            </div>

                            <div class="form-group">
                                <label for="factory_id">Factory</label>
                                <select class="custom-select select2 factory" style="width: 100%" required>
                                    <option value="">Select Factory</option>
                                    @foreach($factories as $factory)
                                        @php $f = $dataFile->site->factory; @endphp
                                        <option value="{{ $factory->id }}" {{ ($f->id == $factory->id) ? 'selected' : '' }}>
                                            {{ $factory->title }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Select a factory name...</div>
                            </div>

                            <div class="form-group">
                                <label for="site_id">Site</label>
                                <select class="custom-select select2 site" id="site_id" name="site_id"
                                        style="width: 100%" required>
                                    <option value=""></option>
                                </select>
                                <div class="invalid-feedback">Select a site name...</div>
                            </div>

                            <div class="form-group">
                                <label for="component_id">Component (optional)</label>
                                <select class="custom-select select2" id="component_id" name="component_id"
                                        style="width: 100%">
                                    <option value="">Not Applicable</option>
                                </select>
                                <div class="invalid-feedback">Select a component name...</div>
                            </div>

                            <div class="form-group">
                                <label for="device_serial">Device</label>
                                <select class="custom-select select2" id="device_serial" name="device_serial"
                                        style="width: 100%" required>
                                    <option value="">Select Device</option>
                                    @foreach($devices as $device)
                                        <option value="{{ $device->serial_number }}" {{ ($dataFile->device->id == $device->id) ? 'selected' : '' }}>
                                            {{ $device->serial_number }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Select a device name...</div>
                            </div>

                            <div class="form-group">
                                <label for="data-file">Data file</label>
                                <input type="file" class="form-control-file" name="file" id="data-file" required>
                                <div class="invalid-feedback">Data file needs to be selected.</div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Upload Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
