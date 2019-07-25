<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Elibyy\TCPDF\Facades\TCPDF;
use PDF;

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
            dd('Error!!', $e);
            return redirect('/');
        }
    }
}
