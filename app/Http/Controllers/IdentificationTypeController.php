<?php

namespace App\Http\Controllers;

use App\Models\IdentificationType;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class IdentificationTypeController extends Controller
{
    private $response = [
        'status' => 'ok',
        'message' => null,
        'data' => []
    ];
    /**
     * Display a listing of the resource.
     */
    public function index() //consultar en bloque o con filtros //get sin nada en la url , talvez body
    {
        $query = IdentificationType::query();

        // if($request['search'] && $request['search'] != 'null') {
        //     // Agrupar los where like
        //     $query->where(function ($q) use ($request) {
        //         $q->orWhere('nombre', 'like', '%'.$request['search'].'%');
        //         $q->orWhere('nombre_corto', 'like', '%'.$request['search'].'%');
        //     });
        // }

        $this->response['data'] = $query->get();
        return response()->json($this->response, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) //recibe un post , recibe solo body , crea un objeto
    {
        try {
			$IdentificationType = IdentificationType::create([
				'name' => $request['name'],
				'value' => $request['value'],
			]);


			if (!$IdentificationType) {
				$this->response['status'] = 'error';
                $this->response['message'] = 'no se Creo el tipo de identificacion';
                return response()->json($this->response, 500);
			}

		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

        $this->response['data'] = $IdentificationType;

        return response()->json($this->response, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id) // consulta un solo objeto, solo get con el id en la url
    {
        $tiposIdentificacion = IdentificationType::find($id);
        if(!$tiposIdentificacion)
        {
            $this->response['status'] = 'error';
            $this->response['message'] = 'no se encontro el tipo de identificación';
            return response()->json($this->response, 400);
        }

        $this->response['data'] = $tiposIdentificacion;
        return response()->json($this->response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IdentificationType $identificationType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) // post , recibe body y id en la url
    {
        try {

            $IdentificationType = IdentificationType::find($id);

            if (!$IdentificationType) {
                $this->response['status'] = 'error';
                $this->response['message'] = 'no se encontro el tipo de identificacion';
                return response()->json($this->response, 400);
            }

			$IdentificationType->update([
				'name' => $request['name'],
				'value' => $request['value'],
			]);


		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

        $this->response['data'] = $IdentificationType;

        return response()->json($this->response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) //post , recibe solo id en la url
    {
        $IdentificationType = IdentificationType::find($id);

        if(!$IdentificationType){
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha encontrado el Tipo de identificacion';
            return response()->json($this->response, 400);
        }

        if($IdentificationType->delete()){
            $this->response['data'] = $IdentificationType;
            return response()->json($this->response, 200);
        }
        else{
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha eliminado el Tipo de identificacion';
            return response()->json($this->response, 400);
        }
    }
}
