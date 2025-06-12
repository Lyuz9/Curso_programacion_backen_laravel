<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class BackendController extends Controller
{
    private $names = [
        1 => ['name' => 'Luis', 'age' => 22],
        2 => ['name' => 'Gabriel', 'age' => 22],
        3 => ['name' => 'Lyuz', 'age' => 22],
        4 => ['name' => 'Gabo', 'age' => 22]
    ];

    public function getAll(){
        return response()->json($this->names);
    }

    public function get(int $id = 0){
        if(isset($this->names[$id])){
            return response()->json($this->names[$id]);
        } else {
            return response()->json(["error" => "No existe el id"], Response::HTTP_NOT_FOUND);
        }
    }

    public function create(Request $request){
        $person = [
            'id' => count($this->names) + 1,
            "name" => $request->input("name"),
            "age" => $request->input("age")
        ];
        $this->names[$person["id"]] = $person;

        return response()->json(["message" => "Persona registrada", "person" => $person],
        Response::HTTP_CREATED);
    }
/*
    public function get($id){
        return response()->json([
            'id' => $id,
            'success' => true,
            'message' => 'Hola',
        ]);
    }
*/

    /*
    funcion publica para enviar parametros opcionales:
    en el parametro $id simplemente colocamos antes int, posteriormente definimos que $id sea igual a 0: int $id = 0

    asi si es que no definimos id en la url, el valor por defecto sera 0:

    public function get(int $id = 0){
        return response()->json([
            'id' => $id,
            'success' => true,
            'message' => 'Hola',
        ]);
    }
    */
    public function update(Request $request, $id){
        if(isset($this->names[$id])){
            $this->names["name"] = $request->input("name");
            $this->names["age"] = $request->input("age");

            return response()->json(["message" => "Usuario actualizado", "person" => $this->names[$id]]);
        }
        return response()->json(["error" => "No existe el id"], Response::HTTP_NOT_FOUND);
    }

    public function delete(int $id){
        if(isset($this->names[$id])){
            unset($this->names[$id]);
            return response()->json(["message" => "Registro eliminado"]);
        }
        return response()->json(["error" => "El registro no existe"], Response::HTTP_NOT_FOUND);
    }
}
