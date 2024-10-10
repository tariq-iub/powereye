@extends('layouts.powereye')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
            <li class="breadcrumb-item active">Create Role</li>
        </ol>
    </nav>

    <div class="mb-5">
        <h2 class="text-bold text-body-emphasis">Create Role</h2>
        <p class="text-body-tertiary lead">Add a new role item.</p>
    </div>

    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <!-- Add your form fields here -->
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <button type="submit" class="btn btn-primary">Save Role</button>
    </form>
@endsection
