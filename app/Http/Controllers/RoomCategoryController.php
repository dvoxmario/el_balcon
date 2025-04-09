<?php

namespace App\Http\Controllers;

use App\Models\RoomCategory;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class RoomCategoryController extends Controller
{
    private $response = [
        'status' => 'ok',
        'message' => 'null',
        'data' => []

    ];


    public function index()
    {
        $query = RoomCategory::query();


        // Busqueda basica por nombre o identificador
        // if ($request->has('search') && $request->search !='') {
        //     $query->where('name', 'like', '%' . $request->search . '%')
        //         ->orwhere('identifiers','like', '%' . $request->search . '%');

        // }
        $this->response['data'] = $query->get();
        return response()->json($this->response, 200);
    }
    public function create()
    {
        //
    }

    public function store(Request $request) //recibe un post , recibe solo body , crea un objeto
    {
        try {
			$roomC = RoomCategory::create([
				'name' => $request['name'],
				'price_id' => $request['price_id'],
                'description' => $request['description'],
                

			]);


			if (!$roomC) {
				$this->response['status'] = 'error';
                $this->response['message'] = 'no se encuentra esta categoria';
                return response()->json($this->response, 500);
			}

		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

        $this->response['data'] = $roomC;

        return response()->json($this->response, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id) // consulta un solo objeto, solo get con el id en la url
    {
        $roomC = RoomCategory::find($id);
        if(!$roomC)
        {
            $this->response['status'] = 'error';
            $this->response['message'] = 'no se encontro la habitacion con esta categoria';
            return response()->json($this->response, 400);
        }

        $this->response['data'] = $roomC;
        return response()->json($this->response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoomCategory $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) // post , recibe body y id en la url
    {
        try {

            $roomC = RoomCategory::find($id);

            if (!$roomC) {
                $this->response['status'] = 'error';
                $this->response['message'] = 'no se encontro el tipo de habitacion';
                return response()->json($this->response, 400);
            }

			$roomC->update([
				'name' => $request['name'],
				'price_id' => $request['price_id'],
                'description' => $request['description'],
			]);


		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

        $this->response['data'] = $roomC;

        return response()->json($this->response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) //post , recibe solo id en la url
    {
        $roomC = RoomCategory::find($id);

        if(!$roomC){
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha encontrado la habitacion de esta categoria';
            return response()->json($this->response, 400);
        }

        if($roomC->delete()){
            $this->response['data'] = $roomC;
            return response()->json($this->response, 200);
        }
        else{
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha eliminado el tipo de categoria';
            return response()->json($this->response, 400);
        }
    }
}
