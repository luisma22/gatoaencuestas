<div class="container-fluid py-4">
    <div class="text-end">
        <button type="button" class="btn btn-dark btn-link" wire:click="irAEncuestas()">
            Volver a Encuestas <i class="material-icons">reply_all</i>
        </button>
    </div>
    <div id="carouselExampleCaptions" class="carousel slide h-70" data-bs-ride="carousel" data-bs-interval="false">
        <div class="carousel-indicators">
          @foreach ($todas_las_preguntas as $key => $pregunta)
            @if ($key == 0)
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $key }}" class="active" aria-current="true" aria-label="Slide {{ $key }}"></button>
            @else
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $key }}" aria-label="Slide {{ $key }}"></button>
            @endif
          @endforeach
        </div>
        <div class="carousel-inner">
            @foreach ($todas_las_preguntas as $key => $pregunta)
                @if ($key == 0)
                <div class="carousel-item active">    
                @else
                <div class="carousel-item">
                @endif
                <div class="pb-8">&nbsp;</div>
                    <div class="row">
                        <div class="col-3"></div>
                        <div class="col-6 pb-10">
                            @if ($pregunta->tipo == 1)
                            <div class="form-check">
                                <input class="form-check-input" wire:model.defer="encuesta_completa.{{ $pregunta->id }}.0" type="radio" value="true" name="opcion{{ $pregunta->id }}" id="opcion{{ $pregunta->id }}">
                                <label class="form-check-label" for="opcion{{ $pregunta->id }}">
                                Si
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" wire:model.defer="encuesta_completa.{{ $pregunta->id }}.0" value="false" name="opcion{{ $pregunta->id }}" id="opcion_{{ $pregunta->id }}">
                                <label class="form-check-label" for="opcion_{{ $pregunta->id }}">
                                No
                            </label>
                            </div>
                            @elseif ($pregunta->tipo == 2)
                                <div class="form-check">
                                    <button type="button" class="btn btn{{ $estilo_microfono }} mb-2 speech" data-id = {{ $pregunta->id }} id="voz_opciones">
                                        <i class="material-icons text-sm">mic</i>
                                    </button>
                                    <textarea wire:model.defer="encuesta_completa.{{ $pregunta->id }}.0" type="text" class="form-control border border-2 p-2" id="textarea{{ $pregunta->id }}"></textarea>
                                </div>
                            @else
                                <div class="form-check">
                                    @foreach (json_decode($pregunta->opciones) as $key2 => $opcion)
                                        <input class="form-check-input" wire:model.defer="encuesta_completa.{{ $pregunta->id }}.{{ $key2 }}" type="checkbox" value="{{ $opcion }}" id="check_{{ $pregunta->id }}_{{ $key2 }}" >
                                        <label class="form-check-label" for="check_{{ $pregunta->id }}_{{ $key2 }}">
                                            {{ $opcion }}
                                        </label><br>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="col-3"></div>
                    </div>
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Pregunta {{ ($key + 1) }}</h5>
                        <p class="text-dark">{{ $pregunta->pregunta }}</p>
                        @if ($cantidad_preguntas == ($key + 1))
                            <button type="button" class="btn btn-dark btn-link m-0" wire:click="finalizarEncuesta()">
                                Finalizar encuesta <i class="material-icons">label_important</i>
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
</div>
