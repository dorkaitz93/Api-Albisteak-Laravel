<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Albisteak;
use Symfony\Component\HttpFoundation\Response;

use function Pest\Laravel\json;

class QueriesController extends Controller
{
    public function get(){
        $albisteak = Albisteak::all();
        return response()->json($albisteak);
    }

    public function getById(int $id){
        $albistea = Albisteak::find($id);

        if(!$albistea){
            return response()->json(["message" => "Producto no encontrado"], Response::HTTP_NOT_FOUND);
        }
        return response()->json($albistea);
    }

    //izenburu artzeko bakarrik
    public function getNames(){
        $albisteak = Albisteak::select("izenburua")
        ->orderBy("izenburua")
        ->get();

        return response()->json($albisteak);
    }

    public function searchName(string $izenburua, string $laburpena){
        $albisteak = Albisteak::where("izenburua", $izenburua)
        ->where("laburpena", "=", $laburpena)
        ->get();

        return response()->json($albisteak);
    }
}
