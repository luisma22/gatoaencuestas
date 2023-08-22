<div class="container-fluid" wire:loading.remove wire:target="editar">
    <div class="text-center">Colores Estadisticas</div>
    @foreach ($colores_seleccionados as $key => $color)
        <input wire:model.defer="colores_seleccionados.{{ $key }}" type="color" value="{{ $color }}" />
    @endforeach
    <div class="form-check form-switch ms-3 mt-3 me-4">
        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked1" wire:click="cambiarforma()" @if ($forma != 'pie') checked @endif>
        <label class="form-check-label" for="flexSwitchCheckChecked1"> @if ($forma == 'pie') Torta @else Torta Radial @endif</label>
    </div>
</div>