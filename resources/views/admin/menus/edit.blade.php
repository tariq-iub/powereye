@extends('layouts.powereye')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('menus.index') }}">Menus</a></li>
                <li class="breadcrumb-item active">Edit Menu</li>
            </ol>
        </nav>
    <form method="POST" action="{{ route('menus.update', $menu->id) }}">
            @csrf
            @method('PUT')
            <div class="row g-3 flex-between-end mb-5">
                <div class="col-auto">
                    <h2 class="mb-2">Edit Menu</h2>
                    <h5 class="text-body-tertiary fw-semibold">
                        Edit menu for users.
                    </h5>
                </div>
                <div class="col-auto">
                    <a href="{{ route('menus.index') }}" class="btn btn-phoenix-secondary me-2 mb-2 mb-sm-0">Discard</a>
                    <button class="btn btn-primary mb-2 mb-sm-0" type="submit">Update menu</button>
                </div>
            </div>

            <div class="row g-5">
                <div class="col-12 col-xl-8">
                    <input type="hidden" name="menu-id" value="{{$menu->id}}">

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input class="form-control" type="text" id="title" name="title" placeholder="Title"
                               value="{{ old('title', $menu->title) }}" required>
                        @if($errors->has('title'))
                            <div class="text-danger small">
                                {{ $errors->first('title') }}
                            </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="icon" class="form-label">Icon</label>
                        <input type="text" class="form-control" id="icon" name="icon" value="{{ old('icon', $menu->icon) }}">
                        @if($errors->has('icon'))
                            <div class="text-danger small">
                                {{ $errors->first('icon') }}
                            </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="parent_id" class="form-label">Parent Menu</label>
                        <select class="form-select " id="parent_id" name="parent_id">
                            @if ($menu->parent_id === null)
                                <option value="">None</option>
                            @else
                                <option value="{{ $menu->parent_id }}">{{ $menu->parent->title }}</option>
                            @endif
                            @foreach($parentMenus as $pm)
                                @if($pm->id !== $menu->id)
                                <option value="{{$pm->id}}">
                                    {{$pm->title}}
                                </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="display_order" class="form-label">Display Order</label>
                        <input type="number" class="form-control" id="display_order" name="display_order" value="{{ old('display_order', $menu->display_order) }}">
                        @if($errors->has('display_order'))
                            <div class="text-danger small">
                                {{ $errors->first('display_order') }}
                            </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="level" class="form-label">Level</label>
                        <select class="form-select" id="level" name="level">
                            <option value="admin">Admin</option>
                            <option value="client">Client</option>
                        </select>
                        @if($errors->has('level'))
                            <div class="text-danger small">
                                {{ $errors->first('level') }}
                            </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <div class="d-flex flex-wrap mb-2">
                            <h5 class="mb-0 text-body-highlight me-2">Status</h5>
                        </div>
                        <select class="form-select" id="status" name="status">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        @if($errors->has('status'))
                            <div class="text-danger small">
                                {{ $errors->first('status') }}
                            </div>
                        @endif
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
                                                <input type="text" class="form-control " id="route" name="route" value="{{old('route', $menu->route)}}">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-xl-12">
                                            <div class="mb-4">
                                                <div class="d-flex flex-wrap mb-2">
                                                    <h5 class="mb-0 text-body-highlight me-2">URL</h5>
                                                </div>
                                                <input type="text" class="form-control " id="url" name="url" value="{{old('url', $menu->url)}}">
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
