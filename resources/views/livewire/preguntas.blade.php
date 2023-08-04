<div class="container-fluid py-4">
    @include('livewire.modals.modal-crear-pregunta')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                        <h6 class="text-white mx-3"><strong>Preguntas</h6>
                            <span>{{ session('message') }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 ms-3 mt-4 col-sm-12">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="material-icons text-sm">add</i>Nueva Pregunta
                        </button>
                    </div>
                    <div lass="col-12 ms-3 mt-4">
                        <div class="row">
                            <div class="form-check form-switch ms-5 pt-3 col-5">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" wire:click="ver()">
                                <label class="form-check-label" for="flexSwitchCheckChecked">Ver todas las preguntas</label>
                            </div>
                            <div class="col-6 align-end">
                                <input wire:model="search" type="text" placeholder="Buscar" class="form-control border border-2 p-2 mb-2">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach ($preguntas as $pos => $pregunta)
        <div class="col-xl-4 col-sm-6 mb-xl-4 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">assignment</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">{{ $pregunta->pregunta }}</p>
                        <h6 class="mb-0">{{ $pregunta->created_at }}</h6>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer pt-1">
                    @if ($pregunta->habilitado)
                        <button type="button" class="btn btn-success btn-link m-0" data-bs-toggle="modal" data-bs-target="#exampleModal" wire:click="editar({{ $pregunta }})" data-original-title="" title="">
                            <i class="material-icons">edit_note</i>
                        </button>
                        <button type="button" class="btn btn-danger btn-link m-0" wire:click="eliminar({{ $pregunta }})">
                            <i class="material-icons">delete</i>
                        </button>
                    @else
                        <button type="button" class="btn btn-danger btn-link m-0" wire:click="restaurar({{ $pregunta }})">
                            <i class="material-icons">restore</i>
                        </button>
                    @endif
                    @php
                    $cuerpo = "<div class='p-3'>";
                    $i=1;
                    @endphp
                    @if ($pregunta->tipo == 1)
                    @php
                        $cuerpo.= "<div><i class='material-icons text-sm md-dark'>radio_button_checked</i><span class='ps-2'>Si</span></div>";
                        $cuerpo.= "<div><i class='material-icons text-sm md-dark'>radio_button_unchecked</i><span class='ps-2'>No</span></div>";
                    @endphp
                    @elseif ($pregunta->tipo == 2)
                    @php
                        $cuerpo.= "<div><i class='material-icons text-sm md-dark'>message</i><span class='ps-2'>Esta es una pregunta para completar</span></div>";  
                        @endphp
                    @else
                    @foreach (json_decode($pregunta->opciones) as $key => $value) 
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
                    <button type="button" class="btn btn-secondary" 
                    data-bs-trigger="hover" 
                    data-bs-toggle="popover" 
                    data-bs-html="true" 
                    data-bs-title="PREGUNTA" 
                    data-bs-container="body"
                    data-bs-content="<b>{{ $pregunta->pregunta }}</b>{{ $cuerpo }}</div>">
                    <i class="material-icons text-sm">remove_red_eye</i>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

