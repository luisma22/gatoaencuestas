<div wire:ignore.self class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $texto_modal }}</h1>
        <div>
          <button type="button" class="btn btn-danger mb-0" wire:click="cancelar" data-bs-dismiss="offcanvas">Cancelar</button>
            @if($editar)
              <button type="button" class="btn btn-success mb-0 close-modal" wire:click.prevent="actualizar">Actualizar</button>
            @else
              <button type="button" class="btn btn-success mb-0 close-modal" wire:click.prevent="crear">Crear</button>
            @endif
        </div>
    </div>
    <div class="offcanvas-body">
        @include('livewire.encuesta.crear-pregunta')
    </div>
</div>