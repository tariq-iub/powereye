@php
    $inspection = $row->inspection;
@endphp
@if($inspection)
    <div class="text-center text-nowrap">
        {{ $inspection->title . ' (' . $inspection->type . ')' }}
        <br>
        <span class="iq-bg-dark font-size-10 p-1">
            {{ $inspection->scheduled_at->format('d-m-Y') }}
        </span>
    </div>
@else
    ""
@endif
