<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAlbisteakRequest;
use App\Models\Albisteak;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class AlbisteakController extends Controller
{ //get
    public function index(Request $request){
        $perPage = $request->query("per_page", 10);
        $page = $request->query("page", 0);
        $offset = $page * $perPage;

        $albisteak = Albisteak::skip($offset)->take($perPage)->get();
        return response()->json($albisteak);
    }
//post
    public function store(Request $request){

        try{
        $validateData = $request->validate([
            'izenburua' => 'required|string|max:255',
            'laburpena' => 'required|string|max:255',
            'xehetasunak' =>'required|string|max:255'
            // 'precio' => 'required|numeric',
        ],[
            "izenburua.required" => 'izenburua es obligatorio',
            "izenburua.string" => 'izenburua karakteke kate bat izan behar da',
            "laburpena.required" => 'laburpena es obligatorio',
            "laburpena.string" => 'izenburua karakteke kate bat izan behar da',
            "xehetasunak.required" => 'xehetasunak es obligatorio',
            "xehetasunak.string" => 'xehetasunak karakteke kate bat izan behar da'
        ]);
        $albisteak = Albisteak::create($validateData);

        return response()->json($albisteak);
        }catch(ValidationException $e){
            return response()->json(["error" => $e->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
//update
    public function update(UpdateAlbisteakRequest $request, Albisteak $albisteak){
        try{
        $validatedData = $request->validated();
        $albisteak->update($validatedData);

        return response()->json(["message" => "albistea ongi aktualizatua","albistea" =>$albisteak]);
        }catch(Exception $e){
            return response()->json(["error" => $e], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function destroy(Albisteak $albisteak){
        $albisteak->delete();
        return response()->json(["message" => "albistea ezabatua"]);
    }
}

