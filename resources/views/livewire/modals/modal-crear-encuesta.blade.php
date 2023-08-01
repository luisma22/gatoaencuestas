  <!-- Modal -->
  <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $texto_modal }}</h1>
        </div>
        <div class="modal-body">
            <form>
                <div class="form-floating">
                  <input wire:model.defer="nombre" type="text" class="form-control border border-2 p-2" id="floatingInput">
                  <label class="form-label" for="floatingInput">Nombre</label>
                    @error('nombre')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
                </div>
                <div class="form-floating mt-1">
                  <textarea wire:model.defer="descripcion" type="text" class="form-control border border-2 p-2" id="floatingText"></textarea>
                  <label class="form-label pt-1" for="floatingText">Descripcion</label>
                    @error('descripcion')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
                </div>
            </form>
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