<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  </head>
  <body style="font-size: 18px; font-family: Tahoma, Verdana, sans-serif;">
      {{-- HEADER OT --}}
      <table style="width: 1050px; border-collapse: collapse">
        <tr style="border: 1px solid black;">
          <th style="border-right: 0px; border-bottom: 2px solid black; width: 450px; text-align: left;">
            <img src="img/logo_ot_3.png" style="padding: 2px;">
          </th>
          <th colspan="2" style="border-left: 0px; border-bottom: 2px solid black; width: 600px; font-size: 24px; font-family: Tahoma, Verdana, sans-serif; font-weight: bold; text-align: center">
            ORDEN DE TRABAJO
          </th>
        </tr>
        {{-- <tr>
          <td style="width: 450px; padding-left: 4px; border: 1px solid black">Cliente: {{ $razonsocial }}</td>
          <td style="width: 200px; padding-left: 4px; border: 1px solid black">Ancho: {{ $ancho }}</td>
          <td style="width: 400px; padding-left: 4px; border: 1px solid black">Cant. Bolsas {{ $cantidad_bolsas }}</td>
        </tr>
        <tr>
          <td style="padding-left: 4px; border: 1px solid black">Trabajo: {{ $trabajo_nombre }}</td>
          <td style="padding-left: 4px; border: 1px solid black">Largo: {{ $largo }}</td>
          <td style="padding-left: 4px; border: 1px solid black">Metros: {{ $metros }}</td>
        </tr> --}}
        {{-- <tr>
          <td style="padding-left: 4px; border: 1px solid black">Mes: Mayo</td>
          <td style="padding-left: 4px; border: 1px solid black">Espesor: {{ $ot->espesor }}</td>
          <td style="padding-left: 4px; border: 1px solid black">Peso (Kg): {{ $ot->peso }}</td>
        </tr>
        <tr>
          <td style="padding-left: 4px; border: 1px solid black">Nº Orden: {{ $ot->numero_ot }}</td>
          <td style="padding-left: 4px; border: 1px solid black">Material: {{ $ot->material_nombre }}</td>
          <td style="padding-left: 4px; border: 1px solid black">Tipo de Corte: {{ $ot->corte_nombre }}</td>
        </tr>
        <tr>
          <td style="padding-left: 4px; border: 1px solid black">Fecha de Pedido: {{ $ot->fecha_pedido }}</td>
          <td style="padding-left: 4px; border: 1px solid black">Tipo: </td>
          <td style="padding-left: 4px; border: 1px solid black">Obs: </td>
        </tr>
        <tr>
          <td style="padding-left: 4px; border: 1px solid black">Fecha de Entrega: {{ $ot->fecha_entrega }}</td>
          <td style="padding-left: 4px; border: 1px solid black">Tratado: {{ $ot->tratado_nombre }}</td>
          <td style="padding-left: 4px; border: 1px solid black"></td>
        </tr> --}}
      </table>
    
    {{-- EXTRUSION --}}
    <table style="width: 1050px; border-collapse: collapse; border: 1px solid black; border-top-width:0px">
        <tr style="border: 2px solid black; border-top-width:1px">
          <th colspan="12" style="background-color: rgb(247, 224, 221); font-size: 20px; font-family: Tahoma, Verdana, sans-serif; font-weight: bold">
            EXTRUSIÓN
          </th>
        </tr>
        <tr style="height: 50px; border: 1px solid black; border-bottom: 0px;">
          <td colspan="7" style="padding-left: 4px; padding-top:13px">Máquina Nº: _________</td>
          <td colspan="5"style="padding-top:13px; text-align: center">Fecha Extrusión: ___/___/______</td>
        </tr>
        <tr>
          <td style="padding-left: 2px; width: 100px; border: 1px solid black">Oper</td>
          <td style="padding-left: 2px; width: 25px; border: 1px solid black">Nº</td>
          <td style="padding-left: 2px; width: 40px; border: 1px solid black">Kgs</td>
          <td style="padding-left: 2px; width: 100px; border: 1px solid black">Oper</td>
          <td style="padding-left: 2px; width: 25px; border: 1px solid black">Nº</td>
          <td style="padding-left: 2px; width: 40px; border: 1px solid black">Kgs</td>
          <td style="padding-left: 2px; width: 100px; border: 1px solid black">Oper</td>
          <td style="padding-left: 2px; width: 25px; border: 1px solid black">Nº</td>
          <td style="padding-left: 2px; width: 40px; border: 1px solid black">Kgs</td>
          <td style="padding-left: 2px; width: 100px; border: 1px solid black">Oper</td>
          <td style="padding-left: 2px; width: 25px; border: 1px solid black">Nº</td>
          <td style="padding-left: 2px; width: 40px; border: 1px solid black">Kgs</td>
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
        <tr style="height: 50px; border: 1px solid black; border-bottom: 0px;">
          <td colspan="12" style="padding-left: 4px; padding-top:10px;">Total Kgs Extrusora: __________</td>
        </tr>
    </table>

    {{-- IMPRESION --}}
    <table style="width: 1050px; border-collapse: collapse; border: 1px solid black; border-top-width:0px">
      <tr style="border: 2px solid black; border-top-width:1px">
        <th colspan="5" style="background-color: rgb(247, 224, 221); font-size: 20px; font-family: Tahoma, Verdana, sans-serif; font-weight: bold">
          IMPRESION
        </th>
      </tr>
      <tr style="height: 50px; border: 1px solid black; border-bottom: 0px;">
        <td colspan="2" style="padding-left: 4px; padding-top:13px">Nº Bobinas: _________</td>
        <td colspan="3" style="padding-top:13px; text-align: center">Fecha Impresión: ___/___/______</td>
      </tr>
      <tr>
        <td style="padding-left: 2px; width: 25px; border: 1px solid black">Nº</td>
        <td style="padding-left: 2px; width: 250px; border: 1px solid black">Color Frente</td>
        <td style="padding-left: 2px; width: 25px; border: 1px solid black">Nº</td>
        <td style="padding-left: 2px; width: 250px; border: 1px solid black">Color Dorso</td>
        <td style="padding-left: 2px; width: 500px;"></td>
      </tr>
      <tr>
        <td style="text-align: right; padding-right: 2px; border: 1px solid black">1</td>
        <td style="border: 1px solid black"></td>
        <td style="text-align: right; padding-right: 2px; border: 1px solid black">1</td>
        <td style="border: 1px solid black"></td>
        <td style=""></td>
      </tr>
      <tr>
        <td style="text-align: right; padding-right: 2px; border: 1px solid black">2</td>
        <td style="border: 1px solid black"></td>
        <td style="text-align: right; padding-right: 2px; border: 1px solid black">2</td>
        <td style="border: 1px solid black"></td>
        <td style=""></td>

      </tr>
      <tr>
        <td style="text-align: right; padding-right: 2px; border: 1px solid black">3</td>
        <td style="border: 1px solid black"></td>
        <td style="text-align: right; padding-right: 2px; border: 1px solid black">3</td>
        <td style="border: 1px solid black"></td>
        <td style=""></td>

      </tr>
      <tr>
        <td style="text-align: right; padding-right: 2px; border: 1px solid black">4</td>
        <td style="border: 1px solid black"></td>
        <td style="text-align: right; padding-right: 2px; border: 1px solid black">4</td>
        <td style="border: 1px solid black"></td>
        <td style=""></td>

      </tr>
      <tr style="height: 50px; border: 1px solid black; border-bottom: 0px; border-top: 0px;">
        <td colspan="5" style="padding-left: 4px; padding-top:10px;">Total Kgs Extrusora: __________</td>
      </tr>
    </table>

    {{-- CORTE --}}
    <table style="width: 1050px; border-collapse: collapse; border: 1px solid black; border-top-width:0px">
      <tr style="border: 2px solid black; border-top-width:1px">
        <th colspan="5" style="background-color: rgb(247, 224, 221); font-size: 20px; font-family: Tahoma, Verdana, sans-serif; font-weight: bold">
          CORTE
        </th>
      </tr>
      <tr style="height: 50px; border: 1px solid black; border-bottom: 0px;">
        <td colspan="2" style="padding-left: 4px; padding-top:13px">Nº Bobinas: _________</td>
        <td colspan="3" style="padding-top:13px; text-align: center">Fecha Corte: ___/___/______</td>
      </tr>
      <tr>
        <td style="padding-left: 2px; width: 120px; border: 1px solid black">Operador</td>
        <td style="padding-left: 2px; width: 200px; border: 1px solid black"></td>
        <td style="padding-left: 2px; width: 200px; border: 1px solid black"></td>
        <td style="padding-left: 2px; width: 200px; border: 1px solid black"></td>
        <td style="padding-left: 2px; width: 200px;"></td>
      </tr>
      <tr>
        <td style="text-align: left; padding-left: 3px; border: 1px solid black">Cantidad</td>
        <td style="border: 1px solid black"></td>
        <td style="text-align: left; padding-left: 3px; border: 1px solid black"></td>
        <td style="border: 1px solid black"></td>
        <td style=""></td>
      </tr>
      <tr>
        <td style="text-align: left; padding-left: 3px; border: 1px solid black">Bultos</td>
        <td style="border: 1px solid black"></td>
        <td style="text-align: left; padding-left: 3px; border: 1px solid black"></td>
        <td style="border: 1px solid black"></td>
        <td style=""></td>

      </tr>
      <tr>
        <td style="text-align: left; padding-left: 3px; border: 1px solid black">Bobinas</td>
        <td style="border: 1px solid black"></td>
        <td style="text-align: left; padding-left: 3px; border: 1px solid black"></td>
        <td style="border: 1px solid black"></td>
        <td style=""></td>

      </tr>
      <tr>
        <td style="text-align: left; padding-left: 3px; border: 1px solid black">Corte</td>
        <td style="border: 1px solid black"></td>
        <td style="text-align: left; padding-left: 3px; border: 1px solid black"></td>
        <td style="border: 1px solid black"></td>
        <td style=""></td>

      </tr>
      <tr style="height: 50px; border: 1px solid black; border-bottom: 0px; border-top: 0px;">
        <td colspan="5" style="padding-left: 4px; padding-top:10px;">Total Bolsas Cortadas: __________</td>
      </tr>
    </table>

  </body>
</html>