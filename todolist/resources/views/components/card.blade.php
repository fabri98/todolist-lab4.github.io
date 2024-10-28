<div class="card">

    <div class="card-header">
        @if (isset($header))
            {{ $header }}
        @else
            No hay header
        @endif
    </div>


    <div class="card-body" style="padding: 15px;">
        {{ $body }}
    </div>


    <div class="card-footer" style="padding: 15px; ">
        {{ $footer }}
    </div>
</div>