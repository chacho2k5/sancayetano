<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
    <style>
      table, th {
        /* border: 2px solid black; */
        border-top: 2px solid black;
        border-bottom: 1px solid black;
        border-left: 2px solid black;
        border-right: 2px solid black;
        border-collapse: collapse;
      }

      /* td {
        border: 2px solid black;
        border-collapse: collapse;
      } */ 

    </style>
  </head>
  <body style="font-size: 18px; font-family: Tahoma, Verdana, sans-serif;">
    <div class="container" style="width: 1150px;">
    <table style="width: 100%">
      <thead>
        <tr>
          <th class="col-6" style="border-right: 0px; border-bottom: 2px solid black">
            {{-- <img src="{{ asset('img/logo_ot_3.png') }}" alt="Logo de la empresa" class="img-fluid"> --}}
            <img src="img/logo_ot_3.png" alt="Logo de la empresa" class="img-fluid">
          </th>
          <th class="col-6 text-left font-weight-bold" colspan="2" style="border-left: 0px; border-bottom: 2px solid black">
            <h2>ORDEN DE TRABAJO</h2>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="pl-1" scope="row" style="width: 400px; border: 1px solid black">Cliente: {{ $ot->razonsocial }}</td>
          <td class="pl-1" style="width: 200px; border: 1px solid black">Ancho: {{ $ot->ancho }}</td>
          <td class="pl-1" style="width: 200px; border: 1px solid black">Cant. Bolsas {{ $ot->cantidad_bolsas }}</td>
        </tr>
        <tr>
          <td class="pl-1" scope="row" style="border: 1px solid black">Trabajo: {{ $ot->trabajo_nombre }}</td>
          <td class="pl-1" style="border: 1px solid black">Largo: {{ $ot->largo }}</td>
          <td class="pl-1" style="border: 1px solid black">Metros: {{ $ot->metros }}</td>
        </tr>
        <tr>
          <td class="pl-1" scope="row" style="border: 1px solid black">Mes: Mayo</td>
          <td class="pl-1" style="border: 1px solid black">Espesor: {{ $ot->espesor }}</td>
          <td class="pl-1" style="border: 1px solid black">Peso (Kg): {{ $ot->peso }}</td>
        </tr>
        <tr>
          <td class="pl-1" scope="row" style="border: 1px solid black">Nº Orden: {{ $ot->numero_ot }}</td>
          <td class="pl-1" style="border: 1px solid black">Material: {{ $ot->material_nombre }}</td>
          <td class="pl-1">Tipo de Corte: {{ $ot->corte_nombre }}</td>
        </tr>
        <tr>
          <td class="pl-1" scope="row" style="border: 1px solid black">Fecha de Pedido: {{ $ot->fecha_pedido }}</td>
          <td class="pl-1" style="border: 1px solid black">Tipo: </td>
          <td class="pl-1" style="border: 1px solid black">Obs: </td>
        </tr>
        <tr>
          <td class="pl-1" scope="row" style="border: 1px solid black">Fecha de Entrega: {{ $ot->fecha_entrega }}</td>
          <td class="pl-1" style="border: 1px solid black">Tratado: {{ $ot->tratado_nombre }}</td>
          <td></td>
        </tr>
      </tbody>
    </table>
    {{-- EXTRUSION --}}
    <div style="width: 100%; background-color: rgb(247, 224, 221); border: 1px solid black; font-size: 20px; font-family: Tahoma, Verdana, sans-serif; font-weight: bold" class="text-center">EXTRUSIÓN</div>
    {{-- Cabecera Extrusion     --}}
    <div class="row m-0" style="width: 100%; height: 50px; border: 1px solid black; border-bottom: 0px;">
      <div class="col-6 pt-3 pl-2">
        <div>Máquina Nº: _________</div>
      </div>
      <div class="col-6 pt-3">
        <div>Fecha Extrusión: ___/___/______</div>
      </div>
    </div>
    {{-- Tabla Extrusion --}}
    <table style="width: 100%">
      <tbody>
        <tr>
          <td class="pl-1" style="width: 180px; border: 1px solid black">Oper</td>
          <td class="text-center" style="width: 30px; border: 1px solid black">Nº</td>
          <td class="pl-1" style="width: 70px; border: 1px solid black">Kgs</td>
          <td class="pl-1" style="width: 180px; border: 1px solid black">Oper</td>
          <td class="text-center" style="width: 30px; border: 1px solid black">Nº</td>
          <td class="pl-1" style="width: 70px; border: 1px solid black">Kgs</td>
          <td class="pl-1" style="width: 180px; border: 1px solid black">Oper</td>
          <td class="text-center"style="width: 30px; border: 1px solid black">Nº</td>
          <td class="pl-1" style="width: 70px; border: 1px solid black">Kgs</td>
          <td class="pl-1" style="width: 180px; border: 1px solid black">Oper</td>
          <td class="text-center" style="width: 30px; border: 1px solid black">Nº</td>
          <td class="pl-1" style="width: 70px; border: 1px solid black">Kgs</td>
        </tr>
        <tr>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">1</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">11</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">21</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">31</td>
          <td style="border: 1px solid black"></td>
        </tr>
        <tr>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">2</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">12</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">22</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">32</td>
          <td style="border: 1px solid black"></td>
        </tr>
        <tr>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">3</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">13</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">23</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">33</td>
          <td style="border: 1px solid black"></td>
        </tr>
        <tr>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">4</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">14</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">24</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">34</td>
          <td style="border: 1px solid black"></td>
        </tr>
        <tr>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">5</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">15</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">25</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">35</td>
          <td style="border: 1px solid black"></td>
        </tr>
        <tr>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">6</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">16</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">26</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">36</td>
          <td style="border: 1px solid black"></td>
        </tr>
        <tr>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">7</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">17</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">27</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">37</td>
          <td style="border: 1px solid black"></td>
        </tr>
        <tr>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">8</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">18</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">28</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">38</td>
          <td style="border: 1px solid black"></td>
        </tr>
        <tr>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">9</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td  class="text-center"style="border: 1px solid black">19</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">29</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">39</td>
          <td style="border: 1px solid black"></td>
        </tr>
        <tr>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">10</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td class="text-center"style="border: 1px solid black">20</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">30</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">40</td>
          <td style="border: 1px solid black"></td>
        </tr>
        <tr>
          <td class="p-2" colspan="2" style="border: 1px solid black">Total Kgs</td>
          <td style="border: 1px solid black"></td>
          <td class="p-2" colspan="2" style="border: 1px solid black">Total Kgs</td>
          <td style="border: 1px solid black"></td>
          <td class="p-2" colspan="2" style="border: 1px solid black">Total Kgs</td>
          <td style="border: 1px solid black"></td>
          <td class="p-2" colspan="2" style="border: 1px solid black">Total Kgs</td>
          <td style="border: 1px solid black"></td>
        </tr>
        <tr>
          <td class="p-2" colspan="12" style="height: 40px; border: 1px solid black">Total Kgs Extrusora: __________</td>
          
        </tr>
      </tbody>
    </table>

    {{-- IMPRESION --}}
    <div style="width: 100%; background-color: rgb(247, 224, 221); border: 1px solid black; font-size: 20px; font-family: Tahoma, Verdana, sans-serif; font-weight: bold" class="text-center">IMPRESIÓN</div>
    {{-- Cabecera Impresion     --}}
    <div class="row m-0" style="width: 100%; height: 50px; border: 1px solid black; border-bottom: 0px;">
      <div class="col-6 pt-3 pl-2">
        <div>Nº Bobinas: _________</div>
      </div>
      <div class="col-6 pt-3">
        <div>Fecha Impresión: ___/___/______</div>
      </div>
    </div>
    {{-- Tabla Impresion --}}
    <table style="width: 100%">
      <tbody>
        <tr>
          <td class="pl-1" style="width: 40px; border: 1px solid black">Nº</td>
          <td class="pl-1" style="width: 200px; border: 1px solid black">Color Frente</td>
          <td class="pl-1" style="width: 40px; border: 1px solid black">Nº</td>
          <td class="pl-1" style="width: 200px; border: 1px solid black">Color Dorso</td>
          <td style="border: 0px solid black"></td>
        </tr>
        <tr>
          <td class="text-center" style="border: 1px solid black">1</td>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">1</td>
          <td style="border: 1px solid black"></td>
        </tr>
        <tr>
          <td class="text-center" style="border: 1px solid black">2</td>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">2</td>
          <td style="border: 1px solid black"></td>
        </tr>
        <tr>
          <td class="text-center" style="border: 1px solid black">3</td>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">3</td>
          <td style="border: 1px solid black"></td>
        </tr>
        <tr>
          <td class="text-center" style="border: 1px solid black">4</td>
          <td style="border: 1px solid black"></td>
          <td class="text-center" style="border: 1px solid black">4</td>
          <td style="border: 1px solid black"></td>
        </tr>

        <tr>
          <td class="p-2" colspan="12" style="height: 40px; border: 1px solid black">Total Metros Impreso: __________</td>
        </tr>
      </tbody>
    </table>

    {{-- CORTE --}}
    <div style="width: 100%; background-color: rgb(247, 224, 221); border: 1px solid black; font-size: 20px; font-family: Tahoma, Verdana, sans-serif; font-weight: bold" class="text-center">CORTE</div>
    {{-- Cabecera Corte     --}}
    <div class="row m-0" style="width: 100%; height: 50px; border: 1px solid black; border-bottom: 0px;">
      <div class="col-6 pt-3 pl-2">
        <div>Nº Bobinas: _________</div>
      </div>
      <div class="col-6 pt-3">
        <div>Fecha Corte: ___/___/______</div>
      </div>
    </div>
    {{-- Tabla Corte --}}
    <table style="width: 100%">
      <tbody>
        <tr>
          <td class="pl-1" style="width: 100px; border: 1px solid black">Operador</td>
          <td style="width: 200px; border: 1px solid black"></td>
          <td style="width: 200px; border: 1px solid black"></td>
          <td style="width: 200px; border: 1px solid black"></td>
          <td style="width: 200px; border: 1px solid black"></td>
          <td style="border: 0px"></td>
        </tr>
        <tr>
          <td class="pl-1" style="border: 1px solid black">Cantidad</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
        </tr>
        <tr>
          <td class="pl-1" style="border: 1px solid black">Bultos</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
        </tr>
        <tr>
          <td class="pl-1" style="border: 1px solid black">Bobinas</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
        </tr>
        <tr>
          <td class="pl-1" style="border: 1px solid black">Corte</td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
          <td style="border: 1px solid black"></td>
        </tr>

        <tr>
          <td class="p-2" colspan="12" style="height: 40px; border: 1px solid black">Total Bolsas Cortadas: __________</td>
        </tr>
      </tbody>
    </table>

    </div>





  </body>
</html>