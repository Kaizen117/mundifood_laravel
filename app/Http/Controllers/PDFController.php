<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Dish;
use PDF;
//use PDFS;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
       //
    }

    public function dishes(){ 
        $dishes=DB::select('SELECT DISTINCT d.name, d.image, d.description, d.price FROM dishes d');                          
        $pdf=\PDF::loadView('pdf', compact('dishes'));
        return $pdf->stream();
        //return $pdf->download('MundiF00d_carta.pdf'); 
    }
}
