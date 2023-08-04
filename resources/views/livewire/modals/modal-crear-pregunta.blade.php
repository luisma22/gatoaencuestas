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
                <div class="form-floating">
                  <input wire:model.defer="pregunta" type="text" class="form-control border border-2 p-2" id="floatingInput">
                  <label class="form-label" for="floatingInput">Pregunta</label>
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
                <button type="button" class="btn btn-success btn-sm me-2 mb-3" wire:click="add()">
                  <i class="material-icons text-sm">add</i> Añadir opcion
                </button>
                <ul class="list-group" wire:sortable="updateTaskOrder">
                    @foreach ($preguntas_opciones as $key => $pregunta)
                      <li class="list-group-item justify-content-between align-items-start" wire:sortable.item="{{ $key }}" wire:key="task-{{ $key }}">
                        <div class="row">
                            <div class="col-2">
                                <button type="button" class="btn btn-danger " wire:click="quitar({{ $key }})">
                                    <i class="material-icons text-sm">delete</i>
                                </button>
                            </div>   
                            <div class="col-10" wire:sortable.handle>
                                <input type="text"  wire:model.defer = 'preguntas_opciones.{{ $key }}' class="form-control border border-2 p-2">
                            </div>
                        </div>
                      </li>
                    @endforeach
                    </ul>
                @endif
              </div>
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