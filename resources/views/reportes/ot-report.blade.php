<!doctype html> 
<html lang="es"> 
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="refresh" content="3; URL=https://idocordoba.edu.ar" />
  </head>
  <style>
    /* border bottom gris */
    .bbfino {
      border-bottom: 1px solid rgb(177, 176, 176); 
      border-left: 1px solid black; 
      border-right: 1px solid black;
    }
    /* border right gris padding */
    .brfino {
      padding-left: 4px;
      border-right: 1px solid rgb(177, 176, 176);
    }
    /* border right black padding */
    .brmedio {
      padding-left: 4px;
      border-right: 1px solid black;
    }
    @page {
	  	margin-left: 0.5cm;
		  margin-right: 0.5cm;
		  margin-top: 0.5cm;
		  margin-bottom: 0.5cm;
	  }
  </style>
  <body style="font-size: 15px; font-family: Tahoma, Verdana, sans-serif;">
      {{-- HEADER OT --}}
    <div style="width: 750px; margin: 0px;">
      <table style="width: 100%; border-collapse: collapse">
        <tr style="border: 1px solid black;">
          <th style="border-right: 0px; border-bottom: 2px solid black; text-align: left;">
            <img src="img/logo_ot_3.png" style="padding: 2px;">
          </th>
          <th colspan="2" style="border-left: 0px; border-bottom: 2px solid black; font-size: 22px; font-family: Tahoma, Verdana, sans-serif; font-weight: bold; text-align: center">
            ORDEN DE TRABAJO
          </th>
        </tr>
        @foreach ($registros as $reg)
        <tr class="bbfino">
          <td class="brfino" style="width: 240px;">Cliente: {{ $reg->razonsocial }}</td>
          <td class="brfino" style="width: 130px;">Ancho: {{ $reg->ancho }}</td>
          <td class="brmedio" style="width: 230px;">Cant. Bolsas {{ $reg->cantidad_bolsas }}</td>
        </tr>
        <tr class="bbfino">
          <td class="brfino">Trabajo: {{ $reg->trabajo_nombre }}</td>
          <td class="brfino">Largo: {{ $reg->largo }}</td>
          <td class="brmedio">Metros: {{ $reg->metros }}</td>
        </tr>
        <tr class="bbfino">
            <td class="brfino">Mes: {{ $mes }}</td>
            <td class="brfino">Espesor: {{ $reg->espesor }}</td>
            <td class="brmedio">Peso (Kg): {{ $reg->peso }}</td>
          </tr>
          <tr class="bbfino">
            <td class="brfino">Nº Orden: {{ $reg->numero_ot }}</td>
            <td class="brfino">Tipo Material: {{ $reg->densidad_nombre }}</td>
            <td class="brmedio">Tipo de Corte: {{ $reg->corte_nombre }}</td>
          </tr>
          <tr class="bbfino">
            <td class="brfino">Fecha de Pedido: {{ $reg->fecha_pedido }}</td>
            <td class="brfino">Material: {{ $reg->material_nombre }}</span></td>
            <td rowspan="3" class="brmedio">Obs: <span style="font-size: 12px;">{{ $reg->observaciones }}</span></td>
          </tr>
          <tr class="bbfino">
            <td class="brfino">Fecha de Entrega: {{ $reg->fecha_entrega }}</td>
            <td class="brfino">Tipo: {{ $reg->bolsa_nombre }} @if ($reg->bolsa_fuelle == 1)
              {{ $reg->bolsa_largo_fuelle }} <span style="font-size: 10px;">cms</span>
          @endif</td>
            {{-- <td class="brmedio"></td> --}}
          </tr>
          <tr class="bbfino">
            <td class="brfino"></td>
            <td class="brfino">Tratado: <span style="font-size: 12px;">{{ $reg->tratado_nombre }}</span></td>
            {{-- <td class="brmedio"></td> --}}
          </tr>
          @endforeach
      </table>
    {{-- EXTRUSION --}}
    <table style="width: 100%; border-collapse: collapse; border: 1px solid black; border-top-width:0px">
        <tr style="border: 2px solid black; border-top-width:1px">
          <th colspan="12" style="background-color: rgb(247, 224, 221); font-size: 18px; font-family: Tahoma, Verdana, sans-serif; font-weight: bold">
            EXTRUSIÓN
          </th>
        </tr>
        <tr style="border: 1px solid black; border-bottom: 0px;">
          <td colspan="12" style="height: 20px;padding-left: 4px; padding-top:13px; border-bottom: 1px solid rgb(177, 176, 176); ">Obs.: <span style="font-size: 12px;">{{ $reg->observaciones_extrusion }}</span></td>
        </tr>
        <tr style="border-top: 0px; border-bottom: 0px;">
          <td colspan="7" style="height: 25px;padding-left: 4px; padding-top:10px">Máquina Nº: _________</td>
          <td colspan="5"style="height: 25px;padding-top:10px; text-align: center">Fecha Extrusión: ___/___/______</td>
        </tr>
        <tr>
          <td style="padding-left: 2px; width: 90px; border: 1px solid black">Oper</td>
          <td style="padding-left: 2px; width: 25px; border: 1px solid black">Nº</td>
          <td style="padding-left: 2px; width: 35px; border: 1px solid black">Kgs</td>
          <td style="padding-left: 2px; width: 90px; border: 1px solid black">Oper</td>
          <td style="padding-left: 2px; width: 25px; border: 1px solid black">Nº</td>
          <td style="padding-left: 2px; width: 35px; border: 1px solid black">Kgs</td>
          <td style="padding-left: 2px; width: 90px; border: 1px solid black">Oper</td>
          <td style="padding-left: 2px; width: 25px; border: 1px solid black">Nº</td>
          <td style="padding-left: 2px; width: 35px; border: 1px solid black">Kgs</td>
          <td style="padding-left: 2px; width: 90px; border: 1px solid black">Oper</td>
          <td style="padding-left: 2px; width: 25px; border: 1px solid black">Nº</td>
          <td style="padding-left: 2px; width: 35px; border: 1px solid black">Kgs</td>
        </tr>
        <tr>
          <td style="border: 1px solid black"></td>
          <td style="text-align: right; padding-right: 2px; border: 1px solid black">1</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td style="text-align: right; padding-right: 2px; border: 1px solid black">11</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td style="text-align: right; padding-right: 2px; border: 1px solid black">21</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td style="text-align: right; padding-right: 2px; border: 1px solid black">31</td>
          <td style="border: 1px solid black"></td>
        </tr>
        <tr>
          <td style="border: 1px solid black"></td>
          <td style="text-align: right; padding-right: 2px; border: 1px solid black">2</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td style="text-align: right; padding-right: 2px; border: 1px solid black">12</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td style="text-align: right; padding-right: 2px; border: 1px solid black">22</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td style="text-align: right; padding-right: 2px; border: 1px solid black">32</td>
          <td style="border: 1px solid black"></td>
        </tr>
        <tr>
          <td style="border: 1px solid black"></td>
          <td style="text-align: right; padding-right: 2px; border: 1px solid black">3</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td style="text-align: right; padding-right: 2px; border: 1px solid black">13</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td style="text-align: right; padding-right: 2px; border: 1px solid black">23</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td style="text-align: right; padding-right: 2px; border: 1px solid black">33</td>
          <td style="border: 1px solid black"></td>
        </tr>
        <tr>
          <td style="border: 1px solid black"></td>
          <td style="text-align: right; padding-right: 2px; border: 1px solid black">4</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td style="text-align: right; padding-right: 2px; border: 1px solid black">14</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td style="text-align: right; padding-right: 2px; border: 1px solid black">24</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td style="text-align: right; padding-right: 2px; border: 1px solid black">34</td>
          <td style="border: 1px solid black"></td>
        </tr>
        <tr>
          <td style="border: 1px solid black"></td>
          <td style="text-align: right; padding-right: 2px; border: 1px solid black">5</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td style="text-align: right; padding-right: 2px; border: 1px solid black">15</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td style="text-align: right; padding-right: 2px; border: 1px solid black">25</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td style="text-align: right; padding-right: 2px; border: 1px solid black">35</td>
          <td style="border: 1px solid black"></td>
        </tr>
        <tr>
          <td style="border: 1px solid black"></td>
          <td style="text-align: right; padding-right: 2px; border: 1px solid black">6</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td style="text-align: right; padding-right: 2px; border: 1px solid black">16</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td style="text-align: right; padding-right: 2px; border: 1px solid black">26</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td style="text-align: right; padding-right: 2px; border: 1px solid black">36</td>
          <td style="border: 1px solid black"></td>
        </tr>
        <tr>
          <td style="border: 1px solid black"></td>
          <td style="text-align: right; padding-right: 2px; border: 1px solid black">7</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td style="text-align: right; padding-right: 2px; border: 1px solid black">17</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td style="text-align: right; padding-right: 2px; border: 1px solid black">27</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td style="text-align: right; padding-right: 2px; border: 1px solid black">37</td>
          <td style="border: 1px solid black"></td>
        </tr>
        <tr>
          <td style="border: 1px solid black"></td>
          <td style="text-align: right; padding-right: 2px; border: 1px solid black">8</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td style="text-align: right; padding-right: 2px; border: 1px solid black">18</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td style="text-align: right; padding-right: 2px; border: 1px solid black">28</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td style="text-align: right; padding-right: 2px; border: 1px solid black">38</td>
          <td style="border: 1px solid black"></td>
        </tr>
        <tr>
          <td style="border: 1px solid black"></td>
          <td style="text-align: right; padding-right: 2px; border: 1px solid black">9</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td style="text-align: right; padding-right: 2px; border: 1px solid black">19</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td style="text-align: right; padding-right: 2px; border: 1px solid black">29</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td style="text-align: right; padding-right: 2px; border: 1px solid black">39</td>
          <td style="border: 1px solid black"></td>
        </tr>
        <tr>
          <td style="border: 1px solid black"></td>
          <td style="text-align: right; padding-right: 2px; border: 1px solid black">10</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td style="text-align: right; padding-right: 2px; border: 1px solid black">20</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td style="text-align: right; padding-right: 2px; border: 1px solid black">30</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td style="text-align: right; padding-right: 2px; border: 1px solid black">40</td>
          <td style="border: 1px solid black"></td>
        </tr>
        <tr>
          <td colspan="2" style="border: 1px solid black">Total Kgs</td>
          <td style="border: 1px solid black"></td>
          <td colspan="2" style="border: 1px solid black">Total Kgs</td>
          <td style="border: 1px solid black"></td>
          <td colspan="2" style="border: 1px solid black">Total Kgs</td>
          <td style="border: 1px solid black"></td>
          <td colspan="2" style="border: 1px solid black">Total Kgs</td>
          <td style="border: 1px solid black"></td>
        </tr>
        <tr style="border: 1px solid black; border-bottom: 0px;">
          <td colspan="12" style="height: 25px; padding-left: 4px; padding-top:10px;">Total Kgs Extrusora: __________</td>
        </tr>
    </table>
    {{-- IMPRESION --}}
    <table style="width: 100%; border-collapse: collapse; border: 1px solid black; border-top-width:0px;">
      <tr style="border: 2px solid black; border-top-width:1px">
        <th colspan="5" style="background-color: rgb(247, 224, 221); font-size: 18px; font-family: Tahoma, Verdana, sans-serif; font-weight: bold">
          IMPRESION
        </th>
      </tr>
      <tr style="border: 1px solid black; border-bottom: 0px;">
        <td colspan="5" style="height: 20px;padding-left: 4px; padding-top:13px; border-bottom: 1px solid rgb(177, 176, 176); ">Obs.: <span style="font-size: 12px;">{{ $reg->observaciones_impresion }}</span></td>
      </tr>

      <tr style="border: 1px solid black; border-bottom: 1px solid rgb(177, 176, 176);">
        <td colspan="2" style="height: 20px; padding-left: 4px; padding-top:10px">Inicio Impresión: ___/___/______</td>
        <td colspan="3" style="height: 20px; padding-top:10px; text-align: center">Fin Impresión: ___/___/______</td>
      </tr>

      <tr style="border: 1px solid black; border-bottom: 0px;">
        <td colspan="5" style="height: 15px;padding-left: 4px; padding-top:13px; border-bottom: 0px;">Tratado: 
          {{ $reg->tratado_nombre }}
        </td>
      </tr>
      <tr style="border: 1px solid black; border-bottom: 0px; border-top: 0px;">
        <td colspan="5" style="height: 15px;padding-left: 4px; padding-top:13px; border-bottom: 0px">Cantidad Colores:
          <span style="color: rgb(177, 176, 176);">____________</span>
        </td>
      </tr>
      <tr style="border: 1px solid black; border-bottom: 0px;  border-top: 0px;">
        <td colspan="5" style="height: 15px;padding-left: 4px; padding-top:13px; border-bottom: 0px; padding-bottom: 5px">
          Colores: {{ $reg->color_nombre_1 }} - {{ $reg->color_nombre_2 }} - {{ $reg->color_nombre_3 }} - {{ $reg->color_nombre_4 }} 
        </td>
      </tr>
      {{-- <tr style="border: 1px solid black; border-bottom: 0px;  border-top: 0px;">
        <td colspan="5" style="height: 5px;padding-left: 4px; padding-top:13px; border-bottom: 1px solid rgb(177, 176, 176); "></td>
      </tr> --}}
    </table>
    {{-- CORTE --}}
    <table style="width: 100%; border-collapse: collapse; border: 1px solid black; border-top-width:0px">
      <tr style="border: 2px solid black; border-top-width:1px">
        <th colspan="6" style="background-color: rgb(247, 224, 221); font-size: 18px; font-family: Tahoma, Verdana, sans-serif; font-weight: bold">
          CORTE
        </th>
      </tr>
      <tr style="border: 1px solid black; border-bottom: 0px;">
        <td colspan="6" style="height: 20px;padding-left: 4px; padding-top:13px; border-bottom: 1px solid rgb(177, 176, 176); ">Obs.: <span style="font-size: 12px;">{{ $reg->observaciones_corte }}</span></td>
      </tr>
      <tr style="border: 1px solid black; border-bottom: 0px;">
        <td colspan="3" style="height: 25px; padding-left: 4px; padding-top:10px">Inicio Corte: ___/___/______<</td>
        <td colspan="3" style="height: 25px; padding-top:10px; text-align: center">Fin Corte: ___/___/______</td>
      </tr>
      <tr>
        <td style="padding-left: 2px; width: 20%; border: 1px solid black">Operador</td>
        <td style="padding-left: 2px; width: 15%; border: 1px solid black"></td>
        <td style="padding-left: 2px; width: 15%; border: 1px solid black"></td>
        <td style="padding-left: 2px; width: 15%; border: 1px solid black"></td>
        <td style="padding-left: 2px; width: 15%; border: 1px solid black"></td>
        <td style="padding-left: 2px; width: 15%; border: 1px solid black"></td>
      </tr>
      <tr>
        <td style="text-align: left; padding-left: 3px; border: 1px solid black">Cantidad</td>
        <td style="border: 1px solid black"></td>
        <td style="text-align: left; padding-left: 3px; border: 1px solid black"></td>
        <td style="border: 1px solid black"></td>
        <td style="border: 1px solid black"></td>
        <td style="border: 1px solid black"></td>
      </tr>
      <tr>
        <td style="text-align: left; padding-left: 3px; border: 1px solid black">Bultos</td>
        <td style="border: 1px solid black"></td>
        <td style="text-align: left; padding-left: 3px; border: 1px solid black"></td>
        <td style="border: 1px solid black"></td>
        <td style="border: 1px solid black"></td>
        <td style="border: 1px solid black"></td>
      </tr>
      <tr>
        <td style="text-align: left; padding-left: 3px; border: 1px solid black">Bobinas</td>
        <td style="border: 1px solid black"></td>
        <td style="text-align: left; padding-left: 3px; border: 1px solid black"></td>
        <td style="border: 1px solid black"></td>
        <td style="border: 1px solid black"></td>
        <td style="border: 1px solid black"></td>
      </tr>
      <tr>
        <td style="text-align: left; padding-left: 3px; border: 1px solid black">Corte</td>
        <td style="border: 1px solid black"></td>
        <td style="text-align: left; padding-left: 3px; border: 1px solid black"></td>
        <td style="border: 1px solid black"></td>
        <td style="border: 1px solid black"></td>
        <td style="border: 1px solid black"></td>
      </tr>
      <tr style="border: 1px solid black; border-bottom: 0px; border-top: 0px;">
        <td colspan="6" style="height: 30px; padding-left: 4px; padding-top:10px;">Total Bolsas Cortadas: __________</td>
      </tr>
    </table>
  </div>
  </body>
</html>