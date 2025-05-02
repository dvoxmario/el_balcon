<?php

namespace App\Http\Controllers;

use App\Models\IncomeDetail;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class IncomeDetailDetailController extends Controller
{
    private $response = [
        'status' => 'ok',
        'message' => 'null',
        'data' => []

    ];


    public function index()
    {
        $query = IncomeDetail::query();


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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
			$IncomeDetail = IncomeDetail::create([
				'amount' => $request['amount'],
                'price' => $request['price'],
                'income_id' => $request['income_id'],
                'product_id' => $request['product_id'],

			]);


			if (!$IncomeDetail) {
				$this->response['status'] = 'error';
                $this->response['message'] = 'no se Creo el  detalle de ingreso';
                return response()->json($this->response, 500);
			}

		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

        $this->response['data'] = $IncomeDetail;

        return response()->json($this->response, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $IncomeDetail = IncomeDetail::find($id);
    if(!$IncomeDetail)
        {
            $this->response['status'] = 'error';
            $this->response['message'] = 'no se encontro el detalle de ingreso';
            return response()->json($this->response, 400);
        }

        $this->response['data'] = $IncomeDetail;
        return response()->json($this->response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IncomeDetail $IncomeDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {

            $IncomeDetail = IncomeDetail::find($id);

            if (!$IncomeDetail) {
                $this->response['status'] = 'error';
                $this->response['message'] = 'no se encontro el detalle de ingreso';
                return response()->json($this->response, 400);
            }

			$IncomeDetail->update([
				'amount' => $request['amount'],
                'price' => $request['price'],
                'income_id' => $request['income_id'],
                'product_id' => $request['product_id'],
			]);


		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

        $this->response['data'] = $IncomeDetail;

        return response()->json($this->response, 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $IncomeDetail = IncomeDetail::find($id);

        if(!$IncomeDetail){
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha encontrado el detalle de ingreso';
            return response()->json($this->response, 400);
        }

        if($IncomeDetail->delete()){
            $this->response['data'] = $IncomeDetail;
            return response()->json($this->response, 200);
        }
        else{
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha eliminado el detalle de ingreso';
            return response()->json($this->response, 400);
        }
    }
}
