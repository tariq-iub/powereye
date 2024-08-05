@extends('layouts.powereye')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
            <li class="breadcrumb-item active">Edit Role</li>
        </ol>
    </nav>

    <div class="mb-5">
        <h2 class="text-bold text-body-emphasis">Edit Role</h2>
        <p class="text-body-tertiary lead">
            Edit a previous user role.
        </p>
    </div>

    <form action="{{ route('roles.update', $role->id) }}" method="POST">
        @csrf
        @method('put')

        <div class="mb-5">
            <div class="form-group">
                <label for="title">Role Title</label>
                <input type="text" class="form-control" id="title" name="title"
                       value="{{ $role->title }}" required>
            </div>
        </div>

        <div class="mb-5">
            <label for="menus">Attach Menus</label>

            <select class="form-select" id="menus" name="menus[]" data-choices="data-choices" multiple="multiple" data-options='{"removeItemButton":true,"placeholder":true}'>
                <option value="">Select Menu...</option>
                @foreach($menus as $menu)
                    <option value="{{ $menu->id }}" {{ $role->menus->contains($menu->id) ? 'selected' : '' }} data-custom-properties="[object Object]">{{ $menu->title }}</option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-primary mt-3">Update Role</button>
        </div>
    </form>
@endsection
