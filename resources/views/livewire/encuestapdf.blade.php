<div>
   <h3>{{ $encuesta->nombre }}</h3>
   @foreach ($preguntas as $key => $pregunta)
      <div class="pb-4">&nbsp;</div>
         <div class="row">
            <div class="col-7 pb-10">
               <p>Pregunta {{ ($key+1) }}  - {{ $pregunta->pregunta }}</p>
                  @if ($pregunta->tipo == 1)
                  <div class="form-check ps-0">
                     <input class="form-check-input" type="radio" value="Si" name="opcion{{ $pregunta->id }}" @if ($respuestas[$pregunta->id][0] == "Si") checked @endif> Si
                  </div>
                  <div class="form-check ps-0">
                     <input class="form-check-input" type="radio" value="No" name="opcion{{ $pregunta->id }}" id="opcion_{{ $pregunta->id }}" @if ($respuestas[$pregunta->id][0] == "No") checked @endif> No
                  </div>
                  @elseif ($pregunta->tipo == 2)
                     <p>{{ $respuestas[$pregunta->id][0] }}</p>
                  @else
                     <div class="form-check ps-0 pe-0">
                        @foreach (json_decode($pregunta->opciones) as $key2 => $opcion)
                              <input class="form-check-input" type="checkbox" value="{{ $opcion }}" id="check_{{ $pregunta->id }}_{{ $key2 }}" @if ($respuestas[$pregunta->id][$key2] != "" || $respuestas[$pregunta->id][$key2] != false) checked @endif>{{ $opcion }}<br>
                        @endforeach
                     </div>
                  @endif
            </div>
         </div>
      </div>
   @endforeach
</div>

