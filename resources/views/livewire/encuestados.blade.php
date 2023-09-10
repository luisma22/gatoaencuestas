<div class="container-fluid py-4">
    <button type="button" class="btn btn-dark btn-link text-end mb-2" wire:click="irAEncuestas()">
        Volver a Encuestas <i class="material-icons">reply_all</i>
    </button>
    <table class="table table-hover table-striped">
        <thead class="table-dark">
          <tr>
            <th scope="col align-center">#</th>
            <th scope="col text-center">fecha</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
            @foreach ($encuestados as $key => $encuestado)
                <tr>
                    <th class="text-center" scope="row">{{ ($key + 1) }}</th>
                    <td>{{ substr($encuestado->created_at, 0, 10) }}</td>
                    <td>
                        <button type="button" class="btn btn-success btn-link mb-1" wire:click="generarPDF({{ $encuestado->id }}, {{ ($key + 1) }})">
                            <i class="material-icons">picture_as_pdf</i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
</div>
