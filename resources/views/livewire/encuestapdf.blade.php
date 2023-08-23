<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
    font-size: 1.1rem;
    color: #7b809a;
}
p.texto-llenado {
   padding-left: .3rem;
}
.row {
   display: flex;
   flex-wrap: wrap;
   color: #7b809a;
   margin-left: 28px; 
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
    padding-left: 3rem;
    margin-bottom: 0;
    color: #7b809a;
}
.form-check-label {
   font-weight: 400;
   margin-top: -0.2rem;
   padding-top: -0.2rem;
}
label, .form-label {;
    color: #7b809a;
}
.text-justify {
   margin-left: 25px;
   margin-right: 55px;
   font-size: 1rem;
   text-align: justify !important;
   font-weight: 0;
}
.text2 {
   font-size: .85rem;
}
.text-center {
   margin-top: 65px;
   text-align: center !important;
}
.text-end {
    text-align: end !important;
}
.nombre {
   position: absolute;
   top: 100px;
   right: -85px;
   color: #7b809a;
}

.imagen {
   position: absolute;
   top: -20px;
   left: -10px;
   color: #7b809a;
}
.imagen img {
   position: absolute;
   top: -35px;
   left: -15px;

}
.nombre-dani {
   -webkit-transform: rotate(90deg); 
   -moz-transform: rotate(90deg);
   font-size: .9rem;
}
.nombre-instituto {
   position: absolute;
   top: 900px;
   left: -115px;
   color: #7b809a;
   -webkit-transform: rotate(-90deg); 
   -moz-transform: rotate(-90deg);
   font-size: .9rem;
}

.form-check-input {
   margin-top: -10px;
   padding-top: -10px;
}

.form-check-label {
   font-size: .8rem;
   color: #7b809a;
}

.tamano {
   font-size: 1rem;
}
.radio2 {
   margin-top: -13px !important;
}
</style>
<div>
   <div class="text-end imagen">
      <img width="150px" height="150px" src="data:image/png;base64,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" />
   </div>
   <div class="nombre-dani nombre">Daniela Miranda Rocha</div>
   <div class="nombre-instituto">Instituto Tecnologico INFOCAL</div>
   <div class="text-center tamano">
      <h4>{{ strtoupper($encuesta->nombre) }}</h4>
   </div>
   <div class="text-justify">
      <p>{{ $encuesta->descripcion }}</p>
   </div>
   @foreach ($preguntas as $key => $pregunta)
         <div class="row">
            <div class="col-12 pb-0">
               <p class="">Pregunta {{ ($key+1) }}  - {{ $pregunta->pregunta }}</p>
                  @if ($pregunta->tipo == 1)
                  <div class="form-check pb-0">
                     <input class="form-check-input btn-check radio2" type="radio" value="Si" name="opcion{{ $pregunta->id }}" @if ($respuestas[$pregunta->id][0] == "Si") checked @endif>
                     <label class="form-check-label" for="opcion{{ $pregunta->id }}">
                        Si
                     </label>
                  </div>
                  <div class="form-check ps-0">
                     <input class="form-check-input radio2" type="radio" value="No" name="opcion{{ $pregunta->id }}" id="opcion_{{ $pregunta->id }}" @if ($respuestas[$pregunta->id][0] == "No") checked @endif>
                     <label class="form-check-label" for="opcion_{{ $pregunta->id }}">
                        No
                     </label>
                  </div>
                  @elseif ($pregunta->tipo == 2)
                     <p class="texto-llenado pb-0 text-justify text2">@if ($respuestas[$pregunta->id][0] != "") {{ $respuestas[$pregunta->id][0] }} @else N/A @endif</p>
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

