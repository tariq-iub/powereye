@extends('layouts.powereye')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="https://care.ibizz.online/home">Home</a></li>
            <li class="breadcrumb-item"><a href="https://care.ibizz.online/menus">Menus</a></li>
            <li class="breadcrumb-item active">Create Menu</li>
        </ol>
    </nav>

    <form action="{{ route('menus.store') }}" method="POST">
        @csrf
        <div class="row g-3 flex-between-end mb-5">
            <div class="col-auto">
                <h2 class="mb-2">Add a Menu</h2>
                <h5 class="text-body-tertiary fw-semibold">
                    Add menu for users.
                </h5>
            </div>
            <div class="col-auto">
                <a href="{{ route('menus.index') }}" class="btn btn-phoenix-secondary me-2 mb-2 mb-sm-0">Discard</a>
                <button class="btn btn-primary mb-2 mb-sm-0" type="submit">Add menu</button>
            </div>
        </div>

        <div class="row g-5">
            <div class="col-12 col-xl-8">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control " id="title" name="title" value="" required="">
                </div>

                <div class="mb-3">
                    <label for="icon" class="form-label">Icon</label>
                    <input type="text" class="form-control " id="icon" name="icon" value="">
                </div>

                <div class="mb-3">
                    <label for="parent_id" class="form-label">Parent Menu</label>
                    <select class="form-select " id="parent_id" name="parent_id">
                        <option value="">None</option>
                        @foreach($menus as $pm)
                            <option value="{{$pm->id}}">
                                {{$pm->title}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="display_order" class="form-label">Display Order</label>
                    <input type="number" class="form-control " id="display_order" name="display_order" value="0">
                </div>

                <div class="mb-3">
                    <label for="level" class="form-label">Level</label>
                    <select class="form-select " id="level" name="level">
                        <option value="admin">Admin</option>
                        <option value="client">Client</option>
                    </select>
                </div>

                <div class="mb-3">
                    <div class="d-flex flex-wrap mb-2">
                        <h5 class="mb-0 text-body-highlight me-2">Status</h5>
                    </div>
                    <select class="form-select " id="status" name="status">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="col-12 col-xl-4">
                <div class="row g-2">
                    <div class="col-12 col-xl-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Organize</h4>
                                <div class="row gx-3">
                                    <div class="col-12 col-sm-6 col-xl-12">
                                        <div class="mb-4">
                                            <div class="d-flex flex-wrap mb-2">
                                                <h5 class="mb-0 text-body-highlight me-2">Route</h5>
                                            </div>
                                            <input type="text" class="form-control " id="route" name="route" value="">
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6 col-xl-12">
                                        <div class="mb-4">
                                            <div class="d-flex flex-wrap mb-2">
                                                <h5 class="mb-0 text-body-highlight me-2">URL</h5>
                                            </div>
                                            <input type="text" class="form-control " id="url" name="url" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
