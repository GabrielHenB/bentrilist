{{-- attributes are being merged through the $attributes --}}
{{-- since $ativo is expected it should be inside props  --}}
@props(['ativo' => false])
<a {{$attributes(['class' =>"dropdown-item".($ativo ? ' bg-ativo' : '')])}}>
    {{ $slot }}
</a>
