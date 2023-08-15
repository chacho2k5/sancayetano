<?php

namespace App\Http\Controllers\Reportes;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

use Dompdf\Dompdf;
use Dompdf\Options;

class OtReport extends Controller
{
    public function index($id) {
        // dd($id);

        // dd(asset('img/logo_ot_3.png'));

        $ot = Pedido::find($id);
        $reporte = 'OT_' . $ot->numero_ot . '.pdf';
        $logo = asset('img/logo_ot_3.png');

        return view('reportes.ot-report', compact('ot'));



        // // $pdf = Pdf::loadView('reportes.ot-report',['ot' => $ot]);
        // // return $pdf->stream($reporte);
        // // return $pdf->download($reporte);

        // // $pdf->loadHTML('<h1>PROBANDO PDF</h1>');

        // // $pdf = Pdf::loadView('reportes.ot-report',['ot' => $ot, 'logo' => $logo]);
        // $pdf = Pdf::loadView('reportes.ot-report', compact('ot'));
        
        // return $pdf->stream('reporte.pdf');

        // // return view('reportes.ot-report', compact('ot', 'logo'));

        // $options = new Options();
        // $options->set('defaultFont', 'Courier');
        // $dompdf = new Dompdf($options); 

        $html = <<<EOF
        <div class="container" style="width: 1050px;">
        <table style="width: 100%; border-collapse: collapse">
        <thead>
          <tr>
            <th class="col-6" style="border-right: 0px; border-bottom: 2px solid black">
              <img src=$logo>
            </th>
            <th class="col-6 text-left font-weight-bold" colspan="2" style="font-size: 22px; font-family: sans-serif, Tahoma, Verdana; font-weight: bold; border-left: 0px; border-bottom: 2px solid black">
              <h2>ORDEN DE TRABAJO</h2>
            </th>
          </tr>
        </thead>
        <tbody style="font-family: sans-serif, Tahoma, Verdana;">
          <tr>
            <td class="pl-1" scope="row" style="width: 400px; border: 1px solid black">Cliente: $ot->razonsocial </td>
            <td class="pl-1" style="width: 200px; border: 1px solid black">Ancho: $ot->ancho</td>
            <td class="pl-1" style="width: 200px; border: 1px solid black">Cant. Bolsas $ot->cantidad_bolsas</td>
          </tr>
          <tr>
            <td class="pl-1" scope="row" style="border: 1px solid black">Trabajo: $ot->trabajo_nombre</td>
            <td class="pl-1" style="border: 1px solid black">Largo: $ot->largo</td>
            <td class="pl-1" style="border: 1px solid black">Metros: $ot->metros</td>
          </tr>
          <tr>
            <td class="pl-1" scope="row" style="border: 1px solid black">Mes: Junio</td>
            <td class="pl-1" style="border: 1px solid black">Espesor: $ot->espesor</td>
            <td class="pl-1" style="border: 1px solid black">Peso (Kg): $ot->peso</td>
          </tr>
          <tr>
            <td class="pl-1" scope="row" style="border: 1px solid black">Nº Orden: $ot->numero_ot</td>
            <td class="pl-1" style="border: 1px solid black">Material: $ot->material_nombre</td>
            <td class="pl-1" style="border: 1px solid black">Tipo de Corte: $ot->corte_nombre</td>
          </tr>
          <tr>
            <td class="pl-1" scope="row" style="border: 1px solid black">Fecha de Pedido: $ot->fecha_pedido</td>
            <td class="pl-1" style="border: 1px solid black">Tipo: </td>
            <td class="pl-1" style="border: 1px solid black">Obs: </td>
          </tr>
          <tr>
            <td class="pl-1" scope="row" style="border: 1px solid black">Fecha de Entrega: $ot->fecha_entrega</td>
            <td class="pl-1" style="border: 1px solid black">Tratado: $ot->tratado_nombre</td>
            <td style="border: 1px solid black"></td>
          </tr>
            </tbody>
          </table>
           <div style="width: 1050px; padding: 5px; text-align: center; background-color: rgb(247, 224, 221); border: 1px solid black; font-size: 20px; font-family: sans-serif, Tahoma, Verdana; font-weight: bold">EXTRUSIÓN</div>
           <table style="width: 1050px; border-collapse: collapse; font-family: sans-serif, Tahoma, Verdana;">
           <tbody>
             <tr style="height: 40px;">
               <td class="col-6" style="border: 1px solid black">Máquina Nº: _________</td>
               <td class="col-6" style="border-left: 0px solid black">Fecha Extrusión: ___/___/______</th>
             </tr>
           </tbody>
           </table>
           <table style="width: 1050px; border-collapse: collapse">
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
         </div>
        EOF;

        $dompdf = new Dompdf();
        
        $options = $dompdf->getOptions();
        $options->setDefaultFont('Serif');
        $dompdf->setOptions($options);
        
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();

        // return view('reportes.ot-report');


    }
}
