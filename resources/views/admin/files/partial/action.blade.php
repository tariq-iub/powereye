<div class="btn-group">
    <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-ellipsis-v"></i>
    </button>

    <ul class="dropdown-menu dropdown-menu-right">
        <li>
            <a class="dropdown-item" href="{{ route('files.download', $row->id) }}">
                <i class="ri-download-cloud-2-line"></i> Download
            </a>
        </li>

        <li>
            <a class="dropdown-item" href="javascript:void(0)" onclick="OpenEditModal({{ $row->id }})">
                <i class="ri-pencil-line"></i> Edit
            </a>
        </li>

        <li>
            <a class="dropdown-item" href="javascript:void(0)" onclick="OpenReplaceModal({{ $row->id }})">
                <i class="ri-corner-up-left-double-fill"></i> Replace
            </a>
        </li>

        <li>
            <a class="dropdown-item text-danger" href="javascript:void(0)" onclick="deleteFile(this, {{ $row->id }})">
                <i class="ri-delete-bin-line"></i> Delete
            </a>
        </li>
    </ul>
</div>

{{--<div class="d-flex align-items-center list-user-action">--}}
{{--    <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="Download"--}}
{{--       href="{{ route('files.download', $row->id) }}"><i class="ri-download-cloud-2-line"></i>--}}
{{--    </a>--}}
{{--    <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="Edit"--}}
{{--       href="{{ route('files.edit', $row->id) }}">--}}
{{--        <i class="ri-pencil-line"></i>--}}
{{--    </a>--}}
{{--    <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="Replace"--}}
{{--       href="javascript:void(0)" onclick="OpenReplaceModal({{ $row->id }})">--}}
{{--        <i class="ri-corner-up-left-double-fill"></i>--}}
{{--    </a>--}}
{{--    <a class="iq-bg-danger" data-toggle="tooltip" data-placement="top" title="Delete"--}}
{{--       onclick="deleteFile(this, {{ $row->id }})" href="javascript:void(0)">--}}
{{--       <i class="ri-delete-bin-line"></i>--}}
{{--    </a>--}}
{{--</div>--}}
