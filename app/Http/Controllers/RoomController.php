<?php

namespace App\Http\Controllers;

use App\Models\room;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class RoomController extends Controller
{
    private $response = [
        'status' => 'ok',
        'message' => null,
        'data' => []
    ];
    public function index()
    {
        $query = Room::query();




        $this->response['data']=$query->get();
        return response()->json($this->response, 200);
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
			$room = Room::create([
		        'number_occupants' =>request('name'),
                 'descripcion_extra' => request('descripcion_extra'),
                'number' => request('number'),
                'room_category_id' => request('room_category_id'),

			]);


			if (!$room) {
				$this->response['status'] = 'error';
                $this->response['message'] = 'no se encontro habitacion';
                return response()->json($this->response, 500);
			}

		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

        $this->response['data'] = $room;

        return response()->json($this->response, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $room = Room::find($id);
        if(!$room)
        {
            $this->response['status'] = 'error';
            $this->response['message'] = 'no se encontro el tipo de habitacion';
            return response()->json($this->response, 400);
        }

        $this->response['data'] = $room;
        return response()->json($this->response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, room $room,$id)
    {
        try {

            $room = Room::find($id);

            if (!$room) {
                $this->response['status'] = 'error';
                $this->response['message'] = 'no se encontro el tipo de habitacion';
                return response()->json($this->response, 400);
            }

			$room->update([
				'number_occupants' =>request('number_occupants'),
                 'descripcion_extra' => request('descripcion_extra'),
                'number' => request('number'),
                'room_category_id' => request('room_category_id'),

			]);


		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

        $this->response['data'] = $room;

        return response()->json($this->response, 200); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(room $room)
    {
        $user = Room::find($room);

        if(!$room){
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha encontrado la habitacion';
            return response()->json($this->response, 400);
        }

        if($room->delete()){
            $this->response['data'] = $room;
            return response()->json($this->response, 200);
        }
        else{
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha eliminado el usuario';
            return response()->json($this->response, 400);
        }
    }
}
