<?php

namespace App\Http\Controllers;

use App\Models\Price;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    private $response = [
        'status' => 'ok',
        'message' => 'null',
        'data' => []

    ];


    public function index()
    {
        $query = Price::query();


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
			$Price = Price::create([
				'name' => $request['name'],
				'manual' => $request['manual'],
                'value' => $request['value'],
                'person_extra' => $request['person_extra'],

			]);


			if (!$Price) {
				$this->response['status'] = 'error';
                $this->response['message'] = 'no se encontro el precio ';
                return response()->json($this->response, 500);
			}

		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

        $this->response['data'] = $Price;

        return response()->json($this->response, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id) // consulta un solo objeto, solo get con el id en la url
    {
        $Price = Price::find($id);
        if(!$Price)
        {
            $this->response['status'] = 'error';
            $this->response['message'] = 'no se encontro el precio';
            return response()->json($this->response, 400);
        }

        $this->response['data'] = $Price;
        return response()->json($this->response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Price $price)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) // post , recibe body y id en la url
    {
        try {

            $price = Price::find($id);

            if (!$price) {
                $this->response['status'] = 'error';
                $this->response['message'] = 'no se actualizado el precio';
                return response()->json($this->response, 400);
            }

			$price->update([
				'name' => $request['name'],
				'manual'=> $request['manual'],
                'value'=> $request['value'],
                'person_extra' => $request['person_extra'],
			]);


		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

        $this->response['data'] = $price;

        return response()->json($this->response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) //post , recibe solo id en la url
    {
        $price = Price::find($id);

        if(!$price){
            $this->response['status'] = 'error';
            $this->response['message'] = 'No hay precio';
            return response()->json($this->response, 400);
        }

        if($price->delete()){
            $this->response['data'] = $price;
            return response()->json($this->response, 200);
        }
        else{
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha eliminado el precio';
            return response()->json($this->response, 400);
        }
    }
}

