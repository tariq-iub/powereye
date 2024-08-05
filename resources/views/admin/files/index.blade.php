@extends('layouts.powereye')

@section('content')
<nav class="mb-3" aria-label="breadcrumb">
    <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
        <li class="breadcrumb-item active">Data Files</li>
    </ol>
</nav>

<div class="mb-5">
    <h2 class="text-bold text-body-emphasis">Data Files</h2>
    <p class="text-body-tertiary lead">
        Manage uploaded data files from devices.
    </p>
</div>

<div id="files" data-list='{"valueNames":["title", "site", "device", "factory"],"page":10,"pagination":true}'>
    <div class="row align-items-center justify-content-between g-3 mb-4">
        <div class="col col-auto">
            <div class="search-box">
                <form class="position-relative">
                    <input class="form-control search-input search" type="search" placeholder="Search files" aria-label="Search" />
                    <span class="fas fa-search search-box-icon"></span>
                </form>
            </div>
        </div>

        <div class="col-auto">
            <div class="d-flex align-items-center">
                <a class="btn btn-primary" href="{{ route('files.create') }}">
                    <span class="fas fa-plus me-2"></span>
                    Add File
                </a>
            </div>
        </div>
    </div>
    <div class="mx-n4 mx-lg-n6 px-4 px-lg-6 mb-9 bg-body-emphasis border-y mt-2 position-relative top-1">
        <div class="table-responsive scrollbar ms-n1 ps-1">
            <table class="table table-sm fs-9 mb-0">
                <thead>
                    <tr>
                        <th class="sort align-middle" scope="col">
                            #
                        </th>
                        <th class="sort align-middle" scope="col" data-sort="title" style="width:20%; min-width:200px;">
                            FILE TITLE
                        </th>
                        <th class="sort align-middle" scope="col" data-sort="device">
                            DEVICE
                        </th>
                        <th class="sort align-middle" scope="col" data-sort="site">
                            SITE
                        </th>
                        <th class="sort align-middle" scope="col" data-sort="factory" style="width:20%; min-width:200px;">
                            FACTORY
                        </th>
                        <th class="sort align-middle text-end" scope="col">

                        </th>
                    </tr>
                </thead>
                <tbody class="list" id="files-table-body">
                    @foreach($files as $file)
                    <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                        <td class="factory align-middle white-space-nowrap">
                            {{ $file->id }}
                        </td>
                        <td class="customer align-middle white-space-nowrap">
                            <a class="d-flex align-items-center text-body text-hover-1000" href="#">
                                <h6 class="fw-semibold">{{ $file->file_name }}</h6>
                            </a>
                        </td>
                        <td class="factory align-middle white-space-nowrap">
                            {{ $file->device->serial_number }}
                        </td>
                        <td class="email align-middle white-space-nowrap">
                            {{ $file->site->title }}
                        </td>
                        <td class="email align-middle white-space-nowrap">
                            {{ $file->site->factory->title }}
                        </td>
                        <td class="actions align-middle text-end white-space-nowrap text-body-tertiary">
                            <div class="btn-reveal-trigger position-static">
                                <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                                    <svg class="svg-inline--fa fa-ellipsis fs-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="ellipsis" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path fill="currentColor" d="M8 256a56 56 0 1 1 112 0A56 56 0 1 1 8 256zm160 0a56 56 0 1 1 112 0 56 56 0 1 1 -112 0zm216-56a56 56 0 1 1 0 112 56 56 0 1 1 0-112z">
                                        </path>
                                    </svg>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end py-2">
                                    <a class="dropdown-item" href="{{ route('files.edit', $file->id) }}">
                                        Edit
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <form action="#" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="dropdown-item text-danger" type="submit">Archive</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="row align-items-center justify-content-between py-2 pe-0 fs-9">
            <div class="col-auto d-flex" style="display: none !important;">
                {{ $files->links() }}
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-center">
            {{ $files->links() }}
        </div>




    </div>
</div>
@endsection
