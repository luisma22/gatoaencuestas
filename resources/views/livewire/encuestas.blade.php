<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white mx-3"><strong>Encuestas</h6>
                            <span>{{ session('message') }}</span>
                    </div>
                </div>
                <div class="row">
                        <div class="col-8">
                            <div class="row">
                                <div class="mt-3 ms-4 col-md-10 col-10">
                                    <label class="form-label">Nombre</label>
                                    <input wire:model="nombre" type="text" class="form-control border border-2 p-2">
                                    @error('nombre')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="mt-3 ms-4 col-md-10 col-10">
                                    <label class="form-label">Descripcion</label>
                                    <textarea wire:model="descripcion" type="text" class="form-control border border-2 p-2"></textarea>
                                    @error('descripcion')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        @if ($editar)
                            <div class="col-3 me-3 mt-6">
                                <button class="btn bg-gradient-dark mb-1" wire:click="actualizar">Actualizar Encuesta</button>
                                <button class="btn btn-danger mb-0" wire:click="cancelar">Cancelar</button>
                            </div>
                        @else
                            <div class="col-3 me-3 mt-6">
                                <button class="btn bg-gradient-dark mb-0" wire:click="crear"><i
                                        class="material-icons text-sm">add</i>Añadir Nueva Encuesta</button>
                            </div>
                        @endif

                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0 ms-4">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">N</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        NOMBRE</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        DESCRIPCION</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        HABILITADO
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        CREADO
                                    </th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($encuestas as $pos => $encuesta)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="mb-0 text-sm">{{ ($pos + 1) }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center">
                                                <p class="mb-0 text-sm">{{ $encuesta->nombre }}</p>
                                            </div>
                                        </td>
                                        <td class="text-left text-sm">
                                            <p class="mb-0 text-sm">{{ $encuesta->descripcion }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $encuesta->habilitado }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $encuesta->created_at }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <button type="button" class="btn btn-success btn-link" wire:click="editar({{ $encuesta }})" data-original-title="" title="">
                                                <i class="material-icons">edit</i>
                                                <div class="ripple-container"></div>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-link" @if($editar) disabled @endif wire:click="eliminar({{ $encuesta }})">
                                                <i class="material-icons">close</i>
                                                <div class="ripple-container"></div>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
