@extends('layouts.powereye')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ url('/home') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">Roles</li>
        </ol>
    </nav>

    <div class="mb-5">
        <h2 class="text-bold text-body-emphasis">Roles</h2>
        <p class="text-body-tertiary lead">Manage the user roles.</p>
    </div>
    <div id="roles" data-list='{"valueNames":["id","title","menus-count"],"page":10,"pagination":true}'>
        <div class="row align-items-center justify-content-between g-3 mb-4">
            <div class="col col-auto">
                <div class="search-box">
                    <form class="position-relative">
                        <input class="form-control search-input search" type="search" placeholder="Search roles" aria-label="Search" />
                        <span class="fas fa-search search-box-icon"></span>
                    </form>
                </div>
            </div>

            <div class="col-auto">
                <div class="d-flex align-items-center">
                    <a class="btn btn-primary" href="{{ route('roles.create') }}">
                        <span class="fas fa-plus me-2"></span>Add role
                    </a>
                </div>
            </div>
        </div>

        <div class="mx-n4 mx-lg-n6 px-4 px-lg-6 mb-9 bg-body-emphasis border-y mt-2 position-relative top-1">
            <div class="table-responsive scrollbar ms-n1 ps-1">
                <table class="table table-sm fs-9 mb-0">
                    <thead>
                    <tr>
                        <th class="sort align-middle" scope="col" data-sort="id" style="width:15%; min-width:200px;">
                            ROLE ID
                        </th>
                        <th class="sort align-middle" scope="col" data-sort="title" style="width:15%; min-width:200px;">
                            ROLE TITLE
                        </th>
                        <th class="sort align-middle pe-3" scope="col" data-sort="menus-count" style="width:20%; min-width:200px;">
                            MENUS ATTACHED
                        </th>
                        <th class="sort align-middle" scope="col" style="width:10%;">
                            CREATED AT
                        </th>
                        <th class="sort align-middle text-end" scope="col" style="width:20%;  min-width:200px;">
                            ACTIONS
                        </th>
                    </tr>
                    </thead>
                    <tbody class="list" id="roles-table-body">
                    @foreach($roles as $role)
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="align-middle ps-3">
                                <h6 class="fw-semibold">{{ $role->id }}</h6>
                            </td>
                            <td class="align-middle">
                                {{ $role->title }}
                            </td>
                            <td class="align-middle">
                                @if ($role->id === 1)
                                    <span>All</span>
                                @else
                                    @if ($role->menus->isEmpty())
                                        <span>0</span>
                                    @else
                                        @foreach($role->menus as $sm)
                                            @if ($sm->subMenus->isEmpty() || $sm->parent_id )
                                            <div class="status align-middle white-space-nowrap">
                                                <span class="badge badge-phoenix fs-10 badge-phoenix-success">
                                                    <span class="badge-label">{{$sm->title}}</span>
                                                </span>
                                            </div>
                                            @endif
                                        @endforeach
                                    @endif
                                @endif


                            </td>
                            <td class="align-middle text-body">
                                {{ $role->created_at->format('d-m-Y h:i:s A') }}
                            </td>
                            <td class="align-middle text-end white-space-nowrap text-body-tertiary">
                                <div class="btn-reveal-trigger position-static">
                                    <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg class="svg-inline--fa fa-ellipsis fs-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="ellipsis" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                            <path fill="currentColor" d="M8 256a56 56 0 1 1 112 0A56 56 0 1 1 8 256zm160 0a56 56 0 1 1 112 0 56 56 0 1 1 -112 0zm216-56a56 56 0 1 1 0 112 56 56 0 1 1 0-112z"></path>
                                        </svg>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end py-2">
                                        <a class="dropdown-item" href="{{ route('roles.edit', $role->id) }}">Edit</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row align-items-center justify-content-between py-2 pe-0 fs-9">
                <div class="col-auto d-flex">
                    <p class="mb-0 d-none d-sm-block me-3 fw-semibold text-body" data-list-info="data-list-info"></p>
                    <a class="fw-semibold" href="#!" data-list-view="*">View all<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a><a class="fw-semibold d-none" href="#!" data-list-view="less">View Less<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
                </div>
                <div class="col-auto d-flex"><button class="page-link" data-list-pagination="prev"><span class="fas fa-chevron-left"></span></button>
                    <ul class="mb-0 pagination"></ul><button class="page-link pe-0" data-list-pagination="next"><span class="fas fa-chevron-right"></span></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push("scripts")

@endpush
