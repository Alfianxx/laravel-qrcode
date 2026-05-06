<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class QRCodeController extends Controller
{
    
    public function create() : View
    {
        return view('qr-code');
    }


    //coba fungsi claude (cara lama)
    // public function generateQrCode(Request $request)
    // {
    //     $request->validate([
    //         'data' => 'required|string'
    //     ]);

    //     $data = $request->input('data');
    //     $qrCode = QrCode::size(200)->errorCorrection('L')->generate($data);

    //     // Konversi HtmlString ke string biasa sebelum simpan ke session
    //     return back()->with('qrCode', (string) $qrCode);
    // }
}


        // jika ingin menyimpan imnage di folder public/images
        // QrCode::generate($request->data, public_path('images/qrcode.png'));