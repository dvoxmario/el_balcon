<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ReservationController extends Controller
{
    private $response = [
        'status' => 'ok',
        'message' => 'null',
        'data' => []
    ];

    public function index()
    {
        $query = Reservation::query();


        // Busqueda basica por nombre o identificador
        // if ($request->has('search') && $request->search !='') {
        //     $query->where('name', 'like', '%' . $request->search . '%')
        //         ->orwhere('identifiers','like', '%' . $request->search . '%');

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
    public function store(Request $request)
    {
        try {
            // falta aqui obtener el usuario logueado para sacar el id y ponerlo en la siguiente varivle
            $user_login = 1;
            // se debe remplazar dinamicamente, se deja quemado 1
			$reservation = Reservation::create([
				'reservation_start_date' => $request['reservation_start_date'],
				'reservation_finish_date' => $request['reservation_finish_date'],
                'number_occupants' => $request['number_occupants'],
                'check_in' => $request['check_in'],
                'check_out' => $request['check_out'],
                'client_id' => $request['client_id'],
                'room_id' => $request['room_id'],
                'responsible_id' => $user_login,

			]);


			if (!$reservation) {
				$this->response['status'] = 'error';
                $this->response['message'] = 'no se Creo la reservacion';
                return response()->json($this->response, 500);
			}

		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

        $this->response['data'] = $reservation;

        return response()->json($this->response, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $reservation = Reservation::find($id);
        if(!$reservation)
        {
            $this->response['status'] = 'error';
            $this->response['message'] = 'no se encontro el tipo de reserva';
            return response()->json($this->response, 400);
        }

        $this->response['data'] = $reservation;
        return response()->json($this->response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation, $id)
    {
        {
            try {
    
                $reservation = Reservation::find($id);
    
                if (!$reservation) {
                    $this->response['status'] = 'error';
                    $this->response['message'] = 'no se encontro el tipo de reserva';
                    return response()->json($this->response, 400);
                }
    
                $reservation->update([
                    'reservation_start_date' => $request['reservation_start_date'],
                    'reservation_finish_date' => $request['reservation_finish_date'],
                    'number_occupants' => $request['number_occupants'],
                    'check_in' => $request['check_in'],
                    'check_out' => $request['check_out'],
                    'user_id' => $request['user_id'],
                    'room_id' => $request['room_id']
                ]);
    
    
            } catch (QueryException $e) {
                return $this->response['message'] = $e->getMessage();
            }
    
            $this->response['data'] = $reservation;
    
            return response()->json($this->response, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)

    {
        $reservation = Reservation::find($id);

        if(!$reservation){
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha encontrado la reserva';
            return response()->json($this->response, 400);
        }

        if($reservation->delete()){
            $this->response['data'] = $reservation;
            return response()->json($this->response, 200);
        }
        else{
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha eliminado la reserva';
            return response()->json($this->response, 400);
        }
    }
}
