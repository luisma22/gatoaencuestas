<div wire:loading.remove wire:target="editar">
<form>
    <div class="form-floating">
      <div class="input-group mb-3">
        <input wire:model.defer="pregunta" type="text" class="form-control border border-2 p-2" wire:click = "seleccionar('pregunta')" id="voz">
        <button type="button" class="btn btn{{ $estilo_microfono }} mb-0" wire:click="voz()">
          <i class="material-icons text-sm">mic</i>
        </button>
      </div>
        @error('pregunta')
        <p class='text-danger inputerror'>{{ $message }} </p>
        @enderror
    </div>
    <div class="form-check form-check-inline pt-2">
        <input class="form-check-input" type="radio" wire:model="tipo" id="tipo1" value="1">
        <label class="form-check-label" for="tipo1">Si/No</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" wire:model="tipo" id="tipo2" value="2">
        <label class="form-check-label" for="tipo2">Completado</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" wire:model="tipo" id="tipo3" value="3">
        <label class="form-check-label" for="tipo3">Seleccion multiple</label>
      </div>
</form>
<hr>
<div class="row">
  <div class="col-xl-12 col-sm-12 mb-xl-12 mb-12">
    @if ($tipo == 1)
    <div class="text-center" role="alert"><span>Esta es una pregunta de Si o No</span></div>
    @elseif ($tipo == 2)
    <div class="text-center" role="alert"><span>Esta es una pregunta de completado en el que usted tendra un campo de texto donde debe llenar su respuesta</span></div>
    @else
    <div class="text-center" role="alert"> Pregunta de seleccion multiple llene sus opciones</div>
    <button type="button" class="btn btn-success btn-sm me-2 mb-2" wire:click="add()">
      <i class="material-icons text-sm">add</i> Añadir opcion
    </button>
    <button type="button" class="btn btn{{ $estilo_microfono }} btn-sm mb-2" wire:click="voz()">
      <i class="material-icons text-sm">mic</i>
    </button>
    <ul class="list-group" wire:sortable="updateTaskOrder">
        @foreach ($preguntas_opciones as $key => $pregunta)
          <li class="list-group-item justify-content-between align-items-start" wire:sortable.item="{{ $key }}" wire:key="task-{{ $key }}">
            <div class="row">
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <button type="button" class="btn btn-danger " wire:click="quitar({{ $key }})">
                        <i class="material-icons text-sm">delete</i>
                    </button>
                </div>   
                <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-xs-12">
                  <div class="row">
                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-2 col-xs-12 text-center" wire:sortable.handle><h3><i class="material-icons text-lg text-middle text-center text-4xl border-2">touch_app</i></h3></div>
                    <div class="col-xl-11 col-lg-11 col-md-11 col-sm-8 col-xs-12"><input type="text" wire:model.defer = 'preguntas_opciones.{{ $key }}' wire:click ="seleccionar('preguntas_opciones.{{ $key }}')" class="form-control border border-2 p-2"></div>
                  </div>
                </div>
            </div>
          </li>
        @endforeach
        </ul>
    @endif
  </div>
</div>
</div>