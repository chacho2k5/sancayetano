<?php

namespace App\Http\Controllers\Reportes;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class PdfReport extends Controller
{
    public function index($id) {

        // $registros = Pedido::find($id);
        $registros = Pedido::all()->where('id',$id);
        $reporte = 'OT_' . $id . '.pdf';
        // $reporte = 'OT_' . $registros->numero_ot . '.pdf';
        // $logo = asset('img/logo_ot_3.png');

        // dd($reporte);
        // return view('reportes.pdf', compact('registros'));

        $pdf = Pdf::loadView('reportes.pdf', compact('registros'));
        return $pdf->stream($reporte);
    }
}
