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
            <ul class="list-group">
                @foreach ($encuesta_ver->preguntas ?? [] as $todaspregunta)
                    <li class="list-group-item justify-content-between align-items-start">
                    <div class="ms-2 me-auto" >
                        <div class="fw-bold text-break" >{{ $todaspregunta->pregunta }}</div>
                        @if ($todaspregunta->tipo == 1)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault{{ $todaspregunta->id }}" id="flexRadioDefault1{{ $todaspregunta->id }}" disabled>
                            <label class="form-check-label" for="flexRadioDefault1{{ $todaspregunta->id }}">
                              Si
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault{{ $todaspregunta->id }}" id="flexRadioDefault2{{ $todaspregunta->id }}" disabled checked>
                            <label class="form-check-label" for="flexRadioDefault2{{ $todaspregunta->id }}">
                              No
                            </label>
                          </div>
                        @elseif ($todaspregunta->tipo == 2)
                          <textarea class="form-control border border-2 p-2" id="floatingInput{{ $todaspregunta->id }}" disabled></textarea>
                        @else
                        @foreach (json_decode($todaspregunta->opciones) as $key => $value) 
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault{{ $key }}" checked disabled>
                            <label class="form-check-label" for="flexCheckDefault{{ $key }}">
                                {{ $value }}
                            </label>
                          </div>
                        @endforeach
                        @endif    
                    </div>
                    </li>
                @endforeach
                </ul>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger mb-0" data-bs-dismiss="modal">
                <i class="material-icons text-sm">close</i>
            </button>
        </div>
      </div>
    </div>
  </div>