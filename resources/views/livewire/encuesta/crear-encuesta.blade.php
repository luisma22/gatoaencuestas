<div wire:loading.remove wire:target="editar" >
<form>
    <div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-10">
                <div class="form-floating mb-3">
                <input wire:model.defer="nombre" type="text" class="form-control border border-2 p-2" id="floatingInput" wire:click = "seleccionar('nombre')" name="floatingInput">
                <label for="floatingInput">Nombre</label>
                    @error('nombre')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
                </div></div>
            <div class="col-2">
                <button type="button" class="btn btn{{ $estilo_microfono }} mb-0" wire:click="voz()">
                    <i class="material-icons text-sm">mic</i>
                </button>
            </div>
        </div>
        <div class="form-floating mt-1">
            <div class="row">
                <div class="col-xl-7 col-md-7 col-sm-12">
                    <textarea rows="5" wire:model.defer="descripcion" type="text" class="form-control border border-2 p-2" placeholder="Descripcion" id="floatingText" wire:click = "seleccionar('descripcion')"></textarea>
                    @error('descripcion')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
                </div>
                <div class="col-xl-5 col-md-5 col-sm-12">
                    @include('livewire.encuesta.colores')
                </div>
            </div>
        </div>
    </div>
    </div>
</form>
<hr>
<div class="row">
    <div class="col-xl-4 col-sm-6 mb-xl-4 mb-4">
    <div class="text-center" role="alert">Encuesta - Preguntas</div>
    <ul class="list-group" wire:sortable="updateTaskOrder">
    @foreach ($preguntas_encuesta as $pregunta)
        <li class="list-group-item d-flex justify-content-between align-items-start" wire:sortable.item="{{ $pregunta->id }}" wire:key="task-{{ $pregunta->id }}">
        <div class="ms-2 me-auto" >
            <div class="fw-bold text-break" wire:sortable.handle>{{ $pregunta->pregunta }}</div>
            <button type="button" class="btn btn-danger btn-sm" wire:click="quitar({{ $pregunta->id }})">
            <i class="material-icons text-sm">delete</i>
            </button>
        </div>
        </li>
    @endforeach
    </ul>
</div>
</div>
<div class="row" style="height: 1500px;">
@livewire('encuesta.preguntas')
</div>
</div>