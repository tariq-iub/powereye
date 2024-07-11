@extends('layouts.powereye')

@section('content')

    <div class="card shadow-none border mb-3" data-component-card="data-component-card">
        <div class="card-header p-4 border-bottom bg-body">
            <h4 class="text-body mb-0" id="factory-list">
                New Factory
            </h4>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('factories.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="row g-3">
                    <div class="col-md-12 mb-2">
                        <label class="form-label text-body" for="title">Factory Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" required>
                        <div class="invalid-feedback">
                            Provide complete factory name.
                        </div>
                    </div>

                    <div class="col-md-12 mb-2">
                        <label class="form-label text-body" for="address">Factory Address <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="address" name="address" required>
                        <div class="invalid-feedback">
                            Provide complete factory address.
                        </div>
                    </div>

                    <div class="col-md-6 mb-2">
                        <label class="form-label text-body" for="owner_name">Owner Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="owner_name" name="owner_name" required>
                        <div class="invalid-feedback">
                            Provide factory owner's name.
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label text-body" for="owner_cnic">Owner's CNIC</label>
                        <input type="text" class="form-control" id="owner_cnic" name="owner_cnic">
                    </div>

                    <div class="col-md-6 mb-2">
                        <label class="form-label text-body" for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        <div class="invalid-feedback">
                            Provide a valid email address for correspondence.
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label text-body" for="contact_no">Contact No</label>
                        <input type="text" class="form-control" id="contact_no" name="contact_no">
                    </div>

                    <div class="col-md-6 mb-2">
                        <label class="form-label text-body" for="fax">Fax</label>
                        <input type="text" class="form-control" id="fax" name="fax">
                    </div>

                </div>

                <button type="submit" class="btn btn-primary mt-3">Register New Factory</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#owner_cnic').mask('00000-0000000-0');
            $('#contact_no').mask('0000-0000000');
        });
    </script>
@endpush
