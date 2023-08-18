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
          @include('livewire.encuesta.crear-encuesta')
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