  <!-- Modal -->
  <div wire:ignore.self class="modal fade" id="verEncuesta" tabindex="-1" role="dialog" aria-labelledby="verEncuestaLabel" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen-xxxl-down modal-fullscreen-xxl-down modal-fullscreen-xl-down" >
      <div class="modal-content" wire:loading.remove>
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="verEncuestaLabel">{{ $encuesta_ver->nombre ?? ''}}</h1>
          <div>
            <button type="button" class="btn btn-danger mb-0" data-bs-dismiss="modal">
                <i class="material-icons text-sm">close</i>
            </button>
          </div>
        </div>
        <div class="modal-body">
          @include('livewire.encuesta.ver-encuesta')
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger mb-0" data-bs-dismiss="modal">
                <i class="material-icons text-sm">close</i>
            </button>
        </div>
      </div>
    </div>
  </div>