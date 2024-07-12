@extends('layouts.powereye')

@section('content')
    <h2 class="mb-2 lh-sm">Factories</h2>
    <p class="text-body-tertiary lead mb-2">
        Manage factory registration process.
    </p>

    <div class="card shadow-none border mb-3" data-component-card="data-component-card">
        <div class="card-header p-4 border-bottom bg-body">
            <div class="row g-3 justify-content-between align-items-center">
                <div class="col-12 col-md">
                    <h4 class="text-body mb-0" data-anchor="data-anchor" id="factory-list">
                        Factories List
                    </h4>
                </div>
                <div class="col col-md-auto">
                    <nav class="nav justify-content-end doc-tab-nav align-items-center" role="tablist">
                        <a role="button" class="btn btn-sm btn-phoenix-primary ms-2" href="{{ route('factories.create') }}">
                            <span class="me-2" data-feather="plus-square"></span>Add Factory
                        </a>
                    </nav>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="p-4">
                <div id="tableExample4">
                    <div class="row justify-content-end g-0">
                        <div class="col-auto px-3">
                            <select class="form-select form-select-sm mb-3" data-list-filter="data-list-filter">
                                <option selected="" value="">Select payment status</option>
                                <option value="Pending">Pending</option>
                                <option value="Success">Success</option>
                                <option value="Blocked">Blocked</option>
                            </select>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover fs-8s mb-0">
                            <thead>
                            <tr class="bg-body-highlight">
                                <th class="border-top border-translucent ps-3" data-sort="name">Factory Detail</th>
                                <th class="border-top border-translucent">Owner's Detail</th>
                                <th class="border-top border-translucent" data-sort="email">Email</th>
                                <th class="border-top border-translucent">Contact No</th>
                                <th class="border-top border-translucent">Actions</th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @foreach($factories  as $row)
                            <tr>
                                <td class="align-middle ps-3">
                                    {{ $row->title }}
                                    <div class="small">
                                        {{ $row->address }}
                                    </div>
                                </td>
                                <td class="align-middle">
                                    {{ $row->owner_name }}
                                    <div class="small">
                                        {{ $row->owner_cnic }}
                                    </div>
                                </td>
                                <td class="align-middle email">{{ $row->email }}</td>
                                <td class="align-middle">{{ $row->contact_no }}</td>
                                <td class="align-middle white-space-nowrap text-end pe-2">
                                    <div class="btn-reveal-trigger position-static">
                                        <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10"
                                                type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                                            <svg class="svg-inline--fa fa-ellipsis fs-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="ellipsis" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                                <path fill="currentColor" d="M8 256a56 56 0 1 1 112 0A56 56 0 1 1 8 256zm160 0a56 56 0 1 1 112 0 56 56 0 1 1 -112 0zm216-56a56 56 0 1 1 0 112 56 56 0 1 1 0-112z"></path>
                                            </svg>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end py-2" style="">
                                            <a class="dropdown-item" href="#!">Edit</a>
                                            <a class="dropdown-item" href="">Link User</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="#!">Remove</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add-factory" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Add Factory
                    </h5>
                    <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close">
                        <span class="fas fa-times fs-9"></span>
                    </button>
                </div>

                <form id="posted" class="needs-validation" novalidate>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label" for="title">Factory Name</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                                <div class="invalid-feedback">Factory name is required.</div>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label" for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address" required>
                                <div class="invalid-feedback">Factory address is required.</div>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label" for="owner_name">Owner Name</label>
                                <input type="text" class="form-control" id="owner_name" name="owner_name" required>
                                <div class="invalid-feedback">Owner name is required.</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="owner_cnic">CNIC No</label>
                                <input type="text" class="form-control" id="owner_cnic" name="owner_cnic">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="contact_no">Contact No</label>
                                <input type="text" class="form-control" id="contact_no" name="contact_no">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="email">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                                <div class="invalid-feedback">Email address is required.</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel</button>
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
                ajax: "{{ route('factories.index') }}",
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
