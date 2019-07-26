<?php

namespace App\Http\Controllers;

use PDF;
use Session;
use Signature;
use App\Http\Requests;
use Illuminate\Http\Request;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function tcpdfTest()
    {
        try {
            /* Start Print Function */
            $name = "John";
            $view = \View::make('test.pdf_test', compact('name'));
            $html = $view->render();
            $pdf  = new TCPDF();

            $pdf::SetTitle('Testing TCPDF');
            $pdf::AddPage();
            $pdf::writeHTML($html, true, false, true, false, '');
            $pdf::Output('pdf_testing.pdf');
            /* End Print Function */
        } catch (\Exception $e) {
            return redirect('/');
        }
    }

    /* Display signature pad form */
    public function createSignatureTest()
    {
        try {
            return view('test.signature_test');
        } catch (\Exception $e) {
            return redirect('/');
        }
    }

    /* Store the image from signature pad in public/signature_images folder */
    public function saveSignatureTest(Request $request)
    {
        $data_uri = $request->signature;

        $encoded_image = explode(",", $data_uri)[1];
        $decoded_image = base64_decode($encoded_image);


        $path = public_path() . "/signature_images/";

        if (!file_exists($path)) {
            // If the folder does not exist, create it with write permissions
            mkdir($path, 0777, TRUE);
        }

        // set unique file name
        $file_name = uniqid() . ".png";

        // store the file
        file_put_contents($path . $file_name, $decoded_image);

        return back();
    }
}
