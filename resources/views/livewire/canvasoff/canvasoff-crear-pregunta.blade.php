<div wire:ignore.self class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div wire:loading class="offcanvas-header" wire:target="editar">
    <h1 class="modal-title fs-5" ><i class="material-icons md-36">hourglass_top</i>Cargando...</h1>
  </div>
    <div class="offcanvas-header" wire:loading.remove wire:target="editar">
        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $texto_modal }}</h1>
        <div class="row">
            <button type="button" class="btn btn-danger mb-1" wire:click="cancelar" data-bs-dismiss="offcanvas">Cancelar</button>
            @if($editar)
              <button type="button" class="btn btn-success mb-1 close-modal" wire:click.prevent="actualizar">Actualizar</button>
            @else
              <button type="button" class="btn btn-success mb-1 close-modal" wire:click.prevent="crear">Crear</button>
            @endif
        </div>
    </div>
    <div class="offcanvas-body">
        @include('livewire.encuesta.crear-pregunta')
    </div>
</div>