<div>
    <div class="container-fluid">
        <div class="justify-content-end pagination-sm">
            {{ $registros->links() }}
        </div>
        <div class="table-responsive" style="overflow-x: auto;">
            {{-- <table class="table table-hover table-sm align-middle" style="word-wrap: break-word;"> --}}
            <table class="table table-hover table-sm align-middle text-nowrap">
                <thead class="table-dark align-bottom">
                    <tr>
                        <th>*</th>
                        <th>E</th>
                        <th>FECHA PEDIDO</th>
                        <th>FECHA ENTREGA</th>
                        <th>CLIENTE</th>
                        <th style="width: 150px; overflow:hidden;">TRABAJO</th>
                        <th style="width: 120px;">A-L-E</th>
                        <th>CANT.</th>
                        <th>COLOR</th>
                        <th>T</th>      {{-- Tratamiento --}}
                        <th>F</th>      {{-- FUELLE --}}
                        <th>CORTE</th>
                        <th>P.UNIT</th>
                        <th>OBSERVACIONES</th>
                        <th>OBSERVACIONES 2</th>
                    </tr> 
                </thead>
                <tbody>
                    @foreach ( $registros as $reg)
                        <tr id={{ $reg->id }}>
                            <td>
                                {{ ($reg->estado_id==2) ? '*' : '-' }}
                            </td>
                            <td title="{{ $reg->estado_nombre }}">{{ substr($reg->estado_nombre,0,1) }}</td>
                            <td>{{ date('d/m/Y', strtotime($reg->fecha_pedido)) }}</td>
                            <td>{{ date('d/m/Y', strtotime($reg->fecha_entrega)) }}</td>
                            <td title="{{ $reg->razonsocial }}">{{ $reg->razonsocial }}</td>
                            <td style="overflow:inherit;">{{ $reg->trabajo_nombre }}</td>
                            <td>{{ $reg->ancho . ' - ' . $reg->largo . ' - ' . $reg->espesor }}</td>
                            <td>{{ $reg->cantidad_bolsas }}</td>
                            <td>{{ $reg->color->nombre }}</td>
                            <td>{{ $reg->tratado->nombre }}</td>
                            <td>{{ $reg->bolsa_largo_fuelle }}</td>
                            <td>{{ $reg->corte->nombre }}</td>
                            <td>{{ $reg->precio_unitario }}</td>
                            <td title="{{ $reg->observaciones }}">{{ substr($reg->observaciones,0,30) }}</td>
                            <td title="{{ $reg->observaciones }}">{{ $reg->observaciones }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
