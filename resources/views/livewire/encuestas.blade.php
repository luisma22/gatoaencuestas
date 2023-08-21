<div class="container-fluid py-4">
    @if ($canvasoff)
        @include('livewire.modals.modal-crear-encuesta')
        @include('livewire.modals.modal-ver-encuesta')
    @else
        @include('livewire.canvasoff.canvasoff-crear-encuesta')
        @include('livewire.canvasoff.canvasoff-ver-encuestas')
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                        <h6 class="text-white mx-3"><strong>Encuestas</h6>
                            <span>{{ session('message') }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8 ms-3 mt-4 col-sm-6">
                        @if ($canvasoff)
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="material-icons text-sm">add</i>Nueva Encuesta
                            </button>
                        @else
                            <button class="btn btn-success" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample">
                                <i class="material-icons text-sm">add</i>Nueva Encuesta
                            </button>
                        @endif
                    </div>
                    <div lass="col-xl-12 col-lg-12 col-md-12">
                        <div class="row">
                            <div class="col-5">
                                <div class="form-check form-switch ms-3 mt-3 me-4">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" wire:click="ver()">
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Ver todas las encuestas</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach ($encuestas as $pos => $encuesta)
        <div class="col-xl-4 col-sm-6 mb-xl-4 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">assignment</i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info">
                           Preguntas {{ $encuesta->preguntas->count() }}
                        </span>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">{{ $encuesta->nombre }}</p>
                        <h6 class="mb-0">{{ $encuesta->created_at }}</h6>
                        <h6 class="mb-0">{{ $encuesta->descripcion }}</h6>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer pt-1">
                    @if ($encuesta->habilitado)
                        @if ($canvasoff)
                            <button type="button" class="btn btn-success btn-link mb-1" data-bs-toggle="modal" data-bs-target="#exampleModal" wire:click="editar({{ $encuesta }})" data-original-title="" title="">
                                <i class="material-icons">edit_note</i>
                            </button>
                        @else
                            <button type="button" class="btn btn-success btn-link mb-1" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" wire:click="editar({{ $encuesta }})" data-original-title="" title="">
                                <i class="material-icons">edit_note</i>
                            </button>
                        @endif
                        <button type="button" class="btn btn-danger btn-link mb-1" wire:click="eliminar({{ $encuesta }})">
                            <i class="material-icons">delete</i>
                        </button>
                        @if ($canvasoff)
                            <button type="button" class="btn btn-info btn-link mb-1" data-bs-toggle="modal" data-bs-target="#verEncuesta" wire:click="verEncuesta({{ $encuesta }})">
                                <i class="material-icons">format_list_numbered</i>
                            </button>
                        @else
                            <button type="button" class="btn btn-info btn-link mb-1" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample1" wire:click="verEncuesta({{ $encuesta }})" data-original-title="" title="">
                                <i class="material-icons">format_list_numbered</i>
                            </button>
                        @endif
                        <button type="button" class="btn btn-dark btn-link mb-1" wire:click="iniciarEncuesta({{ $encuesta }})">
                            <i class="material-icons">rule</i>
                            <span class="position-absolute top-5 start-85 badge rounded-pill bg-info zindex-tooltip">
                                {{ $encuesta->encuestados->count() }}
                             </span>
                        </button>
                        @if ($encuesta->encuestados->count() > 0)
                            <button type="button" class="btn btn-dark btn-link mb-1" wire:click="estadisticas({{ $encuesta }})">
                                <i class="material-icons">stacked_bar_chart</i>
                            </button>
                            <button type="button" class="btn btn-danger btn-link mb-1" wire:click="eliminarEncuestados({{ $encuesta }})">
                                <i class="material-icons">delete_sweep</i>
                            </button>
                        @endif
                    @else
                        <button type="button" class="btn btn-danger btn-link m-0" wire:click="restaurar({{ $encuesta }})">
                            <i class="material-icons">restore</i>
                        </button>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
