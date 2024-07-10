<div class="d-flex align-items-center list-user-action">
    <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="Download"
       href="{{ route('data.download', $row->id) }}"><i class="ri-download-cloud-2-line"></i>
    </a>
    <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="Edit"
       href="{{ route('data.edit', $row->id) }}">
        <i class="ri-pencil-line"></i>
    </a>
    <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="Replace"
       href="javascript:void(0)" onclick="OpenReplaceModal({{ $row->id }})">
        <i class="ri-corner-up-left-double-fill"></i>
    </a>
    <a class="iq-bg-danger" data-toggle="tooltip" data-placement="top" title="Delete"
       onclick="deleteFile(this, {{ $row->id }})" href="javascript:void(0)">
       <i class="ri-delete-bin-line"></i>
    </a>
</div>
