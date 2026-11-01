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
.nombre-instituto {
   position: fixed;
   top: 800px;
   left: -130px;
   color: #000;
   opacity: 0.5;
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

.imagen {
   position: fixed;  
   top: -75px;
   left: 20px;
   right: 0px;
   text-align: left;
}

.imagen2 {
   position: fixed;  
   top: -97px;
   left: 10px;
   right: 0px;
   text-align: center;
}

.imagen3 {
   position: fixed;  
   top: -97px;
   left: 240px;
   right: 0px;
   text-align: right;
}

@page {
   size: Letter portrait;
   margin-top: 110px;
}
.marca-agua {
   position: fixed;
   width: 400px;
   height: auto;

   top: 50%;
   left: 45%;

   transform: translate(-50%, -50%);

   opacity: 0.12;
   z-index: 0;
   pointer-events: none;
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
   
   <div class="imagen">
      <img width="80px" height="90px" src="data:image/png;base64,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">
   </div>
   <div class="imagen2">
      <img width="100px" height="90px" src="data:image/png;base64,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">
   </div>
   <div class="imagen3">
      <img width="100px" height="90px" src="data:image/png;base64,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">
   </div>
   <!--<div class="nombre-dani nombre">Daniela Miranda Rocha</div>-->
   <div class="nombre-instituto">Universidad Mayor De San Simon</div>
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

