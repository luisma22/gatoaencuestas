<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="mb-3">
                <button type="button" class="btn btn-dark btn-link text-end" wire:click="irAEncuestas()">
                    Volver a Encuestas <i class="material-icons">reply_all</i>
                </button>
                @if ($encuesta != null)
                    <button type="button" class="btn btn-dark btn-link text-start" id="downloadPdf">
                        PDF <i class="material-icons">picture_as_pdf</i>
                    </button>
                    <input type="hidden" value="{{ $cantidad_reportes }}" id="cantidad_reportes">
                    <input type="hidden" value="{{ $cantidad_preguntas }}" id="cantidad_preguntas">
                    <input type="hidden" value="{{ $encuestados }}" id="encuestados">
                    <input type="hidden" value="{{ $encuesta->nombre }}" id="nombre_encuesta">
                    <div class="form-check form-switch ms-5 pt-3 col-5">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" wire:click="ver()">
                        <label class="form-check-label" for="flexSwitchCheckChecked">Vista PDF</label>
                    </div>
                @endif
            </div>
        </div>
        @if ($encuesta != null)
            @if (count($todas_las_respuestas) > 0)
                @if (!$is_pdf)
                    <div class="mb-5 text-center text-uppercase">
                        <h6>
                            {{ $encuesta->nombre }}
                        </h6>
                    </div>
                @endif
                <div class="row">
                    @foreach ($todas_las_preguntas as $key => $respuesta)
                        @if ($is_pdf && $key%3 == 0)
                            <div id="reporte_{{ $key/3 }}">
                                <div class="row">
                                <div class="mt-3 mb-4 text-center text-uppercase">
                                    <h6>
                                    Estadisticas {{ $encuesta->nombre }}
                                    </h6>
                                </div>
                        @endif
                        @if (count(json_decode($respuesta->opciones)) > 2)
                            <div class="col-xl-12 col-sm-12 mb-xl-0 mb-5">
                        @else
                            <div class="col-xl-{{ (3 * pow(2,$valor_col_grid_pdf)) }} col-sm-{{(6 * $valor_col_grid_pdf) }} mb-xl-0 mb-5">
                        @endif
                            <div class="card z-index-2 ">
                                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                                    <div class="bg-gradient-success border-radius-lg py-3 pe-1">
                                        <div class="chart">
                                            <canvas id = "chart-canvas{{ $respuesta->id }}" class="chart-canvas{{ $respuesta->id }}" height="150"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pb-0 pt-1">
                                    <h6 class="mb-0 ">Pregunta {{ ($key+1) }}</h6>
                                    <p class="text-sm ">{{ $respuesta->pregunta}}</p>
                                </div>
                            </div>
                        </div>
                        @if ($is_pdf && (($key+4)%3 == 0 || ($key+1) == $cantidad_preguntas))
                            </div></div> 
                        @endif
                    @endforeach
                </div>
            @else 
                <div class="mb-2 text-center text-uppercase">
                    <h6>
                        {{ $encuesta->nombre }}
                    </h6>
                </div>
                <div class="col-12 text-center">
                    <div class="alert alert-dark">
                        <strong class="text-light"><i class="material-icons">info</i> No hay Estadisticas porque no se realizaron encuestas.</strong>
                    </div>
                </div>
            @endif
        @else
            <div class="col-12 text-center">
                <div class="alert alert-dark">
                    <strong class="text-light"><i class="material-icons">info</i> No hay Estadisticas porque esta encuesta no existe.</strong>
                </div>
            </div>
        @endif
    </div>
</div>
@push('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script> 
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.4.0/dist/chartjs-plugin-datalabels.min.js"></script> 
  
  <script type="text/javascript">
    window.addEventListener('para_pdf', function (event) {
        encuestas();
    });
  encuestas();
    function encuestas(){
        var preguntasj = @json($respuestas_preguntas);
        var todaslasrespuestas = @json($todas_las_respuestas);
        var colores = JSON.parse(@json($colores_encuesta));
        var forma = @json($forma);
        if (todaslasrespuestas.length > 0) {
            var options = {
                tooltips: {
                    enabled: true
                },
                plugins: {
                    datalabels: {
                        formatter: (value, ctx) => {
                            let sum = 0;
                            let dataArr = ctx.chart.data.datasets[0].data;
                            dataArr.map(data => {
                                sum += data;
                            });
                            let percentage = (value*100 / sum).toFixed(0)+"%";
                            return percentage;
                        },
                        color: '#fff',
                    }
                  },
              };
            var labels = [];
            var valores = [];
            var ctx = "";
            for (var preguntaj in preguntasj) {
                ctx = document.getElementById("chart-canvas" + preguntaj).getContext("2d");
                for(var key in preguntasj[preguntaj]) {
                    if (key != "tipo") {
                        if (key == "vacio") {
                            labels.push("Sin Respuesta");
                        } else if (key == "lleno") {
                            labels.push("Con Respuesta");
                        } else {
                            labels.push(key);
                        }
                        valores.push(preguntasj[preguntaj][key]);
                    }
                }
                var data = [{
                    data: valores,
                    backgroundColor: colores,
                    borderColor: "#fff"
                }];
                new Chart(ctx, {
                    type: forma, 
                    data: {
                        labels: labels,
                        datasets: data,
                    },
                    options: options
                });
                labels = [];
                valores = [];
            }
        }
    }
  </script>
  @endpush
