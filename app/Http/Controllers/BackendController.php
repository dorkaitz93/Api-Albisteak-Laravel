<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
class BackendController extends Controller
{
    private $names=[
        1 =>['name' => 'ana', 'age' =>30],
        2 =>['name' => 'dorki', 'age' =>32],
        3 =>['name' => 'gorka', 'age' =>24],
    ];

    public function getAll(){
        return response()->json($this->names);
    }
    
    public function get(int $id = 0){
        if(isset($this->names[$id])){
            return response()->json($this->names[$id]);
        }

        return response()->json(["error"=> "Persona no existente"], Response::HTTP_NOT_FOUND);
    }

    public function create(Request $request){
        $person = [
            "id" => count($this->names) + 1,
            "name" => $request->input("name"),
            "age" => $request->input("age")
        ];
        $this->names[$person["id"]] = $person;

        return response()->json(["message"=> "Persona Creada", "person" => $person], 
        Response::HTTP_CREATED);
    }

    public function update(Request $request, int $id){
        if(isset($this->names[$id])){
            $this->names[$id]["name"] = $request->input("name", $this->names[$id]["name"]);
            $this->names[$id]["age"] = $request->input("age", $this->names[$id]["age"]);

            return response()->json(
                ['message'=>'Persona Actualziza',
                'person' =>$this->names[$id]]);
        }
        return response()->json(["error"=> "Persona no existe"], Response::HTTP_NOT_FOUND);
    }

    public function delete(int $id){
        if(isset($this->names[$id])){
            unset($this->names[$id]);
            return response()->json(["message"=> "Persona Eliminada"]);
        }
        return response()->json(["error"=> "Persona no existe"], Response::HTTP_NOT_FOUND);
    }
}
