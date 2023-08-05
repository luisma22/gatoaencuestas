  <!-- Modal -->
  <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen-xxxl-down modal-fullscreen-xxl-down modal-fullscreen-xl-down" >
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $texto_modal }}</h1>
          <div>
            <button type="button" class="btn btn-danger mb-0" wire:click="cancelar" data-bs-dismiss="modal">Cancelar</button>
              @if($editar)
                <button type="button" class="btn btn-success mb-0 close-modal" wire:click.prevent="actualizar">Actualizar</button>
              @else
                <button type="button" class="btn btn-success mb-0 close-modal" wire:click.prevent="crear">Crear</button>
              @endif
          </div>
        </div>
        <div class="modal-body">
            <form>
              <div class="row">
                <div class="col-10">
                  <div class="form-floating">
                    <input wire:model.defer="nombre" type="text" class="form-control border border-2 p-2" id="floatingInput" wire:click = "seleccionar('nombre')">
                    <label class="form-label" for="floatingInput">Nombre</label>
                      @error('nombre')
                      <p class='text-danger inputerror'>{{ $message }} </p>
                      @enderror
                  </div>
                  <div class="form-floating mt-1">
                    <textarea wire:model.defer="descripcion" type="text" class="form-control border border-2 p-2" id="floatingText" wire:click = "seleccionar('descripcion')"></textarea>
                      @error('descripcion')
                      <p class='text-danger inputerror'>{{ $message }} </p>
                      @enderror
                  </div>
                </div>
                <div class="col-2">
                  <button type="button" class="btn btn{{ $estilo_microfono }} mb-0" wire:click="voz()">
                    <i class="material-icons text-sm">mic</i>
                  </button>
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
              @livewire('encuesta.preguntas')
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger mb-0" wire:click="cancelar" data-bs-dismiss="modal">Cancelar</button>
          @if($editar)
            <button type="button" class="btn btn-success mb-0 close-modal" wire:click.prevent="actualizar">Actualizar</button>
          @else
            <button type="button" class="btn btn-success mb-0 close-modal" wire:click.prevent="crear">Crear</button>
          @endif
        </div>
      </div>
    </div>
  </div>