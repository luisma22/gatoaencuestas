<div class="container-fluid py-4">
    <div class="row">
        <div class="mb-5 text-center">
            {{ $encuesta->nombre }}
        </div>
        @foreach ($todas_las_preguntas as $key => $respuesta)
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-5">
                <div class="card z-index-2 ">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
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
    </div>
</div>
@push('js')
  <script src="{{ asset('assets') }}/js/plugins/chartjs.min.js"></script>
  <script type="text/javascript">
        var a = @json($respuestas_preguntas);
        var ctx = document.getElementById("chart-canvas4").getContext("2d");
        console.log(a);
        var y={{ $encuestados }};
        console.log(y);
        new Chart(ctx, {
          type: "bar",
          data: {
              labels: ["Si", "No"],
              datasets: [{
                  label: "",
                  tension: 0.4,
                  borderWidth: 0,
                  borderRadius: 4,
                  borderSkipped: false,
                  backgroundColor: "rgba(255, 255, 255, .8)",
                  data: [a[4]['true'], a[4]['false'], {{ $encuestados }}],
                  maxBarThickness: 6
              }, ],
          },
          options: {
              responsive: true,
              maintainAspectRatio: false,
              plugins: {
                  legend: {
                      display: false,
                  }
              },
              interaction: {
                  intersect: true,
                  mode: 'index',
              },
              scales: {
                  y: {
                      grid: {
                          drawBorder: false,
                          display: true,
                          drawOnChartArea: true,
                          drawTicks: true,
                          borderDash: [5, 5],
                          color: 'rgba(255, 255, 255, .2)'
                      },
                      ticks: {
                          suggestedMin: 0,
                          suggestedMax: 500,
                          beginAtZero: true,
                          padding: 10,
                          stepSize: 1,
                          font: {
                              size: 14,
                              weight: 300,
                              family: "Roboto",
                              style: 'normal',
                              lineHeight: 2
                          },
                          color: "#fff"
                      },
                  },
                  x: {
                      grid: {
                          drawBorder: false,
                          display: true,
                          drawOnChartArea: true,
                          drawTicks: false,
                          borderDash: [5, 5],
                          color: 'rgba(255, 255, 255, .2)'
                      },
                      ticks: {
                          display: true,
                          color: '#f8f9fa',
                          padding: 10,
                          font: {
                              size: 14,
                              weight: 300,
                              family: "Roboto",
                              style: 'normal',
                              lineHeight: 2
                          },
                      }
                  },
              },
          },
      });
  </script>
  @endpush
