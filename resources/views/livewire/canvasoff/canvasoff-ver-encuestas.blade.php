<div wire:ignore.self class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample1" aria-labelledby="veroffcanvasExampleLabel">
    <div wire:loading class="offcanvas-header">
        <h1 class="modal-title fs-5" ><i class="material-icons md-48">hourglass_top</i>Cargando...</h1>
      </div>
    <div class="offcanvas-header" wire:loading.remove>
        <h1 class="modal-title fs-5" id="offcanvasExample1">{{ $texto_modal }}</h1>
        <div>
          <button type="button" class="btn btn-success mb-0" wire:click="cancelar" data-bs-dismiss="offcanvas">Cerrar</button>
        </div>
    </div>
    <div class="offcanvas-body">
        @include('livewire.encuesta.ver-encuesta')
    </div>
</div>
