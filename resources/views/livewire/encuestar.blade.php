<div class="container-fluid py-4">
    <div class="text-end">
        @if (auth()->user()!= null) 
            <button type="button" class="btn btn-dark btn-link" wire:click="irAEncuestas()">
                Volver a Encuestas <i class="material-icons">reply_all</i>
            </button>
        @endif
    </div>
    @if ($encuesta == null)
        <div class="mt-5 text-center text-uppercase">
            <h6>
                Esta Encuesta no Existe verifique si le dieron la direccion correcta.
            </h6>
        </div>
    @else
        @if (auth()->user()!= null) 
            @include('livewire.encuesta.encuesta')
        @else
            @if ($encuesta->habilitar)
                @include('livewire.encuesta.encuesta')
            @else
                <div class="mt-10 pb-10 pt-5 text-center text-uppercase">
                    <h6>
                        La encuesta no esta disponible por ahora.
                    </h6>
                </div>
            @endif
        @endif
    @endif
</div>
