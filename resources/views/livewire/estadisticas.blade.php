<div class="container-fluid py-4">
    <div class="row">
        <div class="text-end mb-3">
            <button type="button" class="btn btn-dark btn-link" wire:click="irAEncuestas()">
                Volver a Encuestas <i class="material-icons">reply_all</i>
            </button>
        </div>
        @if (count($todas_las_respuestas) > 0)
        <div class="mb-5 text-center text-uppercase">
            <h6>
                {{ $encuesta->nombre }}
            </h6>
        </div>
            @foreach ($todas_las_preguntas as $key => $respuesta)
                @if (count(json_decode($respuesta->opciones)) > 2)
                <div class="col-xl-12 col-sm-12 mb-xl-0 mb-5">
                @else
                    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-5">
                @endif
                    <div class="card z-index-2 ">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                            <div class="bg-gradient-success border-radius-lg py-3 pe-1">
                                <div class="chart">
                                    <canvas id = "chart-canvas{{ $respuesta->id }}" class="chart-canvas{{ $respuesta->id }}" height="170"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pb-0 pt-1">
                            <h6 class="mb-0 ">Pregunta {{ ($key+1) }}</h6>
                            <p class="text-sm ">{{ $respuesta->pregunta}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
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
    </div>
</div>
@push('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script> 
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.4.0/dist/chartjs-plugin-datalabels.min.js"></script> 
  <script type="text/javascript">
        var preguntasj = @json($respuestas_preguntas);
        var todaslasrespuestas = @json($todas_las_respuestas);
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
                        labels.push(key);
                        valores.push(preguntasj[preguntaj][key]);
                    }
                }
                var data = [{
                    data: valores,
                    backgroundColor: [
                        "#4b77a9",
                        "#5f255f"
                    ],
                    borderColor: "#fff"
                }];
                console.log(valores)
                new Chart(ctx, {
                    type: "pie",
                    
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
  </script>
  @endpush
