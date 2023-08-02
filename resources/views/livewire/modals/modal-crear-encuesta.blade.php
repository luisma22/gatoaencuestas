  <!-- Modal -->
  <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen-xxxl-down modal-fullscreen-xxl-down modal-fullscreen-xl-down">
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
            <hr>
            <div class="row">
              <div class="text-center" role="alert">Preguntas</div>
              <div class="col-xl-4 col-sm-6 mb-xl-4 mb-4">
                <ul class="list-group" wire:sortable="updateTaskOrder">
                @foreach ($preguntas_encuesta as $pregunta)
                  <li class="list-group-item d-flex justify-content-between align-items-start" wire:sortable.item="{{ $pregunta->id }}" wire:key="task-{{ $pregunta->id }}">
                    <div class="ms-2 me-auto" >
                      <div class="fw-bold text-break" wire:sortable.handle>{{ $pregunta->pregunta }}</div>
                      <button type="button" class="btn btn-success btn-sm">
                        <i class="material-icons text-sm">add_circle</i>
                      </button>
                      @php
                      $cuerpo = "<div class='p-3'>";
                      $i=1;
                      @endphp
                      @if ($pregunta->tipo == 1)
                        @php
                          $cuerpo.= "<div><i class='material-icons text-sm md-dark'>radio_button_checked</i><span class='ps-2'>Si</span></div>";
                          $cuerpo.= "<div><i class='material-icons text-sm md-dark'>radio_button_unchecked</i><span class='ps-2'>No</span></div>";
                        @endphp
                      @elseif ($pregunta->tipo == 2)
                        @php
                            $cuerpo.= "<div><i class='material-icons text-sm md-dark'>message</i><span class='ps-2'>Esta es una pregunta para completar</span></div>";  
                          @endphp
                      @else
                        @foreach (json_decode($pregunta->opciones) as $key => $value) 
                        @php
                          if ($i == 1 || $i == 4 || $i == 5) {
                            $cuerpo.= "<div><i class='material-icons text-sm md-dark'>check_box</i><span class='ps-2'>".$value."</span></div>";
                          } else {
                            $cuerpo.= "<div><i class='material-icons text-sm md-dark'>check_box_outline_blank</i><span class='ps-2'>".$value."</span></div>";
                          }
                          $i++;
                        @endphp
                        @endforeach
                      @endif    
                      <button type="button" class="btn btn-sm btn-secondary" 
                        data-bs-trigger="hover click" 
                        data-bs-toggle="popover" 
                        data-bs-html="true" 
                        data-bs-title="PREGUNTA" 
                        data-bs-container="body"
                        data-bs-content="<b>{{ $pregunta->pregunta }}</b>{{ $cuerpo }}</div>">
                        <i class="material-icons text-sm">remove_red_eye</i>
                      </button>
                    </div>
                  </li>
                @endforeach
                </ul>
              </div>
              <div class="col-xl-4 col-sm-6 mb-xl-4 mb-4">
                <ul class="list-group">
                @foreach ($todaslaspreguntas as $todaspregunta)
                  <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto" >
                      <div class="fw-bold text-break" >{{ $todaspregunta->pregunta }}</div>
                      <button type="button" class="btn btn-success btn-sm">
                        <i class="material-icons text-sm">add_circle</i>
                      </button>
                      @php
                      $cuerpo = "<div class='p-3'>";
                      $i=1;
                      @endphp
                      @if ($todaspregunta->tipo == 1)
                        @php
                          $cuerpo.= "<div><i class='material-icons text-sm md-dark'>radio_button_checked</i><span class='ps-2'>Si</span></div>";
                          $cuerpo.= "<div><i class='material-icons text-sm md-dark'>radio_button_unchecked</i><span class='ps-2'>No</span></div>";
                        @endphp
                      @elseif ($todaspregunta->tipo == 2)
                        @php
                            $cuerpo.= "<div><i class='material-icons text-sm md-dark'>message</i><span class='ps-2'>Esta es una pregunta para completar</span></div>";  
                          @endphp
                      @else
                        @foreach (json_decode($todaspregunta->opciones) as $key => $value) 
                        @php
                          if ($i == 1 || $i == 4 || $i == 5) {
                            $cuerpo.= "<div><i class='material-icons text-sm md-dark'>check_box</i><span class='ps-2'>".$value."</span></div>";
                          } else {
                            $cuerpo.= "<div><i class='material-icons text-sm md-dark'>check_box_outline_blank</i><span class='ps-2'>".$value."</span></div>";
                          }
                          $i++;
                        @endphp
                        @endforeach
                      @endif    
                      <button type="button" class="btn btn-sm btn-secondary" 
                        data-bs-trigger="hover" 
                        data-bs-toggle="popover" 
                        data-bs-html="true" 
                        data-bs-title="PREGUNTA" 
                        data-bs-container="body"
                        data-bs-content="<b>{{ $todaspregunta->pregunta }}</b>{{ $cuerpo }}</div>">
                        <i class="material-icons text-sm">remove_red_eye</i>
                      </button>
                    </div>
                  </li>
                @endforeach
                </ul>
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