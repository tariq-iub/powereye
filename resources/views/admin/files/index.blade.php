@extends('layouts.powereye')
@section('page-title', 'Data Files')
@section('page-message', "Manage uploaded files with appropriate actions.")

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Uploaded Files</h4>
                    </div>
                    <a href="javascript:void(0)" class="btn btn-outline-primary"
                       data-toggle="modal" data-target=".bd-add-modal-lg">
                        <i class="ri-add-circle-line"></i>Add File
                    </a>
                </div>
                <div class="iq-card-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-hover table-bordered mt-4" style="width:100%">
                            <thead>
                            <tr>
                                <th>File Name</th>
                                <th>Device</th>
                                <th>Component</th>
                                <th>Site</th>
                                <th>Factory</th>
                                <th class="text-center">Uploaded At</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-add-modal-lg" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="posted" method="POST" action=""
                      class="needs-validation" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="factory_id">Factory</label>
                            <select class="custom-select select2" id="factory_id" style="width: 100%" required>
                                <option value="">Select Factory</option>
                                @foreach($factories as $factory)
                                    <option value="{{ $factory->id }}">{{ $factory->title }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Select a factory name...</div>
                        </div>

                        <div class="form-group">
                            <label for="site_id">Site</label>
                            <select class="custom-select select2" id="site_id" name="site_id"
                                    style="width: 100%" required>
                                <option value="">Select Site</option>
                            </select>
                            <div class="invalid-feedback">Select a site name...</div>
                        </div>

                        <div class="form-group">
                            <label for="component_id">Component (optional)</label>
                            <select class="custom-select select2" id="component_id" name="component_id" style="width: 100%">
                                <option value="">Not Applicable</option>
                            </select>
                            <div class="invalid-feedback">Select a component name...</div>
                        </div>

                        <div class="form-group">
                            <label for="device_serial">Device</label>
                            <select class="custom-select select2" id="device_serial" name="device_serial" style="width: 100%" required>
                                <option value="">Select Device</option>
                                @foreach($devices as $device)
                                    <option value="{{ $device->serial_number }}">{{ $device->serial_number }}</option>
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

    <div class="modal fade bd-replace-modal-lg" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Replace File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="replace-form" method="POST" action=""
                      class="needs-validation" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="record-id" name="id" value="">
                        <div class="form-group">
                            <label for="data-file">Data file</label>
                            <input type="file" class="form-control-file" name="file" id="data-file" required>
                            <div class="invalid-feedback">Data file needs to be selected.</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Replace File</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function () {
            var table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('files.index') }}",
                columns: [
                    {data: 'file_name', name: 'file_name'},
                    {data: 'device', name: 'device'},
                    {data: 'component', name: 'component'},
                    {data: 'site', name: 'site'},
                    {data: 'factory', name: 'factory'},
                    {data: 'uploaded_at', name: 'uploaded_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                createdRow: function (row, data, dataIndex) {
                    $('td', row).eq(0).addClass('text-center');
                    $('td', row).eq(7).addClass('text-center');
                    $('td', row).eq(8).addClass('text-center');
                },
            });
        });

        function deleteFile(ctrl, id) {
            if (confirm('Are you sure to delete this file?')) {
                fetch(`{{ url('data') }}/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                    alert(data.message);
                    $(ctrl).closest('tr').hide().remove();
                });
            }
        }

        $("#factory_id").on("change", function() {
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
                    $("#site_id").append(`<option value=''>Select Site</option>`);
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

        const form = document.querySelector('#posted');
        form.addEventListener("submit", (event) => {
            event.preventDefault();

            const formData = new FormData(form);
            fetch("{{ url('api/data/upload') }}", {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    location.reload();
                });
        });

        function OpenReplaceModal(id)
        {
            $("#record-id").val(id);
            $(".bd-replace-modal-lg").modal('show');
        }

        const form2 = document.querySelector('#replace-form');
        form2.addEventListener("submit", (event) => {
            event.preventDefault();

            const formData = new FormData(form2);
            fetch(`{{ url('api/data/replace') }}`, {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    location.reload();
                });
        });
    </script>
@endpush
