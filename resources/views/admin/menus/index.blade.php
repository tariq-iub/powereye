@extends('layouts.powereye')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ url('/home') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">Menus</li>
        </ol>
    </nav>

    <div class="mb-5">
        <h2 class="text-bold text-body-emphasis">Menus</h2>
        <p class="text-body-tertiary lead">Manage the menu items.</p>
    </div>
    <div id="roles"
         data-list='{"valueNames":["title","route", "parent_menu", "display_order", "level", "status"],"page":10,"pagination":true}'>
        <div class="row align-items-center justify-content-between g-3 mb-4">
            <div class="col col-auto">
                <div class="search-box">
                    <form class="position-relative">
                        <input class="form-control search-input search" type="search" placeholder="Search menus"
                               aria-label="Search"/>
                        <span class="fas fa-search search-box-icon"></span>
                    </form>
                </div>
            </div>

            <div class="col-auto">
                <div class="d-flex align-items-center">
                    <a class="btn btn-primary" href="{{ route('menus.create') }}">
                        <span class="fas fa-plus me-2"></span>Add menu
                    </a>
                </div>
            </div>
        </div>

        <div class="mx-n4 mx-lg-n6 px-4 px-lg-6 mb-9 bg-body-emphasis border-y mt-2 position-relative top-1">
            <div class="table-responsive scrollbar ms-n1 ps-1">
                <table class="table table-sm fs-9 mb-0">
                    <thead>
                    <tr>
                        <th class="sort align-middle" scope="col" data-sort="title">
                            TITLE
                        </th>
                        <th class="sort align-middle" scope="col" data-sort="route" style="width:20%; min-width:200px;">
                            ROUTE
                        </th>
                        <th class="sort align-middle" scope="col" data-sort="parent_menu">
                            PARENT MENU
                        </th>
                        <th class="sort align-middle" scope="col" data-sort="display_order">
                            DISPLAY ORDER
                        </th>
                        <th class="sort align-middle" scope="col" data-sort="level" style="width:20%; min-width:200px;">
                            LEVEL
                        </th>
                        <th class="sort align-middle" scope="col" data-sort="status">
                            STATUS
                        </th>
                        <th class="sort align-middle text-end" scope="col">
                            ACTION
                        </th>
                    </tr>
                    </thead>
                    <tbody class="list" id="menus-table-body">
                    @foreach($menus as $menu)
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="align-middle ps-3">
                                <h6 class="fw-semibold">{{ $menu->title }}</h6>
                            </td>
                            <td class="align-middle">
                                <a class="fw-semibold" href="{{ $menu->route }}">{{ $menu->route }}</a>
                            </td>
                            <td class="align-middle">
                                <h6 class="fw-semibold">
                                    @if ($menu->parent)
                                        {{ $menu->parent->title }}
                                    @else
                                        None
                                    @endif
                                </h6>

                            </td>
                            <td class="align-middle text-body">
                                <h6 class="fw-semibold">{{ $menu->display_order }}</h6>
                            </td>
                            <td class="align-middle text-body">
                                <h6 class="fw-semibold">{{ $menu->level }}</h6>
                            </td>
                            <td class="align-middle text-body">
                                @if ($menu->status)
                                    <span class="badge bg-success">Active</span>
                                @endif
                            </td>
                            <td class="align-middle text-end white-space-nowrap text-body-tertiary">
                                <div class="btn-reveal-trigger position-static">
                                    <button
                                        class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10"
                                        type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <svg class="svg-inline--fa fa-ellipsis fs-10" aria-hidden="true"
                                             focusable="false" data-prefix="fas" data-icon="ellipsis" role="img"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                            <path fill="currentColor"
                                                  d="M8 256a56 56 0 1 1 112 0A56 56 0 1 1 8 256zm160 0a56 56 0 1 1 112 0 56 56 0 1 1 -112 0zm216-56a56 56 0 1 1 0 112 56 56 0 1 1 0-112z"></path>
                                        </svg>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end py-2">
                                        <a class="dropdown-item" href="{{ route('menus.edit', $menu->id) }}">Edit</a>
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
                    <a class="fw-semibold" href="#!" data-list-view="*">View all<span class="fas fa-angle-right ms-1"
                                                                                      data-fa-transform="down-1"></span></a><a
                        class="fw-semibold d-none" href="#!" data-list-view="less">View Less<span
                            class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
                </div>
                <div class="col-auto d-flex">
                    <button class="page-link" data-list-pagination="prev"><span class="fas fa-chevron-left"></span>
                    </button>
                    <ul class="mb-0 pagination"></ul>
                    <button class="page-link pe-0" data-list-pagination="next"><span
                            class="fas fa-chevron-right"></span></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push("scripts")

@endpush
