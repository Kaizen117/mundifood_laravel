<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class PDFController extends Controller
{    
    public function index(){
        //$dishes=DB::select('SELECT DISTINCT d.id, d.name, d.image, d.description, d.price FROM dishes d');
        $dishesEntrantes=DB::table('dishes')
                ->where('category', 'Entrantes')
                ->orderBy('name', 'asc')
                ->get();
        $dishesSoups=DB::table('dishes')
                ->where('category', 'Sopas')
                ->orderBy('name', 'asc')
                ->get();        
        $dishesMeats=DB::table('dishes')
                ->where('category', 'Carnes')
                ->orderBy('name', 'asc')
                ->get();
        $dishesFish=DB::table('dishes')
                ->where('category', 'Pescados')
                ->orderBy('name', 'asc')
                ->get();       
        $dishesDrinks=DB::table('dishes')
                ->where('category', 'Bebidas')
                ->orderBy('name', 'asc')
                ->get();
        $dishesDesserts=DB::table('dishes')
                ->where('category', 'Postres')
                ->orderBy('name', 'asc')
                ->get();
        $dishesWines=DB::table('dishes')
                ->where('category', 'Vinos')
                ->orderBy('name', 'asc')
                ->get();
        $dishesOthers=DB::table('dishes')
                ->where('category', 'Otros')
                ->orderBy('name', 'asc')
                ->get();
        $pdf=\PDF::loadView('pdf', compact(/*'dishes', */'dishesEntrantes', 'dishesSoups', 'dishesMeats', 'dishesFish', 'dishesDrinks', 'dishesDesserts', 'dishesWines', 'dishesOthers'));
        return $pdf->stream();
        //return $pdf->download('MundiF00d_carta.pdf'); 
    }   
}
