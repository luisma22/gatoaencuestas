<style>
h1, .h1, .h1, h2, .h2, .h2, h3, .h3, .h3, h4, .h4, .h4 {
   letter-spacing: -0.05rem;
   color: #7b809a;
}
p {
    line-height: 1.625;
    font-weight: 300;
    color: #7b809a;
}
p, .p {
    font-size: 1rem;
    color: #7b809a;
}
p.texto-llenado {
   padding-left: 1.73em;
}
.row {
   display: flex;
   flex-wrap: wrap;
   color: #7b809a;
}
.col-12 {
    flex: 0 0 auto;
    width: 98%;
}

.pb-0 {
   padding-bottom: 0rem !important;
}

.form-check {
    display: block;
    min-height: auto;
    padding-left: 1.73em;
    margin-bottom: 0;
    color: #7b809a;
}
.form-check:not(.form-switch) .form-check-input[type="checkbox"]:after {
    transition: opacity 0.25s ease-in-out;
    width: 100%;
    height: 100%;
    color: #fff;
    position: absolute;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 0.67rem;
    opacity: 0;
    border: 2px solid black;
    border-radius: 3px;
}
.form-check-label {
    font-weight: 400;
}
label, .form-label {;
    color: #7b809a;
    padding-top: -2px;
    margin-left: 0.25rem;
}
.text-justify {
    text-align: justify !important;
}
.text-center {
    text-align: center !important;
}
</style>
<div>
   <div class="text-center">
      <h2>{{ $encuesta->nombre }}</h2>
   </div>
   <div class="text-justify">
      <p>{{ $encuesta->descripcion }}</p>
   </div>
   @foreach ($preguntas as $key => $pregunta)
         <div class="row">
            <div class="col-12 pb-0">
               <p>Pregunta {{ ($key+1) }}  - {{ $pregunta->pregunta }}</p>
                  @if ($pregunta->tipo == 1)
                  <div class="form-check ps-0">
                     <input class="form-check-input btn-check" type="radio" value="Si" name="opcion{{ $pregunta->id }}" @if ($respuestas[$pregunta->id][0] == "Si") checked @endif>
                     <label class="form-check-label" for="opcion{{ $pregunta->id }}">
                        Si
                     </label>
                  </div>
                  <div class="form-check ps-0">
                     <input class="form-check-input" type="radio" value="No" name="opcion{{ $pregunta->id }}" id="opcion_{{ $pregunta->id }}" @if ($respuestas[$pregunta->id][0] == "No") checked @endif>
                     <label class="form-check-label" for="opcion_{{ $pregunta->id }}">
                        No
                     </label>
                  </div>
                  @elseif ($pregunta->tipo == 2)
                     <p class="texto-llenado pb-0 text-justify">@if ($respuestas[$pregunta->id][0] != "") {{ $respuestas[$pregunta->id][0] }} @else N/A @endif</p>
                  @else
                     @foreach (json_decode($pregunta->opciones) as $key2 => $opcion)
                        <div class="form-check pb-0">
                              <input class="form-check-input" type="checkbox" value="{{ $opcion }}" id="check_{{ $pregunta->id }}_{{ $key2 }}" @if ($respuestas[$pregunta->id][$key2] != "" || $respuestas[$pregunta->id][$key2] != false) checked @endif>
                              <label class="form-check-label" for="check_{{ $pregunta->id }}_{{ $key2 }}">
                                 {{ $opcion }}
                              </label>
                        </div>
                     @endforeach
                  @endif
            </div>
         </div>
      </div>
   @endforeach
</div>

