<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\User_rol;
use App\Models\UserRol;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class UserRolController extends Controller
{
    
    private $response = [
        'status' => 'ok',
        'message' => null,
        'data' => []
    ];

    public function index()//consultar en bloque ofiltro,get sin nada en la url , talvez body
    {
        $query = UserRol::query();





    $this->response['data'] = $query->get();
    return response()->json($this->response, 2000);
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $UserRol = UserRol::create([
                'name' => $request['name'],
                'rol_id' => $request['rol_id'],

            ]);

            if (!$UserRol) {
                $this->response['status'] = 'error';
                $this->response['message'] = 'no se creo el tipo de Rol';
            }

        } catch(QueryException $e){
            return response()->json($this->response, 500);
        }

        $this->response['data'] = $UserRol;
        return response()->json($this->response, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id) 
    {
        $UserRol = UserRol::find($id);
        if(!$UserRol)
        {
            $this->response['status'] = 'error';
            $this->response['message'] = 'no se encontró  el tipo de usuario  rol ';
            return response()->json($this->response, 400);
        }

        $this->response['data'] = $UserRol;
        return response()->json($this->response, 200);
    }

    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserRol $UserRol)
    {
        
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $UserRol = $UserRol::find($id);

            if(!$UserRol) {
                $this->response['status'] = 'error';
                $this->response['message'] = 'no se encontro el tipo usuario';
                return response()->json($this->response, 400);


            }
            $UserRol->update([
                'name' => $request['name'],
                'rol_id'=>$request['rol_id'],
            ]);
            
           
		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

        $this->response['data'] = $UserRol;

        return response()->json($this->response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) //post , recibe solo id en la url
    {
        $UserRol = UserRol::find($id);

        if(!$UserRol){
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha encontrado el Tipo de identificacion';
            return response()->json($this->response, 400);
        }

        if($UserRol->delete()){
            $this->response['data'] = $UserRol;
            return response()->json($this->response, 200);
        }
        else{
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha eliminado el Tipo de identificacion';
            return response()->json($this->response, 400);
        }
    }
}
