<div class="container-fluid py-4">
    @include('livewire.modals.modal-crear-encuesta')
    @include('livewire.modals.modal-ver-encuesta')
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
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="material-icons text-sm">add</i>Nueva Encuesta
                        </button>
                    </div>
                    <div lass="col-3 ms-3 mt-4">
                        <div class="form-check form-switch ms-3 mt-3 me-4">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" wire:click="ver()">
                            <label class="form-check-label" for="flexSwitchCheckChecked">Ver todas las encuestas</label>
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
                        <button type="button" class="btn btn-success btn-link m-0" data-bs-toggle="modal" data-bs-target="#exampleModal" wire:click="editar({{ $encuesta }})" data-original-title="" title="">
                            <i class="material-icons">edit_note</i>
                        </button>
                        <button type="button" class="btn btn-danger btn-link m-0" wire:click="eliminar({{ $encuesta }})">
                            <i class="material-icons">delete</i>
                        </button>
                        <button type="button" class="btn btn-info btn-link m-0" data-bs-toggle="modal" data-bs-target="#verEncuesta" wire:click="verEncuesta({{ $encuesta }})">
                            <i class="material-icons">format_list_numbered</i>
                        </button>
                        <button type="button" class="btn btn-dark btn-link m-0" wire:click="iniciarEncuesta({{ $encuesta }})">
                            <i class="material-icons">rule</i>
                        </button>
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
