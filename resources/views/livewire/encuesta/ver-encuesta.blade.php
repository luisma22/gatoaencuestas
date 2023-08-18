<div wire:loading.remove>
    <ul class="list-group">
        @foreach ($encuesta_ver->preguntas ?? [] as $key => $todaspregunta)
            <li class="list-group-item justify-content-between align-items-start">
            <div class="ms-2 me-auto" >
            <span class="position-absolute top-0 start-5 translate-middle badge rounded-pill bg-dark">
                Pregunta {{ $key + 1 }}
            </span>
                <div class="fw-bold text-break" >{{ $todaspregunta->pregunta }}</div>
                @if ($todaspregunta->tipo == 1)
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault{{ $todaspregunta->id }}" id="flexRadioDefault1{{ $todaspregunta->id }}" disabled>
                    <label class="form-check-label" for="flexRadioDefault1{{ $todaspregunta->id }}">
                    Si
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault{{ $todaspregunta->id }}" id="flexRadioDefault2{{ $todaspregunta->id }}" disabled checked>
                    <label class="form-check-label" for="flexRadioDefault2{{ $todaspregunta->id }}">
                    No
                    </label>
                </div>
                @elseif ($todaspregunta->tipo == 2)
                <textarea class="form-control border border-2 p-2" id="floatingInput{{ $todaspregunta->id }}" disabled></textarea>
                @else
                @foreach (json_decode($todaspregunta->opciones) as $key => $value) 
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault{{ $key }}" checked disabled>
                    <label class="form-check-label" for="flexCheckDefault{{ $key }}">
                        {{ $value }}
                    </label>
                </div>
                @endforeach
                @endif    
            </div>
            </li>
        @endforeach
    </ul>
</div>