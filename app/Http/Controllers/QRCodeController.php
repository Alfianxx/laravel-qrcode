<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRCodeController extends Controller
{
    //
    public function create() : View
    {
        return view('qr-code');
    }

    public function generateQrCode(Request $request) 
    {

        if ($request->data) {
            $qrCode = QrCode::generate($request->data);
            return back()->with('qrCode', $qrCode);

        }

        // jika ingin menyimpan imnage di folder public/images
        // QrCode::generate($request->data, public_path('images/qrcode.png'));

    }
}
