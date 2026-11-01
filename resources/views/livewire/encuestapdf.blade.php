<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
h1, .h1, .h1, h2, .h2, .h2, h3, .h3, .h3, h4, .h4, .h4 {
   letter-spacing: -0.05rem;
   color: #000;
}
p {
    line-height: 1.625;
    font-weight: 300;
    color: #000;
}
p, .p, span {
    font-size: 1.2rem;
    color: #000;
}
p.texto-llenado{
   padding-left: .3rem;
}

hr {
   width: 95%;
   margin-left: -10px;
   margin-top: 0px;
}
.row , .row2{
   display: flex;
   flex-wrap: wrap;
   color: #000;
   width: 100%;
   margin-left: 28px;
}

.row2 {
   margin-left: 0px;
}

.col-12 {
   flex: 0 0 auto;
   width: 98%;
}
.col-3, .col-sm-3 ,.col-md-3{
    flex: 0 0 auto;
    width: 25%;
}

.pb-0 {
   padding-bottom: 0rem !important;
}

.form-check {
    display: block;
    min-height: auto;
    padding-left: 3rem;
    margin-bottom: 0;
    color: #000;
}

.form-check2 {
   display: flex;
    min-height: auto;
    padding-left: 3rem;
    margin-bottom: 0;
    color: #000;
}
.form-check-label {
   font-size: .9rem;
   font-weight: 400;
   margin-top: -0.2rem;
   padding-top: -0.2rem;
}
label, .form-label {;
    color: #000;
}
.text-justify {
   margin-left: 25px;
   margin-right: 55px;
   font-size: 1rem;
   text-align: justify !important;
   font-weight: 0;
}
.text2 {
   font-size: .9rem;
}
.text-center {
   margin-top: 10px;
   text-align: center !important;
}
.text-end {
    text-align: end !important;
}
.nombre {
   position: absolute;
   top: 100px;
   right: -85px;
   color: #000;
}

.imagen {
   position: absolute;
   top: -20px;
   left: -10px;
   color: #000;
}
.imagen img {
   position: absolute;
   top: -20px;
   left: -15px;

}
.nombre-dani {
   -webkit-transform: rotate(90deg); 
   -moz-transform: rotate(90deg);
   font-size: .9rem;
}
.form-check-input {
   margin-top: -10px;
   padding-top: -10px;
}

.form-check-label {
   font-size: .8rem;
   color: #000;
}

.tamano {
   font-size: 1rem;
}
.radio2 {
   margin-top: -13px !important;
}

.page-break {
    page-break-after: always;
}

@page {
   size: Letter portrait;
   margin-top: 110px;
}
.opciones-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 12px 20px;
    width: 100%;
    padding: 2px 5px;
}

.opciones-grid .form-check {
    display: flex;
    align-items: flex-start;
    gap: 5px;
    margin: 0;
    min-width: 0;
}

.opciones-grid .form-check-input {
    flex-shrink: 0;
    margin-top: 2px;
}

.opciones-grid .form-check-label {
    overflow-wrap: break-word;
}

input[type="checkbox"], input[type="radio"] {
    transform: scale(1.4);
}
</style>
   <!--<div class="nombre-dani nombre">Daniela Miranda Rocha</div>-->
   <!--<div class="nombre-instituto">Universidad Mayor De San Simon</div>-->
<div>
   <div class="text-center tamano">
      <h4>{{ mb_strtoupper($encuesta->nombre , 'UTF-8') }}</h4>
   </div>
   <div class="text-justify">
      <p>{{ $encuesta->descripcion }}</p>
   </div>
   @php($i = 0)
   @foreach ($preguntas as $key => $pregunta)
      @php($i++)
         <div class="row">
            @if ($respuestas[$pregunta->id] ?? '')
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 pb-0">
               <p class="">{{ $i }}. {{ $pregunta->pregunta }}</p>
                  @if ($pregunta->tipo == 1)
                  <div class="opciones-grid">
                        @foreach (json_decode($pregunta->opciones) as $key3 => $opcion)
                           <div class="form-check pb-0">
                              @if ($respuestas[$pregunta->id][0] == $opcion)
                                 <input class="form-check-input btn-check radio2" type="radio" value="{{ $opcion }}" name="opcion{{ $pregunta->id }}" checked>
                              @else
                                 <input class="form-check-input btn-check radio2" type="radio" value="{{ $opcion }}" name="opcion{{ $pregunta->id }}">
                              @endif
                              <label class="form-check-label" for="opcion{{ $pregunta->id }}">
                                 {{ $opcion }}
                              </label>
                           </div>
                        @endforeach
                  </div>
                  <span class="form-label pb-0 mb-0">Comentario</span>
                  <hr class="pb-0">
                   <p class="texto-llenado pb-0 text-justify text2">@if ($respuestas[$pregunta->id]['extratexto'] != "") {{ $respuestas[$pregunta->id]['extratexto'] }} @else N/A @endif</p>
                  <hr class="pb-0">
                   @elseif ($pregunta->tipo == 2)
                     <p class="texto-llenado pb-0 text-justify text2">@if ($respuestas[$pregunta->id][0] != "") {{ $respuestas[$pregunta->id][0] }} @else N/A @endif</p>
                  @else
                     <div class="opciones-grid" style="margin-top:-15px;margin-bottom:10px;">
                        @foreach (json_decode($pregunta->opciones) as $key2 => $opcion)
                           <div class="form-check pb-0">
                              <input class="form-check-input" type="checkbox" value="{{ $opcion }}" id="check_{{ $pregunta->id }}_{{ $key2 }}" @if ($respuestas[$pregunta->id][$key2] != "" || $respuestas[$pregunta->id][$key2] != false) checked @endif>
                              <label class="form-check-label" style="margin-top:11px;" for="check_{{ $pregunta->id }}_{{ $key2 }}">
                                 {{ $opcion }}
                              </label>
                           </div>
                        @endforeach
                     </div>
                     <span class="form-label pb-0 mb-0">Comentario</span>
                     <hr class="pb-0">
                     <p class="texto-llenado pb-0 text-justify text2">@if ($respuestas[$pregunta->id]['extratexto'] != "") {{ $respuestas[$pregunta->id]['extratexto'] }} @else N/A @endif</p>
                     <hr class="pb-0">
                     @endif
               </div>
            @endif
         </div>
      </div>
   @endforeach
</div>

