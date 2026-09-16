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
.row , .row2{
   display: flex;
   flex-wrap: wrap;
   color: #7b809a;
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
    color: #7b809a;
}

.form-check2 {
   display: flex;
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
   top: -25px;
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

.page-break {
    page-break-after: always;
}

</style>
<div>
   <div class="text-end imagen">
      <img width="200px" height="132px" src="data:image/png;base64,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" />
   </div>
   <!--<div class="nombre-dani nombre">Daniela Miranda Rocha</div>-->
   <div class="nombre-instituto">Universidad Mayor De San Simon</div>
   <div class="text-center tamano">
      <h4>{{ strtoupper($encuesta->nombre) }}</h4>
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
                     <table style="width: 100%">
                        @foreach (json_decode($pregunta->opciones) as $key2 => $opcion)
                           @if ($key2%4 == 0)
                              <tr>
                           @endif
                           <td>
                              <div class="form-check pb-0">
                                 <input class="form-check-input" type="checkbox" value="{{ $opcion }}" id="check_{{ $pregunta->id }}_{{ $key2 }}" @if ($respuestas[$pregunta->id][$key2] != "" || $respuestas[$pregunta->id][$key2] != false) checked @endif>
                                 <label class="form-check-label" for="check_{{ $pregunta->id }}_{{ $key2 }}">
                                    {{ $opcion }}
                                 </label>
                              </div>
                              </td>
                           @if (($key2+1)%4 == 0 || (($key2+1) == count(json_decode($pregunta->opciones))))
                           <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                              </tr>
                           @endif
                        @endforeach
                     </table>
                     @endif
               </div>
            @endif
         </div>
      </div>
   @endforeach
</div>

