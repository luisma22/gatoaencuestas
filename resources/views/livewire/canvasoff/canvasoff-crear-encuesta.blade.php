<div wire:ignore.self class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div wire:loading class="offcanvas-header" wire:target="editar">
    <h1 class="modal-title fs-5" ><i class="material-icons md-36">hourglass_top</i>Cargando...</h1>
  </div>
    <div class="offcanvas-header row" wire:loading.remove wire:target="editar">
      <div class="col-xl-6 col-lg-6 col-md-7 col-12 pb-1">
        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $texto_modal }}</h1>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-4 col-12">
        <div class="row">
          <div class="col-xl-6 col-lg-6 col-md-6 col-6">
            <button type="button" class="btn btn-danger mb-1" wire:click="cancelar" data-bs-dismiss="offcanvas">Cancelar</button>
          </div>
          <div class="col-xl-6 col-lg-6 col-md-6 col-6">
            @if($editar)
              <button type="button" class="btn btn-success mb-1 close-modal" wire:click.prevent="actualizar">Actualizar</button>
            @else
              <button type="button" class="btn btn-success mb-1 close-modal" wire:click.prevent="crear">Crear</button>
            @endif
          </div>
        </div>
      </div>
      <div class="col-1 m-0 p-0"></div>
    <div class="offcanvas-body">
        @include('livewire.encuesta.crear-encuesta')
    </div>
</div>