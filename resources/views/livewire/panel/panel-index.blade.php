<div>
    <div class="p-1 text-white h4" style="background-color: #375a7f">
        PANEL GENERAL
    </div>
    <div class="mt-4 row">
        <div class="col-4">
            <div class="mb-4 text-white card bg-primary" title="Muestra el total de todas las OTs ingresadas en el mes en curso.">
                <div class="card-body">
                    {{-- <p class="card-title"><h1>{{ $ots_mes }}</h1></p> --}}
                    <h6 class="card-text">OTs ingresadas en el mes</h6>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="mb-4 text-white card bg-success" title="Total de OTs entregadas en el mes en curso.">
                <div class="card-body">
                    {{-- <p class="card-title"><h1>{{ $ots_entregadas }}</h1></p> --}}
                    <h6 class="card-text">OTs entregadas</h6>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="mb-4 text-white card bg-warning" title="Total de OTs sin entregar al dia de la fecha.">
                <div class="card-body">
                    {{-- <p class="card-text"><h1>{{ $ots_procesadas }}</h1></p>                         --}}
                    <h6 class="card-text">OTs en proceso</h6>
                </div>
            </div>
        </div>

     </div>  {{--Final 1er fila --}}

    <div class="row">

        <div class="col-4">
            <div class="mb-4 text-white card bg-danger" title="Total de OTs que registran pendientes a la fecha.">
                <div class="card-body">
                    {{-- <p class="card-text"><h1>{{ $ots_pendientes }}</h1></p> --}}
                    <h6 class="card-text">OTs con pendientes</h6>
                </div>
                
            </div>
        </div>

        <div class="col-4">
            <div class="mb-4 text-white card bg-dark" title="Cliente con mas OTs. Se contabilizan las OTs entregadas.">
                <div class="card-body"> 
                    {{-- <p class="card-text"><h1>{{ $cliente_max }}</h1></p> --}}
                    <h6 class="card-text">Cliente con mas pedidos en el mes</h6>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="mb-4 text-white card bg-secondary" title="">
                <div class="card-body">
                    {{-- <p class="card-text"><h5>Fecha: {{ $ot_antigua_fecha }}</h5></p>
                    <p class="card-text"><h5>OT: {{ $ot_antigua_numero }}</h5></p>
                    <p class="card-text"><h5>Cliente: {{ $ot_antigua_cliente }}</h4></p> --}}
                    <h6 class="card-text">Pedido mas antiguo sin entregar</h6>
                </div>
            </div>
        </div>

        {{-- <div class="col-4">
            <div class="card">
                <h5 class="card-header">Featured</h5>
                <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                </div>
            </div>
        </div> --}}
    </div>
</div>

