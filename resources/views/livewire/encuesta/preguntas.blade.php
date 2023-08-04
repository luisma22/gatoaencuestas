<div class="col-xl-4 col-sm-6 mb-xl-4 mb-4">
    <div class="text-center" role="alert">Preguntas</div>
    <input wire:model="search" type="text" placeholder="Buscar" class="form-control border border-2 p-2 mb-2" id="floatingInput">
    <ul class="list-group">
    @foreach ($todaslaspreguntas as $todaspregunta)
        <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto" >
            <div class="fw-bold text-break" >{{ $todaspregunta->pregunta }}</div>
            <button type="button" class="btn btn-success btn-sm" wire:click="add({{ $todaspregunta->id }})">
            <i class="material-icons text-sm">add_circle</i>
            </button>
            @php
            $cuerpo = "<div class='p-3'>";
            $i=1;
            @endphp
            @if ($todaspregunta->tipo == 1)
            @php
                $cuerpo.= "<div><i class='material-icons text-sm md-dark'>radio_button_checked</i><span class='ps-2'>Si</span></div>";
                $cuerpo.= "<div><i class='material-icons text-sm md-dark'>radio_button_unchecked</i><span class='ps-2'>No</span></div>";
            @endphp
            @elseif ($todaspregunta->tipo == 2)
            @php
                $cuerpo.= "<div><i class='material-icons text-sm md-dark'>message</i><span class='ps-2'>Esta es una pregunta para completar</span></div>";  
                @endphp
            @else
            @foreach (json_decode($todaspregunta->opciones) as $key => $value) 
            @php
                if ($i == 1 || $i == 4 || $i == 5) {
                $cuerpo.= "<div><i class='material-icons text-sm md-dark'>check_box</i><span class='ps-2'>".$value."</span></div>";
                } else {
                $cuerpo.= "<div><i class='material-icons text-sm md-dark'>check_box_outline_blank</i><span class='ps-2'>".$value."</span></div>";
                }
                $i++;
            @endphp
            @endforeach
            @endif    
            <button type="button" class="btn btn-sm btn-secondary" 
            data-bs-trigger="hover" 
            data-bs-toggle="popover" 
            data-bs-html="true" 
            data-bs-title="PREGUNTA" 
            data-bs-container="body"
            data-bs-content="<b>{{ $todaspregunta->pregunta }}</b>{{ $cuerpo }}</div>">
            <i class="material-icons text-sm">remove_red_eye</i>
            </button>
        </div>
        </li>
    @endforeach
    </ul>
    </div>
