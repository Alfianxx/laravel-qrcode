<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class QRCodeController extends Controller
{
    //
    public function create() : View
    {
        return view('qr-code');
    }

    public function generateQrCode(Request $request) 
    {

        $request->validate([
            'data' => 'required|string'
        ]);

        $data = $request->input('data');

        // Generate QR code SVG
        $qrCode = QrCode::size(300)->generate($data);

        // Kirim QR code ke view
        return back()->with('qrCode', $qrCode);


        // if ($request->data) {
        //     $qrCode = QrCode::size(150)->generate($request->data);
        //     return back()->with('qrCode', $qrCode);

        // }



    }
}


        // jika ingin menyimpan imnage di folder public/images
        // QrCode::generate($request->data, public_path('images/qrcode.png'));