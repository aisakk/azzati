<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

use chillerlan\QRCode\QRCode;

class Controller extends BaseController
{
    //
    public function generateQrCode(Request $request){

        $text = 'Nombre: '. $request->nombre .' Cantidad: '.$request->cantidad. ' Telefono: '.$request->telefono;
        $qrcode = new QRCode();

         return response()->json([
            "status"=> 200,
            "message"=> "Exitosa la conexion",
            "data" => $qrcode->render($text)
         ]);
    }
}
