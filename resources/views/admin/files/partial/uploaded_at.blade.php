<div class="text-center">
    {{ $row->created_at->format('d-m-Y') }}
    <br>
    <span class="iq-bg-dark font-size-10 p-1">
        {{ $row->created_at->format('h:i:s A') }}
    </span>
</div>

