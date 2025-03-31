<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class RolController extends Controller
{
    private $response = [
        'status' => 'ok',
        'message' => null,
        'data' => []
    ];

    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $query = Rol::query();


        // Busqueda basica por nombre o identificador
        // if ($request->has('search') && $request->search !='') {
        //     $query->where('name', 'like', '%' . $request->search . '%')
        //         ->orwhere('identifiers','like', '%' . $request->search . '%');

        // }
        $this->response['data'] = $query->get();
        return response()->json($this->response, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) //recibe un post , recibe solo body , crea un objeto
    {
        try {
			$rol = Rol::create([
				'name' => $request['name'],
				
			]);


			if (!$rol) {
				$this->response['status'] = 'error';
                $this->response['message'] = 'no se Creo el usuario';
                return response()->json($this->response, 500);
			}

		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

        $this->response['data'] = $rol;

        return response()->json($this->response, 200);
    }


    /**
     * Display the specified resource.
     */
    public function show($id) // consulta un solo objeto, solo get con el id en la url
    {
        $rol = Rol::find($id);
        if(!$rol)
        {
            $this->response['status'] = 'error';
            $this->response['message'] = 'no se encontro el tipo de identificación';
            return response()->json($this->response, 400);
        }

        $this->response['data'] = $rol;
        return response()->json($this->response, 200);
    }

    
    public function update(Request $request, $id) // post , recibe body y id en la url
    {
        try {

            $rol = Rol::find($id);

            if (!$rol) {
                $this->response['status'] = 'error';
                $this->response['message'] = 'no se encontro el tipo de rol';
                return response()->json($this->response, 400);
            }

			$rol->update([
				'name' => $request['name'],
				'value' => $request['value'],
			]);


		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

        $this->response['data'] = $rol;

        return response()->json($this->response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) //post , recibe solo id en la url
    {
        $rol = Rol::find($id);

        if(!$rol){
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha encontrado el rol';
            return response()->json($this->response, 400);
        }

        if($rol->delete()){
            $this->response['data'] = $rol;
            return response()->json($this->response, 200);
        }
        else{
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha eliminado el rol';
            return response()->json($this->response, 400);
        }
    }
}
